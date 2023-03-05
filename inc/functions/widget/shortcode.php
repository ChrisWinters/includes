<?php
/**
 * Global class.
 */

namespace Includes\Widget;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Custom widget to render shortcodes widget areas.
 */
class shortcode extends \WP_Widget
{
    /**
     * Init child.
     */
    public function __construct()
    {
        /*
         * Parent constructor.
         *
         * @param string $id_base Base ID for the widget, lowercase and unique.
         * @param string $name            Name for the widget displayed on the configuration page.
         * @param array  $widget_options  Optional. Widget options. See wp_register_sidebar_widget().
         */
        parent::__construct(
            'includes',
            __('Shortcode widget', 'includes'),
            [
                'description' => __('Render shortcodes in widget areas.', 'includes'),
            ]
        );
    }

    /**
     * Echoes the widget content.
     *
     * @param array $args     Widget arguments.
     * @param array $instance Widget settings.
     */
    public function widget($args, $instance): void
    {
        echo $args['before_widget'];
        echo \do_shortcode($instance['widget_shortcode']);
        echo $args['after_widget'];
    }

    /**
     * Outputs the settings update form.
     *
     * @param array $instance Current settings.
     *
     * @return string Default return is 'noform'.
     */
    public function form($instance): string
    {
        $shortcode = '';

        if (true !== empty($instance['widget_shortcode'])) {
            $shortcode = $instance['widget_shortcode'];
        }

        echo '<p><input class="widefat" id="includes" name="'.$this->get_field_name('widget_shortcode').'" type="text" value="'.\esc_html($shortcode).'" /></p>';

        return 'noform';
    }

    /**
     * Updates a particular instance of a widget.
     *
     * This function should check that `$new_instance` is set correctly. The newly-calculated
     * value of `$instance` should be returned. If false is returned, the instance won't be
     * saved/updated.
     *
     * @param array $new_instance New settings for this instance.
     * @param array $old_instance Old settings for this instance.
     *
     * @return array Settings to save or bool false to cancel saving.
     */
    public function update($new_instance, $old_instance): array
    {
        // Reset instance.
        $instance = [];

        // No widget data saved.
        $instance['widget_shortcode'] = '';

        // Widget data found, strip HTML and PHP tags.
        if (true !== empty($new_instance['widget_shortcode'])) {
            $instance['widget_shortcode'] = $new_instance['widget_shortcode'];
        }

        return $instance;
    }
}
