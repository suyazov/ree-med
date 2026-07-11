<?php
/*
Template Name: Юридическая страница
*/

get_header();
?>

<main class="legal-page">
    <section class="legal-section">
        <div class="container legal-container">
            <?php while (have_posts()) : the_post(); ?>
                <h1 class="legal-title"><?php the_title(); ?></h1>
                <div class="legal-content"><?php the_content(); ?></div>
            <?php endwhile; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
