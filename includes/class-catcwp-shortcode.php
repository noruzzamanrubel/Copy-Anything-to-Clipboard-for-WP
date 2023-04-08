<?php
class CATCWP_Shortcode{

    public function shortcode_register() {
        add_shortcode('copy_anything_wp', [$this, 'shortcode_generator']);
    }

    /**
     * Shortcode Rander Function
     */
    public function shortcode_generator( ) {
        ob_start();
        ?>
        <p id="cacwp_text">20%off</p>
        <button id="cacwp_btn">Copy</button>
        <?php
        return ob_get_clean();

    }

}

