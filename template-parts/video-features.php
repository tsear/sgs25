<?php
/**
 * Video Features Section
 * 4 video cards with rocket imagery (no testimonial)
 */
?>

<section class="video-features-section">
    <!-- Background Ellipse Decorations -->
    <div class="background-ellipses">
        <div class="ellipse ellipse-top-right"></div>
        <div class="ellipse ellipse-bottom-left"></div>
    </div>

    <!-- Rocket Images (Left Side) -->
    <div class="rocket-images">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3764-3731-4235-b531-613966333738__1saturn_v_vs_n1_-_to.png" alt="Rocket 1" class="rocket rocket-1">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3364-6535-4135-a634-386337336233__1saturn_v_vs_n1_-_to.png" alt="Rocket 2" class="rocket rocket-2">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3932-3336-4765-a364-643364366263__1saturn_v_vs_n1_-_to.png" alt="Rocket 3" class="rocket rocket-3">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6239-6462-4636-b161-353032393638__1saturn_v_vs_n1_-_to.png" alt="Rocket 4" class="rocket rocket-4">
    </div>

    <!-- Exhaust Flames -->
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6430-6437-4930-b866-623334336661__group_1000011511.png" alt="Exhaust Flames Left" class="exhaust-flame exhaust-flame-left">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3537-6631-4964-b061-363536653330__group_1000011512.png" alt="Exhaust Flames Right" class="exhaust-flame exhaust-flame-right">

    <!-- Connection Labels (Connecting rockets to cards) -->
    <div class="connection-labels">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3561-3936-4731-b062-653464323637__group_1000011509.png" alt="Connection Label 1" class="connection-label label-1">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3339-3539-4436-b737-303530373433__group_1000011510.png" alt="Connection Label 2" class="connection-label label-2">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3966-3834-4964-b930-356130616564__group_1000011509_1.png" alt="Connection Label 3" class="connection-label label-3">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild3261-6165-4736-b239-326432333735__group_1000011510_1.png" alt="Connection Label 4" class="connection-label label-4">
    </div>

    <!-- Video Cards Container -->
    <div class="video-cards-container">
        <!-- Card 1: Strategic Insights -->
        <div class="video-card" data-card-index="1">
            <div class="video-wrapper">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/strategic-resource-management.gif" alt="Strategic Resource Management" class="feature-gif" loading="eager">
            </div>
            <div class="card-content">
                <p>Budgeting keeps you compliant, and MissionGranted keeps it simple. Our tools pull all your funding sources into one clear view so you can see how they work together, plan for what-ifs, adjust when things change, and make confident decisions that move your mission forward.</p>
            </div>
            <a href="#" class="video-card__read-more">Read More</a>
        </div>

        <!-- Card 2: Automation -->
        <div class="video-card">
            <div class="video-wrapper">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/automation-over-spreadsheets.gif" alt="Automation Over Spreadsheets" class="feature-gif">
            </div>
            <div class="card-content">
                <p>MissionGranted takes the messy compliance work you’re stuck doing in spreadsheets—like indirect costs and payroll splits—and automates it. That means fewer mistakes, less wasted time, and more capacity for your team to focus on the bigger picture.</p>
            </div>
            <a href="#" class="video-card__read-more">Read More</a>
        </div>

        <!-- Card 3: Compliance -->
        <div class="video-card">
            <div class="video-wrapper">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/simplified-compliance.gif" alt="Simplified Compliance" class="feature-gif">
            </div>
            <div class="card-content">
                <p>MissionGranted works alongside your team to spot compliance risks early and offer clear guidance on budgets and spending. With smarter alerts and recommendations, you can align funding to shifting program needs, stay compliant, and make the most of limited resources.</p>
            </div>
            <a href="#" class="video-card__read-more">Read More</a>
        </div>

        <!-- Card 4: Best Practices -->
        <div class="video-card">
            <div class="video-wrapper">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/audit-ready-data.gif" alt="Audit Ready Data" class="feature-gif">
            </div>
            <div class="card-content">
                <p>Built for social impact organizations, MissionGranted combines an easy-to-use interface with built-in financial best practices and real-time compliance guidance. It keeps your numbers accurate, your team confident, and your organization ready to meet requirements without the stress.</p>
            </div>
            <a href="#" class="video-card__read-more">Read More</a>
        </div>
    </div>
</section>
