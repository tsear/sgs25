/**
 * Forms Component
 * Handles form validation, submission, and interactions
 */

export class Forms {
  constructor() {
    this.forms = [];
    this.init();
  }

  init() {
    this.registerForms();
    this.setupGlobalFormHandlers();
  }

  registerForms() {
    // Register contact forms
    const contactForms = document.querySelectorAll('.contact-form, .newsletter-form, .search-form');
    contactForms.forEach(form => this.registerForm(form));

    // Register any form with data-sgs-form attribute
    const customForms = document.querySelectorAll('[data-sgs-form]');
    customForms.forEach(form => this.registerForm(form));
  }

  registerForm(formElement) {
    if (!formElement || this.forms.find(f => f.element === formElement)) {
      return; // Already registered or doesn't exist
    }

    const formData = {
      element: formElement,
      type: this.getFormType(formElement),
      validation: this.getValidationRules(formElement),
      isSubmitting: false
    };

    this.forms.push(formData);
    this.bindFormEvents(formData);
  }

  getFormType(form) {
    if (form.classList.contains('contact-form')) return 'contact';
    if (form.classList.contains('newsletter-form')) return 'newsletter';
    if (form.classList.contains('search-form')) return 'search';
    return form.dataset.sgsForm || 'generic';
  }

  getValidationRules(form) {
    const rules = {};
    const inputs = form.querySelectorAll('input, textarea, select');

    inputs.forEach(input => {
      const fieldRules = {};
      
      if (input.hasAttribute('required')) {
        fieldRules.required = true;
      }
      
      if (input.type === 'email') {
        fieldRules.email = true;
      }
      
      if (input.type === 'tel') {
        fieldRules.phone = true;
      }
      
      if (input.minLength) {
        fieldRules.minLength = input.minLength;
      }
      
      if (input.maxLength) {
        fieldRules.maxLength = input.maxLength;
      }
      
      if (input.pattern) {
        fieldRules.pattern = new RegExp(input.pattern);
      }

      if (Object.keys(fieldRules).length > 0) {
        rules[input.name] = fieldRules;
      }
    });

    return rules;
  }

  bindFormEvents(formData) {
    const { element } = formData;

    // Form submission
    element.addEventListener('submit', (e) => {
      this.handleFormSubmit(e, formData);
    });

    // Real-time validation on blur
    const inputs = element.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
      input.addEventListener('blur', () => {
        this.validateField(input, formData.validation[input.name]);
      });

      input.addEventListener('input', () => {
        // Clear validation state on input
        this.clearFieldValidation(input);
      });
    });

    // Special handling for specific form types
    if (formData.type === 'search') {
      this.bindSearchFormEvents(formData);
    }
  }

  handleFormSubmit(event, formData) {
    event.preventDefault();

    if (formData.isSubmitting) return;

    const { element, type } = formData;
    const isValid = this.validateForm(formData);

    if (!isValid) {
      this.showFormError(element, 'Please correct the errors above.');
      return;
    }

    this.submitForm(formData);
  }

  validateForm(formData) {
    const { element, validation } = formData;
    let isValid = true;

    Object.keys(validation).forEach(fieldName => {
      const input = element.querySelector(`[name="${fieldName}"]`);
      if (input && !this.validateField(input, validation[fieldName])) {
        isValid = false;
      }
    });

    return isValid;
  }

  validateField(input, rules) {
    if (!rules) return true;

    const value = input.value.trim();
    let isValid = true;
    let errorMessage = '';

    // Required validation
    if (rules.required && !value) {
      errorMessage = 'This field is required.';
      isValid = false;
    }

    // Email validation
    if (rules.email && value && !this.isValidEmail(value)) {
      errorMessage = 'Please enter a valid email address.';
      isValid = false;
    }

    // Phone validation
    if (rules.phone && value && !this.isValidPhone(value)) {
      errorMessage = 'Please enter a valid phone number.';
      isValid = false;
    }

    // Minimum length
    if (rules.minLength && value && value.length < rules.minLength) {
      errorMessage = `Minimum ${rules.minLength} characters required.`;
      isValid = false;
    }

    // Maximum length
    if (rules.maxLength && value && value.length > rules.maxLength) {
      errorMessage = `Maximum ${rules.maxLength} characters allowed.`;
      isValid = false;
    }

    // Pattern validation
    if (rules.pattern && value && !rules.pattern.test(value)) {
      errorMessage = 'Please enter a valid format.';
      isValid = false;
    }

    // Update field UI
    if (isValid) {
      this.markFieldValid(input);
    } else {
      this.markFieldInvalid(input, errorMessage);
    }

    return isValid;
  }

  markFieldValid(input) {
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
    this.removeFieldError(input);
  }

  markFieldInvalid(input, message) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    this.showFieldError(input, message);
  }

  clearFieldValidation(input) {
    input.classList.remove('is-valid', 'is-invalid');
    this.removeFieldError(input);
  }

  showFieldError(input, message) {
    this.removeFieldError(input);

    const errorElement = document.createElement('div');
    errorElement.className = 'invalid-feedback';
    errorElement.textContent = message;

    const formGroup = input.closest('.form-group') || input.parentNode;
    formGroup.appendChild(errorElement);
  }

  removeFieldError(input) {
    const formGroup = input.closest('.form-group') || input.parentNode;
    const existingError = formGroup.querySelector('.invalid-feedback');
    if (existingError) {
      existingError.remove();
    }
  }

  async submitForm(formData) {
    const { element, type } = formData;
    
    try {
      formData.isSubmitting = true;
      this.setFormLoading(element, true);

      const formDataObj = new FormData(element);
      const data = Object.fromEntries(formDataObj);

      // Add form type and nonce
      data.action = `sgs_submit_${type}`;
      data.nonce = window.sgsAjax?.nonce || '';

      const response = await this.sendAjaxRequest(data);

      if (response.success) {
        this.handleFormSuccess(element, response.data);
      } else {
        this.handleFormError(element, response.data.message || 'An error occurred.');
      }

    } catch (error) {
      console.error('Form submission error:', error);
      this.handleFormError(element, 'Network error. Please try again.');
    } finally {
      formData.isSubmitting = false;
      this.setFormLoading(element, false);
    }
  }

  async sendAjaxRequest(data) {
    const response = await fetch(window.sgsAjax?.ajaxurl || '/wp-admin/admin-ajax.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: new URLSearchParams(data)
    });

    return await response.json();
  }

  handleFormSuccess(form, data) {
    this.showFormSuccess(form, data.message || 'Thank you! Your message has been sent.');
    
    // Reset form after success
    setTimeout(() => {
      form.reset();
      this.clearFormValidation(form);
    }, 2000);
  }

  handleFormError(form, message) {
    this.showFormError(form, message);
  }

  setFormLoading(form, isLoading) {
    const submitBtn = form.querySelector('[type="submit"], .btn-submit');
    
    if (isLoading) {
      form.classList.add('form-loading');
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.classList.add('btn-loading');
        this.setButtonLoadingState(submitBtn, true);
      }
    } else {
      form.classList.remove('form-loading');
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.classList.remove('btn-loading');
        this.setButtonLoadingState(submitBtn, false);
      }
    }
  }

  setButtonLoadingState(button, isLoading) {
    if (isLoading) {
      const originalText = button.textContent;
      button.dataset.originalText = originalText;
      button.innerHTML = '<span class="btn-text">Sending...</span>';
    } else {
      const originalText = button.dataset.originalText;
      if (originalText) {
        button.textContent = originalText;
      }
    }
  }

  showFormSuccess(form, message) {
    this.removeFormMessages(form);
    
    const alertElement = this.createAlert(message, 'success');
    form.insertBefore(alertElement, form.firstChild);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
      if (alertElement.parentNode) {
        alertElement.remove();
      }
    }, 5000);
  }

  showFormError(form, message) {
    this.removeFormMessages(form);
    
    const alertElement = this.createAlert(message, 'error');
    form.insertBefore(alertElement, form.firstChild);
  }

  createAlert(message, type) {
    const alert = document.createElement('div');
    alert.className = `alert alert-${type}`;
    alert.innerHTML = `
      <span class="alert-message">${message}</span>
      <button type="button" class="alert-close" aria-label="Close">×</button>
    `;
    
    // Close button functionality
    alert.querySelector('.alert-close').addEventListener('click', () => {
      alert.remove();
    });
    
    return alert;
  }

  removeFormMessages(form) {
    const existingAlerts = form.querySelectorAll('.alert');
    existingAlerts.forEach(alert => alert.remove());
  }

  clearFormValidation(form) {
    const inputs = form.querySelectorAll('input, textarea, select');
    inputs.forEach(input => this.clearFieldValidation(input));
  }

  bindSearchFormEvents(formData) {
    const { element } = formData;
    const searchInput = element.querySelector('input[type="search"], input[name="s"]');
    
    if (searchInput) {
      // Live search functionality (optional)
      let searchTimeout;
      
      searchInput.addEventListener('input', () => {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
          this.handleLiveSearch(searchInput.value, element);
        }, 300);
      });
    }
  }

  handleLiveSearch(query, form) {
    // Implement live search if needed
    if (query.length < 3) return;
    
    // Could implement AJAX search results here
    console.log('Live search for:', query);
  }

  setupGlobalFormHandlers() {
    // Handle dynamic forms added after page load
    document.addEventListener('sgs:form-added', (event) => {
      this.registerForm(event.detail.form);
    });
  }

  // Utility methods
  isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  isValidPhone(phone) {
    const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
    const cleanPhone = phone.replace(/[\s\-\(\)\.]/g, '');
    return phoneRegex.test(cleanPhone);
  }

  // Public methods
  addForm(formElement, options = {}) {
    if (options.type) {
      formElement.dataset.sgsForm = options.type;
    }
    this.registerForm(formElement);
  }

  removeForm(formElement) {
    const index = this.forms.findIndex(f => f.element === formElement);
    if (index > -1) {
      this.forms.splice(index, 1);
    }
  }

  validateFormById(formId) {
    const formElement = document.getElementById(formId);
    const formData = this.forms.find(f => f.element === formElement);
    
    if (formData) {
      return this.validateForm(formData);
    }
    
    return false;
  }

  destroy() {
    this.forms.forEach(formData => {
      this.clearFormValidation(formData.element);
    });
    
    this.forms = [];
  }
}
