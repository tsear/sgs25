<?php
/**
 * Single Post Hero Section
 */

// Load Poppins font specifically for this component
wp_enqueue_style('poppins-font', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
?>

<section class="post-hero">
    <div class="post-hero__container">
        
        <!-- Post Meta Info -->
        <div class="post-hero__meta">
            <div class="post-hero__date">
                <?php echo get_the_date('l, F j'); ?>
            </div>
            <div class="post-hero__category">
                <?php 
                $categories = get_the_category();
                if (!empty($categories)) {
                    echo esc_html($categories[0]->name);
                }
                ?>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="post-hero__grid">
            
            <!-- Left Column: Title and Description -->
            <div class="post-hero__content">
                <h1 class="post-hero__title">
                    <?php the_title(); ?>
                </h1>
                
                <div class="post-hero__excerpt">
                    <?php 
                    if (has_excerpt()) {
                        the_excerpt();
                    } else {
                        echo wp_trim_words(get_the_content(), 30, '...');
                    }
                    ?>
                </div>
            </div>
            
            <!-- Right Column: Featured Image -->
            <div class="post-hero__image">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large', array('class' => 'post-hero__img')); ?>
                <?php endif; ?>
            </div>
            
        </div>

        <!-- Graphics Elements -->
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6162-6461-4233-b730-396261356134__ellipse_13_1.png" 
             alt="" 
             class="post-hero__ellipse"
             loading="lazy">
        
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tild6535-3966-4638-a265-393438636538__union.svg" 
             alt="" 
             class="post-hero__union"
             loading="lazy">

        <!-- Dividers -->
        <div class="post-hero__divider post-hero__divider--top"></div>
        <div class="post-hero__divider post-hero__divider--bottom"></div>
        <div class="post-hero__divider post-hero__divider--vertical"></div>
        
    </div>
</section>
