<?php
class Getting_Here_Widget extends Lion2486_Widget {
    //The widget ID, must be unique! (optional, if NULL, class name is used).
    protected $WidgetID = "getting_here_widget";
    //WidgetDescription. Text to show on widget list (optional).
    protected $WidgetDescription = "Getting here widget.";

    //text domain for translations.
    protected $textDomain = 'html5blank';
    //Widget Name! (Human readable form)
    protected $WidgetName = "Getting Here Widget";

    public function __construct(  ) {
        //Call the parent::__constructor()
        parent::__construct();

        //Here set your own fields.
        $this->fields = array(
            $this->field(
                'textWithFerry',
                'Description text with Ferry.'
            ),
            $this->field(
                'fromPiraeusMiles',
                'From Piraeus nautic miles',
                '',
                array(
                    'dataType' => 'input',
                    'inputTag' => 'input',
                    'attr'     => array(
                        'type'  => 'number'
                    )
                ),
                94
            ),
            $this->field(
                'timeWithSpeedBoatFromPiraeus',
                'Time With SpeedBoat from Piraeus',
                '',
                'text',
                __( '3 hours', $this->textDomain )
            ),
            $this->field(
                'timeWithFerryFromPiraeus',
                'Time with Ferry from Piraeus',
                '',
                'text',
                __( '5 hours', $this->textDomain )
            ),
            $this->field(
                'textFromPiraeus',
                'Description text from Piraeus',
                '',
                'textarea'
            ),
            $this->field(
                'fromRafinaMiles',
                'From Rafina nautic miles',
                '',
                array(
                    'dataType' => 'input',
                    'inputTag' => 'input',
                    'attr'     => array(
                        'type'  => 'number'
                    )
                ),
                74
            ),
            $this->field(
                'timeWithSpeedBoatFromRafina',
                'Time With SpeedBoat from Rafina',
                '',
                'text',
                __( '2 hours', $this->textDomain )
            ),
            $this->field(
                'timeWithFerryFromRafina',
                'Time with Ferry from Rafina',
                '',
                'text',
                __( '2 hours', $this->textDomain )
            ),
            $this->field(
                'textFromRafina',
                'Description text from Rafina',
                '',
                'textarea'
            ),
            $this->field(
                'timeWithPlane',
                'Time with Plane',
                '',
                'text'
            ),
            $this->field(
                'textWithPlane',
                'Description text with plane.'
            ),
            $this->field(
                'link1_url',
                'URL for useful Link 1'
            ),
            $this->field(
                'link1_img',
                'Image for useful Link 1',
                '',
                'media'
            ),
            $this->field(
                'link2_url',
                'URL for useful Link 1'
            ),
            $this->field(
                'link2_img',
                'Image for useful Link 1',
                '',
                'media'
            ),
            $this->field(
                'link3_url',
                'URL for useful Link 1'
            ),
            $this->field(
                'link3_img',
                'Image for useful Link 1',
                '',
                'media'
            ),
            $this->field(
                'link4_url',
                'URL for useful Link 1'
            ),
            $this->field(
                'link4_img',
                'Image for useful Link 1',
                '',
                'media'
            ),
            $this->field(
                'link5_url',
                'URL for useful Link 1'
            ),
            $this->field(
                'link5_img',
                'Image for useful Link 1',
                '',
                'media'
            )

        );
    }

    public function widget( $args, $instance ) {
        extract( $vars = $this->form_fields( $instance ) );

        echo "<div class=\"middle-sized getting-here-widget\" id=\"getting-here\">
				<div class='header'>
					<img src='" . get_template_directory_uri() . "/img/icons/ornamentTitleGettingHere.png' alt='getting here'/>
					<h3>GETTING <span class='bold'>HERE</span></h3>
				</div>
				<div class='selector'>
					<div class='selector-icon active' id='ferry'>
						<img src='" . get_template_directory_uri() . "/img/icons/byFerry_icon_selected.png' alt='ferry'/><br/>
						<span>" . __( "Ferry", $this->textDomain ) . "</span>
					</div>
					<div class='selector-icon inactive' id='plane'>
						<img src='" . get_template_directory_uri() . "/img/icons/byAirplane_icon_selected.png' alt='plane'/><br/>
						<span>" . __( "Plane", $this->textDomain ) . "</span>
					</div>
				</div>

				<div class='ferry travel-medium'>
					<p class='intro-text'>{$vars['textWithFerry']}</p>

					<div class='box'>
						<div class='right-icon'></div>
						<div class='box-inner'>
							<img src='" . get_template_directory_uri() . "/img/icons/calendar_icon.png' alt='schedule' class='calendar-icon' />
							<h1>" . __( "FROM PIRAEUS PORT", $this->textDomain ) . "</h1>
							<span class='miles'>{$vars['fromPiraeusMiles']} " . __( "nautical miles", $this->textDomain ) . "</span>
							<h3 class='hours'><label>" . __( "SPEEDBOAT", $this->textDomain ) . " </label><img src='" . get_template_directory_uri() . "/img/icons/time_icon.png' alt='time icon'/> {$vars['timeWithSpeedBoatFromPiraeus']} </h3>
							<h3 class='hours'><label>" . __( "FERRY", $this->textDomain ) . " </label><img src='" . get_template_directory_uri() . "/img/icons/time_icon.png' alt='time icon'/> {$vars['timeWithFerryFromPiraeus']} </h3>
							<p>{$vars['textFromPiraeus']}</p>
						</div>
					</div>

					<div class='box'>
						<div class='right-icon'></div>
						<div class='box-inner'>
							<img src='" . get_template_directory_uri() . "/img/icons/calendar_icon.png' alt='schedule' class='calendar-icon' />
							<h1>" . __( "FROM RAFINA PORT", $this->textDomain ) . "</h1>
							<span class='miles'>{$vars['fromRafinaMiles']} " . __( "nautical miles", $this->textDomain ) . "</span>
							<h3 class='hours'><label>" . __( "SPEEDBOAT", $this->textDomain ) . " </label><img src='" . get_template_directory_uri() . "/img/icons/time_icon.png' alt='time icon'/> {$vars['timeWithSpeedBoatFromRafina']} </h3>
							<h3 class='hours'><label>" . __( "FERRY", $this->textDomain ) . " </label><img src='" . get_template_directory_uri() . "/img/icons/time_icon.png' alt='time icon'/> {$vars['timeWithFerryFromRafina']} </h3>
							<p>{$vars['textFromRafina']}</p>
						</div>
					</div>

				</div>
				<div class='plane travel-medium'>
					<p class='intro-text'>{$vars['textWithPlane']}</p>

					<div class='box-container'>
						<div class='box'>
							<div class='right-icon'></div>
							<div class='box-inner'>
								<img src='" . get_template_directory_uri() . "/img/icons/calendar_icon.png' alt='schedule' class='calendar-icon' />
								<h1>" . __( "FROM ELEFTHERIOS VENIZELOS AIRPORT", $this->textDomain ) . "</h1>
								<span class='miles'>{$vars['fromPiraeusMiles']} " . __( "miles", $this->textDomain ) . "</span>
								<h3 class='hours'><label>... </label><img src='" . get_template_directory_uri() . "/img/icons/time_icon.png' alt='time icon'/>  </h3>
								<h3 class='hours'><label>... </label><img src='" . get_template_directory_uri() . "/img/icons/time_icon.png' alt='time icon'/>  </h3>
								<p></p>
							</div>
						</div>

						<div class='box'>
							<div class='right-icon'></div>
							<div class='box-inner'>
								<img src='" . get_template_directory_uri() . "/img/icons/calendar_icon.png' alt='schedule' class='calendar-icon' />
								<h1>" . __( "FROM MYKONOS AIRPORT", $this->textDomain ) . "</h1>
								<span class='miles'>{$vars['fromPiraeusMiles']} " . __( "miles", $this->textDomain ) . "</span>
								<h3 class='hours'><label>... </label><img src='" . get_template_directory_uri() . "/img/icons/time_icon.png' alt='time icon'/>  </h3>
								<h3 class='hours'><label>... </label><img src='" . get_template_directory_uri() . "/img/icons/time_icon.png' alt='time icon'/>  </h3>
								<p></p>
							</div>
						</div>
					</div>
				</div>

				<div class='useful-links'>
					<h2 class='title2'>" . __( "USEFUL LINKS", $this->textDomain ) . "</h2>
				</div>

				<div class='useful-links-items'>
					<a href='{$vars['link1_url']}'>
						<img src='" . wp_get_attachment_url( $vars['link1_img'] ) . "' alt='useful link image' />
					</a>

					<a href='{$vars['link2_url']}'>
						<img src='" . wp_get_attachment_url( $vars['link2_img'] ) . "' alt='useful link image' />
					</a>

					<a href='{$vars['link3_url']}'>
						<img src='" . wp_get_attachment_url( $vars['link3_img'] ) . "' alt='useful link image' />
					</a>

					<a href='{$vars['link4_url']}'>
						<img src='" . wp_get_attachment_url( $vars['link4_img'] ) . "' alt='useful link image' />
					</a>

					<a href='{$vars['link5_url']}'>
						<img src='" . wp_get_attachment_url( $vars['link5_img'] ) . "' alt='useful link image' />
					</a>
				</div>
			</div>
			<script type='text/javascript'>
				jQuery('.getting-here-widget').find('.plane').hide().addClass('inactive');

				jQuery('.getting-here-widget .selector div').click(function(){
					jQuery(this).parent().parent().find('.travel-medium').toggle();
					jQuery(this).parent().find('div').toggleClass('active').toggleClass('inactive');
				});

			</script>
			";
    }
}
new Getting_Here_Widget();