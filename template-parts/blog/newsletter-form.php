<?php
/**
 * Newsletter signup form for blog header
 */
?>

<div class="newsletter-form">
    <form class="newsletter-form__form" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
        <?php wp_nonce_field('newsletter_signup', 'newsletter_nonce'); ?>
        <input type="hidden" name="action" value="newsletter_signup">
        
        <div class="newsletter-form__field">
            <label for="newsletter-email" class="newsletter-form__label">
                Stay Updated
            </label>
            <input 
                type="email" 
                id="newsletter-email" 
                name="email" 
                class="newsletter-form__input" 
                placeholder="email@example.com" 
                required
            >
        </div>
        
        <button type="submit" class="newsletter-form__button">
            Sign Up for Blog Updates
        </button>
    </form>
</div>
