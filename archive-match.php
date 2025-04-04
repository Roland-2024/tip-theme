<?php
get_header(); ?>

<div class="page-header">
    <div class="container">
        <h1><?php post_type_archive_title(); ?></h1>
        <p>Explore all our expert match previews and predictions.</p>
    </div>
</div>

<div class="container match-list">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="match-card">
                <div class="match-header">
                    <div class="league">
                        <i class="fas fa-trophy"></i> 
                        <?php
                        $terms = get_the_terms(get_the_ID(), 'match_category');
                        if ($terms && !is_wp_error($terms)) {
                            echo esc_html($terms[0]->name);
                        }
                        ?>
                    </div>
                    <div class="match-date">
                        <i class="far fa-calendar-alt"></i>
                        <?php echo esc_html(get_field('match_date')); ?>
                    </div>
                </div>
                <div class="teams">
                    <div class="team">
                        <div class="team-name"><?php echo esc_html(get_field('team_home')); ?></div>
                    </div>
                    <div class="vs">VS</div>
                    <div class="team">
                        <div class="team-name"><?php echo esc_html(get_field('team_away')); ?></div>
                    </div>
                </div>
                <div class="prediction">
                    <h3>Tip: <span class="tip-value"><?php echo esc_html(get_field('match_tip')); ?></span></h3>
                    <div class="odds">
                        <strong>Odds:</strong> 
                        <span class="odds-value"><?php echo esc_html(get_field('match_odds')); ?></span>
                    </div>
                </div>
                <div class="analysis p-3">
                    <p><?php echo wp_trim_words(get_the_content(), 30); ?></p>
                    <a href="<?php the_permalink(); ?>" class="read-more-btn">View Full Match</a>
                </div>
            </div>
        <?php endwhile; ?>

        <div class="pagination">
            <?php the_posts_pagination(); ?>
        </div>

    <?php else : ?>
        <p>No matches found.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
