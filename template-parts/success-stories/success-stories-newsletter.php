<?php
/**
 * Success Stories Newsletter Signup (Native)
 * Custom form posts to theme AJAX handler sgs_newsletter_signup
 */
?>

<section class="success-stories-newsletter newsletter-form">
    <div class="container">
        <form class="newsletter-form__form" novalidate>
            <div class="newsletter-form__field">
                <label class="newsletter-form__label" for="newsletter-email">Subscribe to our newsletter</label>
                <input
                    class="newsletter-form__input"
                    type="email"
                    id="newsletter-email"
                    name="email"
                    placeholder="you@example.com"
                    required
                    autocomplete="email"
                    inputmode="email"
                />
            </div>
            <button class="newsletter-form__button" type="submit">Subscribe</button>
            <p class="newsletter-form__message" aria-live="polite"></p>
        </form>
    </div>
    
</section>
