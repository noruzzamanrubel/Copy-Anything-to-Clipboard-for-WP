<?php

class CATCWP_Shortcode {

    public function shortcode_register() {
        add_shortcode('copy_anything_wp', [$this, 'shortcode_generator']);
    }
    
    /**
     * Shortcode Render Function
     */
    public function shortcode_generator($atts, $content = null) {

        $custom_text = 'Click to copy';
        if (empty($content)) {
            $text = isset($atts['text']) ? $atts['text'] : $custom_text;
            $content = isset($atts['content']) ? $atts['content'] : '';
        }else {
            $content = isset($atts['content']) ? $atts['content'] : '';
        }
        
        ob_start();
        ?>
        <span class="cacwp_text" id="cacwp_text_element" title="Click to copy" data-content="<?php echo $content ?>" data-text="<?php echo $text; ?>" style="cursor: pointer; display: inline;"><?php echo $text; ?></span>
        <?php
        return ob_get_clean();
        
    }
    

}


