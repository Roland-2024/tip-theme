<div class="widget upcoming-matches">
    <h3><?php _e('Upcoming Matches', 'bettingtips'); ?></h3>
    <ul>
        <?php
        $today = date('Ymd');

        $upcoming_matches = new WP_Query([
            'post_type'      => 'match',
            'posts_per_page' => 5,
            'meta_key'       => 'match_date',
            'orderby'        => 'meta_value',
            'order'          => 'ASC',
            'meta_query'     => [
                [
                    'key'     => 'match_date',
                    'value'   => $today,
                    'compare' => '>=',
                ],
            ],
        ]);

        if ($upcoming_matches->have_posts()) :
            while ($upcoming_matches->have_posts()) : $upcoming_matches->the_post();
                $team_home  = get_field('team_home');
                $team_away  = get_field('team_away');
                $match_date = get_field('match_date');
                $match_time = get_field('match_time');
                $terms      = get_the_terms(get_the_ID(), 'match_category');
                $league     = (!empty($terms) && !is_wp_error($terms)) ? $terms[0]->name : __('Unknown League', 'bettingtips');

                $formatted_date = date_i18n('M j, H:i', strtotime("$match_date $match_time"));
                ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <div class="match-info">
                            <span class="league-small"><?php echo esc_html($league); ?></span>
                            <div class="teams-small"><?php echo esc_html("$team_home vs $team_away"); ?></div>
                            <span class="date-small"><?php echo esc_html($formatted_date); ?></span>
                        </div>
                    </a>
                </li>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <li><?php _e('No upcoming matches found.', 'bettingtips'); ?></li>
        <?php endif; ?>
    </ul>
</div>

<div class="widget recent-results">
    <h3><?php _e('Recent Results', 'bettingtips'); ?></h3>
    <ul>
        <?php
        $today = date('Ymd');
        $seven_days_ago = date('Ymd', strtotime('-7 days'));

        $recent_results = new WP_Query([
            'post_type'      => 'match',
            'posts_per_page' => 5,
            'meta_key'       => 'match_date',
            'orderby'        => 'meta_value',
            'order'          => 'DESC',
            'meta_query'     => [
                [
                    'key'     => 'match_date',
                    'value'   => [$seven_days_ago, date('Ymd', strtotime('-1 day'))],
                    'compare' => 'BETWEEN',
                    'type'    => 'DATE'
                ]
            ],
        ]);

        if ($recent_results->have_posts()) :
            while ($recent_results->have_posts()) : $recent_results->the_post();
                $team_home  = get_field('team_home');
                $team_away  = get_field('team_away');
                $tip        = get_field('match_tip');
                $score      = get_field('match_score'); // If not defined, returns null
                $terms      = get_the_terms(get_the_ID(), 'match_category');
                $league     = (!empty($terms) && !is_wp_error($terms)) ? $terms[0]->name : __('Unknown League', 'bettingtips');

                $result_class = 'success'; // Temporary logic, replace later with API result matching

                ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <div class="result-info">
                            <span class="league-small"><?php echo esc_html($league); ?></span>
                            <div class="teams-small">
                                <?php
                                echo esc_html(
                                    $team_home . ' ' . ($score ? $score : __('vs', 'bettingtips')) . ' ' . $team_away
                                );
                                ?>
                            </div>
                            <span class="tip-result <?php echo esc_attr($result_class); ?>">
                                <?php echo sprintf(__('Tip: %s %s', 'bettingtips'), esc_html($tip), $result_class === 'success' ? '✓' : '✗'); ?>
                            </span>
                        </div>
                    </a>
                </li>
                <?php
            endwhile;
            wp_reset_postdata();
        else : ?>
            <li><?php _e('No recent results found.', 'bettingtips'); ?></li>
        <?php endif; ?>
    </ul>
</div>

<div class="widget newsletter">
    <h3><?php _e('Get Premium Tips', 'bettingtips'); ?></h3>
    <p><?php _e('Subscribe to our newsletter for exclusive betting tips delivered to your inbox daily.', 'bettingtips'); ?></p>
    <form>
        <input type="email" placeholder="<?php esc_attr_e('Your Email Address', 'bettingtips'); ?>">
        <button type="submit" class="btn"><?php _e('Subscribe', 'bettingtips'); ?></button>
    </form>
</div>
