<?php
/**
 * Referral Program Content Section
 */
?>

<section class="referral-content">
    <div class="referral-content__container">
        
        <!-- How It Works Section -->
        <div class="referral-content__how-it-works">
            <h2 class="section-title">How It Works</h2>
            <div class="steps-grid">
                <div class="step-card" data-step="1">
                    <div class="step-number">1</div>
                    <h3 class="step-title">Share Your Link</h3>
                    <p class="step-description">Get your unique referral link and share it with organizations that could benefit from MissionGranted.</p>
                </div>
                
                <div class="step-card" data-step="2">
                    <div class="step-number">2</div>
                    <h3 class="step-title">They Sign Up</h3>
                    <p class="step-description">When they create an account and start a trial, you'll be notified and tracking begins.</p>
                </div>
                
                <div class="step-card" data-step="3">
                    <div class="step-number">3</div>
                    <h3 class="step-title">You Get Rewarded</h3>
                    <p class="step-description">Earn rewards when they become a paying customer. The more you refer, the more you earn.</p>
                </div>
            </div>
        </div>
        
        <!-- Rewards Tiers Section -->
        <div class="referral-content__rewards">
            <h2 class="section-title">Referral Rewards</h2>
            <div class="rewards-grid">
                <div class="reward-card reward-card--basic">
                    <div class="reward-badge">🥉 Basic Tier</div>
                    <h3 class="reward-title">1-3 Referrals</h3>
                    <div class="reward-amount">$200</div>
                    <p class="reward-per">per successful referral</p>
                    <ul class="reward-benefits">
                        <li>Cash or account credit</li>
                        <li>Priority support</li>
                        <li>Early feature access</li>
                    </ul>
                </div>
                
                <div class="reward-card reward-card--pro">
                    <div class="reward-badge">🥈 Pro Tier</div>
                    <h3 class="reward-title">4-9 Referrals</h3>
                    <div class="reward-amount">$350</div>
                    <p class="reward-per">per successful referral</p>
                    <ul class="reward-benefits">
                        <li>Everything in Basic</li>
                        <li>Exclusive partner status</li>
                        <li>Co-marketing opportunities</li>
                        <li>Dedicated account manager</li>
                    </ul>
                </div>
                
                <div class="reward-card reward-card--elite">
                    <div class="reward-badge">🥇 Elite Tier</div>
                    <h3 class="reward-title">10+ Referrals</h3>
                    <div class="reward-amount">$500</div>
                    <p class="reward-per">per successful referral</p>
                    <ul class="reward-benefits">
                        <li>Everything in Pro</li>
                        <li>Custom revenue sharing</li>
                        <li>White-label options</li>
                        <li>Strategic partnership team</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Who Benefits Section -->
        <div class="referral-content__benefits">
            <h2 class="section-title">Who Should You Refer?</h2>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-icon">🏥</div>
                    <h3 class="benefit-title">Healthcare Nonprofits</h3>
                    <p class="benefit-description">Organizations managing HRSA, CDC, or state health department grants.</p>
                </div>
                
                <div class="benefit-card">
                    <div class="benefit-icon">🎓</div>
                    <h3 class="benefit-title">Educational Institutions</h3>
                    <p class="benefit-description">Schools, colleges, and training programs with federal or state funding.</p>
                </div>
                
                <div class="benefit-card">
                    <div class="benefit-icon">🏛️</div>
                    <h3 class="benefit-title">Local Government</h3>
                    <p class="benefit-description">Cities, counties, and municipalities managing grant portfolios.</p>
                </div>
                
                <div class="benefit-card">
                    <div class="benefit-icon">🚀</div>
                    <h3 class="benefit-title">Tech Startups</h3>
                    <p class="benefit-description">Companies pursuing SBIR/STTR grants or innovation funding.</p>
                </div>
                
                <div class="benefit-card">
                    <div class="benefit-icon">🤝</div>
                    <h3 class="benefit-title">Social Services</h3>
                    <p class="benefit-description">Organizations serving communities through multiple grant programs.</p>
                </div>
                
                <div class="benefit-card">
                    <div class="benefit-icon">🌱</div>
                    <h3 class="benefit-title">Environmental Groups</h3>
                    <p class="benefit-description">Conservation and sustainability projects with complex funding.</p>
                </div>
            </div>
        </div>
        
        <!-- CTA Section -->
        <div class="referral-content__cta">
            <div class="cta-card">
                <h2 class="cta-title">Ready to Start Earning?</h2>
                <p class="cta-description">Join our referral program today and start earning rewards while helping organizations succeed with their grant management.</p>
                <div class="cta-buttons">
                    <a href="<?php echo esc_url(home_url('/referral-program#signup')); ?>" class="cta-button cta-button--primary">
                        Get Your Referral Link
                    </a>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="cta-button cta-button--secondary">
                        Have Questions?
                    </a>
                </div>
                <p class="cta-note">💡 No cap on earnings. The more organizations you refer, the more you earn.</p>
            </div>
        </div>
        
    </div>
</section>