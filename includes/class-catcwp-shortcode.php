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
        }
        
        ob_start();
        ?>
        <span class="cacwp_text" title="Click to copy" data-text="<?php echo $content; ?>" style="cursor: pointer; display: inline;"><?php echo $content; ?></span>
        <?php
        return ob_get_clean();
        
    }
    

}


