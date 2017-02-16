<?php
class RssPageWidget extends Lion2486_Widget{
    //The widget ID, must be unique! (optional, if NULL, class name is used).
    protected $WidgetID = "RssPageWidget";
    //WidgetDescription. Text to show on widget list (optional).
    protected $WidgetDescription = "Created an rss icon and link for the page.";

    //text domain for translations.
    protected $textDomain = 'html5blank';
    //Widget Name! (Human readable form)
    protected $WidgetName = "RSS Page Widget";

    public function __construct(  ) {
        //Call the parent::__constructor()
        parent::__construct();

        //Here set your own fields.
        $this->fields = array(
            $this->field(
                'title',
                'Title'
            ),
            $this->field(
                'feed_query',
                'Feed Query',
                'Insert the feed query to use in tho the url.'
            )
        );
    }

    public function widget( $args, $instance )
    {
        extract( $vars = $this->form_fields( $instance ) );

        echo "<div class=\"rss-page-containter\">
                <a href=\"/feed/{$vars['feed_query']}\">
                    <img width='32' height='32' src='" . get_template_directory_uri() . "/img/black-rss-logo-icon-png.png' title='rss' alt='rss'/>
                    <link rel=\"alternate\" type=\"application/rss+xml\" title=\"" . get_bloginfo() . ":{$vars['title']}\" href=\"/feed/{$vars['feed_query']}\"/>
                </a>
            </div>";

    }
}
new RssPageWidget();