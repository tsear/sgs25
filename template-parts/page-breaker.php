<?php
/**
 * Page Breaker Component - Horizontal section divider with title
 * 
 * @param string $title - The title text to display
 * @param string $additional_classes - Optional additional CSS classes
 */

// Get the title from the component call or use default
$title = $args['title'] ?? 'Default Title';
$additional_classes = $args['additional_classes'] ?? '';
?>

<section class="page-breaker <?php echo esc_attr($additional_classes); ?>" data-rocket-section>
    <div class="page-breaker__container">
        <div class="page-breaker__graphic" data-rocket-element>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/graphic-rocket copy.png" alt="Rocket" />
        </div>
    </div>
</section>
