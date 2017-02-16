<?php
class SubPages_Tile_Widget extends Lion2486_Widget {
    //The widget ID, must be unique! (optional, if NULL, class name is used).
    protected $WidgetID = "subpages_tile_widget";
    //WidgetDescription. Text to show on widget list (optional).
    protected $WidgetDescription = "Generate Tiled-style widget with pages from parent page.";

    //text domain for translations.
    protected $textDomain = 'html5blank';
    //Widget Name! (Human readable form)
    protected $WidgetName = "SubPages Tiles";

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
                'header_icon',
                'Header Icon',
                '',
                array(
                    'dataType' => 'media'
                    //,'multiple' => true
                )
            ),
            $this->field(
                'items_per_row',
                'Menu Items per row',
                '',
                array(
                    'dataType' => 'input',
                    'inputTag' => 'input',
                    'attr'     => array(
                        'type'  => 'number'
                    )
                ),
                3
            ),
            $this->field(
                'bg_image',
                'Background Image',
                '',
                'media'
            ),
            $this->field(
                'parent_page',
                'Parent Page ID',
                '',
                array(
                    'dataType'  => 'input',
                    'inputTag'     => 'input',
                    'attr'      => array(
                        'type' => 'number'
                    )
                )
            )
        );
    }

    public function widget( $args, $instance ) {
        extract( $vars = $this->form_fields( $instance ) );

        $my_wp_query = new WP_Query();
        $page_children = $my_wp_query->query(
            array(
                'post_type'     => 'page',
                'post_parent'   => $vars['parent_page'],
                'nopaging' => true,
                'orderby' => 'menu_order',
                'order'   => 'ASC'
            )
        );

        echo "<div class=\"category-tile-widget\" style=\"background-image: url('" .  wp_get_attachment_url( $vars['bg_image'] ) . "');\">
				<div class='middle-sized'>
					<div class='title'>
						<img src='" . wp_get_attachment_url( $vars['header_icon'] ) . "' alt='{$vars['title']}' />
						<h3>{$vars['title']}</h3>
					</div>
					<div class='tile-items'>
						<div class='row'>
				";

        $i = 0;
        foreach( $page_children as $page ){
            $cols = 12 / $vars['items_per_row'];
            echo "
							<div class='tile-item col-sm-$cols col-md-$cols col-lg-$cols' ".
                //	style='width: " . (88 / $vars['items_per_row'] ) . "%;'
                ">
								<a href='{$page->guid}'>
									" . get_the_post_thumbnail( $page->ID ) ."
									<span class='text-link'>{$page->post_title}</span>
									<p>" . wp_html_excerpt( $page->post_content, 132, "..." ) . "</p>
								</a>
							</div>
			";
            if( 0 == ++$i % $vars['items_per_row'] ) {
                //break line
                echo "	</div><div class='row'>";
            }
        }

        echo "
						</div>
					</div>

				</div>
			</div>
			";
    }
}
new SubPages_Tile_Widget();