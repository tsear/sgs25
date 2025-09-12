/**
 * Rocket Image Scroll Animations
 * Implements fade-in-up animations for the 4 rocket images
 */

// Animation configuration based on Tilda export
const animationConfig = {
    style: 'fadeinup',
    duration: 2000, // 2 seconds in milliseconds
    delay: 500, // 0.5 seconds in milliseconds
    distance: 300 // 300px upward movement
};

// Initialize animations when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initAllAnimations();
});

function initRocketAnimations() {
    // Get all rocket images in the video features section
    const rocketImages = document.querySelectorAll('.video-features .rocket-images img');
    
    if (rocketImages.length === 0) {
        console.log('No rocket images found for animation');
        return;
    }

    // Set up Intersection Observer for scroll-triggered animations
    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -100px 0px', // Trigger when element is 100px from bottom of viewport
        threshold: 0.1
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                // Add animated class to prevent re-triggering
                entry.target.classList.add('animated');
                
                // Trigger animation
                animateRocket(entry.target);
            }
        });
    }, observerOptions);

    // Observe each rocket image
    rocketImages.forEach((img, index) => {
        // Set initial state
        setupRocketInitialState(img, index);
        
        // Start observing
        observer.observe(img);
    });
}

function setupRocketInitialState(img, index) {
    // Set initial CSS for animation
    img.style.opacity = '0';
    img.style.transform = `translateY(${animationConfig.distance}px)`;
    img.style.transition = `opacity ${animationConfig.duration}ms ease-out, transform ${animationConfig.duration}ms ease-out`;
    
    // Add a slight stagger delay for each rocket (sequential animation)
    img.dataset.animationDelay = animationConfig.delay + (index * 200); // 200ms stagger between rockets
}

function animateRocket(img) {
    const delay = parseInt(img.dataset.animationDelay) || animationConfig.delay;
    
    setTimeout(() => {
        // Animate to final state
        img.style.opacity = '1';
        img.style.transform = 'translateY(0)';
        
        // Add completion class after animation finishes
        setTimeout(() => {
            img.classList.add('animation-complete');
        }, animationConfig.duration);
        
    }, delay);
}

// Alternative method using CSS classes (more performant)
function initCSSAnimations() {
    // Add CSS classes to document head
    if (!document.getElementById('rocket-animations-css')) {
        const style = document.createElement('style');
        style.id = 'rocket-animations-css';
        style.textContent = `
            .rocket-fade-in-up {
                opacity: 0;
                transform: translateY(${animationConfig.distance}px);
                transition: opacity ${animationConfig.duration}ms ease-out, 
                           transform ${animationConfig.duration}ms ease-out;
            }
            
            .rocket-fade-in-up.animate {
                opacity: 1;
                transform: translateY(0);
            }
            
            .rocket-fade-in-up.animate.delay-1 {
                transition-delay: ${animationConfig.delay}ms;
            }
            
            .rocket-fade-in-up.animate.delay-2 {
                transition-delay: ${animationConfig.delay + 200}ms;
            }
            
            .rocket-fade-in-up.animate.delay-3 {
                transition-delay: ${animationConfig.delay + 400}ms;
            }
            
            .rocket-fade-in-up.animate.delay-4 {
                transition-delay: ${animationConfig.delay + 600}ms;
            }
        `;
        document.head.appendChild(style);
    }
    
    const rocketImages = document.querySelectorAll('.video-features .rocket-images img');
    
    // Apply initial CSS classes
    rocketImages.forEach((img, index) => {
        img.classList.add('rocket-fade-in-up');
    });
    
    // Set up intersection observer
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animate')) {
                const img = entry.target;
                const index = Array.from(rocketImages).indexOf(img);
                
                img.classList.add('animate', `delay-${index + 1}`);
            }
        });
    }, {
        root: null,
        rootMargin: '0px 0px -100px 0px',
        threshold: 0.1
    });
    
    rocketImages.forEach(img => observer.observe(img));
}

// Exhaust Flame Animation Functions
function initExhaustFlameAnimations() {
    const exhaustFlames = document.querySelectorAll('.exhaust-flame');
    
    console.log('Found exhaust flames:', exhaustFlames.length);
    
    if (exhaustFlames.length === 0) {
        console.log('No exhaust flames found for animation');
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

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('exhaust-animated')) {
                // Add animated class to prevent re-triggering
                entry.target.classList.add('exhaust-animated');
                
                console.log('Exhaust flame in view, starting 3-second delay');
                
                // 3-second delay to let rockets fade in first
                setTimeout(() => {
                    console.log('Starting exhaust flame animations');
                    
                    // Fade in exhaust flames
                    exhaustFlames.forEach((flame, index) => {
                        flame.style.opacity = '1';
                        
                        // Start rotation animations
                        startExhaustRotation(flame);
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

function startExhaustRotation(flame) {
    let rotation = 0;
    const isLeft = flame.classList.contains('exhaust-flame-left');
    const maxRotation = 15; // degrees
    const speed = 0.02; // rotation speed
    
    function animate() {
        // Calculate rotation using sine wave for smooth back-and-forth motion
        const rotationValue = Math.sin(rotation) * maxRotation;
        const direction = isLeft ? -1 : 1; // Left rotates negative, right rotates positive
        
        flame.style.transform = `rotate(${rotationValue * direction}deg)`;
        
        rotation += speed;
        requestAnimationFrame(animate);
    }
    
    animate();
}

// Update initialization to include exhaust flames
function initAllAnimations() {
    initRocketAnimations();
    initExhaustFlameAnimations();
}

// Export functions for potential external use
window.RocketAnimations = {
    init: initRocketAnimations,
    initCSS: initCSSAnimations,
    initExhaust: initExhaustFlameAnimations,
    initAll: initAllAnimations,
    config: animationConfig
};
