<?php
class SubPages_Menu_Widget extends Lion2486_Widget {
    //The widget ID, must be unique! (optional, if NULL, class name is used).
    protected $WidgetID = "subpages_menu_widget";
    //WidgetDescription. Text to show on widget list (optional).
    protected $WidgetDescription = "Generate a menu into a page with it's sub-pages.";

    //text domain for translations.
    protected $textDomain = 'html5blank';
    //Widget Name! (Human readable form)
    protected $WidgetName = "Page Sub-Pages Menu";

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
                'item_icon',
                'Menu Item Icon',
                '',
                array(
                    'dataType' => 'media'
                    //,'multiple' => true
                )
            ),

            $this->field(
                'items_per_row_lg',
                'Items per row in Large Screens',
                '',
                array(
                    'dataType' => 'input',
                    'inputTag' => 'input',
                    'attr'     => array(
                        'type'  => 'number'
                    )
                ),
                4
            ),
            $this->field(
                'items_per_row_md',
                'Items per row in Medium Screens',
                '',
                array(
                    'dataType' => 'input',
                    'inputTag' => 'input',
                    'attr'     => array(
                        'type'  => 'number'
                    )
                ),
                4
            ),
            $this->field(
                'items_per_row_sm',
                'Items per row in Small Screens',
                '',
                array(
                    'dataType' => 'input',
                    'inputTag' => 'input',
                    'attr'     => array(
                        'type'  => 'number'
                    )
                ),
                4
            ),
            $this->field(
                'items_per_row_xs',
                'Items per row in X-Small Screens',
                '',
                array(
                    'dataType' => 'input',
                    'inputTag' => 'input',
                    'attr'     => array(
                        'type'  => 'number'
                    )
                ),
                4
            ),
            $this->field(
                'row_classes',
                'Div Row Class',
                'Use space between class names',
                'text',
                'row col-lg-12 col-md-12'
            ),
            $this->field(
                'item_classes',
                'Div Menu Item Class',
                'Use space between class names',
                'text',
                'col-lg-3 col-md-3'
            )

        );
    }

    public function widget( $args, $instance ) {
        extract( $vars = $this->form_fields( $instance ) );

        $post_id = $GLOBALS['post']->ID;

        $my_wp_query = new WP_Query();
        $page_children = $my_wp_query->query(
            array(
                'post_type' => 'page',
                'post_parent' => $post_id,
                'nopaging' => true,
                'orderby' => 'menu_order',
                'order'   => 'ASC'
            )
        );

        echo "<div class=\"middle-sized subpages-menu-widget\">
				<div class='title'>
					<h3>{$vars['title']}</h3>
				</div>
				<div class='subpages-menu'>
					<div class='{$vars['row_classes']}'>
				";

        $i = 0;
        /* If we want to make it automatic and not rely on user
           entering the correct CSS classes of the Grid System
           then we should do someting as follows
        */
        $items_count = count( $page_children );
        $class_lg = floor( 12 / $vars['items_per_row_lg'] );
        $class_md = floor( 12 / $vars['items_per_row_md'] );
        $class_sm = floor( 12 / $vars['items_per_row_sm'] );
        $class_xs = 12;
        $classes = 'col-lg-'.$class_lg.' col-md-'.$class_md.' col-sm-'.$class_sm.' col-xs-'.$class_xs;
        foreach( $page_children as $page ){
            echo "  <div class='$classes {$vars['item_classes']}'>
						<a href='{$page->guid}'>
							<img class='hidden-xs' src='" . wp_get_attachment_url( $vars['item_icon']) . "' alt='{$page->post_title}' />
							<span class='text-link'>{$page->post_title}</span>
						</a>
                    </div>";
            /* TODO this here makes the plugin's consept too complex
			if( 0 == ++$i % $vars['items_per_row'] && $i < count( $page_children ) ) {
				//break line
				echo "</div><div class='{$vars['row_classes']}'>";
			} */
        }

        echo "
					</div>
				</div>

			</div>
			<div class='widget-blue-separator'></div>
			";
    }
}
new SubPages_Menu_Widget();