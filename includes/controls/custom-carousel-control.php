<?php
/**
 * Elementor emoji one area control.
 *
 * A control for displaying a textarea with the ability to add emojis.
 *
 * @since 1.0.0
 */
class Custom_Carousel_Control extends \Elementor\Base_Data_Control
{

    /**
     * Get emoji one area control type.
     *
     * Retrieve the control type, in this case `emojionearea`.
     *
     * @since  1.0.0
     * @access public
     * @return string Control type.
     */
    public function get_type()
    {
        return 'custom-carousel';
    }

    /**
     * Enqueue emoji one area control scripts and styles.
     *
     * Used to register and enqueue custom scripts and styles used by the emoji one
     * area control.
     *
     * @since  1.0.0
     * @access public
     */
   

    /**
     * Get emoji one area control default settings.
     *
     * Retrieve the default settings of the emoji one area control. Used to return
     * the default settings while initializing the emoji one area control.
     *
     * @since  1.0.0
     * @access protected
     * @return array Control default settings.
     */
   

    /**
     * Render emoji one area control output in the editor.
     *
     * Used to generate the control HTML in the editor using Underscore JS
     * template. The variables for the class are available using `data` JS
     * object.
     *
     * @since  1.0.0
     * @access public
     */
    function content_template()
    {
        ?>
    <#
    if ( settings.slider.length ) {
    #>
        <div class="custom-carousel-widget">
            <div class="slider-for">
                <#
                _.each( settings.slider, function( slide ) {
                #>
                    <div class="slider-simple">
                        <img class="slider-image" src="{{ slide.slider_image.url }}">
                        <div class="slider-quote">{{{ slide.slider_text }}}</div>
                    </div>
                <#
                });
                #>
            </div>
            
            <div class="slider-nav">
                <#
                _.each( settings.slider, function( slide ) {
                #>
                    <div class="simple-nav">
                        <div class="slider-quote">{{{ slide.navigation_text }}}</div>
                    </div>
                <#
                });
                #>
            </div>
        </div>
    <#
    }
    #>
        <?php
    }

}
