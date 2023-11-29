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
            'navigation_heading',
            [
            'label' => __('Navigation Heading', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Jane Orson', 'custom-carousel-widget'),
            'label_block' => true
            ]
        );
        
        $repeater->add_control(
            'navigation_subheading',
            [
            'label' => __('Navigation Sub-heading', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('marketing lead, supreme', 'custom-carousel-widget'),
            'label_block' => true
            ]
        );
        $repeater->add_control(
            'navigation_text',
            [
            'label' => __('Navigation Text', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => __('Managing a team of marketing professionals, delivered 40% ROI in every quarter of 2021. She specializes working  with high volume of user research data and maintain the group morale as high as possible.', 'custom-carousel-widget'),
            'label_block' => true
            ]
        );

        $repeater->add_control(
            'slider_text',
            [
            'label' => __('Slider Text', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => __('This is simply unbelievable!I have gotten at least 50 times the value from Knosc.I will refer everyone I know.', 'custom-carousel-widget'),
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

//-------------------------------------------------Slider Settings--------------------------//
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
            'default' => false,
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
            'default' => false,
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
            'default' => false,
            ]
        );

           // Slide to show
    $this->add_control(
    'slides_to_show',
    [
        'label' => __( 'Slides to show', 'custom-carousel-widget' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'default' => [
            'size' => 5,
            'unit' => '', // Fără unitate, pentru a permite zecimale
        ],
        'range' => [
            'px' => [
                'min' => 1,
                'max' => 10,
                'step' => 0.1, // Pasul pentru valori zecimale
            ],
        ],
        'separator' => 'before', // Poți ajusta separarea între controale pentru claritate
        'description' => __( 'Enter the number of slides to be visible.', 'custom-carousel-widget' ),
    ]
);

        
          $this->add_control(
            'slides_to_show_mobile',
            [
                'label' => __( 'Slides to show mobile', 'custom-carousel-widget' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1,
                'placeholder' => __( 'Enter the number of slides to be visible.', 'custom-carousel-widget' ),
            ]
        );
          $this->add_control(
            'slides_to_show_desktop',
            [
                'label' => __( 'Slides to show desktop', 'custom-carousel-widget' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1,
                'placeholder' => __( 'Enter the number of slides to be visible.', 'custom-carousel-widget' ),
            ]
        );
        $this->end_controls_section();


         //---------------------------------------------------------------- Slider Style---------------------------------//
        $this->start_controls_section('carousel_slider', [
            'label' => __('Slider', 'custom-carousel-widget'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control('heading_color', [
            'label' => __('Heading Color', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .slider-quote' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
            'label' => __('Typography Heading', 'custom-carousel-widget'),
            'name' => 'subtitle_typography',
            'selector' => '{{WRAPPER}} .slider-quote',
        ]);

        $this->add_responsive_control(
            'slider_padding',
            [
                'label' => esc_html__('Heading Padding', 'custom-carousel-widget'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-quote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
            $this->add_responsive_control( 
		    'w_size_heading',
				[
				'label' => esc_html__( 'Heading Width', 'custom-carousel-widget' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','%' ],
							'range' => [
								'px' => [
									'min' => 0,
									'max' => 400,
									'step' => 1,
								]
							],
							'default' => [
								'unit' => 'px',
								'size' => 400,
							],
							'selectors' => [
								'{{WRAPPER}} .slider-simple .slider-quote' => 'width: {{SIZE}}{{UNIT}};',
							]
						]
				);
        $this->add_responsive_control(
            'slider_spacer',
            [
                'label' => esc_html__('Spacer', 'custom-carousel-widget'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0

                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-for' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control( 
		    'w_size_image',
				[
				'label' => esc_html__( 'Image Width', 'custom-carousel-widget' ),
                'separator' => 'before',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','%' ],
							'range' => [
								'px' => [
									'min' => 0,
									'max' => 400,
									'step' => 1,
								]
							],
							'default' => [
								'unit' => 'px',
								'size' => 400,
							],
							'selectors' => [
								'{{WRAPPER}} .slider-simple .slider-image' => 'width: {{SIZE}}{{UNIT}};',
							]
						]
				);
        $this->add_responsive_control( 
		    'h_size_image',
				[
				'label' => esc_html__( 'Image Height', 'custom-carousel-widget' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','%' ],
							'range' => [
								'px' => [
									'min' => 0,
									'max' => 400,
									'step' => 1,
								]
							],
							'default' => [
								'unit' => 'px',
								'size' => 400,
							],
							'selectors' => [
								'{{WRAPPER}} .slider-simple .slider-image' => 'height: {{SIZE}}{{UNIT}};',
							]
						]
				);	
        $this->end_controls_section();

           // Navigation Style
        $this->start_controls_section('carousel_navigation', [
            'label' => __('Navigation', 'custom-carousel-widget'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('navigation_heading_color', [
            'label' => __('Heading Color', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .navigation-heading' => 'color: {{VALUE}};',
            ],
        ]);
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
            'label' => __('Heading Typography', 'custom-carousel-widget'),
            'name' => 'navigation_heading_typography',
            'selector' => '{{WRAPPER}} .navigation-heading',
        ]);	
        
        $this->add_control('navigation_subheading_color', [
            'label' => __('Sub-heading Color', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'spacer'=>'before',
            'selectors' => [
                '{{WRAPPER}} .navigation-subheading' => 'color: {{VALUE}};',
            ],
        ]);
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
            'label' => __('Sub-heading Typography', 'custom-carousel-widget'),
            'name' => 'navigation_subheading_typography',
            'selector' => '{{WRAPPER}} .navigation-subheading',
        ]);		

        $this->add_control('text_color', [
            'label' => __('Text Color', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .navigation-quote' => 'color: {{VALUE}};',
            ],
        ]);
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
            'label' => __('Text Typography', 'custom-carousel-widget'),
            'name' => 'navigations_typography',
            'selector' => '{{WRAPPER}} .navigation-quote',
        ]);		

        $this->add_responsive_control(
            'navigation_padding',
            [
                'label' => esc_html__('Navigation Padding', 'custom-carousel-widget'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-nav .simple-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control( 
		\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'carousel_bullets_border',
				'label' => esc_html__( 'Border', 'custom-carousel-widget' ),
				'selector' => '{{WRAPPER}} .slider-nav .simple-nav',						
					]
				);

        $this->add_control(
            'navigation_background',
            [
                'label' => esc_html__('Background Color', 'custom-carousel-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .slider-nav .slick-current'  => 'background: {{VALUE}} !important;',
                ],
            ]
        );
        $this->end_controls_section();
    }


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
                'data-slides-desktop'=>$settings['slides_to_show_desktop'],
                'data-slides-mobile'=>$settings['slides_to_show_mobile'],
            ]
    
        );

  
        ?>
        <div class="custom-carousel-widget">
            <div class="slider-for" <?php echo $this->get_render_attribute_string( 'custom_carousel_options' ); ?>>
                <?php foreach( $settings[ 'slider' ] as $slide ) : ?>
                        <div class="slider-simple">
                            <img class="slider-image" src="<?php echo esc_url($slide[ 'slider_image' ][ 'url' ]); ?>" alt="<?php esc_attr_e($slide[ 'slider_text' ]); ?>">
                            <div class="slider-quote slider-quote-sign"><?php echo $slide[ 'slider_text' ]; ?></div>
                        </div>
                <?php endforeach; ?>
            </div>
            
            <div class="slider-nav">
            <?php foreach( $settings[ 'slider' ] as $slideNav ) : ?>
                    <div class="simple-nav">
                        <h2 class="navigation-heading"><?php echo $slideNav['navigation_heading']?></h2>
                        <h3 class="navigation-subheading"><?php echo $slideNav['navigation_subheading']?></h3>
                        <div class="navigation-quote"><?php echo $slideNav[ 'navigation_text' ]; ?></div>
                    </div>
            <?php endforeach; ?>
            </div>
        </div>
        <?php
    }

}
