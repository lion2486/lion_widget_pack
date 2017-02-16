<?php
class Image_Full_Width_Widget extends Lion2486_Widget {
    //The widget ID, must be unique! (optional, if NULL, class name is used).
    protected $WidgetID = "image_full_width_widget";
    //WidgetDescription. Text to show on widget list (optional).
    protected $WidgetDescription = "Widget to display an image with full width.";

    //text domain for translations.
    protected $textDomain = 'html5blank';
    //Widget Name! (Human readable form)
    protected $WidgetName = "Full Width Image";

    public function __construct(  ) {
        //Call the parent::__constructor()
        parent::__construct();

        //Here set your own fields.
        $this->fields = array(
            $this->field(
                'title',                    //Name of the field
                'Title'                    //Title (auto translation supported)
            ),
            $this->field(
                'image_id',
                'Image',
                '',
                'media'
            )
        );
    }

    public function widget( $args, $instance ) {
        extract( $vars = $this->form_fields( $instance ) );

        echo "
			<div class='image-full-width-widget-container'>
				" . $this->fields[1]->displayValue() . "
            </div>";
    }
}
new Image_Full_Width_Widget();
