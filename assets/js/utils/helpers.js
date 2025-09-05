/**
 * Utility Functions
 * Common helper functions used throughout the theme
 */

export class Utils {
  // DOM manipulation utilities
  static $(selector, context = document) {
    return context.querySelector(selector);
  }

  static $$(selector, context = document) {
    return Array.from(context.querySelectorAll(selector));
  }

  static createElement(tag, attributes = {}, children = []) {
    const element = document.createElement(tag);
    
    // Set attributes
    Object.keys(attributes).forEach(key => {
      if (key === 'className') {
        element.className = attributes[key];
      } else if (key === 'innerHTML') {
        element.innerHTML = attributes[key];
      } else if (key === 'textContent') {
        element.textContent = attributes[key];
      } else {
        element.setAttribute(key, attributes[key]);
      }
    });

    // Add children
    children.forEach(child => {
      if (typeof child === 'string') {
        element.appendChild(document.createTextNode(child));
      } else if (child instanceof HTMLElement) {
        element.appendChild(child);
      }
    });

    return element;
  }

  static removeElement(element) {
    if (element && element.parentNode) {
      element.parentNode.removeChild(element);
    }
  }

  static insertAfter(newElement, referenceElement) {
    referenceElement.parentNode.insertBefore(newElement, referenceElement.nextSibling);
  }

  // Event handling utilities
  static on(element, event, handler, options = {}) {
    if (typeof element === 'string') {
      element = document.querySelector(element);
    }
    
    if (element) {
      element.addEventListener(event, handler, options);
    }
  }

  static off(element, event, handler) {
    if (typeof element === 'string') {
      element = document.querySelector(element);
    }
    
    if (element) {
      element.removeEventListener(event, handler);
    }
  }

  static trigger(element, event, data = {}) {
    if (typeof element === 'string') {
      element = document.querySelector(element);
    }

    if (element) {
      const customEvent = new CustomEvent(event, { detail: data });
      element.dispatchEvent(customEvent);
    }
  }

  static delegate(parent, selector, event, handler) {
    parent.addEventListener(event, (e) => {
      if (e.target.matches(selector) || e.target.closest(selector)) {
        handler.call(e.target, e);
      }
    });
  }

  // Class manipulation utilities
  static addClass(element, className) {
    if (element && className) {
      const classes = className.split(' ');
      element.classList.add(...classes);
    }
  }

  static removeClass(element, className) {
    if (element && className) {
      const classes = className.split(' ');
      element.classList.remove(...classes);
    }
  }

  static toggleClass(element, className) {
    if (element && className) {
      element.classList.toggle(className);
    }
  }

  static hasClass(element, className) {
    return element && element.classList.contains(className);
  }

  // Style utilities
  static setStyle(element, styles) {
    if (element && styles) {
      Object.keys(styles).forEach(property => {
        element.style[property] = styles[property];
      });
    }
  }

  static getStyle(element, property) {
    if (element) {
      return window.getComputedStyle(element)[property];
    }
    return null;
  }

  // Data utilities
  static setData(element, key, value) {
    if (element) {
      element.dataset[key] = value;
    }
  }

  static getData(element, key) {
    if (element) {
      return element.dataset[key];
    }
    return null;
  }

  // Animation utilities
  static fadeIn(element, duration = 300) {
    if (!element) return Promise.resolve();

    return new Promise(resolve => {
      element.style.opacity = '0';
      element.style.display = 'block';

      const start = performance.now();
      
      const animate = (currentTime) => {
        const elapsed = currentTime - start;
        const progress = Math.min(elapsed / duration, 1);
        
        element.style.opacity = progress;
        
        if (progress < 1) {
          requestAnimationFrame(animate);
        } else {
          resolve();
        }
      };
      
      requestAnimationFrame(animate);
    });
  }

  static fadeOut(element, duration = 300) {
    if (!element) return Promise.resolve();

    return new Promise(resolve => {
      const start = performance.now();
      const initialOpacity = parseFloat(window.getComputedStyle(element).opacity);
      
      const animate = (currentTime) => {
        const elapsed = currentTime - start;
        const progress = Math.min(elapsed / duration, 1);
        
        element.style.opacity = initialOpacity * (1 - progress);
        
        if (progress < 1) {
          requestAnimationFrame(animate);
        } else {
          element.style.display = 'none';
          resolve();
        }
      };
      
      requestAnimationFrame(animate);
    });
  }

  static slideUp(element, duration = 300) {
    if (!element) return Promise.resolve();

    return new Promise(resolve => {
      const height = element.offsetHeight;
      element.style.height = `${height}px`;
      element.style.overflow = 'hidden';
      
      const start = performance.now();
      
      const animate = (currentTime) => {
        const elapsed = currentTime - start;
        const progress = Math.min(elapsed / duration, 1);
        
        element.style.height = `${height * (1 - progress)}px`;
        
        if (progress < 1) {
          requestAnimationFrame(animate);
        } else {
          element.style.display = 'none';
          element.style.height = '';
          element.style.overflow = '';
          resolve();
        }
      };
      
      requestAnimationFrame(animate);
    });
  }

  static slideDown(element, duration = 300) {
    if (!element) return Promise.resolve();

    return new Promise(resolve => {
      element.style.display = 'block';
      element.style.height = '0px';
      element.style.overflow = 'hidden';
      
      const targetHeight = element.scrollHeight;
      const start = performance.now();
      
      const animate = (currentTime) => {
        const elapsed = currentTime - start;
        const progress = Math.min(elapsed / duration, 1);
        
        element.style.height = `${targetHeight * progress}px`;
        
        if (progress < 1) {
          requestAnimationFrame(animate);
        } else {
          element.style.height = '';
          element.style.overflow = '';
          resolve();
        }
      };
      
      requestAnimationFrame(animate);
    });
  }

  // Viewport utilities
  static isInViewport(element, threshold = 0) {
    if (!element) return false;

    const rect = element.getBoundingClientRect();
    const windowHeight = window.innerHeight || document.documentElement.clientHeight;
    
    return (
      rect.top >= -threshold &&
      rect.left >= 0 &&
      rect.bottom <= windowHeight + threshold &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  }

  static getViewportSize() {
    return {
      width: window.innerWidth || document.documentElement.clientWidth,
      height: window.innerHeight || document.documentElement.clientHeight
    };
  }

  static getScrollPosition() {
    return {
      x: window.pageXOffset || document.documentElement.scrollLeft,
      y: window.pageYOffset || document.documentElement.scrollTop
    };
  }

  static getElementPosition(element) {
    if (!element) return { x: 0, y: 0 };

    const rect = element.getBoundingClientRect();
    const scroll = this.getScrollPosition();
    
    return {
      x: rect.left + scroll.x,
      y: rect.top + scroll.y
    };
  }

  // String utilities
  static slugify(text) {
    return text
      .toString()
      .toLowerCase()
      .trim()
      .replace(/\s+/g, '-')
      .replace(/[^\w\-]+/g, '')
      .replace(/\-\-+/g, '-')
      .replace(/^-+/, '')
      .replace(/-+$/, '');
  }

  static capitalize(text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
  }

  static camelCase(text) {
    return text.replace(/-([a-z])/g, (match, letter) => letter.toUpperCase());
  }

  static kebabCase(text) {
    return text.replace(/([a-z])([A-Z])/g, '$1-$2').toLowerCase();
  }

  // Number utilities
  static formatNumber(number, options = {}) {
    const defaults = {
      style: 'decimal',
      minimumFractionDigits: 0,
      maximumFractionDigits: 2
    };

    const config = { ...defaults, ...options };
    return new Intl.NumberFormat('en-US', config).format(number);
  }

  static formatCurrency(amount, currency = 'USD') {
    return new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: currency
    }).format(amount);
  }

  static formatPercentage(value, decimals = 1) {
    return `${(value * 100).toFixed(decimals)}%`;
  }

  static clamp(number, min, max) {
    return Math.min(Math.max(number, min), max);
  }

  static lerp(start, end, factor) {
    return start + (end - start) * factor;
  }

  // Array utilities
  static shuffle(array) {
    const newArray = [...array];
    for (let i = newArray.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [newArray[i], newArray[j]] = [newArray[j], newArray[i]];
    }
    return newArray;
  }

  static chunk(array, size) {
    const chunks = [];
    for (let i = 0; i < array.length; i += size) {
      chunks.push(array.slice(i, i + size));
    }
    return chunks;
  }

  static unique(array) {
    return [...new Set(array)];
  }

  // Object utilities
  static deepClone(obj) {
    if (obj === null || typeof obj !== 'object') return obj;
    if (obj instanceof Date) return new Date(obj.getTime());
    if (obj instanceof Array) return obj.map(item => this.deepClone(item));
    if (typeof obj === 'object') {
      const clonedObj = {};
      for (const key in obj) {
        if (obj.hasOwnProperty(key)) {
          clonedObj[key] = this.deepClone(obj[key]);
        }
      }
      return clonedObj;
    }
    return obj;
  }

  static merge(target, ...sources) {
    if (!sources.length) return target;
    const source = sources.shift();

    if (this.isObject(target) && this.isObject(source)) {
      for (const key in source) {
        if (this.isObject(source[key])) {
          if (!target[key]) Object.assign(target, { [key]: {} });
          this.merge(target[key], source[key]);
        } else {
          Object.assign(target, { [key]: source[key] });
        }
      }
    }

    return this.merge(target, ...sources);
  }

  static isObject(item) {
    return item && typeof item === 'object' && !Array.isArray(item);
  }

  // Performance utilities
  static throttle(func, limit) {
    let inThrottle;
    return function() {
      const args = arguments;
      const context = this;
      if (!inThrottle) {
        func.apply(context, args);
        inThrottle = true;
        setTimeout(() => inThrottle = false, limit);
      }
    };
  }

  static debounce(func, delay) {
    let timeoutId;
    return function(...args) {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(() => func.apply(this, args), delay);
    };
  }

  // URL utilities
  static getUrlParameter(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
    const results = regex.exec(url);
    
    if (!results) return null;
    if (!results[2]) return '';
    
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
  }

  static updateUrlParameter(url, param, paramVal) {
    let newAdditionalURL = "";
    let tempArray = url.split("?");
    let baseURL = tempArray[0];
    let additionalURL = tempArray[1];
    let temp = "";
    
    if (additionalURL) {
      tempArray = additionalURL.split("&");
      for (let i = 0; i < tempArray.length; i++) {
        if (tempArray[i].split('=')[0] !== param) {
          newAdditionalURL += temp + tempArray[i];
          temp = "&";
        }
      }
    }
    
    let rows_txt = temp + "" + param + "=" + paramVal;
    return baseURL + "?" + newAdditionalURL + rows_txt;
  }

  // Device detection
  static isMobile() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
  }

  static isTablet() {
    return /iPad|Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) && window.innerWidth >= 768;
  }

  static isDesktop() {
    return !this.isMobile() && !this.isTablet();
  }

  static isTouchDevice() {
    return 'ontouchstart' in window || navigator.maxTouchPoints > 0;
  }

  // Storage utilities
  static setLocalStorage(key, value) {
    try {
      localStorage.setItem(key, JSON.stringify(value));
      return true;
    } catch (error) {
      console.warn('Could not save to localStorage:', error);
      return false;
    }
  }

  static getLocalStorage(key, defaultValue = null) {
    try {
      const item = localStorage.getItem(key);
      return item ? JSON.parse(item) : defaultValue;
    } catch (error) {
      console.warn('Could not read from localStorage:', error);
      return defaultValue;
    }
  }

  static removeLocalStorage(key) {
    try {
      localStorage.removeItem(key);
      return true;
    } catch (error) {
      console.warn('Could not remove from localStorage:', error);
      return false;
    }
  }

  // Cookie utilities
  static setCookie(name, value, days = 7) {
    const expires = new Date();
    expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
    document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/`;
  }

  static getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) === ' ') {
        c = c.substring(1, c.length);
      }
      if (c.indexOf(nameEQ) === 0) {
        return c.substring(nameEQ.length, c.length);
      }
    }
    
    return null;
  }

  static deleteCookie(name) {
    document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
  }

  // Validation utilities
  static isEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  static isPhone(phone) {
    const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
    const cleanPhone = phone.replace(/[\s\-\(\)\.]/g, '');
    return phoneRegex.test(cleanPhone);
  }

  static isUrl(string) {
    try {
      new URL(string);
      return true;
    } catch (_) {
      return false;
    }
  }

  // Loading state utilities
  static showLoader(element, options = {}) {
    if (!element) return;

    const loader = this.createElement('div', {
      className: `sgs-loader ${options.className || ''}`,
      innerHTML: options.html || '<div class="loading-spinner"></div>'
    });

    element.appendChild(loader);
    element.classList.add('loading');
  }

  static hideLoader(element) {
    if (!element) return;

    const loader = element.querySelector('.sgs-loader');
    if (loader) {
      loader.remove();
    }
    element.classList.remove('loading');
  }

  // Ready state utility
  static ready(callback) {
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', callback);
    } else {
      callback();
    }
  }

  // Image lazy loading utility
  static lazyLoadImage(img, src) {
    if ('IntersectionObserver' in window) {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const image = entry.target;
            image.src = src;
            image.classList.remove('lazy');
            observer.unobserve(image);
          }
        });
      });

      observer.observe(img);
    } else {
      // Fallback for older browsers
      img.src = src;
      img.classList.remove('lazy');
    }
  }
}
