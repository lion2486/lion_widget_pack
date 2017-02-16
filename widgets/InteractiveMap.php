<?php

class InteractiveMap extends Lion2486_Widget{
    //The widget ID, must be unique! (optional, if NULL, class name is used).
    protected $WidgetID = "InteractiveMap";
    //WidgetDescription. Text to show on widget list (optional).
    protected $WidgetDescription = "Created an interactive map with layers.";

    //text domain for translations.
    protected $textDomain = 'html5blank';
    //Widget Name! (Human readable form)
    protected $WidgetName = "Interactive Map";

    public function __construct(  ) {
        //Call the parent::__constructor()
        parent::__construct();

        //API KEY (browser key) AIzaSyBzMqJqhx0MAssOnbLblEUS6nnNVpFpGHM

        //Here set your own fields.
        $this->fields = array(
            $this->field(
                'title',
                'Title'
            ),
            $this->field(
                'api_key',
                'Google Maps API KEY (browser key)',
                'Insert your google maps api key (browser key) here.'
            ),
            $this->field(
                'map_center_lat',
                'Center lan',
                'Initial Map Center lat',
                'text',
                '37.4340043'
            ),
            $this->field(
                'map_center_lon',
                'Center lon',
                'Initial Map Center lon',
                'text',
                '25.2749582'
            ),
            $this->field(
                'zoom',
                'Zoom',
                'Initial Map Zoom',
                'text',
                '12'
            ),
            $this->field(
                'path_to_kml',
                'Path to KML',
                'Path to KML Files to show, separate the files within folders of locales, path is relative to your wordpress\' root path!(use short names in order to have bigger kml limit)',
                'text',
                'kmls/'
            )
        );
    }

    public function widget( $args, $instance )
    {
        extract( $vars = $this->form_fields( $instance ) );


        $kml_files = array();
        foreach ( glob( ABSPATH . '/' . $vars['path_to_kml'] . get_locale() . '/*.kml' ) as $file ){
            $xml = simplexml_load_file( $file );

            foreach ($xml->children() as $child) {
                //echo "<!-- {$child->getName()} -->";
                $i = ( string ) $child->name;
                break;
            }
            //manipulate file path into url
            $file = site_url( ) . '/' . $vars['path_to_kml'] . get_locale() . '/'.
                rawurlencode( substr( $file, strlen( ABSPATH. '/' .
                    $vars['path_to_kml'] . get_locale() . '/' ) ) );

            //$i = ( string ) $xml->Document->name;
            $kml_files[ $i ] = $file;
        }

        $kml_list = "";
        foreach( $kml_files as $name => $url ){
            $kml_list = "<li><input type=\"checkbox\" class=\"kml-checkbox\" disabled=\"disabled\" data-kml-file=\"{$url}\" data-name=\"{$name}\" id=\"map-layer-{$name}\"><label for=\"map-layer-{$name}\">{$name}</label></li>" . $kml_list;
        }


//                <div class=\"dropdown\" id='map-control'>
//                  <button class=\"btn btn-primary dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">layers<span class=\"caret\"></span></button>
//                  <ul class=\"dropdown-menu\">
//                    {$kml_list}
//                  </ul>
//                </div>
        echo "
            <div class='interactive-map-wrapper'>
      
               
                <div id=\"map\"></div>
                <div class=\"map-notes\">
                    <div class=\"alert alert-info touch-alert\" style=\"display: none;\">
                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                        " . __( 'In order to toggle the map controls, double-tap into it.', 'html5blank' ) . "
                    </div>
                </div>
            </div> 
            
                ";

        echo "<style type='text/css'>
                #map{
                    width: 100%;
                    height: 62vh;
                }
                .mapLayers div{

                }
                .mapLayers ul.dropdown-menu{
                    min-width: 380px;
                    width: 30vw;
                    padding: 4px 6px;
                }
                .mapLayers ul.dropdown-menu li{
                    display: inline-block;
                    min-width: 180px;
                    
                    cursor: pointer;
                }
                .mapLayers ul.dropdown-menu li label{
                    padding: 0 4px;
                    cursor: pointer;
                }
            </style>";
        echo "<script type='text/javascript'>
                var map;
                var myLayers = new Array();
                  
                function LayersControl(controlDiv, map){

                    var controlUI = document.createElement('div');
                    controlUI.title = '" . __( 'Click to manage layers of the map', 'html5blank' ) . "';
                    controlUI.className = 'dropdown mapLayers '
                    controlUI.style = 'margin: 10px; z-index: 0; position: absolute; cursor: pointer;left: 0; top: 0;';
                    controlDiv.appendChild(controlUI);
                
                    // Set CSS for the control interior.
                    var controlText = document.createElement('div');
                    controlText.innerHTML = '" . __( 'Layers', 'html5blank' ) . "';
                    controlText.className = 'dropdown-toggle'
                    controlText.type = 'button';
                    controlText.style = 'direction: ltr; overflow: hidden; text-align: center; position: relative; ' +
                     'color: rgb(86, 86, 86); font-family: Roboto, Arial, sans-serif; -webkit-user-select: none; ' +
                     'font-size: 11px; padding: 8px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; ' +
                     '-webkit-background-clip: padding-box; box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; ' +
                     'border-left-width: 0px; min-width: 55px; background-color: rgb(255, 255, 255); ' +
                     'background-clip: padding-box;';
                    controlText.setAttribute('data-toggle', 'dropdown')
                    controlUI.appendChild(controlText);
                    
                    jQuery(controlUI).append('<ul class=\"dropdown-menu\">{$kml_list}</ul>');
                }
                 function mapResize(){
                 
                  var css = jQuery( '.interactve-map-wrapper .gm-style-mtc > div' ).style;
                    jQuery( '.mapLayers .dropdown-toggle' ).style = css;
                    
                   /* var left = jQuery( '.mapLayers' ).parent().css('left');
                    jQuery( '.mapLayers .dropdown-toggle' ).css({'left' : left});
                    jQuery( '.mapLayers' ).parent().css({'left' : 0});*/
                }
                
                function layersCheckboxHandler(){ 
                    jQuery( 'input.kml-checkbox' ).click( function(){
                        var name = jQuery( this ).data( 'name' );
                        
                        if ( jQuery( this ).is( ':checked' ) ) {
                            // the checkbox was checked 
                            if(typeof myLayers[ name ] === 'undefined')
                                myLayers[ name ] = new google.maps.KmlLayer({
                                    url: jQuery( this ).data( 'kml-file' )
                                });
                            
                            myLayers[ name ].setMap(map);
                        } else {
                            // the checkbox was unchecked
                            myLayers[ name ].setMap( null );
                        }
                        
                        mapResize();
                    });
                    
                    jQuery( 'input.kml-checkbox' ).prop('disabled', false);
                    
                   mapResize();
                   setTimeout( mapResize, 300 );
                }
                
                function initMap() {
                    map = new google.maps.Map(document.getElementById('map'), {
                        scrollwheel: false,
                        center: {lat: {$vars['map_center_lat']}, lng: {$vars['map_center_lon']}},
                        zoom: {$vars['zoom']},
                        mapTypeId: google.maps.MapTypeId.TERRAIN,
                        draggable: !(\"ontouchend\" in document),
                        disableDoubleClickZoom: (\"ontouchend\" in document),
                        mapTypeControlOptions: {
                            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                            position: google.maps.ControlPosition.TOP_RIGHT
                        },
                    });
                    
                    var homeControlDiv = document.createElement('div');
                    var homeControl = new LayersControl(homeControlDiv, map);
                    
                    homeControlDiv.index = 1;
                    map.controls[google.maps.ControlPosition.LEFT_TOP].push(homeControlDiv);
                    
                    google.maps.event.addListenerOnce( map, 'idle', function(){
                        setTimeout( layersCheckboxHandler, 1000 );
                    });
                    map.addListener( 'dblclick', function(){
                        if((\"ontouchend\" in document))
                            map.draggable = !map.draggable;
                    });
                    map.addListener( 'resize', function(){
                        mapResize();
                    });
                    
                    map.addListener( 'center_changed', function(){
                        mapResize();
                    });
                    
                     map.addListener( 'bounds_changed', function(){
                        mapResize();
                    });
                    
                     map.addListener( 'zoom_changed', function(){
                        mapResize();
                    });
                    
                    if((\"ontouchend\" in document)){
                        jQuery( '.interactive-map-wrapper .map-notes .touch-alert' ).show('slow');
                    }
                    
                }
                
               
                
            
                </script>
                <script src=\"https://maps.googleapis.com/maps/api/js?key={$vars['api_key']}&callback=initMap\" async defer></script>
                
           ";

    }
}
new InteractiveMap();