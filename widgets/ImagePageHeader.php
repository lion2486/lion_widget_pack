<?php

class Image_Page_header_Widget extends Lion2486_Widget {
    //The widget ID, must be unique! (optional, if NULL, class name is used).
    protected $WidgetID = "image_page_header_widget";
    //WidgetDescription. Text to show on widget list (optional).
    protected $WidgetDescription = "Widget to display an image as header of the page.";

    //text domain for translations.
    protected $textDomain = 'html5blank';
    //Widget Name! (Human readable form)
    protected $WidgetName = "Page Image Header";

    public function __construct(  ) {
        //Call the parent::__constructor()
        parent::__construct();

        //Here set your own fields.
        $this->fields = array(
            $this->field(
                'image_id',
                'Image',
                '',
                'media'
            ),
            $this->field(
                'icon_id',
                'Icon',
                '',
                'media'
            ),
            $this->field(
                'small_title',
                'Small Title'
            ),
            $this->field(
                'title',
                'Title'
            ),
            $this->field(
                'body',
                'Text Body',
                '',
                'textarea'
            ),
            $this->field(
                'bg_color',
                'Background Color',
                '',
                array(
                    'dataType'  => 'input',
                    'attr'      => array(
                        'type'      => 'color'
                    )
                ),
                '#143260'
            ),
            $this->field(
                'opacity',
                'Background Opacity',
                '',
                array(
                    'dataType'  => 'input',
                    'attr'      => array(
                        'type'  => 'range',
                        'min'   => '0',
                        'max'   => '1',
                        'step'  => '0.05'
                    )
                ),
                '0.35'
            )
        );
    }

    public function widget( $args, $instance ) {
        extract( $vars = $this->form_fields( $instance ) );

        $rgb = hex2rgb( $vars['bg_color'] );

        echo "
			<div class='page-header-image-container' style='
				background-image: url(\"" . wp_get_attachment_url( $vars['image_id'] ) . "\");
				background-size: cover;
				background-position: center;
				top: 0;
				width: 100%;
				height: 46vw;
			' >
				<div class='content' style='
					width: 100%;
					height: 100%;
					background-color: rgba({$rgb['red']}, {$rgb['green']}, {$rgb['blue']}, {$vars['opacity']});

				'>
				".
            ( ( isset($vars['icon_id']) && is_int($vars['icon_id']) ) ? "
					<img src='" . wp_get_attachment_url( $vars['icon_id']) . "' alt='{$vars['title']}' />" : "" ) .
            "<h4>{$vars['small_title']}</h4>
				    <h1>{$vars['title']}</h1>
					<p>{$vars['body']}</p>
				</div>
           	</div>";
    }
}
function hex2rgb( $colour ) {
    if ( $colour[0] == '#' ) {
        $colour = substr( $colour, 1 );
    }
    if ( strlen( $colour ) == 6 ) {
        list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
    } elseif ( strlen( $colour ) == 3 ) {
        list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
    } else {
        return false;
    }
    $r = hexdec( $r );
    $g = hexdec( $g );
    $b = hexdec( $b );
    return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

new Image_Page_header_Widget();