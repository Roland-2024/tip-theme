<?php
$today = date('Ymd'); // Match ACF's return format for date_picker

$matches = new WP_Query([
    'post_type'      => 'match',
    'posts_per_page' => -1,
    'meta_key'       => 'match_date',
    'orderby'        => 'meta_value',
    'order'          => 'ASC',
    'meta_query'     => [
        [
            'key'     => 'match_date',
            'value'   => $today,
            'compare' => '=',
        ]
    ]
]);

if ($matches->have_posts()) :
    while ($matches->have_posts()) : $matches->the_post();

        $team_home   = get_field('team_home');
        $team_away   = get_field('team_away');
        $match_date  = get_field('match_date');
        $match_time  = get_field('match_time');
        $tip         = get_field('match_tip');
        $odds        = get_field('match_odds');
        $confidence  = get_field('confidence_level');
        $excerpt     = wp_trim_words(get_the_content(), 20);

        $terms  = get_the_terms(get_the_ID(), 'match_category');
        $league = (!empty($terms) && !is_wp_error($terms)) ? $terms[0]->name : __('Uncategorized', 'bettingtips');

        if ($confidence >= 90) {
            $conf_class = 'very-high';
        } elseif ($confidence >= 70) {
            $conf_class = 'high';
        } elseif ($confidence >= 50) {
            $conf_class = 'medium';
        } else {
            $conf_class = 'low';
        }
        ?>

        <div class="match-card">
            <div class="match-header">
                <span class="league"><i class="fas fa-trophy"></i> <?php echo esc_html($league); ?></span>
                <span class="date"><?php echo esc_html("$match_date - $match_time"); ?></span>
            </div>
            <div class="teams">
                <div class="team home"><span class="team-name"><?php echo esc_html($team_home); ?></span></div>
                <div class="vs"><?php _e('VS', 'bettingtips'); ?></div>
                <div class="team away"><span class="team-name"><?php echo esc_html($team_away); ?></span></div>
            </div>
            <div class="prediction">
                <h3><?php _e('Our Prediction', 'bettingtips'); ?></h3>
                <div class="bet-tip">
                    <span class="tip-label"><?php _e('Tip:', 'bettingtips'); ?></span>
                    <span class="tip-value"><?php echo esc_html($tip); ?></span>
                </div>
                <div class="odds">
                    <span class="odds-label"><?php _e('Odds:', 'bettingtips'); ?></span>
                    <span class="odds-value"><?php echo esc_html($odds); ?></span>
                </div>
                <div class="confidence">
                    <span class="confidence-label"><?php _e('Confidence:', 'bettingtips'); ?></span>
                    <div class="confidence-meter <?php echo esc_attr($conf_class); ?>">
                        <div class="meter-fill" style="width:<?php echo intval($confidence); ?>%;"></div>
                    </div>
                </div>
            </div>
            <div class="analysis">
                <div class="analysis-preview">
                    <p><?php echo esc_html($excerpt); ?></p>
                </div>
                <a href="<?php the_permalink(); ?>" class="view-full-match">
                    <?php _e('View Full Match Analysis', 'bettingtips'); ?>
                </a>
            </div>
        </div>

        <?php
    endwhile;
    wp_reset_postdata();
else :
    echo '<p>' . __('No matches available for today.', 'bettingtips') . '</p>';
endif;
?>
