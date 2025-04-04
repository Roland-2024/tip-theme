<?php
/**
 * Single Match Template
 * 
 * This file displays a single match's static layout. 
 * 
 * - Calls get_header() and get_footer() for the standard WP header/footer
 * - Loads a separate partial for the sidebar content
 */

get_header(); 
?>

<div class="match-template">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?php echo home_url(); ?>">Home</a> &gt; 
            <a href="<?php echo get_post_type_archive_link('match'); ?>">Match Analysis</a> &gt; 
            <span class="current-page"><?php the_title(); ?></span>
        </div>
    <div class="match-header-large">
    <h1>Match Analysis</h1>
        <?php
        // Get the first category assigned to this match post
        $terms = get_the_terms(get_the_ID(), 'match_category');

        $league = 'Uncategorized'; // Default fallback
        if (!empty($terms) && !is_wp_error($terms)) {
            // If you want all categories comma-separated:
            // $league = implode(', ', wp_list_pluck($terms, 'name'));

            // Or just the first one:
            $league = $terms[0]->name;
        }

        $match_date = get_field('match_date');
        $match_time = get_field('match_time');
        $venue      = get_field('venue');
        ?>
        <div class="match-meta">
            <span class="league-large">
                <i class="fas fa-trophy"></i>
                <span class="league-name"><?php echo esc_html($league); ?></span>
            </span>
            <span class="date-large">
                <i class="far fa-calendar-alt"></i>
                <span class="match-date"><?php echo esc_html($match_date); ?></span>
            </span>
            <span class="time-large">
                <i class="far fa-clock"></i>
                <span class="match-time"><?php echo esc_html($match_time); ?></span>
            </span>
            <span class="venue-large">
                <i class="fas fa-map-marker-alt"></i>
                <span class="match-venue"><?php echo esc_html($venue); ?></span>
            </span>
        </div>
    </div>
        
        <?php
        $team_home = get_field('team_home');
        $team_away = get_field('team_away');
        ?>
        <div class="teams-large">
            <div class="team-large home">
                <div class="team-logo">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h2 class="team-name-large home-team"><?php echo esc_html($team_home); ?></h2>
            </div>
            <div class="vs-large">VS</div>
            <div class="team-large away">
                <div class="team-logo">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h2 class="team-name-large away-team"><?php echo esc_html($team_away); ?></h2>
            </div>
        </div>
        
        <div class="match-content-wrapper">
            <div class="match-main-content">
                <?php
                $tip       = get_field('match_tip');
                $odds      = get_field('match_odds');
                $confidence = get_field('confidence_level');

                // Set CSS class for confidence bar based on percentage
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
                <section class="prediction-section">
                    <h2>Our Prediction</h2>
                    <div class="prediction-details">
                        <div class="prediction-item">
                            <span class="prediction-label">Tip:</span>
                            <span class="prediction-value tip-value"><?php echo esc_html($tip); ?></span>
                        </div>
                        <div class="prediction-item">
                            <span class="prediction-label">Odds:</span>
                            <span class="prediction-value odds-value"><?php echo esc_html($odds); ?></span>
                        </div>
                        <div class="prediction-item">
                            <span class="prediction-label">Confidence:</span>
                            <div class="confidence-meter-large <?php echo esc_attr($conf_class); ?>">
                                <div class="meter-fill" style="width: <?php echo intval($confidence); ?>%;"></div>
                            </div>
                            <span class="confidence-text"><?php echo ucfirst($conf_class); ?> (<?php echo intval($confidence); ?>%)</span>
                        </div>
                    </div>
                </section>  
                <section class="analysis-section">
                    <h2>Detailed Analysis</h2>
                    <div class="analysis-content">
                        <?php the_content(); ?>
                    </div>
                </section>
            </div>
            
            <!-- Load the sidebar partial from template-parts -->
            <?php get_template_part( 'template-parts/match', 'sidebar' ); ?>
            
        </div>
    </div>
</div>

<?php get_footer(); ?>
