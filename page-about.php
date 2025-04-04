<?php
/**
 * Template Name: About Us
 */

get_header(); ?>

<div class="match-template">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?php echo home_url(); ?>"><?php _e('Home', 'bettingtips'); ?></a> &gt;
            <span class="current-page"><?php the_title(); ?></span>
        </div>

        <div class="match-header-large">
            <h1><?php the_title(); ?></h1>
        </div>

        <div class="match-content-wrapper">
            <div class="match-main-content">
                <section class="analysis-section">
                    <div class="analysis-content">
                        <?php
                        while (have_posts()) : the_post();
                            the_content();
                        endwhile;
                        ?>
                    </div>
                </section>
            </div>

            <?php get_template_part('template-parts/match', 'sidebar'); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
