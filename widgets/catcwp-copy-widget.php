<?php

require_once CATCWP_PATH . 'includes/class-catcwp-settings.php';

class CATCWP_COPY_WIDGET extends \Elementor\Widget_Base {

	public function get_name() {
		return 'Copy-to-Clipboard';
	}

	public function get_title() {
		return esc_html__( 'Copy to Clipboard', 'catcwp' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'copy', 'clipboard' ];
	}

	protected function register_controls() {



		$args = array(
            'post_type'      => 'copy_to_clipboard', 
            'posts_per_page' => -1,
        );
        
        $query = new WP_Query($args);
        
        $meta = [];
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $meta[] = get_post_meta( get_the_ID(), 'copy_to_clipboard_options', true );
            }
            wp_reset_postdata();
        }

        $copy_clipboard_selector = [];
        foreach ($meta as $meta_item) {
            $copy_clipboard_selector[] = strtolower($meta_item['copy_clipboard_select']);
        }
	
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Copy to Clipboard', 'catcwp' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'tag_selector',
			[
				'label' => esc_html__( 'Selector', 'catcwp' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $copy_clipboard_selector,
			]
		);
	
		$this->end_controls_section();
	
	}
	
	protected function render() {
		$args = array(
            'post_type'      => 'copy_to_clipboard',
            'posts_per_page' => -1,
        );
        
        $query = new WP_Query($args);
        
        $meta = [];
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $meta[] = get_post_meta( get_the_ID(), 'copy_to_clipboard_options', true );
            }
            wp_reset_postdata();
        }

        $copy_clipboard_selector = [];
        foreach ($meta as $meta_item) {
            $copy_clipboard_selector[] = strtolower($meta_item['copy_clipboard_selector']);
        }
		
		$settings = $this->get_settings_for_display();
		$tag_index = isset($settings['tag_selector']) ? $settings['tag_selector'] : -1;
		$tag = $tag_index !== -1 ? $copy_clipboard_selector[$tag_index] : '';
		$shortcode = '[copy_clipboard tag="' . $tag . '"]';
		echo do_shortcode($shortcode);
	}
}