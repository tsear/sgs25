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
                                        target: '#hubspot-form-contact',
                                        onFormSubmit: function($form) {
                                            console.log('📤 Form being submitted');
                                            const referralField = document.querySelector('input[name="referral_source"]');
                                            if (referralField) {
                                                console.log('📤 Referral field value at submission:', referralField.value);
                                            } else {
                                                console.warn('⚠️ Referral field not found at submission');
                                            }
                                        },
                                        onFormReady: function($form) {
                                            console.log('📋 HubSpot form ready, checking for referral cookie');
                                            
                                            // Get referral code from cookie
                                            const cookies = document.cookie.split(';');
                                            let referralCode = null;
                                            
                                            for (let cookie of cookies) {
                                                const [name, value] = cookie.trim().split('=');
                                                if (name === 'sgs_referral_public') {
                                                    referralCode = decodeURIComponent(value);
                                                    break;
                                                }
                                            }
                                            
                                            if (referralCode) {
                                                console.log('✅ Found referral cookie:', referralCode);
                                                
                                                // Retry logic to wait for field to be rendered
                                                let attempts = 0;
                                                const maxAttempts = 10;
                                                
                                                const trySetField = () => {
                                                    attempts++;
                                                    
                                                    // Try multiple ways to get the form element
                                                    const formElement = $form[0] || $form;
                                                    
                                                    // Debug: log what we're searching in
                                                    if (attempts === 1) {
                                                        console.log('🔍 Form element type:', formElement);
                                                        console.log('🔍 All inputs in form:', formElement.querySelectorAll('input'));
                                                    }
                                                    
                                                    // Try to find the field
                                                    let referralField = formElement.querySelector('input[name="referral_source"]');
                                                    
                                                    // Also try looking in the entire document (HubSpot might render it elsewhere)
                                                    if (!referralField) {
                                                        referralField = document.querySelector('input[name="referral_source"]');
                                                        if (referralField && attempts === 1) {
                                                            console.log('🔍 Found field in document but not in form element');
                                                        }
                                                    }
                                                    
                                                    if (referralField) {
                                                        referralField.value = referralCode;
                                                        console.log('✅ Referral field populated with:', referralCode);
                                                    } else if (attempts < maxAttempts) {
                                                        console.log(`⏳ Waiting for referral_source field (attempt ${attempts}/${maxAttempts})`);
                                                        setTimeout(trySetField, 100);
                                                    } else {
                                                        console.warn('⚠️ referral_source field not found after ' + maxAttempts + ' attempts');
                                                        console.log('🔍 All inputs with name attribute:', document.querySelectorAll('input[name]'));
                                                    }
                                                };
                                                
                                                trySetField();
                                            } else {
                                                console.log('ℹ️ No referral cookie found');
                                            }
                                        }
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
