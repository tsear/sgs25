/**
 * Blog Show More Functionality
 * Handles progressive loading of blog and grants posts
 */

class BlogShowMore {
    constructor() {
        // Detect which post type is active
        if (document.querySelector('.blog-posts-grid')) {
            this.type = 'blog';
            this.grid = document.querySelector('.blog-posts-grid');
            this.showMoreBtn = document.querySelector('.blog-show-more__btn');
            this.showMoreText = document.querySelector('.blog-show-more__text');
            this.loader = document.querySelector('.blog-show-more__loader');
            this.showMoreContainer = document.querySelector('.blog-show-more');
            this.hiddenClass = 'blog-post-hidden';
            this.revealingClass = 'blog-post-revealing';
        } else if (document.querySelector('.grants-posts-grid')) {
            this.type = 'grants';
            this.grid = document.querySelector('.grants-posts-grid');
            this.showMoreBtn = document.querySelector('.grants-show-more__btn');
            this.showMoreText = document.querySelector('.grants-show-more__text');
            this.loader = document.querySelector('.grants-show-more__loader');
            this.showMoreContainer = document.querySelector('.grants-show-more');
            this.hiddenClass = 'grants-post-hidden';
            this.revealingClass = 'grants-post-revealing';
        } else {
            console.log('BlogShowMore: No matching grid found');
            return;
        }

        if (this.grid && this.showMoreBtn) {
            this.postsPerLoad = parseInt(this.showMoreBtn.dataset.postsPerLoad) || 6;
            this.totalPosts = parseInt(this.showMoreBtn.dataset.totalPosts);
            this.visiblePosts = this.postsPerLoad;
            this.init();
        } else {
            console.log(`BlogShowMore: Required elements not found for ${this.type}`);
        }
    }

    init() {
        this.bindEvents();
        this.updateShowMoreButton();
    }

    bindEvents() {
        this.showMoreBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const hiddenPosts = this.grid.querySelectorAll(`.${this.hiddenClass}`);

            // Show next batch
            for (let i = 0; i < Math.min(this.postsPerLoad, hiddenPosts.length); i++) {
                hiddenPosts[i].classList.remove(this.hiddenClass);
                hiddenPosts[i].classList.add(this.revealingClass);
                setTimeout(() => {
                    hiddenPosts[i].classList.remove(this.revealingClass);
                }, 300);
            }

            this.visiblePosts += Math.min(this.postsPerLoad, hiddenPosts.length);
            this.updateShowMoreButton();
        });
    }

    updateShowMoreButton() {
        const remainingPosts = this.grid.querySelectorAll(`.${this.hiddenClass}`).length;

        if (remainingPosts === 0) {
            this.showMoreContainer.style.display = 'none';
        } else {
            const postsToShow = Math.min(remainingPosts, this.postsPerLoad);
            this.showMoreText.textContent = `Show ${postsToShow} More`;
        }
    }
}

export default BlogShowMore;
