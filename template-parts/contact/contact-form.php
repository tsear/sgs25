<?php
/**
 * Contact Form Section
 * 
 * HubSpot embedded form with dynamic configuration from theme options
 */

// Get HubSpot configuration from theme options
$portal_id = get_option('sgs_hubspot_portal_id', '44675524');
$contact_form_id = get_option('sgs_hubspot_contact_form_id', '2cd3f48e-c5a2-4f5f-89ae-70d16a736d04');
?>

<section class="contact-form-section">
    <div class="container">
        <div class="contact-form__wrapper">
            <div class="contact-form__container">
                <?php if (!empty($portal_id) && !empty($contact_form_id)) : ?>
                    <!-- HubSpot Form Embed -->
                    <div id="hubspot-form-contact" class="contact-form__hubspot">
                        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/embed/v2.js"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                if (typeof hbspt !== 'undefined') {
                                    hbspt.forms.create({
                                        portalId: "<?php echo esc_js($portal_id); ?>",
                                        formId: "<?php echo esc_js($contact_form_id); ?>",
                                        region: "na1",
                                        target: '#hubspot-form-contact'
                                    });
                                } else {
                                    console.error('HubSpot forms script not loaded');
                                }
                            });
                        </script>
                    </div>
                <?php else : ?>
                    <!-- Configuration Error Message -->
                    <div class="contact-form__error">
                        <p><strong>Configuration Error:</strong> HubSpot form configuration is missing.</p>
                        <p>Please configure the HubSpot Portal ID and Contact Form ID in <strong>Appearance > Theme Options</strong>.</p>
                    </div>
                <?php endif; ?>
                
                <!-- Fallback form in case HubSpot fails to load -->
                <noscript>
                    <div class="contact-form__fallback">
                        <p>Please enable JavaScript to view the contact form, or email us directly at:</p>
                        <a href="mailto:info@smartgrantsolutions.com">info@smartgrantsolutions.com</a>
                    </div>
                </noscript>
            </div>
        </div>
    </div>
</section>
