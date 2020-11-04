<?php
/**
 * @package testwebsite
 */

add_action('widgets_init', 'testwebsite_register_personal_info');

function testwebsite_register_personal_info() {
    register_widget('testwebsite_personal_info');
}

class testwebsite_Personal_Info extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'testwebsite_personal_info', 'testwebsite - Personal Info', array(
                'description' => __('A widget to display Personal Information', 'testwebsite')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'title' => array(
                'testwebsite_widgets_name' => 'title',
                'testwebsite_widgets_title' => __('Title', 'testwebsite'),
                'testwebsite_widgets_field_type' => 'text',
            ),
            'image' => array(
                'testwebsite_widgets_name' => 'image',
                'testwebsite_widgets_title' => __('Image', 'testwebsite'),
                'testwebsite_widgets_field_type' => 'upload',
            ),
            'intro' => array(
                'testwebsite_widgets_name' => 'intro',
                'testwebsite_widgets_title' => __('Short Intro', 'testwebsite'),
                'testwebsite_widgets_field_type' => 'textarea',
                'testwebsite_widgets_row' => '4'
            ),
            'signature' => array(
                'testwebsite_widgets_name' => 'name',
                'testwebsite_widgets_title' => __('Name', 'testwebsite'),
                'testwebsite_widgets_field_type' => 'text',
            )
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);

        $title = isset( $instance['title'] ) ? $instance['title'] : '' ;
        $image = isset( $instance['image'] ) ? $instance['image'] : '' ;
        $intro = isset( $instance['intro'] ) ? $instance['intro'] : '' ;
        $name = isset( $instance['name'] ) ? $instance['name'] : '' ;

        $image_id = testwebsiteGetImageIdByUrl($image);
        $image_array = wp_get_attachment_image_src( $image_id, 'thumbnail' );

        echo $before_widget;
        ?>
        <div class="mn-personal-info">
            <?php
            if (!empty($title)):
                echo $before_title . esc_html($title) . $after_title;
            endif;

            if (!empty($image)):
             echo '<div class="mn-pi-image"><img src="'.esc_url($image_array[0]).'"/></div>';
            endif;

            if (!empty($name)):
            echo '<h5 class="mn-pi-name"><span>'.esc_html($name).'</span></h5>';
            endif;

            if (!empty($intro)):
            echo '<div class="mn-pi-intro">'.esc_html($intro).'</div>';
            endif;
            ?>
        </div>
        <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	testwebsite_widgets_updated_field_value()		defined in widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            // Use helper function to get updated field values
            $instance[$testwebsite_widgets_name] = testwebsite_widgets_updated_field_value($widget_field, $new_instance[$testwebsite_widgets_name]);
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param	array $instance Previously saved values from database.
     *
     * @uses	testwebsite_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $testwebsite_widgets_field_value = !empty($instance[$testwebsite_widgets_name]) ? esc_attr($instance[$testwebsite_widgets_name]) : '';
            testwebsite_widgets_show_widget_field($this, $widget_field, $testwebsite_widgets_field_value);
        }
    }

}
