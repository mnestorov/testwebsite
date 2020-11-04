<?php
/**
 * @package testwebsite
 */

add_action('widgets_init', 'testwebsite_register_contact_info');

function testwebsite_register_contact_info() {
    register_widget('testwebsite_contact_info');
}

class testwebsite_Contact_Info extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'testwebsite_contact_info', 'testwebsite - Contact Info', array(
                'description' => __('A widget to display Contact Information', 'testwebsite')
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
            'phone' => array(
                'testwebsite_widgets_name' => 'phone',
                'testwebsite_widgets_title' => __('Phone', 'testwebsite'),
                'testwebsite_widgets_field_type' => 'text',
            ),
            'contact_info_email' => array(
                'testwebsite_widgets_name' => 'email',
                'testwebsite_widgets_title' => __('Email', 'testwebsite'),
                'testwebsite_widgets_field_type' => 'text',
            ),
            'website' => array(
                'testwebsite_widgets_name' => 'website',
                'testwebsite_widgets_title' => __('Website', 'testwebsite'),
                'testwebsite_widgets_field_type' => 'text',
            ),
            'address' => array(
                'testwebsite_widgets_name' => 'address',
                'testwebsite_widgets_title' => __('Contact Address', 'testwebsite'),
                'testwebsite_widgets_field_type' => 'textarea',
                'testwebsite_widgets_row' => '4'
            ),
            'time' => array(
                'testwebsite_widgets_name' => 'time',
                'testwebsite_widgets_title' => __('Contact Time', 'testwebsite'),
                'testwebsite_widgets_field_type' => 'textarea',
                'testwebsite_widgets_row' => '3'
            ),
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
        $phone = isset( $instance['phone'] ) ? $instance['phone'] : '' ;
        $email = isset( $instance['email'] ) ? $instance['email'] : '' ;
        $website = isset( $instance['website'] ) ? $instance['website'] : '' ;
        $address = isset( $instance['address'] ) ? $instance['address'] : '' ;
        $time = isset( $instance['time'] ) ? $instance['time'] : '' ;

        echo $before_widget;
        ?>
        <div class="mn-contact-info">
            <?php
            if (!empty($title)):
                echo $before_title . esc_html($title) . $after_title;
            endif;
            ?>

            <ul>
                <?php if (!empty($phone)): ?>
                    <li><i class="fa fa-phone"></i><?php echo esc_html($phone); ?></li>
                <?php endif; ?>

                <?php if (!empty($email)): ?>
                    <li><i class="fa fa-envelope"></i><?php echo esc_html($email); ?></li>
                <?php endif; ?>

                <?php if (!empty($website)): ?>
                    <li><i class="fa fa-globe"></i><?php echo esc_html($website); ?></li>
                <?php endif; ?>

                <?php if (!empty($address)): ?>
                    <li><i class="fa fa-map-marker"></i><?php echo wpautop(esc_html($address)); ?></li>
                <?php endif; ?>

                <?php if (!empty($time)): ?>
                    <li><i class="fa fa-clock-o"></i><?php echo wpautop(esc_html($time)); ?></li>
                    <?php endif; ?>
            </ul>
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
