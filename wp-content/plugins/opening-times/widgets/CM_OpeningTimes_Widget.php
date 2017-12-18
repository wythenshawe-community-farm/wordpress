<?php

/**
 * Widget to display opening times
 */
class CM_OpeningTimes_Widget extends WP_Widget
{
    const THEME_MOD_DEFAULT_WIDGET_TITLE = 'Opening Times';


    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = [
            'classname'   => 'cm_opening_times',
            'description' => 'Displays currently configured opening times',
        ];
        parent::__construct('cm_opening_times', 'Opening Times', $widget_ops);
    }


    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        $title   = get_theme_mod('cm_opening_times_widget_title', self::THEME_MOD_DEFAULT_WIDGET_TITLE);
        $content = implode(
            array_map(
                function ($line) {
                    return "<p>${line}</p>";
                },
                explode("\n", get_theme_mod('cm_opening_times_widget_content', ''))
            )
        );

        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'].apply_filters('widget_title', $title, $instance).$args['after_title'];
        }
        echo '<div>';
        echo $content;
        echo '</div>';
        echo $args['after_widget'];
    }


    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form($instance)
    {
        $title         = get_theme_mod('cm_opening_times_widget_title', self::THEME_MOD_DEFAULT_WIDGET_TITLE);
        $opening_times = get_theme_mod('cm_opening_times_widget_content', '');
        ?>
        <dl>
            <dt>Title:</dt>
            <dd><?php echo $title; ?></dd>
            <dt>Times:</dt>
            <dl><?php echo $opening_times; ?></dl>
        </dl>
        <p>
            Update opening times
            <a href="<?php echo admin_url('customize.php'); ?>#control=cm_opening_times_widget_content"
               data-open-control="cm_opening_times_widget_content">here</a>
        </p>
        <?php
    }


    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update($new_instance, $old_instance)
    {
        return [];
    }
}