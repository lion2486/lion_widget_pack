<?php
class Activities_Bar_Widget extends Lion2486_Widget {
    //The widget ID, must be unique! (optional, if NULL, class name is used).
    protected $WidgetID = "activities_bar_widget";
    //WidgetDescription. Text to show on widget list (optional).
    protected $WidgetDescription = "Place multiple images on same line.";

    //text domain for translations.
    protected $textDomain = 'html5blank';
    //Widget Name! (Human readable form)
    protected $WidgetName = "Activities Bar Widget";

    public function __construct(  ) {
        //Call the parent::__constructor()
        parent::__construct();

        //Here set your own fields.
        $this->fields = array(
            $this->field(
                'icon_1',
                'Icon 1',
                '',
                array(
                    'dataType' => 'media'
                    //,'multiple' => true
                )
            ),
            $this->field(
                'text_1',
                'Text 1'
            ),
            $this->field(
                'url_1',
                'URL 1'
            ),
            $this->field(
                'icon_2',
                'Icon 2',
                '',
                'media'
            ),
            $this->field(
                'text_2',
                'Text 2'
            ),
            $this->field(
                'url_2',
                'URL 2'
            ),
            $this->field(
                'icon_3',
                'Icon 3',
                '',
                'media'
            ),
            $this->field(
                'text_3',
                'Text 3'
            ),
            $this->field(
                'url_3',
                'URL 3'
            ),

        );
    }

    public function widget( $args, $instance ) {
        extract( $vars = $this->form_fields( $instance ) );


        echo "<div class=\"activities-bar\">
				<div class='activity'>
					<a href='{$vars['url_1']}'>
						<img src='" . wp_get_attachment_url( $vars['icon_1']) . "' alt='{$vars['text_1']}' />
						<span>{$vars['text_1']}</span>
					</a>
				</div>
				<div class='activity'>
					<a href='{$vars['url_2']}'>
						<img src='" . wp_get_attachment_url( $vars['icon_2']) . "' alt='{$vars['text_2']}' />
						<span>{$vars['text_2']}</span>
					</a>
				</div>
				<div class='activity'>
					<a href='{$vars['url_3']}'>
						<img src='" . wp_get_attachment_url( $vars['icon_3']) . "' alt='{$vars['text_3']}' />
						<span>{$vars['text_3']}</span>
					</a>
				</div>

			</div>
			";
    }
}
new Activities_Bar_Widget();