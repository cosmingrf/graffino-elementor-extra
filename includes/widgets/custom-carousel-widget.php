<?php

if (! defined('ABSPATH') ) {
    exit; // Exit if accessed directly.
}

class Custom_Carousel_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'custom-carousel-widget';
    }


    public function get_title()
    {
        return esc_html__('Custom Carousel', 'custom-carousel-widget');
    }

    public function get_icon()
    {
        return 'eicon-slider-device';
    }


    public function get_custom_help_url()
    {
        return 'https://developers.elementor.com/docs/widgets/';
    }

  
    public function get_categories()
    {
        return array('graffino_elementor_extra');
    }


    public function get_keywords()
    {
        return [ 'Carousel', 'Custom', 'link' ];
    }

    protected function register_controls()
    {   $control_selector = '.custom-carousel-widget';

        $this->start_controls_section(
            'content_section',
            [
            'label' => esc_html__('Content', 'custom-carousel-widget'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'navigation_text',
            [
            'label' => __('Navigation Text', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => __('Navigation text', 'custom-carousel-widget'),
            'label_block' => true
            ]
        );

        $repeater->add_control(
            'slider_text',
            [
            'label' => __('Slider Text', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => __('Slider text', 'custom-carousel-widget'),
            'label_block' => true
            ]
        );

        $repeater->add_control(
            'slider_image',
            [
            'label'   => __('Image', 'custom-carousel-widget'),
            'type'    => \Elementor\Controls_Manager::MEDIA,
            'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            ],
        );

        $this->add_control(
            'slider',
            [
            'label' => __('Slider Items', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
            [
                'slider_title' => __('Slider title #1', 'custom-carousel-widget'),
            ],
            ],
            'title_field' => '{{{ slider_title }}}',
            ]
        );
    
        $this->end_controls_section();


        $this->start_controls_section(
            'slider_settings',
            [
            'label' => esc_html__('Slider Settings', 'custom-carousel-widget'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        // show Dots
        $this->add_control(
            'dots',
            [
            'label' => __('Dots', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Show', 'custom-carousel-widget'),
            'label_off' => __('Hide', 'custom-carousel-widget'),
            'return_value' => true,
            'default' => true,
            ]
        );

        // Show Navs
        $this->add_control(
            'navs',
            [
            'label' => __('Navs', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Show', 'custom-carousel-widget'),
            'label_off' => __('Hide', 'custom-carousel-widget'),
            'return_value' => true,
            'default' => true,
            ]
        );

        // Infinite Loop
        $this->add_control(
            'loop',
            [
            'label' => __('Infinite Loop', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'custom-carousel-widget'),
            'label_off' => __('No', 'custom-carousel-widget'),
            'return_value' => true,
            'default' => true,
            ]
        );


           // Slide to show
        $this->add_control(
            'slides_to_show',
            [
                'label' => __( 'Slides to show', 'custom-carousel-widget' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
                'placeholder' => __( 'Enter the number of slides to be visible.', 'custom-carousel-widget' ),
            ]
        );
        $this->end_controls_section();


    }

    /**
     * Render custom carousel widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute(
            'custom_carousel_options',

            [
                'id'=>'custom-carousel-'. $this->get_id(),
                'data-dots'=>$settings['dots'],
                'data-navs'=>$settings['navs'],
                'data-loop'=>$settings['loop'],
                'data-slides'=>$settings['slides_to_show'],
            ]
    
        );

  
        ?>
        <div class="custom-carousel-widget">
            <div class="slider-for" <?php echo $this->get_render_attribute_string( 'custom_carousel_options' ); ?>>
                <?php foreach( $settings[ 'slider' ] as $slide ) : ?>
                        <div class="slider-simple">
                            <img class="slider-image" src="<?php echo esc_url($slide[ 'slider_image' ][ 'url' ]); ?>" alt="<?php esc_attr_e($slide[ 'slider_text' ]); ?>">
                            <div class="slider-quote"><?php echo $slide[ 'slider_text' ]; ?></div>
                        </div>
                <?php endforeach; ?>
            </div>
            
            <div class="slider-nav">
            <?php foreach( $settings[ 'slider' ] as $slideNav ) : ?>
                    <div class="simple-nav">
                        <div class="slider-quote"><?php echo $slideNav[ 'navigation_text' ]; ?></div>
                    </div>
            <?php endforeach; ?>
            </div>
        </div>
        <?php
    }

}
