<?php
/**
 * Contact Form Section
 * 
 * HubSpot form integration with Portal ID: 44675524
 * Form ID: 2cd3f48e-c5a2-4f5f-89ae-70d16a736d04
 */
?>

<section class="contact-form-section">
    <div class="container">
        <div class="contact-form__wrapper">
            <div class="contact-form__container">
                <!-- HubSpot Form Embed -->
                <div id="hubspot-form-contact" class="contact-form__hubspot">
                    <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/embed/v2.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            if (typeof hbspt !== 'undefined') {
                                hbspt.forms.create({
                                    portalId: "44675524",
                                    formId: "2cd3f48e-c5a2-4f5f-89ae-70d16a736d04",
                                    region: "na1",
                                    target: '#hubspot-form-contact'
                                });
                            }
                        });
                    </script>
                </div>
                
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
