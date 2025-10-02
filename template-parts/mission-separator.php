<?php
/**
 * Mission Separator Section (EXACT copy from Financial Compliance)
 * Left: title + rocket SVG (mirrors post-type hero styling)  
 * Right: blurb + CTA
 */
?>

<section class="mission-separator-section">
    <div class="mission-separator-container">
        <div class="mission-separator__grid">
            <!-- Left Column: RSS Slideshow -->
            <div class="mission-separator__left">
                <?php 
                // Recent grants slideshow (3 latest)
                $ms_recent_posts = new WP_Query([
                    'post_type'           => 'grant_opportunity',
                    'posts_per_page'      => 3,
                    'ignore_sticky_posts' => true,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                ]);
                if ($ms_recent_posts->have_posts()) : ?>
                    <div class="mission-separator__slider" data-ms-slider aria-label="Recent grant opportunities">
                        <button class="ms-nav ms-nav--prev" aria-label="Previous grant">
                            <svg viewBox="0 0 24 24">
                                <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                            </svg>
                        </button>
                        <button class="ms-nav ms-nav--next" aria-label="Next grant">
                            <svg viewBox="0 0 24 24">
                                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                            </svg>
                        </button>
                        <?php $i = 0; while ($ms_recent_posts->have_posts()) : $ms_recent_posts->the_post(); $i++; ?>
                            <?php 
                              $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
                              if (!$thumb) {
                                  $thumb = get_template_directory_uri() . '/assets/images/blue-circle.png';
                              }
                            ?>
                            <article class="ms-slide<?php echo $i === 1 ? ' is-active' : ''; ?>">
                                <a class="ms-slide__image" href="<?php echo esc_url(get_permalink()); ?>">
                                    <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                                </a>
                                <div class="ms-slide__meta">
                                    <a class="ms-slide__title" href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                    <div class="ms-slide__byline">
                                        <span class="ms-slide__date"><?php echo esc_html(get_the_date('M j, Y')); ?></span>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                        
                        <!-- Browse All Button -->
                        <div class="mission-separator__browse-all">
                            <a href="<?php echo home_url('/grants'); ?>" class="browse-all-btn">Browse All</a>
                        </div>
                    </div>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>

            <!-- Right Column: Title + SVG + Description -->
            <div class="mission-separator__right">
                <div class="mission-separator__title-frame">
                    <h2 class="mission-separator__title">Our Mission is to Fuel Yours</h2>
                </div>
                <div class="mission-separator__svg-container">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/yellow-rocket-div.svg" alt="" />
                </div>
                <div class="mission-separator__description">
                    <p class="compliance-description">
                        Find potential funding in our Grant Repository and rely on us to simplify management once the dollars arrive.
                    </p>
                </div>
            </div>
        </div>

        <!-- Optional: page indicator retained if used elsewhere -->
        <div class="page-indicator">1/4</div>
    </div>
</section>
