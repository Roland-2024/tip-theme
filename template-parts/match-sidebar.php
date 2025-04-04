<?php
/**
 * Partial: Match Sidebar
 * 
 * Displays the sidebar content for a single match.
 */
?>

<aside class="match-sidebar" role="complementary">
    <div class="widget betting-odds">
        <!-- You can dynamically insert odds widgets or promo content here later -->
    </div>

    <div class="widget related-matches">
        <h3><?php _e('More Matches Today', 'bettingtips'); ?></h3>
        <ul>
            <?php
            $today = date('Ymd'); // Format used by ACF date_picker return_format
            $current_id = get_the_ID();

            $related_matches = new WP_Query(array(
                'post_type' => 'match',
                'posts_per_page' => 4,
                'post__not_in' => array($current_id),
                'meta_key' => 'match_date',
                'orderby' => 'meta_value',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => 'match_date',
                        'value' => $today,
                        'compare' => '=',
                    )
                )
            ));

            if ($related_matches->have_posts()) :
                while ($related_matches->have_posts()) : $related_matches->the_post();
                    $home = get_field('team_home');
                    $away = get_field('team_away');
                    $time = get_field('match_time');
                    $terms = get_the_terms(get_the_ID(), 'match_category');
                    $league = (!empty($terms) && !is_wp_error($terms)) ? $terms[0]->name : __('Uncategorized', 'bettingtips');
                    ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <div class="related-match">
                                <div class="related-teams"><?php echo esc_html("$home vs $away"); ?></div>
                                <div class="related-league"><?php echo esc_html($league); ?></div>
                                <div class="related-time"><?php echo esc_html($time); ?></div>
                            </div>
                        </a>
                    </li>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <li><?php _e('No other matches today.', 'bettingtips'); ?></li>
            <?php endif; ?>
        </ul>
    </div>

    <div class="widget newsletter">
        <h3><?php _e('Get Premium Tips', 'bettingtips'); ?></h3>
        <p><?php _e('Subscribe to our newsletter for exclusive betting tips delivered to your inbox daily.', 'bettingtips'); ?></p>
        <form action="#" method="post">
            <input type="email" name="email" placeholder="<?php esc_attr_e('Your Email Address', 'bettingtips'); ?>" required>
            <button type="submit" class="btn"><?php _e('Subscribe', 'bettingtips'); ?></button>
        </form>
    </div>
</aside>
