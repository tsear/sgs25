/**
 * Blog Search Functionality
 * Handles search form interactions
 */

class BlogSearch {
    constructor() {
        this.form = document.querySelector('.blog-search__form');
        this.input = document.querySelector('.blog-search__input');
        this.submitBtn = document.querySelector('.blog-search__submit');
        this.clearBtn = document.querySelector('.blog-search__clear');
        
        if (this.form) {
            this.init();
        }
    }
    
    init() {
        this.bindEvents();
        this.checkClearButton();
    }
    
    bindEvents() {
        if (this.input) {
            this.input.addEventListener('input', () => {
                this.checkClearButton();
            });
            
            this.input.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.form.submit();
                }
            });
        }
        
        if (this.clearBtn) {
            this.clearBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.clearSearch();
            });
        }
    }
    
    checkClearButton() {
        if (this.clearBtn && this.input) {
            this.clearBtn.style.display = this.input.value.length > 0 ? 'block' : 'none';
        }
    }
    
    clearSearch() {
        if (this.input) {
            this.input.value = '';
            this.checkClearButton();
            // Redirect to blog page without search params
            window.location.href = window.location.pathname;
        }
    }
}

export default BlogSearch;
