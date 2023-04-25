<?php

require_once CATCWP_PATH . 'includes/class-catcwp-settings.php';

class CATCWP_Shortcode {

    public function shortcode_register() {
        add_shortcode('copy_clipboard', [$this, 'shortcode_generator']);
    }
    
    /**
     * Shortcode Render Function
     */
    public function shortcode_generator($atts, $content = null) {
        ob_start();
        $settings = CACTWP_setting::get_settings();
        $copy_clipboard_lists = $settings['copy_clipboard_lists'];
        
        $copy_clipboard_selector = [];
        $copy_clipboard_text = [];
        $copy_clipboard_content = [];
        $copy_clipboard_bg_color = [];
        $copy_clipboard_color = [];
        $copy_clipboard_font_family = [];
        $copy_clipboard_font_weight = [];
        $copy_clipboard_text_align = [];
        $copy_clipboard_text_transform = [];
        $copy_clipboard_font_size = [];
        $copy_clipboard_line_height = [];
        $copy_clipboard_letter_spacing = [];

        if(!empty($copy_clipboard_lists)){
            foreach($copy_clipboard_lists as $item){
                $copy_clipboard_selector[] = strtolower($item['copy_clipboard_selector']);
                $copy_clipboard_text[] = $item['copy_clipboard_text'];
                $copy_clipboard_content[] = $item['copy_clipboard_content'];
                $copy_clipboard_color[] = $item['copy_clipboard_color'];
                $copy_clipboard_bg_color[] = $item['copy_clipboard_bg_color'];
                $copy_clipboard_font_family [] = $item['copy_clipboard_typography']['font-family'];
                $copy_clipboard_font_weight [] = $item['copy_clipboard_typography']['font-weight'];
                $copy_clipboard_text_align [] = $item['copy_clipboard_typography']['text-align'];
                $copy_clipboard_text_transform [] = $item['copy_clipboard_typography']['text-transform'];
                $copy_clipboard_font_size [] = $item['copy_clipboard_typography']['font-size'];
                $copy_clipboard_line_height [] = $item['copy_clipboard_typography']['line-height'];
                $copy_clipboard_letter_spacing [] = $item['copy_clipboard_typography']['letter-spacing'];
            }
        }

        $tag = isset($atts['tag']) ? strtolower($atts['tag']) : ''; // get the 'tag' attribute value

        // check if the 'tag' value matches a value in $copy_clipboard_selector array
        if (in_array($tag, $copy_clipboard_selector)) {
            $index = array_search($tag, $copy_clipboard_selector);
            $custom_text = $copy_clipboard_text[$index];
            $custom_content = $copy_clipboard_content[$index];
            $custom_color = $copy_clipboard_color[$index];
            $custom_bg_color = $copy_clipboard_bg_color[$index];
            $custom_font_family = $copy_clipboard_font_family[$index];
            $custom_font_weight = $copy_clipboard_font_weight[$index];
            $custom_text_align = $copy_clipboard_text_align[$index];
            $custom_text_transform = $copy_clipboard_text_transform[$index];
            $custom_font_size = $copy_clipboard_font_size[$index];
            $custom_line_height = $copy_clipboard_line_height[$index];
            $custom_letter_spacing = $copy_clipboard_letter_spacing[$index];
        } else {
            //set default value
            $custom_text = 'Click to copy';
            $custom_content = '';
            $custom_bg_color = 'transparent';
            $custom_color = 'black';
            $custom_font_family = 'inherit';
            $custom_font_weight = 'inherit';
            $custom_text_align = 'inherit';
            $custom_text_transform = 'inherit';
            $custom_font_size = 'inherit';
            $custom_line_height = 'inherit';
            $custom_letter_spacing = 'inherit';

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
        <style>
            span.cacwp_text{
                font-family: <?php echo $custom_font_family; ?>;
                font-weight: <?php echo $custom_font_weight; ?>;
                text-align: <?php echo $custom_text_align; ?>;
                text-transform: <?php echo $custom_text_transform; ?>;
                font-size: <?php echo $custom_font_size; ?>px;
                line-height: <?php echo $custom_line_height; ?>px;
                letter-spacing: <?php echo $custom_letter_spacing; ?>px;
                background-color: <?php echo $custom_bg_color; ?>;
                color: <?php echo $custom_color; ?>;
                cursor: pointer;
                display: inline;
            }
        </style>

        <span class="cacwp_text" title="Click to copy" data-content="<?php echo $content ?>" data-text="<?php echo $text; ?>"><?php echo $text; ?></span>
        <?php
        return ob_get_clean();
        
    }
    
}


