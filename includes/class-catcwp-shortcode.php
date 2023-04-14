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
            $content = isset($atts['content']) ? $atts['content'] : $custom_text;
            $link_url = isset($atts['link']) ? $atts['link'] : '';
        }else {
            $link_url = isset($atts['link']) ? $atts['link'] : '';
        }
        
        ob_start();
        ?>
        <span class="cacwp_text" id="cacwp_text_element" title="Click to copy" data-link="<?php echo $link_url ?>" data-text="<?php echo $content; ?>" style="cursor: pointer; display: inline;"><?php echo $content; ?></span>
        <?php
        return ob_get_clean();
        
    }
    

}


