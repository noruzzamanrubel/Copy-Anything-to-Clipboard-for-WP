<?php

require_once CATCWP_PATH . 'includes/class-catcwp-settings.php';

class CATCWP_Shortcode {

    public function shortcode_register() {
        add_shortcode('copy', [$this, 'shortcode_generator']);
    }
    
    /**
     * Shortcode Render Function
     */
    public function shortcode_generator($atts, $content = null) {
        ob_start();
        $settings = CACTWP_setting::get_settings();
        $copy_clipboard_lists = $settings['Copy_clipboard_lists'];
        
        $copy_clipboard_selector = [];
        $copy_clipboard_text = [];
        $copy_clipboard_content = [];
        $copy_clipboard_color = [];
        foreach($copy_clipboard_lists as $item){
            $copy_clipboard_selector[] = $item['Copy_clipboard_selector'];
            $copy_clipboard_text[] = $item['Copy_clipboard_text'];
            $copy_clipboard_content[] = $item['Copy_clipboard_content'];
            $copy_clipboard_color[] = $item['Copy_clipboard_color'];
        }

        $tag = isset($atts['tag']) ? $atts['tag'] : ''; // get the 'tag' attribute value

        // check if the 'tag' value matches a value in $copy_clipboard_selector array
        if (in_array($tag, $copy_clipboard_selector)) {
            $index = array_search($tag, $copy_clipboard_selector);
            $custom_text = $copy_clipboard_text[$index]; // get the corresponding setting
            $custom_content = $copy_clipboard_content[$index]; // get the corresponding setting
            $custom_color = $copy_clipboard_color[$index]; // get the corresponding setting
        } else {
            $custom_text = 'Click to copy';
            $custom_content = '';
            $custom_color = 'black'; // set default color
        }


        // $custom_text = 'Click to copy';
        if (empty($content)) {
            $text = isset($atts['text']) ? $atts['text'] : $custom_text;
            $content = isset($atts['content']) ? $atts['content'] : $custom_content;
        }else {
            $content = isset($atts['content']) ? $atts['content'] : $custom_content;
            $text = isset($atts['text']) ? $atts['text'] : $custom_text;
        }
        

        ?>
        <span class="cacwp_text" title="Click to copy" data-content="<?php echo $content ?>" data-text="<?php echo $text; ?>" style="cursor: pointer; display: inline; color: <?php echo $custom_color; ?>;"><?php echo $text; ?></span>
        <?php
        return ob_get_clean();
        
    }
    

}


