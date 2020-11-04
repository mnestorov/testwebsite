<?php
/**
 * @package testwebsite
 */

function testwebsite_widgets_show_widget_field($instance = '', $widget_field = '', $testwebsite_field_value = '') {

    extract($widget_field);

    if(isset($testwebsite_widgets_default)){
        $testwebsite_field_value = !empty( $testwebsite_field_value ) ? $testwebsite_field_value : $testwebsite_widgets_default;
    }

    switch ($testwebsite_widgets_field_type) {

        // Standard text field
        case 'text' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($testwebsite_widgets_name); ?>"><?php echo esc_html($testwebsite_widgets_title); ?>:</label>
                <input class="widefat" id="<?php echo $instance->get_field_id($testwebsite_widgets_name); ?>" name="<?php echo $instance->get_field_name($testwebsite_widgets_name); ?>" type="text" value="<?php echo esc_html($testwebsite_field_value); ?>" />

                <?php if (isset($testwebsite_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($testwebsite_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Standard url field
        case 'url' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($testwebsite_widgets_name); ?>"><?php echo esc_html($testwebsite_widgets_title); ?>:</label>
                <input class="widefat" id="<?php echo $instance->get_field_id($testwebsite_widgets_name); ?>" name="<?php echo $instance->get_field_name($testwebsite_widgets_name); ?>" type="text" value="<?php echo esc_url($testwebsite_field_value); ?>" />

                <?php if (isset($testwebsite_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($testwebsite_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Textarea field
        case 'textarea' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($testwebsite_widgets_name); ?>"><?php echo esc_html($testwebsite_widgets_title); ?>:</label>
                <textarea class="widefat" rows="<?php echo absint($testwebsite_widgets_row); ?>" id="<?php echo $instance->get_field_id($testwebsite_widgets_name); ?>" name="<?php echo $instance->get_field_name($testwebsite_widgets_name); ?>"><?php echo wp_kses_post($testwebsite_field_value); ?></textarea>
            </p>
            <?php
            break;

        // Checkbox field
        case 'checkbox' :
            ?>
            <p>
                <input id="<?php echo $instance->get_field_id($testwebsite_widgets_name); ?>" name="<?php echo $instance->get_field_name($testwebsite_widgets_name); ?>" type="checkbox" value="1" <?php checked('1', $testwebsite_field_value); ?>/>
                <label for="<?php echo $instance->get_field_id($testwebsite_widgets_name); ?>"><?php echo esc_html($testwebsite_widgets_title); ?></label>

                <?php if (isset($testwebsite_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($testwebsite_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Radio fields
        case 'radio' :
            ?>
            <p>
                <?php
                echo $testwebsite_widgets_title;
                echo '<br />';
                foreach ($testwebsite_widgets_field_options as $testwebsite_option_name => $testwebsite_option_title) {
                    ?>
                    <input id="<?php echo $instance->get_field_id($testwebsite_option_name); ?>" name="<?php echo $instance->get_field_name($testwebsite_widgets_name); ?>" type="radio" value="<?php echo $testwebsite_option_name; ?>" <?php checked($testwebsite_option_name, $testwebsite_field_value); ?> />
                    <label for="<?php echo $instance->get_field_id($testwebsite_option_name); ?>"><?php echo esc_html($testwebsite_option_title); ?></label>
                    <br />
                <?php } ?>

                <?php if (isset($testwebsite_widgets_description)) { ?>
                    <small><?php echo wp_kses_post($testwebsite_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Select field
        case 'select' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($testwebsite_widgets_name); ?>"><?php echo esc_html($testwebsite_widgets_title); ?>:</label>
                <select name="<?php echo $instance->get_field_name($testwebsite_widgets_name); ?>" id="<?php echo $instance->get_field_id($testwebsite_widgets_name); ?>" class="widefat">
                    <?php foreach ($testwebsite_widgets_field_options as $testwebsite_option_name => $testwebsite_option_title) { ?>
                        <option value="<?php echo esc_attr($testwebsite_option_name); ?>" id="<?php echo $instance->get_field_id($testwebsite_option_name); ?>" <?php selected($testwebsite_option_name, $testwebsite_field_value); ?>><?php echo esc_html($testwebsite_option_title); ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($testwebsite_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($testwebsite_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'number' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($testwebsite_widgets_name); ?>"><?php echo esc_html($testwebsite_widgets_title); ?>:</label><br />
                <input name="<?php echo $instance->get_field_name($testwebsite_widgets_name); ?>" type="number" step="1" min="1" id="<?php echo $instance->get_field_id($testwebsite_widgets_name); ?>" value="<?php echo absint($testwebsite_field_value); ?>" class="small-text" />

                <?php if (isset($testwebsite_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($testwebsite_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'upload':
            $image = $image_class = "";
            if($testwebsite_field_value){ 
                $image = '<img src="'.esc_url($testwebsite_field_value).'" style="max-width:100%;"/>';    
                $image_class = ' hidden';
            }
            ?>
            <div class="attachment-media-view">

            <label for="<?php echo $instance->get_field_id($testwebsite_widgets_name); ?>"><?php echo esc_html($testwebsite_widgets_title); ?>:</label><br />
            
                <div class="placeholder<?php echo $image_class; ?>">
                    <?php _e('No image selected', 'testwebsite'); ?>
                </div>
                <div class="thumbnail thumbnail-image">
                    <?php echo $image; ?>
                </div>

                <div class="actions clearfix">
                    <button type="button" class="button testwebsite-delete-button align-left"><?php _e('Remove', 'testwebsite'); ?></button>
                    <button type="button" class="button testwebsite-upload-button alignright"><?php _e('Select Image', 'testwebsite'); ?></button>
                    
                    <input name="<?php echo $instance->get_field_name($testwebsite_widgets_name); ?>" id="<?php echo $instance->get_field_id($testwebsite_widgets_name); ?>" class="upload-id" type="hidden" value="<?php echo esc_url($testwebsite_field_value) ?>"/>
                </div>

            <?php if (isset($testwebsite_widgets_description)) { ?>
                <br />
                <small><?php echo wp_kses_post($testwebsite_widgets_description); ?></small>
            <?php } ?>

            </div>
            <?php                        
            break;
    }
}

function testwebsite_widgets_updated_field_value($widget_field, $new_field_value) {

    extract($widget_field);

    // Allow only integers in number fields
    if ($testwebsite_widgets_field_type == 'number') {
        return absint($new_field_value);

        // Allow some tags in textareas
    } elseif ($testwebsite_widgets_field_type == 'textarea') {
        // Check if field array specifed allowed tags
        if (!isset($testwebsite_widgets_allowed_tags)) {
            // If not, fallback to default tags
            $testwebsite_widgets_allowed_tags = '<p><strong><em><a>';
        }
        return strip_tags($new_field_value, $testwebsite_widgets_allowed_tags);

        // No allowed tags for all other fields
    } elseif ($testwebsite_widgets_field_type == 'url') {
        return esc_url_raw($new_field_value);
    } else {
        return strip_tags($new_field_value);
    }
}