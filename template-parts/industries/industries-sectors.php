<?php
/**
 * Industries Sectors Section - Three Core Focus Areas
 */
?>

<section class="industries-sectors">
    <div class="container">
        
        <!-- Section Header -->
        <div class="industries-sectors__header">
            <h2 class="industries-sectors__title">Our Core <span class="brand-pink">Sectors</span></h2>
        </div>

        <!-- Sectors Grid -->
        <div class="industries-sectors__grid">
            
            <!-- Nonprofits Sector -->
            <div class="sector-card sector-card--nonprofits">
                <div class="sector-card__icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                        <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z" fill="currentColor"/>
                        <path d="M19 15L20.09 18.26L23 19L20.09 19.74L19 23L17.91 19.74L15 19L17.91 18.26L19 15Z" fill="currentColor"/>
                        <path d="M5 15L6.09 18.26L9 19L6.09 19.74L5 23L3.91 19.74L1 19L3.91 18.26L5 15Z" fill="currentColor"/>
                    </svg>
                </div>
                <h3 class="sector-card__title">Nonprofits</h3>
                <p class="sector-card__subtitle">All Sizes, All Missions</p>
                <p class="sector-card__description">From community-based nonprofits to statewide organizations and national advocacy groups we support grant-funded missions of all scales.</p>
                
                <div class="sector-card__features">
                    <ul class="feature-list">
                        <li>Human Services</li>
                        <li>Workforce Development & Training</li>
                        <li>Education & Youth Development</li>
                        <li>Housing & Community Development</li>
                        <li>Environment & Conservation</li>
                        <li>Animal Welfare</li>
                        <li>Arts & Culture</li>
                    </ul>
                </div>
                <div class="sector-card__expertise">
                    <h4>Specialized Expertise</h4>
                    <p>Board governance, grant & restricted fund compliance, program evaluation, capacity building, and mission-driven strategic planning.</p>
                </div>
                <a href="<?php echo home_url('/nonprofits'); ?>" class="browse-btn-outline">Learn More</a>
            </div>

            <!-- Local Government Sector -->
            <div class="sector-card sector-card--government">
                <div class="sector-card__icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                        <path d="M12 2L2 7V10C2 16 6 20.9 12 22C18 20.9 22 16 22 10V7L12 2Z" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                </div>
                <h3 class="sector-card__title">Local Government</h3>
                <p class="sector-card__subtitle">Municipalities & Districts</p>
                <p class="sector-card__description">Whether you manage infrastructure projects or multi-department grant portfolios we understand the complexities of public funding compliance.</p>
                
                <div class="sector-card__features">
                    <ul class="feature-list">
                        <li>Municipalities</li>
                        <li>Townships</li>
                        <li>Housing Authorities</li>
                        <li>Library Districts</li>
                        <li>Parks & Recreation</li>
                        <li>Workforce Development Boards</li>
                        <li>K-12 & Charter Schools</li>
                    </ul>
                </div>

                <div class="sector-card__expertise">
                    <h4>Specialized Expertise</h4>
                    <p>Government procurement rules, policy standards, Uniform Guidance regulations, and stakeholder engagement strategies.</p>
                </div>
                <a href="<?php echo home_url('/local-government'); ?>" class="browse-btn-outline">Learn More</a>
            </div>

            <!-- Grantmakers Sector -->
            <div class="sector-card sector-card--grantmakers">
                <div class="sector-card__icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                        <path d="M17 21V19C17 16.79 15.21 15 13 15H5C2.79 15 1 16.79 1 19V21" stroke="currentColor" stroke-width="2" fill="none"/>
                        <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M23 21V19C23 18.13 22.39 17.39 21.55 17.13" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M16 3.13C16.84 3.39 17.45 4.13 17.45 5C17.45 5.87 16.84 6.61 16 6.87" stroke="currentColor" stroke-width="2" fill="none"/>
                    </svg>
                </div>
                <h3 class="sector-card__title">Grantmakers</h3>
                <p class="sector-card__subtitle">Cohort Capacity Building</p>
                <p class="sector-card__description">For funders committed to strengthening their grantees, we provide cohort-based programs that build financial capacity, improve compliance, and amplify the long-term impact of your investments.</p>
                
                <div class="sector-card__features">
                    <ul class="feature-list">
                        <li>Community Foundations</li>
                        <li>Private Family Foundations</li>
                        <li>Place-Based Funders</li>
                        <li>Rural & Regional Funders</li>
                        <li>Intermediary Funders</li>
                        <li>Corporate Foundations</li>
                        <li>Donor Advised Funds</li>
                    </ul>
                </div>

                <div class="sector-card__expertise">
                    <h4>Specialized Expertise</h4>
                    <p>Grantee capacity building, financial management training, post-award compliance practices, grant-funded financial systems design.</p>
                </div>
                <a href="<?php echo home_url('/grantmakers'); ?>" class="browse-btn-outline">Learn More</a>
            </div>

        </div>

    </div>
</section>
