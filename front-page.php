<?php get_header(); ?>

<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h2><?php _e('Expert Football Betting Tips', 'bettingtips'); ?></h2>
            <p><?php _e('Get the most accurate predictions for football matches worldwide', 'bettingtips'); ?></p>
            <a href="#tips" class="btn"><?php _e("View Today's Tips", 'bettingtips'); ?></a>
        </div>
    </div>
</section>

<main>
    <div class="container">
        <div class="content-wrapper">
            <section class="main-content" id="tips">
                <h2><?php _e("Today's Top Betting Tips", 'bettingtips'); ?></h2>
                <?php get_template_part('template-parts/tips-today'); ?>
            </section>

            <aside class="sidebar">
                <?php get_template_part('template-parts/sidebar'); ?>
            </aside>
        </div>
    </div>
</main>

<section class="stats-section">
    <div class="container">
        <h2><?php _e('Our Success Rate', 'bettingtips'); ?></h2>
        <div class="stats-container">
            <div class="stat-box">
                <div class="stat-number">78%</div>
                <div class="stat-label"><?php _e('Success Rate', 'bettingtips'); ?></div>
            </div>
            <div class="stat-box">
                <div class="stat-number">300+</div>
                <div class="stat-label"><?php _e('Tips Per Month', 'bettingtips'); ?></div>
            </div>
            <div class="stat-box">
                <div class="stat-number">20+</div>
                <div class="stat-label"><?php _e('Leagues Covered', 'bettingtips'); ?></div>
            </div>
            <div class="stat-box">
                <div class="stat-number">15k+</div>
                <div class="stat-label"><?php _e('Happy Users', 'bettingtips'); ?></div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>