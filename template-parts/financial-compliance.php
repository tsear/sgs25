<?php
/**
 * Financial Compliance Section (two equal columns)
 * Left: title + rocket SVG (mirrors post-type hero styling)
 * Right: blurb + CTA
 */
?>

<section class="financial-compliance-section">
    <div class="financial-compliance-container">
        <div class="financial-compliance__grid">
            <!-- Left Column: Title + SVG -->
            <div class="financial-compliance__left">
                <div class="financial-compliance__title-frame">
                    <h2 class="financial-compliance__title">Automating Financial Compliance</h2>
                </div>
                <div class="financial-compliance__svg-container">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/red-rocket-div.svg" alt="" />
                </div>
                <div class="financial-compliance__description">
                    <p class="compliance-description">
                        Visit the Smart Grant Solutions blog for practical guidance on financial grant management—built from real frontline experience.
                    </p>
                </div>
            </div>

            <!-- Right Column: Description + CTA -->
            <div class="financial-compliance__right">
                <?php 
                // Recent posts slideshow (3 latest)
                $fc_recent_posts = new WP_Query([
                    'post_type'           => 'post',
                    'posts_per_page'      => 3,
                    'ignore_sticky_posts' => true,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                ]);
                if ($fc_recent_posts->have_posts()) : ?>
                    <div class="financial-compliance__slider" data-fc-slider aria-label="Recent blog posts">
                        <button class="fc-nav fc-nav--prev" aria-label="Previous post">
                            <svg viewBox="0 0 24 24">
                                <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                            </svg>
                        </button>
                        <button class="fc-nav fc-nav--next" aria-label="Next post">
                            <svg viewBox="0 0 24 24">
                                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                            </svg>
                        </button>
                        <?php $i = 0; while ($fc_recent_posts->have_posts()) : $fc_recent_posts->the_post(); $i++; ?>
                            <?php 
                              $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
                              if (!$thumb) {
                                  $thumb = get_template_directory_uri() . '/assets/images/tild3237-3532-4430-b831-336365643061__yt_thumbnail_1.jpg';
                              }
                              $author = get_the_author();
                            ?>
                            <article class="fc-slide<?php echo $i === 1 ? ' is-active' : ''; ?>">
                                <a class="fc-slide__image" href="<?php echo esc_url(get_permalink()); ?>">
                                    <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                                </a>
                                <div class="fc-slide__meta">
                                    <a class="fc-slide__title" href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                    <div class="fc-slide__byline">
                                        <span class="fc-slide__date"><?php echo esc_html(get_the_date('M j, Y')); ?></span>
                                        <span class="fc-slide__sep">•</span>
                                        <span class="fc-slide__author"><?php echo esc_html($author); ?></span>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                        
                        <!-- Browse All Button -->
                        <div class="financial-compliance__browse-all">
                            <a href="<?php echo home_url('/blog'); ?>" class="browse-all-btn">Browse All</a>
                        </div>
                    </div>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Optional: page indicator retained if used elsewhere -->
        <div class="page-indicator">1/4</div>
    </div>
</section>
