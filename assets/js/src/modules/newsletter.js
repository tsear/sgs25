export default function initNewsletter() {
  const forms = Array.from(document.querySelectorAll('.newsletter-form__form'));
  if (!forms.length) return;

  const isValidEmail = (email) => /[^@\s]+@[^@\s]+\.[^@\s]+/.test(email);

  const setMessage = (el, text, type = '') => {
    if (!el) return;
    el.textContent = text || '';
    el.className = `newsletter-form__message${type ? ` newsletter-form__message--${type}` : ''}`;
  };

  forms.forEach((form) => {
    const emailInput = form.querySelector('input[name="email"]');
    const submitBtn = form.querySelector('button[type="submit"]');
    const msgEl = form.querySelector('.newsletter-form__message');

    if (!emailInput || !submitBtn) return;

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const email = (emailInput.value || '').trim();

      if (!isValidEmail(email)) {
        setMessage(msgEl, 'Please enter a valid email address.', 'error');
        emailInput.focus();
        return;
      }

      submitBtn.disabled = true;
      setMessage(msgEl, 'Submitting...', 'info');

      try {
        const fd = new FormData();
        fd.append('action', 'sgs_newsletter_signup');
        fd.append('nonce', (window.sgs_ajax && window.sgs_ajax.nonce) || '');
        fd.append('email', email);

        const res = await fetch((window.sgs_ajax && window.sgs_ajax.ajax_url) || '/wp-admin/admin-ajax.php', {
          method: 'POST',
          body: fd,
          credentials: 'same-origin',
        });

        const data = await res.json();
        if (data && data.success) {
          setMessage(msgEl, (data.data && data.data.message) || 'Thank you for subscribing!', 'success');
          form.reset();
        } else {
          const err = (data && data.data && data.data.message) || 'Sorry, something went wrong. Please try again.';
          setMessage(msgEl, err, 'error');
        }
      } catch (error) {
        setMessage(msgEl, 'Network error. Please try again later.', 'error');
      } finally {
        submitBtn.disabled = false;
      }
    });
  });
}
