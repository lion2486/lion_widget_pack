<?php
class Page_Paragraph_Widget extends Lion2486_Widget {
    //The widget ID, must be unique! (optional, if NULL, class name is used).
    protected $WidgetID = "page_paragraph_widget";
    //WidgetDescription. Text to show on widget list (optional).
    protected $WidgetDescription = "Widget to display a paragraph into the page.";

    //text domain for translations.
    protected $textDomain = 'html5blank';
    //Widget Name! (Human readable form)
    protected $WidgetName = "Page Paragraph ";

    public function __construct(  ) {
        //Call the parent::__constructor()
        parent::__construct();

        //Here set your own fields.
        $this->fields = array(
            $this->field(
                'icon_id',
                'Icon',
                '',
                array(
                    'dataType' => 'media'
                    //,'multiple' => true
                )
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
            )
        );
    }

    public function widget( $args, $instance ) {
        extract( $vars = $this->form_fields( $instance ) );


        echo "<div class=\"middle-sized page-paragraph-widget\">
				";
        if( !empty( $vars['icon_id'] ) )
            echo "<img src='" . wp_get_attachment_url( $vars['icon_id']) . "' alt='{$vars['title']}' />";
        echo    "
				<h3>{$vars['small_title']}</h3>
				<h4>{$vars['title']}</h4>
				<p>{$vars['body']}</p>
			</div>
			";
    }
}
new Page_Paragraph_Widget();