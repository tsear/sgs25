/**
 * Video Features Section JavaScript
 * Handles rocket animations, video controls, and connection interactions
 */

(function($) {
    'use strict';

    class VideoFeaturesController {
        constructor() {
            this.section = $('.video-features-section');
            this.rockets = $('.rocket');
            this.connectionLabels = $('.connection-label');
            this.videoCards = $('.video-card');
            this.videos = $('.video-card video');
            
            if (this.section.length) {
                this.init();
            }
        }

        init() {
            this.setupIntersectionObserver();
            this.setupVideoControls();
            this.setupRocketInteractions();
            this.setupConnectionAnimations();
            this.setupExhaustFlameAnimations();
        }

        setupIntersectionObserver() {
            // Set up individual observers for each video card to trigger corresponding rocket
            this.setupIndividualRocketObservers();
        }

        setupIndividualRocketObservers() {
            const observerOptions = {
                threshold: 0.3, // Trigger when 30% of card is visible
                rootMargin: '0px 0px -20% 0px'
            };

            // Create observer for individual card/rocket pairs
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const cardIndex = parseInt(entry.target.dataset.cardIndex);
                        this.animateIndividualRocket(cardIndex);
                    }
                });
            }, observerOptions);

            // Add data attributes to cards and observe each one
            this.videoCards.each((index, card) => {
                const $card = $(card);
                $card.attr('data-card-index', index);
                observer.observe(card);
            });
        }

        animateIndividualRocket(cardIndex) {
            // Get the specific rocket and card
            const rocket = $(`.rocket-${cardIndex + 1}`);
            const card = this.videoCards.eq(cardIndex);
            
            // Skip if this rocket is already animated
            if (rocket.hasClass('animation-complete')) {
                return;
            }
            
            // Animate the rocket with Tilda specifications
            setTimeout(() => {
                rocket.css({
                    'opacity': '1',
                    'transform': 'translateY(0)'
                });
                
                // Lock in final state after animation completes
                setTimeout(() => {
                    rocket.addClass('animation-complete');
                    rocket.css({
                        'transition': 'none',
                        'opacity': '1',
                        'transform': 'translateY(0)'
                    });
                }, 2000); // 2s animation duration
                
            }, 500); // 0.5s delay as per Tilda specs
            
            // Also animate the corresponding connection label
            const connectionLabel = $(`.label-${cardIndex + 1}`);
            setTimeout(() => {
                connectionLabel.addClass('animate-in');
            }, 800); // Animate connection after rocket starts
            
            // Animate the card itself
            setTimeout(() => {
                card.addClass('animate-in');
            }, 1000); // Animate card after connection
        }

        setupVideoControls() {
            this.videos.each((index, video) => {
                const $video = $(video);
                const $card = $video.closest('.video-card');
                
                // Add play/pause on click
                $video.on('click', () => {
                    if (video.paused) {
                        this.pauseAllVideos();
                        video.play();
                        $card.addClass('video-playing');
                    } else {
                        video.pause();
                        $card.removeClass('video-playing');
                    }
                });

                // Handle video events
                $video.on('play', () => {
                    $card.addClass('video-playing');
                    this.highlightRocket(index);
                });

                $video.on('pause ended', () => {
                    $card.removeClass('video-playing');
                    this.unhighlightRocket(index);
                });

                // Auto-pause when scrolled out of view
                $video.on('loadedmetadata', () => {
                    const videoObserver = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (!entry.isIntersecting && !video.paused) {
                                video.pause();
                            }
                        });
                    }, { threshold: 0.3 });

                    videoObserver.observe(video);
                });
            });
        }

        setupRocketInteractions() {
            this.rockets.each((index, rocket) => {
                const $rocket = $(rocket);
                
                $rocket.on('click', () => {
                    this.focusVideoCard(index);
                    this.playVideoCard(index);
                });

                // Hover effects
                $rocket.on('mouseenter', () => {
                    $rocket.addClass('hover-state');
                    this.highlightConnectionLabel(index);
                    this.previewVideoCard(index);
                });

                $rocket.on('mouseleave', () => {
                    $rocket.removeClass('hover-state');
                    this.unhighlightConnectionLabel(index);
                    this.unpreviewVideoCard(index);
                });
            });
        }

        setupConnectionAnimations() {
            // Add pulsing animation to connection labels
            this.connectionLabels.each((index, label) => {
                const $label = $(label);
                
                setInterval(() => {
                    if (!$label.hasClass('highlighted')) {
                        $label.addClass('pulse-subtle');
                        setTimeout(() => {
                            $label.removeClass('pulse-subtle');
                        }, 1000);
                    }
                }, 4000 + (index * 1000));
            });
        }

        pauseAllVideos() {
            this.videos.each((index, video) => {
                if (!video.paused) {
                    video.pause();
                }
            });
            this.videoCards.removeClass('video-playing');
        }

        focusVideoCard(index) {
            const $targetCard = this.videoCards.eq(index);
            
            // Smooth scroll to video card
            $('html, body').animate({
                scrollTop: $targetCard.offset().top - 100
            }, 800);
        }

        playVideoCard(index) {
            const video = this.videos[index];
            if (video) {
                this.pauseAllVideos();
                setTimeout(() => {
                    video.play();
                }, 300);
            }
        }

        highlightRocket(index) {
            this.rockets.eq(index).addClass('highlighted');
            this.highlightConnectionLabel(index);
        }

        unhighlightRocket(index) {
            this.rockets.eq(index).removeClass('highlighted');
            this.unhighlightConnectionLabel(index);
        }

        highlightConnectionLabel(index) {
            this.connectionLabels.eq(index).addClass('highlighted');
        }

        unhighlightConnectionLabel(index) {
            this.connectionLabels.eq(index).removeClass('highlighted');
        }

        previewVideoCard(index) {
            this.videoCards.eq(index).addClass('preview-state');
        }

        unpreviewVideoCard(index) {
            this.videoCards.eq(index).removeClass('preview-state');
        }

        setupExhaustFlameAnimations() {
            const exhaustFlames = document.querySelectorAll('.exhaust-flame');
            
            if (exhaustFlames.length === 0) {
                return;
            }

            // Set initial state - invisible
            exhaustFlames.forEach(flame => {
                flame.style.opacity = '0';
                flame.style.transition = 'opacity 2s ease-out';
            });

            // Set up Intersection Observer for scroll-triggered animations
            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -100px 0px', // Same trigger area as rockets
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !entry.target.classList.contains('exhaust-animated')) {
                        // Add animated class to prevent re-triggering
                        entry.target.classList.add('exhaust-animated');
                        
                        // 3-second delay to let rockets fade in first
                        setTimeout(() => {
                            // Fade in exhaust flames
                            exhaustFlames.forEach((flame, index) => {
                                flame.style.opacity = '1';
                                
                                // Start rotation animations
                                this.startExhaustRotation(flame);
                            });
                        }, 3000);
                    }
                });
            }, observerOptions);

            // Observe the first exhaust flame (both will trigger together)
            if (exhaustFlames.length > 0) {
                observer.observe(exhaustFlames[0]);
            }
        }

        startExhaustRotation(flame) {
            let rotation = 0;
            const isLeft = flame.classList.contains('exhaust-flame-left');
            const maxRotation = 15; // degrees
            const speed = 0.02; // rotation speed
            
            const animate = () => {
                // Calculate rotation using sine wave for smooth back-and-forth motion
                const rotationValue = Math.sin(rotation) * maxRotation;
                const direction = isLeft ? -1 : 1; // Left rotates negative, right rotates positive
                
                flame.style.transform = `rotate(${rotationValue * direction}deg)`;
                
                rotation += speed;
                requestAnimationFrame(animate);
            };
            
            animate();
        }
    }

    // Initialize when DOM is ready
    $(document).ready(function() {
        new VideoFeaturesController();
    });

    // Handle window resize
    $(window).on('resize', debounce(function() {
        // Recalculate positions if needed
    }, 250));

    // Debounce utility
    function debounce(func, wait, immediate) {
        let timeout;
        return function executedFunction() {
            const context = this;
            const args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

})(jQuery);
