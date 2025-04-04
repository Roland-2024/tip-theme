<?php
/**
 * Template Name: Upcoming Matches
 */

get_header(); ?>

<section class="page-header">
    <div class="container">
        <h1>Upcoming Matches</h1>
        <p>Schedule of upcoming football matches with our expert predictions</p>
    </div>
</section>

<main>
    <div class="container">
        <div class="content-wrapper">
            <section class="main-content" id="upcoming">
                <!-- Optional Date Filter Tabs -->
                <div class="date-filter">
                <div class="date-tabs">
                        <a href="?range=today" class="date-tab <?php echo ($_GET['range'] ?? 'today') === 'today' ? 'active' : ''; ?>">Today</a>
                        <a href="?range=tomorrow" class="date-tab <?php echo ($_GET['range'] ?? '') === 'tomorrow' ? 'active' : ''; ?>">Tomorrow</a>
                        <a href="?range=this-week" class="date-tab <?php echo ($_GET['range'] ?? '') === 'this-week' ? 'active' : ''; ?>">This Week</a>
                        <a href="?range=next-week" class="date-tab <?php echo ($_GET['range'] ?? '') === 'next-week' ? 'active' : ''; ?>">Next Week</a>
                    </div>
                </div>
                <?php
                // Get all upcoming matches sorted by date
                $range = $_GET['range'] ?? 'today';
                $today = current_time('Ymd');
                $meta_query = [];
                
                switch ($range) {
                    case 'tomorrow':
                        $tomorrow = date('Ymd', strtotime('+1 day', strtotime($today)));
                        $meta_query[] = [
                            'key'     => 'match_date',
                            'value'   => $tomorrow,
                            'compare' => '=',
                        ];
                        break;
                
                    case 'this-week':
                        $start = $today;
                        $end = date('Ymd', strtotime('sunday this week', strtotime($today)));
                        $meta_query[] = [
                            'key'     => 'match_date',
                            'value'   => [$start, $end],
                            'compare' => 'BETWEEN',
                            'type'    => 'DATE',
                        ];
                        break;
                
                    case 'next-week':
                        $start = date('Ymd', strtotime('monday next week', strtotime($today)));
                        $end = date('Ymd', strtotime('sunday next week', strtotime($today)));
                        $meta_query[] = [
                            'key'     => 'match_date',
                            'value'   => [$start, $end],
                            'compare' => 'BETWEEN',
                            'type'    => 'DATE',
                        ];
                        break;
                
                    case 'today':
                    default:
                        $meta_query[] = [
                            'key'     => 'match_date',
                            'value'   => $today,
                            'compare' => '=',
                        ];
                        break;
                }
                
                $matches = new WP_Query([
                    'post_type'      => 'match',
                    'posts_per_page' => -1,
                    'meta_key'       => 'match_date',
                    'orderby'        => 'meta_value',
                    'order'          => 'ASC',
                    'meta_query'     => $meta_query
                ]);
                

                if ($matches->have_posts()) :
                    while ($matches->have_posts()) : $matches->the_post();
                        $team_home = get_field('team_home');
                        $team_away = get_field('team_away');
                        $match_date = get_field('match_date');
                        $match_time = get_field('match_time');
                        $venue = get_field('venue');
                        $tip = get_field('match_tip');
                        $odds = get_field('match_odds');
                        $terms = get_the_terms(get_the_ID(), 'match_category');
                        $league = (!empty($terms) && !is_wp_error($terms)) ? $terms[0]->name : 'Uncategorized';
                ?>

                <div class="match-card upcoming-card hover-lift">
                    <div class="match-header">
                        <span class="league"><i class="fas fa-trophy"></i> <?php echo esc_html($league); ?></span>
                        <span class="date"><i class="far fa-calendar-alt"></i> <?php echo esc_html($match_date); ?> - <?php echo esc_html($match_time); ?></span>
                    </div>
                    <div class="teams">
                        <div class="team home">
                            <div class="team-logo"><i class="fas fa-shield-alt"></i></div>
                            <span class="team-name"><?php echo esc_html($team_home); ?></span>
                        </div>
                        <div class="vs">VS</div>
                        <div class="team away">
                            <div class="team-logo"><i class="fas fa-shield-alt"></i></div>
                            <span class="team-name"><?php echo esc_html($team_away); ?></span>
                        </div>
                    </div>
                    <div class="prediction-preview">
                        <div  class="prediction-preview__flex">
                            <div class="bet-tip">
                                <span class="label">Our Tip:</span>
                                <span class="value"><?php echo esc_html($tip); ?></span>
                            </div>
                            <div class="odds">
                                <span class="label">Odds:</span>
                                <span class="odds-value"><?php echo esc_html($odds); ?></span>
                            </div>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="view-full-match"><i class="fas fa-chart-line"></i> View Full Prediction</a>
                    </div>
                </div>

                <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    <p>No upcoming matches found.</p>
                <?php endif; ?>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>