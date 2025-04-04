<?php
/**
 * Register ACF fields for Match custom post type
 */

add_action('acf/init', 'register_match_acf_fields');
function register_match_acf_fields() {
    if( function_exists('acf_add_local_field_group') ) {

        acf_add_local_field_group(array(
            'key' => 'group_match_fields',
            'title' => 'Match Details',
            'fields' => array(

                array(
                    'key' => 'field_match_info_tab',
                    'label' => 'Match Info',
                    'name' => '',
                    'type' => 'tab',
                ),
                array(
                    'key' => 'field_team_home',
                    'label' => 'Home Team Name',
                    'name' => 'team_home',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_team_away',
                    'label' => 'Away Team Name',
                    'name' => 'team_away',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_league',
                    'label' => 'League',
                    'name' => 'league',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_match_date',
                    'label' => 'Match Date',
                    'name' => 'match_date',
                    'type' => 'date_picker',
                    'display_format' => 'F j, Y',
                    'return_format' => 'F j, Y',
                ),
                array(
                    'key' => 'field_match_time',
                    'label' => 'Match Time',
                    'name' => 'match_time',
                    'type' => 'time_picker',
                    'display_format' => 'H:i',
                    'return_format' => 'H:i',
                ),
                array(
                    'key' => 'field_venue',
                    'label' => 'Venue',
                    'name' => 'venue',
                    'type' => 'text',
                ),

                array(
                    'key' => 'field_prediction_tab',
                    'label' => 'Prediction',
                    'name' => '',
                    'type' => 'tab',
                ),
                array(
                    'key' => 'field_match_tip',
                    'label' => 'Tip',
                    'name' => 'match_tip',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_match_odds',
                    'label' => 'Odds',
                    'name' => 'match_odds',
                    'type' => 'number',
                    'step' => '0.01',
                ),
                array(
                    'key' => 'field_confidence_level',
                    'label' => 'Confidence %',
                    'name' => 'confidence_level',
                    'type' => 'number',
                    'min' => 1,
                    'max' => 100,
                    'step' => 1,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'match',
                    ),
                ),
            ),
        ));
    }
}
