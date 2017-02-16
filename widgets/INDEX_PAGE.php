<?php
class INDEX_PAGE_Widget extends Lion2486_Widget {
    //The widget ID, must be unique! (optional, if NULL, class name is used).
    protected $WidgetID = "html_widget";
    //WidgetDescription. Text to show on widget list (optional).
    protected $WidgetDescription = "Widget to display welcome post into index page.";

    //text domain for translations.
    protected $textDomain = 'html5blank';
    //Widget Name! (Human readable form)
    protected $WidgetName = "Welcome Post on Homepage";

    public function __construct(  ) {
        //Call the parent::__constructor()
        parent::__construct();

        //Here set your own fields.
        $this->fields = array(
            $this->field(
                'title',                    //Name of the field
                'Title',                    //Title (auto translation supported)
                'The widget title field.',  //Description (auto translation supported)
                'text',                     //Type of the field
                'Enter Title',              //Default value
                '',                         //Current value
                $this->textDomain           //text-domain to use
            ),
            $this->field(
                'page_id',
                'Page ID',
                '',
                array('dataType' => 'input', 'attr' => array('type' => 'number'))
            )
        );
    }

    public function widget( $args, $instance ) {
        extract( $vars = $this->form_fields( $instance ) );

        //$page = get_post($instance['page_id']);

        $page = get_post( $vars['page_id'] );
        $icon = ($i = get_post_meta($page->ID, 'title_preview_icon')) ? ("<img src=' " . wp_get_attachment_url( $i[0] ) . "' alt='". get_the_title($page->ID) ."'/>"): '';

        if(!$page)
            return;
        echo "<div class='page-widget-root'>
                <div class=\"page-widget-container middle-sized\">

                    <div class='page-widget-inner'>

                        <div class='page-widget-title'><h3>{$icon}" . get_the_title($page->ID)."</h3></div>
                        <div class='page-widget-text'><p>". __( $page->post_excerpt, $this->textDomain ) ."</p></div>

                        <div class='page-widget-view-more'><a class='text-link1' href='/?p={$page->ID}'>" . __( "SEE FULL BIO", "html5blank" ) . "</a></div>
                    </div>
                    <div class='page-widget-image hidden-xs'>
                        ".get_the_post_thumbnail($page->ID)."
                    </div>

                  </div></div>";

        //echo __( 'Hello, World!', 'html5blank' );

    }
}
new INDEX_PAGE_Widget();