    <!-- Final CTA Section matching Tilda -->
    <section class="final-cta-section" style="background-color: #000000; padding: 75px 0; text-align: center;">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <div class="cta-content">
                <h2 style="font-family: 'DM Sans', sans-serif; font-size: 48px; font-weight: 700; color: #ffffff; margin-bottom: 40px; line-height: 1.2;">Our Mission is to Fuel Yours</h2>
                <a href="<?php echo home_url('/contact'); ?>" class="cta-button primary large" style="display: inline-block; padding: 20px 40px; background-color: #FFB03F; color: #000000; text-decoration: none; font-family: 'Inter', sans-serif; font-size: 16px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 40px; transition: all 0.3s ease;">REQUEST A DEMO</a>
                <h3 style="font-family: 'DM Sans', sans-serif; font-size: 28px; font-weight: 600; color: #ffffff; line-height: 1.3; margin: 0;">Eliminate Spreadsheets.<br>Ensure Compliance.<br>Drive Strategy.</h3>
            </div>
        </div>
    </section>

    <footer id="colophon" class="site-footer" style="background-color: #000000; padding: 40px 0; border-top: 1px solid #333;">
        <div class="footer-container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <div class="footer-content" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
                <!-- Logo -->
                <div class="footer-logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/sgs-logo-footer.png" alt="Smart Grant Solutions" style="height: 35px;" />
                </div>
                
                <!-- Navigation Links matching header -->
                <div class="footer-nav" style="display: flex; gap: 30px; align-items: center;">
                    <a href="<?php echo home_url('/'); ?>" style="color: #ffffff; text-decoration: none; font-family: 'Inter', sans-serif; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">HOME</a>
                    <a href="<?php echo home_url('/blog'); ?>" style="color: #ffffff; text-decoration: none; font-family: 'Inter', sans-serif; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">BLOG</a>
                    <a href="<?php echo home_url('/testimonials'); ?>" style="color: #ffffff; text-decoration: none; font-family: 'Inter', sans-serif; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">TESTIMONIALS</a>
                    <a href="<?php echo home_url('/contact'); ?>" style="color: #FFB03F; text-decoration: none; font-family: 'Inter', sans-serif; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">REQUEST A DEMO</a>
                </div>
                
                <!-- Copyright -->
                <div class="footer-copyright" style="color: #666666; font-family: 'Inter', sans-serif; font-size: 12px;">
                    &copy; <?php echo date('Y'); ?> Smart Grant Solutions. All rights reserved.
                </div>
            </div>
        </div>
    </footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
