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
                    echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="post-hero__category-link">';
                    echo esc_html($categories[0]->name);
                    echo '</a>';
                }
                ?>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="post-hero__grid">
            
            <!-- Left Column: Title -->
            <div class="post-hero__title-column">
                <h1 class="post-hero__title">
                    <?php the_title(); ?>
                </h1>
            </div>
            
            <!-- Right Column: Meta Description -->
            <div class="post-hero__description-column">
                <div class="post-hero__description">
                    <?php 
                    // Priority: RankMath → Yoast → Excerpt → Trimmed content
                    $meta_description = '';
                    
                    // Check RankMath first (free version has better features)
                    $rankmath_desc = get_post_meta(get_the_ID(), 'rank_math_description', true);
                    if (!empty($rankmath_desc)) {
                        $meta_description = $rankmath_desc;
                    }
                    
                    // Fallback to Yoast if RankMath not found
                    if (empty($meta_description)) {
                        $yoast_desc = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true);
                        if (!empty($yoast_desc)) {
                            $meta_description = $yoast_desc;
                        }
                    }
                    
                    // Display meta description, excerpt, or trimmed content
                    if (!empty($meta_description)) {
                        echo esc_html($meta_description);
                    } elseif (has_excerpt()) {
                        the_excerpt();
                    } else {
                        echo wp_trim_words(get_the_content(), 25, '...');
                    }
                    ?>
                </div>
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
