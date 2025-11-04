/**
 * Blog Show More Functionality
 * Handles progressive loading of blog posts
 */

class BlogShowMore {
    constructor() {
        this.grid = document.querySelector('.blog-posts-grid');
        this.showMoreBtn = document.querySelector('.blog-show-more__btn');
        this.showMoreText = document.querySelector('.blog-show-more__text');
        this.loader = document.querySelector('.blog-show-more__loader');
        this.showMoreContainer = document.querySelector('.blog-show-more');
        
        if (this.grid && this.showMoreBtn) {
            this.postsPerLoad = parseInt(this.showMoreBtn.dataset.postsPerLoad) || 6;
            this.totalPosts = parseInt(this.showMoreBtn.dataset.totalPosts);
            this.visiblePosts = this.postsPerLoad;
            this.init();
        } else {
            console.log('BlogShowMore: Required elements not found');
        }
    }
    
    init() {
        this.bindEvents();
        this.updateShowMoreButton();
    }
    
    bindEvents() {
        this.showMoreBtn.addEventListener('click', (e) => {
            e.preventDefault();
            
            const hiddenPosts = this.grid.querySelectorAll('.blog-post-hidden');
            
            // Show next batch
            for (let i = 0; i < Math.min(this.postsPerLoad, hiddenPosts.length); i++) {
                hiddenPosts[i].classList.remove('blog-post-hidden');
                hiddenPosts[i].classList.add('blog-post-revealing');
                
                setTimeout(() => {
                    hiddenPosts[i].classList.remove('blog-post-revealing');
                }, 300);
            }
            
            this.visiblePosts += Math.min(this.postsPerLoad, hiddenPosts.length);
            this.updateShowMoreButton();
        });
    }
    
    updateShowMoreButton() {
        const remainingPosts = this.grid.querySelectorAll('.blog-post-hidden').length;
        
        if (remainingPosts === 0) {
            this.showMoreContainer.style.display = 'none';
        } else {
            const postsToShow = Math.min(remainingPosts, this.postsPerLoad);
            this.showMoreText.textContent = `Show ${postsToShow} More`;
        }
    }
}

export default BlogShowMore;
