<?php

class InPageDynamicMenu extends Lion2486_Widget{
    //The widget ID, must be unique! (optional, if NULL, class name is used).
    protected $WidgetID = "InPageDynamicMenuwidget";
    //WidgetDescription. Text to show on widget list (optional).
    protected $WidgetDescription = "Created a page-menu (with anchor links) for page-widgets.";

    //text domain for translations.
    protected $textDomain = 'html5blank';
    //Widget Name! (Human readable form)
    protected $WidgetName = "In Page Dynamic Menu";

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
                'widget_classes',
                'Widget Classes',
                'Insert here all widget class names with a comma(,) between them.',
                'textarea',
                'Page_Paragraph_Widget,SiteOrigin_Widget_Editor_Widget,SiteOrigin_Widget_Features_Widget'
            )
        );
    }

    public function widget( $args, $instance )
    {
        extract( $vars = $this->form_fields( $instance ) );

        $current_widgets = get_post_meta ( get_the_id(), 'panels_data' ) ;
        $in_page_menu_items = array();
        $widget_class_list = explode( ',', $vars['widget_classes'] );
        $list = "";

        if( ( ! empty( $current_widgets ) )
            && array_key_exists( 0, $current_widgets )
            && array_key_exists( 'widgets', $current_widgets[0] )
        ) {
            $id = 0;
            $panel = 0;
            foreach( $current_widgets[0]['widgets'] as $widget ){


                if( $panel < $widget['panels_info']['grid'] ){
                    $panel = $widget['panels_info']['grid'];
                    $id = 0;
                }

                if( in_array( $widget['panels_info']['class'], $widget_class_list ) ){
                    $list .= "<li><a class='page-scroll' href='#panel-" . get_the_ID() . "-{$widget['panels_info']['grid']}-{$widget['panels_info']['cell']}-{$id}'>{$widget['title']}</a></li>";
                    array_push( $in_page_menu_items, $widget );
                }
                $id ++;
            }
        }

//        echo "<div style=\"display: none\">";
//        print_r($in_page_menu_items);
//        echo "</div>";



        echo "
               <nav class=\"navbar navbar-default affix-top\" role=\"navigation\" id=\"InPageMenu\" >
                    <div class=\"container\">
                        <div class=\"navbar-header page-scroll\">
                            <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-ex1-collapse\">".
            /////                               <span class=\"sr-only\">Toggle navigation</span>
            "<span class=\"icon-bar\"></span>
                                <span class=\"icon-bar\"></span>
                                <span class=\"icon-bar\"></span>
                            </button>
                            <span class='content-label  visible-xs-inline-block'>" . __( "Contents", "html5blank" ) . "</span>
                        </div>
                        

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class=\"collapse navbar-collapse navbar-ex1-collapse\">
                ";
        echo "<ul class='InPageMenu nav navbar-nav'>";

        foreach( $in_page_menu_items as $item ){

            // echo "<li><a class='page-scroll' href='#panel-" . get_the_ID() . "-{$item['panels_info']['grid']}-{$item['panels_info']['cell']}-{$item['panels_info']['id']}'>{$item['title']}</a></li>";
        }
        echo $list;
        echo "</ul>";
        echo "
                        </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container -->
            </nav>
            <span class=\"anchor\" id=\"landing\"></span>
        ";

        $classes_selectors = $widget_class_list;
        array_walk($classes_selectors, function(&$value, $key) { $value = '.' . $value; });

        echo "<script type='text/javascript'>
                jQuery(document).ready(function($) {


                    $('#' +
                     'Menu .navbar-collapse').click('li', function() {
                        $(this).collapse('hide');
                    });
                  /*  var scrollThreshold = 0;

                    scrollThreshold = $('#InPageMenu').parent().outerHeight();

                    /!*$('#InPageMenu').prevAll().each(function() {
                         scrollThreshold += $(this).outerHeight();
                    });
                    scrollThreshold -= 30;
*!/
                    $(window).resize(function(){
                        scrollThreshold = $('#InPageMenu').parent().outerHeight();
                        /!*scrollThreshold = 0;
                        $('#InPageMenu').prevAll().each(function() {
                             scrollThreshold += $(this).outerHeight();
                        });
                        scrollThreshold -= 30;*!/
                    });

                    $(window).scroll(function () {
                          //if you hard code, then use console
                          //.log to determine when you want the
                          //nav bar to stick.
                         // console.log($(window).scrollTop())
                        if ($(window).scrollTop() > scrollThreshold ) {
                          $('#InPageMenu').addClass('navbar-fixed-top');
                        }
                        if ($(window).scrollTop() < scrollThreshold ) {
                          $('#InPageMenu').removeClass('navbar-fixed-top');
                        }
                    });
*/
                    $('#InPageMenu').affix({
                      offset: {
                        top: function(){
                            var extra = $('#InPageMenu').css('position') == \"fixed\" ? $('#InPageMenu').outerHeight(true) : 0;
                            return (this.top = $('.page-header-image-container').outerHeight(true) + extra )
                        },
                        bottom: function () {
                          return (this.bottom = $('.footer').outerHeight(true))
                        }
                      }
                    });
                    $(window).resize( function(){
                        $('#InPageMynu').affix('checkPosition');
                    });

                    var offset = $('" . implode(', ', $classes_selectors ) . "').offset();
                    if(offset){
                        var scrollto = offset.top + 160; // minus fixed header height
                        $('html, body').animate({scrollTop:scrollto}, 0);
                    }
                });

            </script>
           ";

    }
}


new InPageDynamicMenu();
