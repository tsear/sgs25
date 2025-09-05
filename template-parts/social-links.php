<?php
/**
 * Social Links Template Part
 */

$social_links = array(
    'facebook' => get_theme_mod('social_facebook'),
    'twitter' => get_theme_mod('social_twitter'),
    'linkedin' => get_theme_mod('social_linkedin'),
    'instagram' => get_theme_mod('social_instagram'),
    'youtube' => get_theme_mod('social_youtube'),
);

// Filter out empty links
$social_links = array_filter($social_links);

if (!empty($social_links)) : ?>
    <div class="social-links">
        <?php foreach ($social_links as $platform => $url) : ?>
            <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr(ucfirst($platform)); ?>">
                <?php
                // Simple icons - you can replace with SVG or icon fonts
                switch ($platform) {
                    case 'facebook':
                        echo '<span>f</span>';
                        break;
                    case 'twitter':
                        echo '<span>𝕏</span>';
                        break;
                    case 'linkedin':
                        echo '<span>in</span>';
                        break;
                    case 'instagram':
                        echo '<span>📷</span>';
                        break;
                    case 'youtube':
                        echo '<span>▶</span>';
                        break;
                }
                ?>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
