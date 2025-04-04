<?php get_header(); ?>

<div class="page-header">
    <div class="container">
        <h1><?php _e('All Football Matches', 'bettingtips'); ?></h1>
        <p><?php _e('Browse expert tips, odds, and analysis for upcoming matches.', 'bettingtips'); ?></p>
    </div>
</div>

<main class="container">
    <?php if (have_posts()) : ?>
        <div class="match-list">
            <?php while (have_posts()) : the_post();
                $fields = SCF::get(); // Smart Custom Fields data
                ?>
                <article class="match-card hover-lift">
                    <div class="match-header">
                        <span class="league"><i class="fas fa-trophy"></i> <?php echo esc_html($fields['league_name']); ?></span>
                        <span class="date"><i class="far fa-calendar-alt"></i> <?php echo esc_html($fields['match_date']); ?> <?php echo esc_html($fields['match_time']); ?></span>
                    </div>
                    <div class="teams">
                        <div class="team">
                            <div class="team-name"><?php echo esc_html($fields['home_team']); ?></div>
                        </div>
                        <div class="vs"><?php _e('vs', 'bettingtips'); ?></div>
                        <div class="team">
                            <div class="team-name"><?php echo esc_html($fields['away_team']); ?></div>
                        </div>
                    </div>
                    <div class="prediction">
                        <div class="bet-tip"><span class="tip-label"><?php _e('Tip:', 'bettingtips'); ?></span> <span class="tip-value"><?php echo esc_html($fields['tip']); ?></span></div>
                        <div class="odds"><span class="odds-label"><?php _e('Odds:', 'bettingtips'); ?></span> <span class="odds-value"><?php echo esc_html($fields['odds']); ?></span></div>
                        <a class="btn btn-secondary btn-small" href="<?php the_permalink(); ?>"><?php _e('View Match', 'bettingtips'); ?></a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <div class="pagination">
            <?php the_posts_pagination([
                'mid_size'  => 2,
                'prev_text' => __('« Previous', 'bettingtips'),
                'next_text' => __('Next »', 'bettingtips'),
            ]); ?>
        </div>

    <?php else : ?>
        <p><?php _e('No matches found.', 'bettingtips'); ?></p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
