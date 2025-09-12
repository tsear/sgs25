<?php
/**
 * Tag Archive Template
 */

get_header(); ?>

<main class="tag-archive">
    <?php get_template_part('template-parts/blog/blog-header'); ?>
    <?php get_template_part('template-parts/blog/search-form'); ?>
    <?php get_template_part('template-parts/blog/post-grid'); ?>
</main>

<?php get_footer(); ?>
