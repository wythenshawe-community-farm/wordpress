<?php
/*
Plugin Name: Opening Times widget
Description: Provides a WP customizer compatible Opening Time widget
Version: 1.0.0
Author: Cubic Mushroom Ltd.
License: GPLv2 or later
Text Domain: cm_opening_times
*/

/**
 * @param WP_Customize_Manager $wp_customize
 */
function cm_opening_times_customize_register($wp_customize)
{
    $wp_customize->add_setting(
        'cm_opening_times_widget_title',
        [
            'default'   => 'Opening Times',
            'transport' => 'refresh',
        ]
    );

    $wp_customize->add_setting(
        'cm_opening_times_widget_content',
        [
            'default'   => '11:30 - 16:00',
            'transport' => 'refresh',
        ]
    );

    $wp_customize->add_section(
        'cm_opening_times_section',
        [
            'title'       => __('Opening times', 'cm_opening_times'),
            'priority'    => 60,
            'description' => __('Configure the opening times widget'),
        ]
    );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'cm_opening_times_widget_title',
            [
                'label'    => __('Widget title', 'cm_opening_times'),
                'section'  => 'cm_opening_times_section',
                'settings' => 'cm_opening_times_widget_title',
            ]
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'cm_opening_times_widget_content',
            [
                'label'    => __('Opening times', 'cm_opening_times'),
                'type'     => 'textarea',
                'section'  => 'cm_opening_times_section',
                'settings' => 'cm_opening_times_widget_content',
            ]
        )
    );
}

add_action('customize_register', 'cm_opening_times_customize_register');

require(__DIR__.'/widgets/CM_OpeningTimes_Widget.php');
add_action(
    'widgets_init',
    function () {
        register_widget('CM_OpeningTimes_Widget');
    }
);

/**
 * Used by hook: 'customize_preview_init'
 *
 * @see add_action('customize_preview_init',$func)
 */
function cm_opening_times_load_admin_script()
{
    wp_enqueue_script(
        'cm-opening-times-themecustomizer',
        plugin_dir_url(__FILE__).'/js/wp-admin.js',
        ['jquery', 'customize-preview'],
        '',
        true
    );
}

add_action('admin_enqueue_scripts', 'cm_opening_times_load_admin_script');