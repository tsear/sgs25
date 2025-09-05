/**
 * Navigation Component
 * Handles mobile menu, scroll effects, and navigation interactions
 */

export class Navigation {
  constructor() {
    this.header = document.querySelector('.site-header');
    this.mobileToggle = document.querySelector('.mobile-menu-toggle');
    this.mobileNav = document.querySelector('.mobile-navigation');
    this.navLinks = document.querySelectorAll('.nav-menu a, .mobile-nav-menu a');
    this.body = document.body;
    this.isMenuOpen = false;
    this.lastScrollY = 0;
    this.scrollThreshold = 100;

    this.init();
  }

  init() {
    if (!this.header) return;

    this.bindEvents();
    this.handleInitialScroll();
  }

  bindEvents() {
    // Mobile menu toggle
    if (this.mobileToggle) {
      this.mobileToggle.addEventListener('click', (e) => {
        e.preventDefault();
        this.toggleMobileMenu();
      });
    }

    // Close mobile menu when clicking outside
    if (this.mobileNav) {
      this.mobileNav.addEventListener('click', (e) => {
        if (e.target === this.mobileNav) {
          this.closeMobileMenu();
        }
      });
    }

    // Close mobile menu when clicking nav links
    this.navLinks.forEach(link => {
      link.addEventListener('click', () => {
        if (this.isMenuOpen) {
          this.closeMobileMenu();
        }
      });
    });

    // Scroll effects
    window.addEventListener('scroll', this.throttle(() => {
      this.handleScroll();
    }, 16)); // ~60fps

    // Escape key to close mobile menu
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.isMenuOpen) {
        this.closeMobileMenu();
      }
    });

    // Handle window resize
    window.addEventListener('resize', this.throttle(() => {
      this.handleResize();
    }, 250));

    // Smooth scroll for anchor links
    this.initSmoothScroll();
  }

  toggleMobileMenu() {
    if (this.isMenuOpen) {
      this.closeMobileMenu();
    } else {
      this.openMobileMenu();
    }
  }

  openMobileMenu() {
    this.isMenuOpen = true;
    this.mobileToggle?.classList.add('active');
    this.mobileNav?.classList.add('active');
    this.body.style.overflow = 'hidden';
    
    // Focus first menu item for accessibility
    const firstMenuItem = this.mobileNav?.querySelector('.mobile-nav-menu a');
    if (firstMenuItem) {
      firstMenuItem.focus();
    }

    // Animate menu items
    this.animateMenuItems(true);
  }

  closeMobileMenu() {
    this.isMenuOpen = false;
    this.mobileToggle?.classList.remove('active');
    this.mobileNav?.classList.remove('active');
    this.body.style.overflow = '';

    // Animate menu items
    this.animateMenuItems(false);
  }

  animateMenuItems(show) {
    const menuItems = this.mobileNav?.querySelectorAll('.mobile-nav-menu .nav-item');
    if (!menuItems) return;

    menuItems.forEach((item, index) => {
      const delay = show ? index * 100 : 0;
      
      setTimeout(() => {
        if (show) {
          item.style.opacity = '0';
          item.style.transform = 'translateX(-20px)';
          item.style.animation = `slideInLeft 0.3s ease-out ${delay}ms forwards`;
        } else {
          item.style.animation = '';
          item.style.opacity = '';
          item.style.transform = '';
        }
      }, show ? 0 : (menuItems.length - index - 1) * 50);
    });
  }

  handleScroll() {
    const currentScrollY = window.pageYOffset;
    
    // Add/remove scrolled class
    if (currentScrollY > this.scrollThreshold) {
      this.header?.classList.add('scrolled');
    } else {
      this.header?.classList.remove('scrolled');
    }

    // Hide/show header on scroll (optional)
    if (window.innerWidth > 1024) { // Only on desktop
      if (currentScrollY > this.lastScrollY && currentScrollY > this.scrollThreshold) {
        // Scrolling down
        this.header?.classList.add('header-hidden');
      } else {
        // Scrolling up
        this.header?.classList.remove('header-hidden');
      }
    }

    this.lastScrollY = currentScrollY;
  }

  handleInitialScroll() {
    // Set initial scroll state
    const currentScrollY = window.pageYOffset;
    if (currentScrollY > this.scrollThreshold) {
      this.header?.classList.add('scrolled');
    }
  }

  handleResize() {
    // Close mobile menu on resize to larger screen
    if (window.innerWidth > 1024 && this.isMenuOpen) {
      this.closeMobileMenu();
    }

    // Remove header hidden class on mobile
    if (window.innerWidth <= 1024) {
      this.header?.classList.remove('header-hidden');
    }
  }

  initSmoothScroll() {
    // Handle smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(link => {
      link.addEventListener('click', (e) => {
        const href = link.getAttribute('href');
        
        // Skip empty hrefs and # only
        if (!href || href === '#') return;
        
        const target = document.querySelector(href);
        if (!target) return;
        
        e.preventDefault();
        
        // Calculate offset for fixed header
        const headerHeight = this.header?.offsetHeight || 0;
        const targetPosition = target.offsetTop - headerHeight - 20; // 20px extra padding
        
        // Smooth scroll
        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });

        // Update URL without jumping
        history.pushState(null, null, href);
      });
    });
  }

  // Utility function for throttling
  throttle(func, limit) {
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

  // Public methods
  getCurrentSection() {
    const sections = document.querySelectorAll('section[id]');
    const scrollPos = window.pageYOffset + (this.header?.offsetHeight || 0) + 50;

    for (let i = sections.length - 1; i >= 0; i--) {
      const section = sections[i];
      if (section.offsetTop <= scrollPos) {
        return section.id;
      }
    }

    return null;
  }

  highlightActiveNavItem() {
    const currentSection = this.getCurrentSection();
    
    // Remove active class from all nav links
    this.navLinks.forEach(link => {
      link.classList.remove('active', 'current-menu-item');
    });

    // Add active class to current section link
    if (currentSection) {
      const activeLink = document.querySelector(`a[href="#${currentSection}"]`);
      if (activeLink) {
        activeLink.classList.add('active', 'current-menu-item');
      }
    }
  }

  destroy() {
    // Clean up event listeners
    if (this.mobileToggle) {
      this.mobileToggle.replaceWith(this.mobileToggle.cloneNode(true));
    }
    
    // Remove scroll effects
    window.removeEventListener('scroll', this.handleScroll);
    window.removeEventListener('resize', this.handleResize);
    
    // Reset mobile menu state
    this.closeMobileMenu();
    
    // Reset body overflow
    this.body.style.overflow = '';
  }
}

// CSS for animations (to be added to SCSS)
const style = document.createElement('style');
style.textContent = `
  @keyframes slideInLeft {
    from {
      opacity: 0;
      transform: translateX(-20px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  .header-hidden {
    transform: translateY(-100%);
    transition: transform 0.3s ease-in-out;
  }

  .site-header {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
  }
`;

document.head.appendChild(style);
