<?php get_header(); ?>

<main class="main">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            the_content();
        endwhile;
    else :
        echo '<p>' . esc_html__('Ничего не найдено.', 'trimed') . '</p>';
    endif;
    ?>
</main>

<?php get_footer(); ?>
