<?php
class CACTWP_setting {

    public static $plugin_name = CATCWP_NAME,
    $plugin_file_url           = CATCWP_URL;

    public function __construct() {
        add_filter( 'CATCWP_register_options_panel', array( $this, 'register_options_panel' ), 1, 2 );
    }

    public function register_options_panel( $options_panel_func, $options_panel_config ) {
        return array(
            'func'   => $options_panel_func,
            'config' => $options_panel_config,
        );
    }

    public function generate_settings() {
        // Set a unique slug-like ID
        $prefix = CACTWP_setting::$plugin_name;

        // Plugin options panel configuration
        $options_panel_func   = 'createOptions';
        $options_panel_config = array(
            'framework_title' => __( 'Copy to Clipboard Settings', 'catcwp' ),
            'footer_text'     => sprintf(
                __( 'Visit our plugin usage <a href="%s">documentation</a>', 'catcwp' ),
                esc_url( 'https://github.com/noruzzamanrubel' )
            ),
            'footer_credit'   => sprintf(
                __( 'A proud creation of <a href="%s">Noruzzaman</a>', 'catcwp' ),
                esc_url( 'https://github.com/noruzzamanrubel' )
            ),
            'menu_title'      => __( 'Copy to Clipboard', 'catcwp' ),
            'menu_slug'       => 'catcwp-settings',
            'database'        => 'option',
            'transport'       => 'refresh',
            'capability'      => 'manage_options',
            'save_defaults'   => true,
            'enqueue_webfont' => true,
            'async_webfont'   => true,
            'output_css'      => true,
        );

        $options_panel_builder = apply_filters( 'CATCWP_register_options_panel', $options_panel_func, $options_panel_config );

        CSF::{$options_panel_builder['func']}

        ( $prefix, $options_panel_builder['config'] );

        $parent = '';

        CSF::createSection( $prefix, array(
            'parent' => $parent,
            'title'  => __( 'General Setting', 'catcwp' ),
            'fields' => array(
                array(
                    'id'    => 'Copy_clipboard_setting',
                    'type'  => 'text',
                    'title' => 'Copy Clipboard Text',
                    'default' => '20%off'
                ),
            ),
        ) );
        CSF::createSection( $prefix, array(
            'parent' => $parent,
            'title'  => __( ' List of Items', 'catcwp' ),
            'fields' => array(
                array(
                    'id'        => 'copy_clipboard_lists',
                    'type'      => 'repeater',
                    // 'title'     => 'Add New',
                    'button_title'     => 'Add New',
                    'fields'    => array(
                    array(
                        'id'    => 'copy_clipboard_selector',
                        'type'  => 'text',
                        'title' => 'Selector',
                        ),
                      
                      array(
                        'id'    => 'copy_clipboard_text',
                        'type'  => 'text',
                        'title' => 'Text',
                      ),
                  
                      array(
                        'id'    => 'copy_clipboard_content',
                        'type'  => 'textarea',
                        'title' => 'Content',
                      ),
                      array(
                        'id'      => 'copy_clipboard_typography',
                        'type'    => 'typography',
                        'title'   => 'Typography',
                        'output'  => 'span.cacwp_text',
                        'output_important' => true,
                        'font_family'      => true,
                        'font_weight'      => true,
                        'subset'           => true,
                        'font_style'       => false,
                        'font_size'        => true,
                        'line_height'      => true,
                        'letter_spacing'   => true,
                        'text_align'       => true,
                        'text_transform'   => true,
                        'color'            => false,
                        'default' => array(
                          'font-family'    => 'inherit',
                          'font_size'    => 'inherit',
                          'letter_spacing'    => 'inherit',
                          'type'           => 'google',
                          'unit'           => 'px',
                        ),
                      ),
                      array(
                        'id'          => 'copy_clipboard_bg_color',
                        'type'        => 'color',
                        'title'       => 'Background Color',
                        'output_mode' => 'background-color',
                        'default' => 'transparent'
                      ),
                      array(
                        'id'    => 'copy_clipboard_color',
                        'type'    => 'color',
                        'title'   => 'Color',
                        'default' => '#000000'
                      ),
                    )
                  ),                  
            ),
        ) );
    }

    /**
     * Return plugin all settings.
     *
     * @return string|array Settings values.
     */
    public static function get_settings() {
        return get_option( CACTWP_setting::$plugin_name );
    }

}