<?php
/*
Section: BigTextDMS
Author: TourKick (Clifford P)
Author URI: http://tourkick.com/?utm_source=pagelines&utm_medium=section&utm_content=authoruri&utm_campaign=bigtextdms_section
Plugin URI: http://www.pagelinestheme.com/bigtextdms-section?utm_source=pagelines&utm_medium=section&utm_content=pluginuri&utm_campaign=bigtext_section
Description: A <a href="https://github.com/zachleat/BigText" target="_blank">BigText</a> section that resizes text to fit one or more words on a line that fits the container. Responsive too, which means it scales with different size browsers.
Demo: http://www.pagelinestheme.com/bigtextdms-section?utm_source=pagelines&utm_medium=section&utm_content=demolink&utm_campaign=bigtextdms_section
Class Name: BigTextDMS
Version: 1.0
Cloning: true
PageLines: true
v3: true
Filter: component
*/


class BigTextDMS extends PageLinesSection {

	function section_scripts(){
		// BigText version 0.1.2, MIT License, from https://github.com/zachleat/BigText#releases
		wp_enqueue_script('bigtextdms', $this->base_url.'/bigtextdms.js', array('jquery'), '0.1.2', true);

	}


	function section_head(){
		if(function_exists('pl_has_editor') && pl_has_editor()){
			$clone_id = $this->get_the_id();
		} else {
	        global $pagelines_ID;
	        $oset = array('post_id' => $pagelines_ID);
			$clone_id = $this->oset['clone_id'];
		}


		// pull in the options, since they're from another function
		global $pagelines_ID;
        $oset = array('post_id' => $pagelines_ID);


		// commented out since the .js sets it to 528 already //$maxfontsize = $this->opt('bigtext-maxfontsize') ? $this->opt('bigtext-maxfontsize') : '528';
		$maxfontsize = $this->opt('bigtext_maxfontsize');
		$minfontsize = $this->opt('bigtext_minfontsize');

		// allow only numbers
		$maxfontsize = preg_replace("/[^0-9]/","",$maxfontsize);
		$minfontsize = preg_replace("/[^0-9]/","",$minfontsize);
		?>

		<script type="text/javascript">
		/*<![CDATA[*/
			jQuery(document).ready(function(){

				jQuery("#bigtextdms-<?php echo $clone_id ?>").bigtextdms({
					<?php
					// FYI: https://github.com/zachleat/BigText#change-the-default-min-starting-font-size

					if(empty($maxfontsize) && empty($minfontsize)) {
						echo "";
					} elseif(!empty($maxfontsize) && !empty($minfontsize)) {
						echo "maxfontsize: $maxfontsize, minfontsize: $minfontsize";
					} elseif(!empty($maxfontsize)) {
						echo "maxfontsize: $maxfontsize";
					} else{
						echo "minfontsize: $minfontsize";
					}
					?>
				});

			});
		/*]]>*/</script>

		<?php

		echo load_custom_font( $this->opt('bigtext_font'), ' #bigtextdms-'. $clone_id );
		echo load_custom_font( $this->opt('bigtext_font_0'), "#bigtextdms-$clone_id .btline0" );
		echo load_custom_font( $this->opt('bigtext_font_1'), "#bigtextdms-$clone_id .btline1" );
		echo load_custom_font( $this->opt('bigtext_font_2'), "#bigtextdms-$clone_id .btline2" );
		echo load_custom_font( $this->opt('bigtext_font_3'), "#bigtextdms-$clone_id .btline3" );
		echo load_custom_font( $this->opt('bigtext_font_4'), "#bigtextdms-$clone_id .btline4" );
		echo load_custom_font( $this->opt('bigtext_font_5'), "#bigtextdms-$clone_id .btline5" );
		echo load_custom_font( $this->opt('bigtext_font_6'), "#bigtextdms-$clone_id .btline6" );
		echo load_custom_font( $this->opt('bigtext_font_7'), "#bigtextdms-$clone_id .btline7" );
		echo load_custom_font( $this->opt('bigtext_font_8'), "#bigtextdms-$clone_id .btline8" );
		echo load_custom_font( $this->opt('bigtext_font_9'), "#bigtextdms-$clone_id .btline9" );

	}



	function section_optionator( $settings ){

		$settings = wp_parse_args($settings, $this->optionator_default);

		global $post_ID;
		$oset = array(
			'post_id'  => $post_ID,
			'clone_id' => $settings['clone_id'],
			'type'     => $settings['type']
		);

		$options = array();

		$options[] = array(
			'key'	=> 'bigtext_text',
			'type'	=> 'multi',
			'title'		=> __('Enter your BigText here.', $this->id),
			'shortexp'	=> __('Everything you enter per line will resize to fill the entire width. Blank lines will be skipped.<br/>You may enter HTML code and/or use shortcodes.<br/>Consider entering one or more <em>nbsp;</em> on each side of a line of text to pseudo-indent it.', $this->id),
			'opts'	=> array(
				array(
					'key'	=> 'bigtext_text_0',
					'type'	=> 'text',
					'label'	=> __('Line 0 Text <em>(Required)</em>', $this->id)
				),
				array(
					'key'	=> 'bigtext_text_1',
					'type'	=> 'text',
					'label'	=> __('Line 1 Text', $this->id)
				),
				array(
					'key'	=> 'bigtext_text_2',
					'type'	=> 'text',
					'label'	=> __('Line 2 Text', $this->id)
				),
				array(
					'key'	=> 'bigtext_text_3',
					'type'	=> 'text',
					'label'	=> __('Line 3 Text', $this->id)
				),
				array(
					'key'	=> 'bigtext_text_4',
					'type'	=> 'text',
					'label'	=> __('Line 4 Text', $this->id)
				),
				array(
					'key'	=> 'bigtext_text_5',
					'type'	=> 'text',
					'label'	=> __('Line 5 Text', $this->id)
				),
				array(
					'key'	=> 'bigtext_text_6',
					'type'	=> 'text',
					'label'	=> __('Line 6 Text', $this->id)
				),
				array(
					'key'	=> 'bigtext_text_7',
					'type'	=> 'text',
					'label'	=> __('Line 7 Text', $this->id)
				),
				array(
					'key'	=> 'bigtext_text_8',
					'type'	=> 'text',
					'label'	=> __('Line 8 Text', $this->id)
				),
				array(
					'key'	=> 'bigtext_text_9',
					'type'	=> 'text',
					'label'	=> __('Line 9 Text', $this->id)
				),
			  )
			);

		$options[] = array(
			'key'		=> 'bigtext_container',
			'type'		=> 'multi',
			'title'		=> __('BigText Container Settings', $this->id),
			'help'		=> 'http://www.pagelinestheme.com/bigtext-section?utm_source=pagelines&utm_medium=section&utm_content=docslink&utm_campaign=bigtext_section',
			'opts'	=> array(
				array(
					'key'		=> 'bigtext_color_bg',
					'type'		=> 'color',
					'default'	=> '',
					'label' 	=> __('Background Color', $this->id)
				),
				array(
					'key'	=> 'bigtext_image_bg',
					'type'	=> 'image_upload',
					'label' => __('Background Image', $this->id)
				),
				array(
					'key'	=> 'bigtext_image_bg_size',
					'type' 	=> 'select',
					'label'	=> __('Background Image Size.<br/>&nbsp;&nbsp;&nbsp;Default = <em>None / Auto</em><br/><a href="https://developer.mozilla.org/en-US/docs/CSS/background-size" target="_blank">CSS background-size</a>', $this->id),
					'opts' => array(
						'contain'	=> array('name' => 'Contain' ),
						'cover'		=> array('name' => 'Cover' )
						)
				),
				array(
					'key'	=> 'bigtext_image_bg_position',
					'type' 	=> 'select',
					'label'	=> __('Background Image Position.<br/>&nbsp;&nbsp;&nbsp;Default = <em>center center</em><br/><a href="https://developer.mozilla.org/en-US/docs/CSS/background-position" target="_blank">CSS background-position</a>, <a href="http://www.w3schools.com/cssref/playit.asp?filename=playcss_background-position" target="_blank">Try It Out</a>', $this->id),
					'opts' => array(
						'left top'		=> array('name' => __('Left Top', $this->id) ),
						'left center'	=> array('name' => __('Left Center', $this->id) ),
						'left bottom'	=> array('name' => __('Left Bottom', $this->id) ),
						'right top'		=> array('name' => __('Right Top', $this->id) ),
						'right center'	=> array('name' => __('Right Center', $this->id) ),
						'right bottom'	=> array('name' => __('Right Bottom', $this->id) ),
						'center top'	=> array('name' => __('Center Top', $this->id) ),
						'center bottom'	=> array('name' => __('Center Bottom', $this->id) )
					)
				),
				array(
					'key'	=> 'bigtext_width',
					'type'	=> 'text',
					'label'	=> __('Width of BigText area (any units: %, px, em, etc).<br/>&nbsp;&nbsp;&nbsp;Default = <em>100%</em><br/><a href="https://developer.mozilla.org/en-US/docs/CSS/width" target="_blank">CSS width</a>', $this->id)
				),
				array(
					'key'	=> 'bigtext_max_width',
					'type'	=> 'text',
					'label'	=> __('Max-Width of BigText area (any units: %, px, em, etc).<br/>&nbsp;&nbsp;&nbsp;Default = <em>100%</em> (which makes it responsive)<br/><a href="https://developer.mozilla.org/en-US/docs/CSS/max-width" target="_blank">CSS max-width</a>', $this->id)
				),
				array(
					'key'	=> 'bigtext_maxfontsize',
					'type'	=> 'text',
					'label'	=> __('Max Font-Size (MUST BE IN PX, with or w/o "px")<br/>&nbsp;&nbsp;&nbsp;Default = <em>528</em>', $this->id)
				),
				array(
					'key'	=> 'bigtext_minfontsize',
					'type'	=> 'text',
					'label'	=> __('Min Font-Size (MUST BE IN PX, with or w/o "px")<br/>&nbsp;&nbsp;&nbsp;Default = Null/Zero', $this->id)
				)
			)
		);

		$options[] = array(
			'key'	=> 'bigtext_defaults',
			'type'	=> 'multi',
			'title'		=> __('BigText Default Settings to set all line options (can override per line)', $this->id),
			'opts'	=> array(
				array(
					'key'	=> 'bigtext_font',
					'type'	=> 'fonts',
					'label'	=> __('Default Font', $this->id)
				),
				array(
					'key'	=> 'bigtext_text_align',
					'type' 		=> 'select',
					'label'	=> __('BigText Text-Align<br/>&nbsp;&nbsp;&nbsp;Default = <em>center</em><br/><a href="https://developer.mozilla.org/en-US/docs/CSS/text-align" target="_blank">CSS text-align</a>', $this->id),
					'opts' => array(
						'left'		=> array('name' => __('Left', $this->id) ),
						'right'		=> array('name' => __('Right', $this->id) ),
						'justify'	=> array('name' => __('Justify', $this->id) )
					)
				),
				array(
					'key'	=> 'bigtext_text_decoration',
					'type' 		=> 'select',
					'label'	=> __('Text-Decoration.<br/>&nbsp;&nbsp;&nbsp;Default = <em>None</em><br/><a href="https://developer.mozilla.org/en-US/docs/CSS/text-decoration" target="_blank">CSS text-decoration</a>', $this->id),
					'opts' => array(
						'underline'	=> array('name' => __('Underline', $this->id) ),
						'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
						'overline'		=> array('name' => __('Overline', $this->id) )
					)
				),
				array(
					'key'	=> 'bigtext_line_height',
					'type'	=> 'text',
					'label'	=> __('BigText Line-Height (e.g. 0.9).<br/>&nbsp;&nbsp;&nbsp;Default = <em>1</em><br/><a href="https://developer.mozilla.org/en-US/docs/CSS/line-height" target="_blank">CSS line-height</a>', $this->id)
				),
				array(
					'key'	=> 'bigtext_small_caps',
					'type'	=> 'check',
					'label'	=> __('Display in small-caps?', $this->id)
				),
				array(
					'key'	=> 'bigtext_transparent_text',
					'type'	=> 'check',
					'label'	=> __('Change text color to transparent. Warnings:<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Only works on Webkit browsers. Ignored on other browsers.<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Try setting text color to white or black as a backup for non-Webkit.<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Does not work as expected with Stroke/Outline or Shadow Colors.<br/><br/>', $this->id)
				),
				array(
					'key'	=> 'bigtext_color',
					'type'		    => 'color',
					'default'		=> '',
					'label' 		=> __('Default Text Color', $this->id)
				),
				array(
					'key'	=> 'bigtext_color_stroke',
					'type'	=> 'color',
					'default'		=> '',
					'label' 		=> __('Stroke Color<br/>(a 1px Outline)', $this->id)
				),
				array(
					'key'	=> 'bigtext_color_shadow',
					'type'		    => 'color',
					'default'		=> '',
					'label'	=> __('Default<br/>Shadow Color', $this->id)
				),
				array(
					'key'	=> 'bigtext_color_shadow_length',
					'type'	=> 'text',
					'label' 		=> __('Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
				)
			)
		);

		$options[] = array(
			'key'	=> 'bigtext_exempt',
			'type'	=> 'multi',
			'title'		=> __('Exempt lines will be displayed at the sitewide font size', $this->id),
			'opts'	=> array(
				array(
					'key'	=> 'bigtext_exempt_0',
					'type'	=> 'check',
					'label'	=> __('Exempt Line 0', $this->id)
				),
				array(
					'key'	=> 'bigtext_exempt_1',
					'type'	=> 'check',
					'label'	=> __('Exempt Line 1', $this->id)
				),
				array(
					'key'	=> 'bigtext_exempt_2',
					'type'	=> 'check',
					'label'	=> __('Exempt Line 2', $this->id)
				),
				array(
					'key'	=> 'bigtext_exempt_3',
					'type'	=> 'check',
					'label'	=> __('Exempt Line 3', $this->id)
				),
				array(
					'key'	=> 'bigtext_exempt_4',
					'type'	=> 'check',
					'label'	=> __('Exempt Line 4', $this->id)
				),
				array(
					'key'	=> 'bigtext_exempt_5',
					'type'	=> 'check',
					'label'	=> __('Exempt Line 5', $this->id)
				),
				array(
					'key'	=> 'bigtext_exempt_6',
					'type'	=> 'check',
					'label'	=> __('Exempt Line 6', $this->id)
				),
				array(
					'key'	=> 'bigtext_exempt_7',
					'type'	=> 'check',
					'label'	=> __('Exempt Line 7', $this->id)
				),
				array(
					'key'	=> 'bigtext_exempt_8',
					'type'	=> 'check',
					'label'	=> __('Exempt Line 8', $this->id)
				),
				array(
					'key'	=> 'bigtext_exempt_9',
					'type'	=> 'check',
					'label'	=> __('Exempt Line 9', $this->id)
				),
			)
		);


		$options[] = array(
			'key'	=> 'bigtext_options_line_by_line',
			'title' => __( 'Show Line-by-Line Styling?', $this->id ),
			'label'	=> __( 'Show Line-by-Line Styling?<br/>(e.g. font picker, alignment, small-caps, colors, etc.)', $this->id ),
			'shortexp'	=> __('Save and refresh to see the different options.', $this->id),
			'type'	=> 'check',
		);

		$line_by_line_disabled = !$this->opt('bigtext_options_line_by_line') ? true : false;

		if( $line_by_line_disabled == false ) {

			$options[] = array(
				'key'	=> 'bigtext_0',
				'type'	=> 'multi',
				'title'		=> __('BigText Line 0', $this->id),
				'disabled' => $line_by_line_disabled,
				'opts'	=> array(
					array(
						'key'	=> 'bigtext_font_0',
						'type'	=> 'fonts',
						'label'	=> __('Line 0 Font', $this->id)
					),
					array(
						'key'	=> 'bigtext_text_align_0',
						'type' 	=> 'select',
						'label'	=> __('Line 0 Text-Align', $this->id),
						'opts' => array(
							'center'	=> array('name' => __('Center', $this->id) ),
							'left'		=> array('name' => __('Left', $this->id) ),
							'right'		=> array('name' => __('Right', $this->id) ),
							'justify'	=> array('name' => __('Justify', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_text_decoration_0',
						'type' 	=> 'select',
						'label'	=> __('Line 0 Text-Decoration', $this->id),
						'opts' => array(
							'none'	=> array('name' => __('None', $this->id) ),
							'underline'	=> array('name' => __('Underline', $this->id) ),
							'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
							'overline'		=> array('name' => __('Overline', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_line_height_0',
						'type'	=> 'text',
						'label'	=> __('Line 0 Line-Height', $this->id)
					),
					array(
						'key'	=> 'bigtext_small_caps_0',
						'type'	=> 'check',
						'label'	=> __('Line 0 in Small-Caps<br/><br/>', $this->id)
					),
	/*
					array(
						'key'	=> 'bigtext_transparent_text_0',
						'type'	=> 'check',
						'label'	=> __('Line 0 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
					),
	*/
					array(
						'key'	=> 'bigtext_color_0',
						'type'		    => 'color',
						'default'		=> '',
						'label' 		=> __('Line 0 Text Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_0_stroke',
						'type'	=> 'color',
						'default'		=> '',
						'label' 		=> __('Line 0 Stroke<br/>(a 1px Outline)', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_0_shadow',
						'type'		    => 'color',
						'default'		=> '',
						'label'	=> __('Line 0<br/>Shadow Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_0_shadow_length',
						'type'	=> 'text',
						'label' 		=> __('Line 0 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
					)
				  )
				);

			$options[] = array(
				'key'	=> 'bigtext_1',
				'type'	=> 'multi',
				'title'		=> __('BigText Line 1', $this->id),
				'disabled' => $line_by_line_disabled,
				'opts'	=> array(
					array(
						'key'	=> 'bigtext_font_1',
						'type'	=> 'fonts',
						'label'	=> __('Line 1 Font', $this->id)
					),
					array(
						'key'	=> 'bigtext_text_align_1',
						'type' 	=> 'select',
						'label'	=> __('Line 1 Text-Align', $this->id),
						'opts' => array(
							'center'	=> array('name' => __('Center', $this->id) ),
							'left'		=> array('name' => __('Left', $this->id) ),
							'right'		=> array('name' => __('Right', $this->id) ),
							'justify'	=> array('name' => __('Justify', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_text_decoration_1',
						'type' 	=> 'select',
						'label'	=> __('Line 1 Text-Decoration', $this->id),
						'opts' => array(
							'none'	=> array('name' => __('None', $this->id) ),
							'underline'	=> array('name' => __('Underline', $this->id) ),
							'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
							'overline'		=> array('name' => __('Overline', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_line_height_1',
						'type'	=> 'text',
						'label'	=> __('Line 1 Line-Height', $this->id)
					),
					array(
						'key'	=> 'bigtext_small_caps_1',
						'type'	=> 'check',
						'label'	=> __('Line 1 in Small-Caps<br/><br/>', $this->id)
					),
	/*
					array(
						'key'	=> 'bigtext_transparent_text_1',
						'type'	=> 'check',
						'label'	=> __('Line 1 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
					),
	*/
					array(
						'key'	=> 'bigtext_color_1',
						'type'		    => 'color',
						'default'		=> '',
						'label' 		=> __('Line 1 Text Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_1_stroke',
						'type'	=> 'color',
						'default'		=> '',
						'label' 		=> __('Line 1 Stroke<br/>(a 1px Outline)', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_1_shadow',
						'type'		    => 'color',
						'default'		=> '',
						'label'	=> __('Line 1<br/>Shadow Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_1_shadow_length',
						'type'	=> 'text',
						'label' 		=> __('Line 1 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
					)
				  )
				);

			$options[] = array(
				'key'	=> 'bigtext_2',
				'type'	=> 'multi',
				'title'		=> __('BigText Line 2', $this->id),
				'disabled' => $line_by_line_disabled,
				'opts'	=> array(
					array(
						'key'	=> 'bigtext_font_2',
						'type'	=> 'fonts',
						'label'	=> __('Line 2 Font', $this->id)
					),
					array(
						'key'	=> 'bigtext_text_align_2',
						'type' 		=> 'select',
						'label'	=> __('Line 2 Text-Align', $this->id),
						'opts' => array(
							'center'	=> array('name' => __('Center', $this->id) ),
							'left'		=> array('name' => __('Left', $this->id) ),
							'right'		=> array('name' => __('Right', $this->id) ),
							'justify'	=> array('name' => __('Justify', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_text_decoration_2',
						'type' 		=> 'select',
						'label'	=> __('Line 2 Text-Decoration', $this->id),
						'opts' => array(
							'none'	=> array('name' => __('None', $this->id) ),
							'underline'	=> array('name' => __('Underline', $this->id) ),
							'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
							'overline'		=> array('name' => __('Overline', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_line_height_2',
						'type'	=> 'text',
						'label'	=> __('Line 2 Line-Height', $this->id)
					),
					array(
						'key'	=> 'bigtext_small_caps_2',
						'type'	=> 'check',
						'label'	=> __('Line 2 in Small-Caps<br/><br/>', $this->id)
					),
	/*
					array(
						'key'	=> 'bigtext_transparent_text_2',
						'type'	=> 'check',
						'label'	=> __('Line 2 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
					),
	*/
					array(
						'key'	=> 'bigtext_color_2',
						'type'		    => 'color',
						'default'		=> '',
						'label' 		=> __('Line 2 Text Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_2_stroke',
						'type'	=> 'color',
						'default'		=> '',
						'label' 		=> __('Line 2 Stroke<br/>(a 1px Outline)', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_2_shadow',
						'type'		    => 'color',
						'default'		=> '',
						'label'	=> __('Line 2<br/>Shadow Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_2_shadow_length',
						'type'	=> 'text',
						'label' 		=> __('Line 2 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
					)
				  )
				);

			$options[] = array(
				'key'	=> 'bigtext_3',
				'type'	=> 'multi',
				'title'		=> __('BigText Line 3', $this->id),
				'disabled' => $line_by_line_disabled,
				'opts'	=> array(
					array(
						'key'	=> 'bigtext_font_3',
						'type'	=> 'fonts',
						'label'	=> __('Line 3 Font', $this->id)
					),
					array(
						'key'	=> 'bigtext_text_align_3',
						'type' 		=> 'select',
						'label'	=> __('Line 3 Text-Align', $this->id),
						'opts' => array(
							'center'	=> array('name' => __('Center', $this->id) ),
							'left'		=> array('name' => __('Left', $this->id) ),
							'right'		=> array('name' => __('Right', $this->id) ),
							'justify'	=> array('name' => __('Justify', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_text_decoration_3',
						'type' 		=> 'select',
						'label'	=> __('Line 3 Text-Decoration', $this->id),
						'opts' => array(
							'none'	=> array('name' => __('None', $this->id) ),
							'underline'	=> array('name' => __('Underline', $this->id) ),
							'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
							'overline'		=> array('name' => __('Overline', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_line_height_3',
						'type'	=> 'text',
						'label'	=> __('Line 3 Line-Height', $this->id)
					),
					array(
						'key'	=> 'bigtext_small_caps_3',
						'type'	=> 'check',
						'label'	=> __('Line 3 in Small-Caps<br/><br/>', $this->id)
					),
	/*
					array(
						'key'	=> 'bigtext_transparent_text_3',
						'type'	=> 'check',
						'label'	=> __('Line 3 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
					),
	*/
					array(
						'key'	=> 'bigtext_color_3',
						'type'		    => 'color',
						'default'		=> '',
						'label' 		=> __('Line 3 Text Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_3_stroke',
						'type'	=> 'color',
						'default'		=> '',
						'label' 		=> __('Line 3 Stroke<br/>(a 1px Outline)', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_3_shadow',
						'type'		    => 'color',
						'default'		=> '',
						'label'	=> __('Line 3<br/>Shadow Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_3_shadow_length',
						'type'	=> 'text',
						'label' 		=> __('Line 3 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
					)
				  )
				);

			$options[] = array(
				'key'	=> 'bigtext_4',
				'type'	=> 'multi',
				'title'		=> __('BigText Line 4', $this->id),
				'disabled' => $line_by_line_disabled,
				'opts'	=> array(
					array(
						'key'	=> 'bigtext_font_4',
						'type'	=> 'fonts',
						'label'	=> __('Line 4 Font', $this->id)
					),
					array(
						'key'	=> 'bigtext_text_align_4',
						'type' 		=> 'select',
						'label'	=> __('Line 4 Text-Align', $this->id),
						'opts' => array(
							'center'	=> array('name' => __('Center', $this->id) ),
							'left'		=> array('name' => __('Left', $this->id) ),
							'right'		=> array('name' => __('Right', $this->id) ),
							'justify'	=> array('name' => __('Justify', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_text_decoration_4',
						'type' 		=> 'select',
						'label'	=> __('Line 4 Text-Decoration', $this->id),
						'opts' => array(
							'none'	=> array('name' => __('None', $this->id) ),
							'underline'	=> array('name' => __('Underline', $this->id) ),
							'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
							'overline'		=> array('name' => __('Overline', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_line_height_4',
						'type'	=> 'text',
						'label'	=> __('Line 4 Line-Height', $this->id)
					),
					array(
						'key'	=> 'bigtext_small_caps_4',
						'type'	=> 'check',
						'label'	=> __('Line 4 in Small-Caps<br/><br/>', $this->id)
					),
	/*
					array(
						'key'	=> 'bigtext_transparent_text_4',
						'type'	=> 'check',
						'label'	=> __('Line 4 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
					),
	*/
					array(
						'key'	=> 'bigtext_color_4',
						'type'		    => 'color',
						'default'		=> '',
						'label' 		=> __('Line 4 Text Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_4_stroke',
						'type'	=> 'color',
						'default'		=> '',
						'label' 		=> __('Line 4 Stroke<br/>(a 1px Outline)', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_4_shadow',
						'type'		    => 'color',
						'default'		=> '',
						'label'	=> __('Line 4<br/>Shadow Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_4_shadow_length',
						'type'	=> 'text',
						'label' 		=> __('Line 4 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
					)
				  )
				);

			$options[] = array(
				'key'	=> 'bigtext_5',
				'type'	=> 'multi',
				'title'		=> __('BigText Line 5', $this->id),
				'disabled' => $line_by_line_disabled,
				'opts'	=> array(
					array(
						'key'	=> 'bigtext_font_5',
						'type'	=> 'fonts',
						'label'	=> __('Line 5 Font', $this->id)
					),
					array(
						'key'	=> 'bigtext_text_align_5',
						'type' 		=> 'select',
						'label'	=> __('Line 5 Text-Align', $this->id),
						'opts' => array(
							'center'	=> array('name' => __('Center', $this->id) ),
							'left'		=> array('name' => __('Left', $this->id) ),
							'right'		=> array('name' => __('Right', $this->id) ),
							'justify'	=> array('name' => __('Justify', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_text_decoration_5',
						'type' 		=> 'select',
						'label'	=> __('Line 5 Text-Decoration', $this->id),
						'opts' => array(
							'none'	=> array('name' => __('None', $this->id) ),
							'underline'	=> array('name' => __('Underline', $this->id) ),
							'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
							'overline'		=> array('name' => __('Overline', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_line_height_5',
						'type'	=> 'text',
						'label'	=> __('Line 5 Line-Height', $this->id)
					),
					array(
						'key'	=> 'bigtext_small_caps_5',
						'type'	=> 'check',
						'label'	=> __('Line 5 in Small-Caps<br/><br/>', $this->id)
					),
	/*
					array(
						'key'	=> 'bigtext_transparent_text_5',
						'type'	=> 'check',
						'label'	=> __('Line 5 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
					),
	*/
					array(
						'key'	=> 'bigtext_color_5',
						'type'		    => 'color',
						'default'		=> '',
						'label' 		=> __('Line 5 Text Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_5_stroke',
						'type'	=> 'color',
						'default'		=> '',
						'label' 		=> __('Line 5 Stroke<br/>(a 1px Outline)', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_5_shadow',
						'type'		    => 'color',
						'default'		=> '',
						'label'	=> __('Line 5<br/>Shadow Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_5_shadow_length',
						'type'	=> 'text',
						'label' 		=> __('Line 5 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
					)
				  )
				);

			$options[] = array(
				'key'	=> 'bigtext_6',
				'type'	=> 'multi',
				'title'		=> __('BigText Line 6', $this->id),
				'disabled' => $line_by_line_disabled,
				'opts'	=> array(
					array(
						'key'	=> 'bigtext_font_6',
						'type'	=> 'fonts',
						'label'	=> __('Line 6 Font', $this->id)
					),
					array(
						'key'	=> 'bigtext_text_align_6',
						'type' 		=> 'select',
						'label'	=> __('Line 6 Text-Align', $this->id),
						'opts' => array(
							'center'	=> array('name' => __('Center', $this->id) ),
							'left'		=> array('name' => __('Left', $this->id) ),
							'right'		=> array('name' => __('Right', $this->id) ),
							'justify'	=> array('name' => __('Justify', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_text_decoration_6',
						'type' 		=> 'select',
						'label'	=> __('Line 6 Text-Decoration', $this->id),
						'opts' => array(
							'none'	=> array('name' => __('None', $this->id) ),
							'underline'	=> array('name' => __('Underline', $this->id) ),
							'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
							'overline'		=> array('name' => __('Overline', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_line_height_6',
						'type'	=> 'text',
						'label'	=> __('Line 6 Line-Height', $this->id)
					),
					array(
						'key'	=> 'bigtext_small_caps_6',
						'type'	=> 'check',
						'label'	=> __('Line 6 in Small-Caps<br/><br/>', $this->id)
					),
	/*
					array(
						'key'	=> 'bigtext_transparent_text_6',
						'type'	=> 'check',
						'label'	=> __('Line 6 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
					),
	*/
					array(
						'key'	=> 'bigtext_color_6',
						'type'		    => 'color',
						'default'		=> '',
						'label' 		=> __('Line 6 Text Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_6_stroke',
						'type'	=> 'color',
						'default'		=> '',
						'label' 		=> __('Line 6 Stroke<br/>(a 1px Outline)', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_6_shadow',
						'type'		    => 'color',
						'default'		=> '',
						'label'	=> __('Line 6<br/>Shadow Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_6_shadow_length',
						'type'	=> 'text',
						'label' 		=> __('Line 6 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
					)
				  )
				);

			$options[] = array(
				'key'	=> 'bigtext_7',
				'type'	=> 'multi',
				'title'		=> __('BigText Line 7', $this->id),
				'disabled' => $line_by_line_disabled,
				'opts'	=> array(
					array(
						'key'	=> 'bigtext_font_7',
						'type'	=> 'fonts',
						'label'	=> __('Line 7 Font', $this->id)
					),
					array(
						'key'	=> 'bigtext_text_align_7',
						'type' 		=> 'select',
						'label'	=> __('Line 7 Text-Align', $this->id),
						'opts' => array(
							'center'	=> array('name' => __('Center', $this->id) ),
							'left'		=> array('name' => __('Left', $this->id) ),
							'right'		=> array('name' => __('Right', $this->id) ),
							'justify'	=> array('name' => __('Justify', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_text_decoration_7',
						'type' 		=> 'select',
						'label'	=> __('Line 7 Text-Decoration', $this->id),
						'opts' => array(
							'none'	=> array('name' => __('None', $this->id) ),
							'underline'	=> array('name' => __('Underline', $this->id) ),
							'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
							'overline'		=> array('name' => __('Overline', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_line_height_7',
						'type'	=> 'text',
						'label'	=> __('Line 7 Line-Height', $this->id)
					),
					array(
						'key'	=> 'bigtext_small_caps_7',
						'type'	=> 'check',
						'label'	=> __('Line 7 in Small-Caps<br/><br/>', $this->id)
					),
	/*
					array(
						'key'	=> 'bigtext_transparent_text_7',
						'type'	=> 'check',
						'label'	=> __('Line 7 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
					),
	*/
					array(
						'key'	=> 'bigtext_color_7',
						'type'		    => 'color',
						'default'		=> '',
						'label' 		=> __('Line 7 Text Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_7_stroke',
						'type'	=> 'color',
						'default'		=> '',
						'label' 		=> __('Line 7 Stroke<br/>(a 1px Outline)', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_7_shadow',
						'type'		    => 'color',
						'default'		=> '',
						'label'	=> __('Line 7<br/>Shadow Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_7_shadow_length',
						'type'	=> 'text',
						'label' 		=> __('Line 7 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
					)
				  )
				);

			$options[] = array(
				'key'	=> 'bigtext_8',
				'type'	=> 'multi',
				'title'		=> __('BigText Line 8', $this->id),
				'disabled' => $line_by_line_disabled,
				'opts'	=> array(
					array(
						'key'	=> 'bigtext_font_8',
						'type'	=> 'fonts',
						'label'	=> __('Line 8 Font', $this->id)
					),
					array(
						'key'	=> 'bigtext_text_align_8',
						'type' 		=> 'select',
						'label'	=> __('Line 8 Text-Align', $this->id),
						'opts' => array(
							'center'	=> array('name' => __('Center', $this->id) ),
							'left'		=> array('name' => __('Left', $this->id) ),
							'right'		=> array('name' => __('Right', $this->id) ),
							'justify'	=> array('name' => __('Justify', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_text_decoration_8',
						'type' 		=> 'select',
						'label'	=> __('Line 8 Text-Decoration', $this->id),
						'opts' => array(
							'none'	=> array('name' => __('None', $this->id) ),
							'underline'	=> array('name' => __('Underline', $this->id) ),
							'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
							'overline'		=> array('name' => __('Overline', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_line_height_8',
						'type'	=> 'text',
						'label'	=> __('Line 8 Line-Height', $this->id)
					),
					array(
						'key'	=> 'bigtext_small_caps_8',
						'type'	=> 'check',
						'label'	=> __('Line 8 in Small-Caps<br/><br/>', $this->id)
					),
	/*
					array(
						'key'	=> 'bigtext_transparent_text_8',
						'type'	=> 'check',
						'label'	=> __('Line 8 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
					),
	*/
					array(
						'key'	=> 'bigtext_color_8',
						'type'		    => 'color',
						'default'		=> '',
						'label' 		=> __('Line 8 Text Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_8_stroke',
						'type'	=> 'color',
						'default'		=> '',
						'label' 		=> __('Line 8 Stroke<br/>(a 1px Outline)', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_8_shadow',
						'type'		    => 'color',
						'default'		=> '',
						'label'	=> __('Line 8<br/>Shadow Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_8_shadow_length',
						'type'	=> 'text',
						'label' 		=> __('Line 8 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
					)
				  )
				);

			$options[] = array(
				'key'	=> 'bigtext_9',
				'type'	=> 'multi',
				'title'		=> __('BigText Line 9', $this->id),
				'disabled' => $line_by_line_disabled,
				'opts'	=> array(
					array(
						'key'	=> 'bigtext_font_9',
						'type'	=> 'fonts',
						'label'	=> __('Line 9 Font', $this->id)
					),
					array(
						'key'	=> 'bigtext_text_align_9',
						'type' 		=> 'select',
						'label'	=> __('Line 9 Text-Align', $this->id),
						'opts' => array(
							'center'	=> array('name' => __('Center', $this->id) ),
							'left'		=> array('name' => __('Left', $this->id) ),
							'right'		=> array('name' => __('Right', $this->id) ),
							'justify'	=> array('name' => __('Justify', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_text_decoration_9',
						'type' 		=> 'select',
						'label'	=> __('Line 9 Text-Decoration', $this->id),
						'opts' => array(
							'none'	=> array('name' => __('None', $this->id) ),
							'underline'	=> array('name' => __('Underline', $this->id) ),
							'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
							'overline'		=> array('name' => __('Overline', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_line_height_9',
						'type'	=> 'text',
						'label'	=> __('Line 9 Line-Height', $this->id)
					),
					array(
						'key'	=> 'bigtext_small_caps_9',
						'type'	=> 'check',
						'label'	=> __('Line 9 in Small-Caps<br/><br/>', $this->id)
					),
	/*
					array(
						'key'	=> 'bigtext_transparent_text_9',
						'type'	=> 'check',
						'label'	=> __('Line 9 Transparent Text. (Read warnings in Default Settings above.)<br/><br/>', $this->id)
					),
	*/
					array(
						'key'	=> 'bigtext_color_9',
						'type'		    => 'color',
						'default'		=> '',
						'label' 		=> __('Line 9 Text Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_9_stroke',
						'type'	=> 'color',
						'default'		=> '',
						'label' 		=> __('Line 9 Stroke<br/>(a 1px Outline)', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_9_shadow',
						'type'		    => 'color',
						'default'		=> '',
						'label'		=> __('Line 9<br/>Shadow Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_9_shadow_length',
						'type'	=> 'text',
						'label' 		=> __('Line 9 Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
					)
				  )
				);
		} // end of $line_by_line_disabled conditional



		$tab_settings = array(
			'id'		=> 'bigtextdms_options',
			'name'		=> 'BigTextDMS',
			'icon'		=> $this->icon,
			'clone_id'	=> $settings['clone_id'],
			'active'	=> $settings['active']
		);

		register_metatab($tab_settings, $options, $this->class_name);

	}


	function section_template(){

		if(function_exists('pl_has_editor') && pl_has_editor()){
			$clone_id = $this->get_the_id();
		} else {
	        global $pagelines_ID;
	        $oset = array('post_id' => $pagelines_ID);
			$clone_id = $this->oset['clone_id'];
		}


		if(!$this->opt('bigtext_text_0')){
			echo setup_section_notify($this, __('Get started with BigTextDMS by entering a value for "BigText Line 0 Text".'));
			return;
		}

		// widths
		$width = $this->opt('bigtext_width') ? $this->opt('bigtext_width') : '100%';
			$width = esc_html($width);
		$maxwidth = $this->opt('bigtext_max_width') ? $this->opt('bigtext_max_width') : '100%';
			$maxwidth = esc_html($maxwidth);


		//background color
		$colorbg = $this->opt('bigtext_color_bg') ? pl_hashify($this->opt('bigtext_color_bg')) : '';

		//background image
		$bgimage = $this->opt('bigtext_image_bg');
			if(!empty($bgimage)) {
				$bgimagesize = $this->opt('bigtext_image_bg_size') ? $this->opt('bigtext_image_bg_size') : 'auto';
				$bgimageposition = $this->opt('bigtext_image_bg_position') ? $this->opt('bigtext_image_bg_position') : 'center center';
				$bgimagecode = "background: url(\"$bgimage\") no-repeat; background-position: $bgimageposition; -webkit-background-size: $bgimagesize; -moz-background-size: $bgimagesize; background-size: $bgimagesize;";
			}


		// text
		// cannot do esc_html() to protect input on all these because then HTML will not work -- so do not insert your own malicious scripts ;-)
		$text0 = $this->opt('bigtext_text_0');
			$text0 = do_shortcode($text0);
		$text1 = $this->opt('bigtext_text_1');
			$text1 = do_shortcode($text1);
		$text2 = $this->opt('bigtext_text_2');
			$text2 = do_shortcode($text2);
		$text3 = $this->opt('bigtext_text_3');
			$text3 = do_shortcode($text3);
		$text4 = $this->opt('bigtext_text_4');
			$text4 = do_shortcode($text4);
		$text5 = $this->opt('bigtext_text_5');
			$text5 = do_shortcode($text5);
		$text6 = $this->opt('bigtext_text_6');
			$text6 = do_shortcode($text6);
		$text7 = $this->opt('bigtext_text_7');
			$text7 = do_shortcode($text7);
		$text8 = $this->opt('bigtext_text_8');
			$text8 = do_shortcode($text8);
		$text9 = $this->opt('bigtext_text_9');
			$text9 = do_shortcode($text9);


		//same code applies to all of them
		$smallcapscode = "font-variant:small-caps;";
		//
		$smallcaps = $this->opt('bigtext_small_caps');
		$smallcaps0 = $this->opt('bigtext_small_caps_0');
		$smallcaps1 = $this->opt('bigtext_small_caps_1');
		$smallcaps2 = $this->opt('bigtext_small_caps_2');
		$smallcaps3 = $this->opt('bigtext_small_caps_3');
		$smallcaps4 = $this->opt('bigtext_small_caps_4');
		$smallcaps5 = $this->opt('bigtext_small_caps_5');
		$smallcaps6 = $this->opt('bigtext_small_caps_6');
		$smallcaps7 = $this->opt('bigtext_small_caps_7');
		$smallcaps8 = $this->opt('bigtext_small_caps_8');
		$smallcaps9 = $this->opt('bigtext_small_caps_9');

		//same code applies to all of them
		$transparenttextcode = "-webkit-background-clip:text; -webkit-text-fill-color:transparent;";
		// transparent text
		$transparenttext = $this->opt('bigtext_transparent_text');
		// line-by-line
		// DOES NOT WORK LINE-BY-LINE UNLESS BACKGROUND IS LINE-BY-LINE
/*
		$transparenttext0 = $this->opt('bigtext_transparent_text_0');
		$transparenttext1 = $this->opt('bigtext_transparent_text_1');
		$transparenttext2 = $this->opt('bigtext_transparent_text_2');
		$transparenttext3 = $this->opt('bigtext_transparent_text_3');
		$transparenttext4 = $this->opt('bigtext_transparent_text_4');
		$transparenttext5 = $this->opt('bigtext_transparent_text_5');
		$transparenttext6 = $this->opt('bigtext_transparent_text_6');
		$transparenttext7 = $this->opt('bigtext_transparent_text_7');
		$transparenttext8 = $this->opt('bigtext_transparent_text_8');
		$transparenttext9 = $this->opt('bigtext_transparent_text_9');
*/

		//text color
		$color = $this->opt('bigtext_color') ? pl_hashify($this->opt('bigtext_color')) : '';
		// line-by-line color
		$color0 = $this->opt('bigtext_color_0') ? pl_hashify($this->opt('bigtext_color_0')) : '';
		$color1 = $this->opt('bigtext_color_1') ? pl_hashify($this->opt('bigtext_color_1')) : '';
		$color2 = $this->opt('bigtext_color_2') ? pl_hashify($this->opt('bigtext_color_2')) : '';
		$color3 = $this->opt('bigtext_color_3') ? pl_hashify($this->opt('bigtext_color_3')) : '';
		$color4 = $this->opt('bigtext_color_4') ? pl_hashify($this->opt('bigtext_color_4')) : '';
		$color5 = $this->opt('bigtext_color_5') ? pl_hashify($this->opt('bigtext_color_5')) : '';
		$color6 = $this->opt('bigtext_color_6') ? pl_hashify($this->opt('bigtext_color_6')) : '';
		$color7 = $this->opt('bigtext_color_7') ? pl_hashify($this->opt('bigtext_color_7')) : '';
		$color8 = $this->opt('bigtext_color_8') ? pl_hashify($this->opt('bigtext_color_8')) : '';
		$color9 = $this->opt('bigtext_color_9') ? pl_hashify($this->opt('bigtext_color_9')) : '';

		//stroke
		$colorstroke = $this->opt('bigtext_color_stroke') ? pl_hashify($this->opt('bigtext_color_stroke')) : '';
			if(!empty($colorstroke)) {
				$stroketextcode = "text-shadow: -1px -1px 0 $colorstroke, 1px -1px 0 $colorstroke, -1px 1px 0 $colorstroke, 1px 1px 0 $colorstroke;";
			}
		// line-by-line stroke
		$colorstroke0 = $this->opt('bigtext_color_0_stroke') ? pl_hashify($this->opt('bigtext_color_0_stroke')) : '';
			if(!empty($colorstroke0)) {
				$stroketextcode0 = "text-shadow: -1px -1px 0 $colorstroke0, 1px -1px 0 $colorstroke0, -1px 1px 0 $colorstroke0, 1px 1px 0 $colorstroke0;";
			}
		$colorstroke1 = $this->opt('bigtext_color_1_stroke') ? pl_hashify($this->opt('bigtext_color_1_stroke')) : '';
			if(!empty($colorstroke1)) {
				$stroketextcode1 = "text-shadow: -1px -1px 0 $colorstroke1, 1px -1px 0 $colorstroke1, -1px 1px 0 $colorstroke1, 1px 1px 0 $colorstroke1;";
			}
		$colorstroke2 = $this->opt('bigtext_color_2_stroke') ? pl_hashify($this->opt('bigtext_color_2_stroke')) : '';
			if(!empty($colorstroke2)) {
				$stroketextcode2 = "text-shadow: -1px -1px 0 $colorstroke2, 1px -1px 0 $colorstroke2, -1px 1px 0 $colorstroke2, 1px 1px 0 $colorstroke2;";
			}
		$colorstroke3 = $this->opt('bigtext_color_3_stroke') ? pl_hashify($this->opt('bigtext_color_3_stroke')) : '';
			if(!empty($colorstroke3)) {
				$stroketextcode3 = "text-shadow: -1px -1px 0 $colorstroke3, 1px -1px 0 $colorstroke3, -1px 1px 0 $colorstroke3, 1px 1px 0 $colorstroke3;";
			}
		$colorstroke4 = $this->opt('bigtext_color_4_stroke') ? pl_hashify($this->opt('bigtext_color_4_stroke')) : '';
			if(!empty($colorstroke4)) {
				$stroketextcode4 = "text-shadow: -1px -1px 0 $colorstroke4, 1px -1px 0 $colorstroke4, -1px 1px 0 $colorstroke4, 1px 1px 0 $colorstroke4;";
			}
		$colorstroke5 = $this->opt('bigtext_color_5_stroke') ? pl_hashify($this->opt('bigtext_color_5_stroke')) : '';
			if(!empty($colorstroke5)) {
				$stroketextcode5 = "text-shadow: -1px -1px 0 $colorstroke5, 1px -1px 0 $colorstroke5, -1px 1px 0 $colorstroke5, 1px 1px 0 $colorstroke5;";
			}
		$colorstroke6 = $this->opt('bigtext_color_6_stroke') ? pl_hashify($this->opt('bigtext_color_6_stroke')) : '';
			if(!empty($colorstroke6)) {
				$stroketextcode6 = "text-shadow: -1px -1px 0 $colorstroke6, 1px -1px 0 $colorstroke6, -1px 1px 0 $colorstroke6, 1px 1px 0 $colorstroke6;";
			}
		$colorstroke7 = $this->opt('bigtext_color_7_stroke') ? pl_hashify($this->opt('bigtext_color_7_stroke')) : '';
			if(!empty($colorstroke7)) {
				$stroketextcode7 = "text-shadow: -1px -1px 0 $colorstroke7, 1px -1px 0 $colorstroke7, -1px 1px 0 $colorstroke7, 1px 1px 0 $colorstroke7;";
			}
		$colorstroke8 = $this->opt('bigtext_color_8_stroke') ? pl_hashify($this->opt('bigtext_color_8_stroke')) : '';
			if(!empty($colorstroke8)) {
				$stroketextcode8 = "text-shadow: -1px -1px 0 $colorstroke8, 1px -1px 0 $colorstroke8, -1px 1px 0 $colorstroke8, 1px 1px 0 $colorstroke8;";
			}
		$colorstroke9 = $this->opt('bigtext_color_9_stroke') ? pl_hashify($this->opt('bigtext_color_9_stroke')) : '';
			if(!empty($colorstroke9)) {
				$stroketextcode9 = "text-shadow: -1px -1px 0 $colorstroke9, 1px -1px 0 $colorstroke9, -1px 1px 0 $colorstroke9, 1px 1px 0 $colorstroke9;";
			}

		//shadow color
		$colorshadow = $this->opt('bigtext_color_shadow') ? pl_hashify($this->opt('bigtext_color_shadow')) : '';
			if(!empty($colorshadow)) {
				$shadowlength = $this->opt('bigtext_color_shadow_length') ? $this->opt('bigtext_color_shadow_length') : '2px';
				$shadowlength = esc_html($shadowlength);
				$shadowcode = "text-shadow: $shadowlength $shadowlength $colorshadow;";
			}
		// line-by-line shadow
		$colorshadow0 = $this->opt('bigtext_color_0_shadow') ? pl_hashify($this->opt('bigtext_color_0_shadow')) : '';
			if(!empty($colorshadow0)) {
				$shadowlength0 = $this->opt('bigtext_color_0_shadow_length') ? $this->opt('bigtext_color_0_shadow-length') : '2px';
				$shadowlength0 = esc_html($shadowlength0);
				$shadowcode0 = "text-shadow: $shadowlength0 $shadowlength0 $colorshadow0;";
			}
		$colorshadow1 = $this->opt('bigtext_color_1_shadow') ? pl_hashify($this->opt('bigtext_color_1_shadow')) : '';
			if(!empty($colorshadow1)) {
				$shadowlength1 = $this->opt('bigtext_color_1_shadow_length') ? $this->opt('bigtext_color_1_shadow_length') : '2px';
				$shadowlength1 = esc_html($shadowlength1);
				$shadowcode1 = "text-shadow: $shadowlength1 $shadowlength1 $colorshadow1;";
			}
		$colorshadow2 = $this->opt('bigtext_color_2_shadow') ? pl_hashify($this->opt('bigtext_color_2_shadow')) : '';
			if(!empty($colorshadow2)) {
				$shadowlength2 = $this->opt('bigtext_color_2_shadow_length') ? $this->opt('bigtext_color_2_shadow_length') : '2px';
				$shadowlength2 = esc_html($shadowlength2);
				$shadowcode2 = "text-shadow: $shadowlength2 $shadowlength2 $colorshadow2;";
			}
		$colorshadow3 = $this->opt('bigtext_color_3_shadow') ? pl_hashify($this->opt('bigtext_color_3_shadow')) : '';
			if(!empty($colorshadow3)) {
				$shadowlength3 = $this->opt('bigtext_color_3_shadow_length') ? $this->opt('bigtext_color_3_shadow_length') : '2px';
				$shadowlength3 = esc_html($shadowlength3);
				$shadowcode3 = "text-shadow: $shadowlength3 $shadowlength3 $colorshadow3;";
			}
		$colorshadow4 = $this->opt('bigtext_color_4_shadow') ? pl_hashify($this->opt('bigtext_color_4_shadow')) : '';
			if(!empty($colorshadow4)) {
				$shadowlength4 = $this->opt('bigtext_color_4_shadow_length') ? $this->opt('bigtext_color_4_shadow_length') : '2px';
				$shadowlength4 = esc_html($shadowlength4);
				$shadowcode4 = "text-shadow: $shadowlength4 $shadowlength4 $colorshadow4;";
			}
		$colorshadow5 = $this->opt('bigtext_color_5_shadow') ? pl_hashify($this->opt('bigtext_color_5_shadow')) : '';
			if(!empty($colorshadow5)) {
				$shadowlength5 = $this->opt('bigtext_color_5_shadow_length') ? $this->opt('bigtext_color_5_shadow_length') : '2px';
				$shadowlength5 = esc_html($shadowlength5);
				$shadowcode5 = "text-shadow: $shadowlength5 $shadowlength5 $colorshadow5;";
			}
		$colorshadow6 = $this->opt('bigtext_color_6_shadow') ? pl_hashify($this->opt('bigtext_color_6_shadow')) : '';
			if(!empty($colorshadow6)) {
				$shadowlength6 = $this->opt('bigtext_color_6_shadow_length') ? $this->opt('bigtext_color_6_shadow_length') : '2px';
				$shadowlength6 = esc_html($shadowlength6);
				$shadowcode6 = "text-shadow: $shadowlength6 $shadowlength6 $colorshadow6;";
			}
		$colorshadow7 = $this->opt('bigtext_color_7_shadow') ? pl_hashify($this->opt('bigtext_color_7_shadow')) : '';
			if(!empty($colorshadow7)) {
				$shadowlength7 = $this->opt('bigtext_color_7_shadow_length') ? $this->opt('bigtext_color_7_shadow_length') : '2px';
				$shadowlength7 = esc_html($shadowlength7);
				$shadowcode7 = "text-shadow: $shadowlength7 $shadowlength7 $colorshadow7;";
			}
		$colorshadow8 = $this->opt('bigtext_color_8_shadow') ? pl_hashify($this->opt('bigtext_color_8_shadow')) : '';
			if(!empty($colorshadow8)) {
				$shadowlength8 = $this->opt('bigtext_color_8_shadow_length') ? $this->opt('bigtext_color_8_shadow_length') : '2px';
				$shadowlength8 = esc_html($shadowlength8);
				$shadowcode8 = "text-shadow: $shadowlength8 $shadowlength8 $colorshadow8;";
			}
		$colorshadow9 = $this->opt('bigtext_color_9_shadow') ? pl_hashify($this->opt('bigtext_color_9_shadow')) : '';
			if(!empty($colorshadow9)) {
				$shadowlength9 = $this->opt('bigtext_color_9_shadow_length') ? $this->opt('bigtext_color_9_shadow_length') : '2px';
				$shadowlength9 = esc_html($shadowlength9);
				$shadowcode9 = "text-shadow: $shadowlength9 $shadowlength9 $colorshadow9;";
			}

		// text-align
		$textalign = $this->opt('bigtext_text_align') ? $this->opt('bigtext_text_align') : 'center' ;
		// line-by-line text-align
		$textalign0 = $this->opt('bigtext_text_align_0');
		$textalign1 = $this->opt('bigtext_text_align_1');
		$textalign2 = $this->opt('bigtext_text_align_2');
		$textalign3 = $this->opt('bigtext_text_align_3');
		$textalign4 = $this->opt('bigtext_text_align_4');
		$textalign5 = $this->opt('bigtext_text_align_5');
		$textalign6 = $this->opt('bigtext_text_align_6');
		$textalign7 = $this->opt('bigtext_text_align_7');
		$textalign8 = $this->opt('bigtext_text_align_8');
		$textalign9 = $this->opt('bigtext_text_align_9');

		// text-decoration
		$textdecoration = $this->opt('bigtext_text_decoration') ? $this->opt('bigtext_text_decoration') : 'none' ;
		// line-by-line text-decoration
		$textdecoration0 = $this->opt('bigtext_text_decoration_0') ? $this->opt('bigtext_text_decoration_0') : 'none' ;
		$textdecoration1 = $this->opt('bigtext_text_decoration_1') ? $this->opt('bigtext_text_decoration_1') : 'none' ;
		$textdecoration2 = $this->opt('bigtext_text_decoration_2') ? $this->opt('bigtext_text_decoration_2') : 'none' ;
		$textdecoration3 = $this->opt('bigtext_text_decoration_3') ? $this->opt('bigtext_text_decoration_3') : 'none' ;
		$textdecoration4 = $this->opt('bigtext_text_decoration_4') ? $this->opt('bigtext_text_decoration_4') : 'none' ;
		$textdecoration5 = $this->opt('bigtext_text_decoration_5') ? $this->opt('bigtext_text_decoration_5') : 'none' ;
		$textdecoration6 = $this->opt('bigtext_text_decoration_6') ? $this->opt('bigtext_text_decoration_6') : 'none' ;
		$textdecoration7 = $this->opt('bigtext_text_decoration_7') ? $this->opt('bigtext_text_decoration_7') : 'none' ;
		$textdecoration8 = $this->opt('bigtext_text_decoration_8') ? $this->opt('bigtext_text_decoration_8') : 'none' ;
		$textdecoration9 = $this->opt('bigtext_text_decoration_9') ? $this->opt('bigtext_text_decoration_9') : 'none' ;

		// line-height
		$lineheight = $this->opt('bigtext_line_height') ? $this->opt('bigtext_line_height') : '1';
			$lineheight = esc_html($lineheight);
		// line-by-line line-height
		$lineheight0 = $this->opt('bigtext_line_height_0');
			$lineheight0 = esc_html($lineheight0);
		$lineheight1 = $this->opt('bigtext_line_height_1');
			$lineheight1 = esc_html($lineheight1);
		$lineheight2 = $this->opt('bigtext_line_height_2');
			$lineheight2 = esc_html($lineheight2);
		$lineheight3 = $this->opt('bigtext_line_height_3');
			$lineheight3 = esc_html($lineheight3);
		$lineheight4 = $this->opt('bigtext_line_height_4');
			$lineheight4 = esc_html($lineheight4);
		$lineheight5 = $this->opt('bigtext_line_height_5');
			$lineheight5 = esc_html($lineheight5);
		$lineheight6 = $this->opt('bigtext_line_height_6');
			$lineheight6 = esc_html($lineheight6);
		$lineheight7 = $this->opt('bigtext_line_height_7');
			$lineheight7 = esc_html($lineheight7);
		$lineheight8 = $this->opt('bigtext_line_height_8');
			$lineheight8 = esc_html($lineheight8);
		$lineheight9 = $this->opt('bigtext_line_height_9');
			$lineheight9 = esc_html($lineheight9);

		// exempt
		$exempt0 = $this->opt('bigtext_exempt_0');
		$exempt1 = $this->opt('bigtext_exempt_1');
		$exempt2 = $this->opt('bigtext_exempt_2');
		$exempt3 = $this->opt('bigtext_exempt_3');
		$exempt4 = $this->opt('bigtext_exempt_4');
		$exempt5 = $this->opt('bigtext_exempt_5');
		$exempt6 = $this->opt('bigtext_exempt_6');
		$exempt7 = $this->opt('bigtext_exempt_7');
		$exempt8 = $this->opt('bigtext_exempt_8');
		$exempt9 = $this->opt('bigtext_exempt_9');




		//start BigText Area
		echo "<div id='bigtextdms-$clone_id' class='bigtextdms' style='width: $width; max-width: $maxwidth; line-height: $lineheight; text-align: $textalign; text-decoration:$textdecoration;";
			if(!empty($color)){ echo " color: $color;"; }
			if(!empty($colorbg)){ echo " background-color: $colorbg;"; }
			if(!empty($bgimage)){ echo " $bgimagecode"; }
			if(!empty($colorstroke)){ " $stroketextcode"; }
			if(!empty($colorshadow)){ " $shadowcode"; }
			if(!empty($smallcaps)){ echo " $smallcapscode"; }
			if(!empty($transparenttext)){ echo " $transparenttextcode"; }
		echo "'>";

		//text0
			echo "<div class='bigtextdms btline0";
				if(empty($exempt0)){ echo "'"; } else { echo " bigtextdms-exempt'"; }
				echo " style='text-decoration:$textdecoration0;"; // just so style tag isn't empty
				if(!empty($lineheight0)){ echo " line-height: $lineheight0;"; }
				if(!empty($textalign0)){ echo " text-align: $textalign0;"; }
				if(!empty($color0)){ echo " color: $color0;"; }
				if(!empty($colorstroke0)){ echo " $stroketextcode0"; }
				if(!empty($colorshadow0)){ echo " $shadowcode0"; }
				if(!empty($smallcaps0)){ echo " $smallcapscode"; }
			echo "'>$text0</div>";
		//text1
		if(!empty($text1)) {
			echo "<div class='bigtextdms btline1";
				if(empty($exempt1)){ echo "'"; } else { echo " bigtextdms-exempt'"; }
				echo " style='text-decoration:$textdecoration1;";
				if(!empty($lineheight1)){ echo " line-height: $lineheight1;"; }
				if(!empty($textalign1)){ echo " text-align: $textalign1;"; }
				if(!empty($color1)){ echo " color: $color1;"; }
				if(!empty($colorstroke1)){ echo " $stroketextcode1"; }
				if(!empty($colorshadow1)){ echo " $shadowcode1"; }
				if(!empty($smallcaps1)){ echo " $smallcapscode"; }
			echo "'>$text1</div>";
		}
		//text2
		if(!empty($text2)) {
			echo "<div class='bigtextdms btline2";
				if(empty($exempt2)){ echo "'"; } else { echo " bigtextdms-exempt'"; }
				echo " style='text-decoration:$textdecoration2;";
				if(!empty($lineheight2)){ echo " line-height: $lineheight2;"; }
				if(!empty($textalign2)){ echo " text-align: $textalign2;"; }
				if(!empty($color2)){ echo " color: $color2;"; }
				if(!empty($colorstroke2)){ echo " $stroketextcode2"; }
				if(!empty($colorshadow2)){ echo " $shadowcode2"; }
				if(!empty($smallcaps2)){ echo " $smallcapscode"; }
			echo "'>$text2</div>";
		}
		//text3
		if(!empty($text3)) {
			echo "<div class='bigtextdms btline3";
				if(empty($exempt3)){ echo "'"; } else { echo " bigtextdms-exempt'"; }
				echo " style='text-decoration:$textdecoration3;";
				if(!empty($lineheight3)){ echo " line-height: $lineheight3;"; }
				if(!empty($textalign3)){ echo " text-align: $textalign3;"; }
				if(!empty($color3)){ echo " color: $color3;"; }
				if(!empty($colorstroke3)){ echo " $stroketextcode3"; }
				if(!empty($colorshadow3)){ echo " $shadowcode3"; }
				if(!empty($smallcaps3)){ echo " $smallcapscode"; }
			echo "'>$text3</div>";
		}
		//text4
		if(!empty($text4)) {
			echo "<div class='bigtextdms btline4";
				if(empty($exempt4)){ echo "'"; } else { echo " bigtextdms-exempt'"; }
				echo " style='text-decoration:$textdecoration4;";
				if(!empty($lineheight4)){ echo " line-height: $lineheight4;"; }
				if(!empty($textalign4)){ echo " text-align: $textalign4;"; }
				if(!empty($color4)){ echo " color: $color4;"; }
				if(!empty($colorstroke4)){ echo " $stroketextcode4"; }
				if(!empty($colorshadow4)){ echo " $shadowcode4"; }
				if(!empty($smallcaps4)){ echo " $smallcapscode"; }
			echo "'>$text4</div>";
		}
		//text5
		if(!empty($text5)) {
			echo "<div class='bigtextdms btline5";
				if(empty($exempt5)){ echo "'"; } else { echo " bigtextdms-exempt'"; }
				echo " style='text-decoration:$textdecoration5;";
				if(!empty($lineheight5)){ echo " line-height: $lineheight5;"; }
				if(!empty($textalign5)){ echo " text-align: $textalign5;"; }
				if(!empty($color5)){ echo " color: $color5;"; }
				if(!empty($colorstroke5)){ echo " $stroketextcode5"; }
				if(!empty($colorshadow5)){ echo " $shadowcode5"; }
				if(!empty($smallcaps5)){ echo " $smallcapscode"; }
			echo "'>$text5</div>";
		}
		//text6
		if(!empty($text6)) {
			echo "<div class='bigtextdms btline6";
				if(empty($exempt6)){ echo "'"; } else { echo " bigtextdms-exempt'"; }
				echo " style='text-decoration:$textdecoration6;";
				if(!empty($lineheight6)){ echo " line-height: $lineheight6;"; }
				if(!empty($textalign6)){ echo " text-align: $textalign6;"; }
				if(!empty($color6)){ echo " color: $color6;"; }
				if(!empty($colorstroke6)){ echo " $stroketextcode6"; }
				if(!empty($colorshadow6)){ echo " $shadowcode6"; }
				if(!empty($smallcaps6)){ echo " $smallcapscode"; }
			echo "'>$text6</div>";
		}
		//text7
		if(!empty($text7)) {
			echo "<div class='bigtextdms btline7";
				if(empty($exempt7)){ echo "'"; } else { echo " bigtextdms-exempt'"; }
				echo " style='text-decoration:$textdecoration7;";
				if(!empty($lineheight7)){ echo " line-height: $lineheight7;"; }
				if(!empty($textalign7)){ echo " text-align: $textalign7;"; }
				if(!empty($color7)){ echo " color: $color7;"; }
				if(!empty($colorstroke7)){ echo " $stroketextcode7"; }
				if(!empty($colorshadow7)){ echo " $shadowcode7"; }
				if(!empty($smallcaps7)){ echo " $smallcapscode"; }
			echo "'>$text7</div>";
		}
		//text8
		if(!empty($text8)) {
			echo "<div class='bigtextdms btline8";
				if(empty($exempt8)){ echo "'"; } else { echo " bigtextdms-exempt'"; }
				echo " style='text-decoration:$textdecoration8;";
				if(!empty($lineheight8)){ echo " line-height: $lineheight8;"; }
				if(!empty($textalign8)){ echo " text-align: $textalign8;"; }
				if(!empty($color8)){ echo " color: $color8;"; }
				if(!empty($colorstroke8)){ echo " $stroketextcode8"; }
				if(!empty($colorshadow8)){ echo " $shadowcode8"; }
				if(!empty($smallcaps8)){ echo " $smallcapscode"; }
			echo "'>$text8</div>";
		}
		//text9
		if(!empty($text9)) {
			echo "<div class='bigtextdms btline9";
				if(empty($exempt9)){ echo "'"; } else { echo " bigtextdms-exempt'"; }
				echo " style='text-decoration:$textdecoration9;";
				if(!empty($lineheight9)){ echo " line-height: $lineheight9;"; }
				if(!empty($textalign9)){ echo " text-align: $textalign9;"; }
				if(!empty($color9)){ echo " color: $color9;"; }
				if(!empty($colorstroke9)){ echo " $stroketextcode9"; }
				if(!empty($colorshadow9)){ echo " $shadowcode9"; }
				if(!empty($smallcaps9)){ echo " $smallcapscode"; }
			echo "'>$text9</div>";
		}
		//end BigText Area
		echo "</div>";


	} // end of function



} // end of section