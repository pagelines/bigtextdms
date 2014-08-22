<?php
/*
Section: BigTextDMS
Author: TourKick (Clifford P)
Author URI: http://tourkick.com/?utm_source=pagelines&utm_medium=section&utm_content=authoruri&utm_campaign=bigtextdms_section
Plugin URI: http://www.pagelinestheme.com/bigtextdms-section?utm_source=pagelines&utm_medium=section&utm_content=pluginuri&utm_campaign=bigtext_section
Description: A <a href="https://github.com/zachleat/BigText" target="_blank">BigText</a> section that resizes text to fit one or more words on a line that fits the container. Responsive too, which means it scales with different size browsers.
Demo: http://www.pagelinestheme.com/bigtextdms-section?utm_source=pagelines&utm_medium=section&utm_content=demolink&utm_campaign=bigtextdms_section
Class Name: BigTextDMS
Cloning: true
Filter: component, dual-width
*/

class BigTextDMS extends PageLinesSection {
// Ideas:
// add 3D settings, like at http://www.zachleat.com/bigtext/demo/
// add padding shorthand (can come in handy for bottom, especially with lower-case text)


	function section_persistent() {

	// This section only works with DMS v1.1 or later
		$themeversionnumber = get_theme_mod( 'pagelines_version' ); // Works in both DMS and Framework
		$dmsnometapanelversion = '1.1'; // The first DMS Version that has the accordion option type

		if( function_exists('pl_has_editor')
			&& pl_has_editor()
			&& $themeversionnumber >= $dmsnometapanelversion) {	} else { return; }
	}

	function section_scripts(){
		// BigText version 0.1.2, MIT License, from https://github.com/zachleat/BigText#releases
		wp_enqueue_script('bigtextdms', $this->base_url.'/bigtext.js', array('jquery'), '0.1.2', true);
	}


	function section_head(){
		$clone_id = $this->get_the_id();

		// pull in the options, since they're from another function
		global $pagelines_ID;
        $oset = array('post_id' => $pagelines_ID);


		// commented out since the .js sets it to 528 already //$maxfontsize = $this->opt('bigtext_maxfontsize') ? $this->opt('bigtext_maxfontsize') : '528';
		$maxfontsize = $this->opt('bigtext_maxfontsize');
		$minfontsize = $this->opt('bigtext_minfontsize');

		// allow only numbers
		// script requires numbers only so do not add 'px'
		$maxfontsize = preg_replace("/[^0-9]/","",$maxfontsize);
		$minfontsize = preg_replace("/[^0-9]/","",$minfontsize);

		if($maxfontsize
		   && $minfontsize >= $maxfontsize){
			$minfontsize = '';
		}
		?>

		<script type="text/javascript">
			jQuery(document).ready(function(){

				jQuery("#bigtextdms-<?php echo $clone_id ?>").bigtext({
					<?php

					if(!$maxfontsize && !$minfontsize) {
						echo "";
					} elseif($maxfontsize && $minfontsize) {
						echo "maxfontsize: $maxfontsize, minfontsize: $minfontsize";
					} elseif($maxfontsize) {
						echo "maxfontsize: $maxfontsize";
					} else{
						echo "minfontsize: $minfontsize";
					}
					?>
				});

			});
		</script>

		<?php
		echo load_custom_font( $this->opt('bigtext_font'), " #bigtextdms-$clone_id" );


		// The Lines
		$bigtextdms_array = $this->opt('bigtextdms_array');

		if( !$bigtextdms_array || $bigtextdms_array == 'false' || !is_array($bigtextdms_array) ){
			$bigtextdms_array = array( array(), array(), array() );
		}

		if( is_array($bigtextdms_array) ) {

			$count = 1;
				// line-by-line
				foreach( $bigtextdms_array as $bigtext ){

					$count0 = $count - 1; //BigText script starts at Line 0

					$text0 = pl_array_get( 'bigtext_text0', $bigtext);
						do_shortcode($text0);
						// cannot do esc_html() to protect input on all these because then HTML will not work -- so do not insert your own malicious scripts ;-)

					if( $text0 ){
						$font0 = pl_array_get( 'bigtext_font0', $bigtext );

						if($font0){
							echo load_custom_font( $font0, "#bigtextdms-$clone_id .btline$count0" );
						}
					}

					$count++;

				}//end of foreach
		} //end of is_array

	}



	function section_opts(){

		$options = array();

		$options[] = array(
			'key'		=> 'bigtext_config',
			'type'		=> 'multi',
			'col'		=> 1, //left side
			'title'		=> __('BigTextDMS Container Settings', $this->id),
			'help'		=> '<strong><a href="http://www.pagelinestheme.com/bigtextdms-section?utm_source=pagelines&utm_medium=section&utm_content=help&utm_campaign=bigtextdms_section" target="_blank">BigTextDMS Helpful Tips</a></strong>',
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
					'label'	=> __('Background Image Size. (Default = <em>None / Auto</em>)<br/><a href="https://developer.mozilla.org/en-US/docs/CSS/background-size" target="_blank">CSS background-size</a>', $this->id),
					'opts' => array(
						'contain'	=> array('name' => 'Contain' ),
						'cover'		=> array('name' => 'Cover' )
						)
				),
				array(
					'key'	=> 'bigtext_image_bg_position',
					'type' 	=> 'select',
					'label'	=> __('Background Image Position. (Default = <em>center center</em>)<br/><a href="https://developer.mozilla.org/en-US/docs/CSS/background-position" target="_blank">CSS background-position</a>, <a href="http://www.w3schools.com/cssref/playit.asp?filename=playcss_background-position" target="_blank">Try It Out</a>', $this->id),
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
					'label'	=> __('Width of BigText area (Default = <em>100%</em>)<br/>Any units: %, px, em, etc. <a href="https://developer.mozilla.org/en-US/docs/CSS/width" target="_blank">CSS width</a>', $this->id)
				),
				array(
					'key'	=> 'bigtext_max_width',
					'type'	=> 'text',
					'label'	=> __('Max-Width of BigText area (Default = <em>100%</em>)<br/>Any units: %, px, em, etc. <a href="https://developer.mozilla.org/en-US/docs/CSS/max-width" target="_blank">CSS max-width</a>', $this->id)
				),
/* script wasn't working with fontsize
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
*/
			)
		);

		$options[] = array(
			'key'	=> 'bigtext_defaults',
			'type'	=> 'multi',
			'col'		=> 1, //left side
			'title'		=> __('BigTextDMS Default Settings to set all line options (can override per line)', $this->id),
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
/* does not allow line-specific overriding
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
*/
				array(
					'key'	=> 'bigtext_line_height',
					'type'	=> 'text',
					'label'	=> __('BigText Line-Height (e.g. 0.9).<br/>&nbsp;&nbsp;&nbsp;Default = <em>1</em><br/><a href="https://developer.mozilla.org/en-US/docs/CSS/line-height" target="_blank">CSS line-height</a>', $this->id)
				),
				array(
					'key'	=> 'bigtext_small_caps',
					'type'	=> 'select',
					'label'	=> __('Display in small-caps?', $this->id),
					'opts'	=> array(
						'1'	=> array('name' => __('Small-Caps All Lines', $this->id) )
					)
				),
				array(
					'key'	=> 'bigtext_transparent_text',
					'type'	=> 'select',
					'label'	=> __('Change text color to transparent<br/>Warning: Only works on Webkit browsers. Ignored on other browsers.<br/>Try setting text color to white or black as a backup for non-Webkit.<br/>Does not work as expected with Stroke/Outline or Shadow Colors.', $this->id),
					'opts'	=> array(
						'1'	=> array('name' => __('Make All Text Transparent', $this->id) )
					)
				),
				array(
					'key'	=> 'bigtext_color',
					'type'	=> 'color',
					'default'	=> '',
					'label' => __('Default Text Color', $this->id)
				),
				array(
					'key'	=> 'bigtext_color_stroke',
					'type'	=> 'color',
					'default'	=> '',
					'label' => __('1px Stroke/Outline Color', $this->id)
				),
/*
				array(
					'key'	=> 'bigtext_color_stroke_width',
					'type'	=> 'text',
					'label' => __('Stroke/Outline Width (default: <em>1px</em> if Stroke Color is set)', $this->id)
				),
*/
				array(
					'key'	=> 'bigtext_color_shadow',
					'type'	=> 'color',
					'default'	=> '',
					'label'	=> __('Default<br/>Shadow Color', $this->id)
				),
				array(
					'key'	=> 'bigtext_color_shadow_length',
					'type'	=> 'text',
					'label' => __('Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
				)
			)
		);







		$options[] = array(
			'key'		=> 'bigtextdms_array',
	    	'type'		=> 'accordion',
			'col'		=> 2, //right side
			'title'		=> __('BigTextDMS Lines', $this->id),
			'post_type'	=> __('Line', $this->id), //does not actually register a custom post type and therefore ok to have spaces (unlike http://codex.wordpress.org/Function_Reference/register_post_type#Parameters )
			'opts'	=> array(
					array(
						'key'	=> 'bigtext_text0',
						'type'	=> 'text',
						'label'	=> __('Line Text', $this->id)
					),
					array(
						'key'	=> 'bigtext_text_nbsp_before0',
						'type'	=> 'count_select',
						'label'	=> __('How many spaces to indent BEFORE this line? (Default: zero)', $this->id),
						'count_start'	=> 0,
						'count_number'	=> 40,
						'default'	=> 0,
					),
					array(
						'key'	=> 'bigtext_text_nbsp_after0',
						'type'	=> 'count_select',
						'label'	=> __('How many spaces to indent AFTER this line? (Likely want to make it the same as BEFORE option)', $this->id),
						'count_start'	=> 0,
						'count_number'	=> 40,
						'default'	=> 0,
					),
					array(
						'key'	=> 'bigtext_exempt0',
						'type'	=> 'select',
						'label'	=> __('Exempt this line and display at the sitewide font size?', $this->id),
						'opts'	=> array(
							'1'	=> array('name' => __('Exempt this Line', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_font0',
						'type'	=> 'fonts',
						'label'	=> __('Line-Specific Font', $this->id)
					),
					array(
						'key'	=> 'bigtext_text_align0',
						'type' 	=> 'select',
						'label'	=> __('Line-Specific Text-Align', $this->id),
						'opts'	=> array(
							'center'	=> array('name' => __('Center', $this->id) ),
							'left'		=> array('name' => __('Left', $this->id) ),
							'right'		=> array('name' => __('Right', $this->id) ),
							'justify'	=> array('name' => __('Justify', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_text_decoration0',
						'type' 	=> 'select',
						'label'	=> __('Line-Specific Text-Decoration', $this->id),
						'opts'	=> array(
							'none'	=> array('name' => __('None', $this->id) ),
							'underline'	=> array('name' => __('Underline', $this->id) ),
							'line-through'		=> array('name' => __('Line-Through / Strikethrough', $this->id) ),
							'overline'		=> array('name' => __('Overline', $this->id) )
						)
					),
					array(
						'key'	=> 'bigtext_line_height0',
						'type'	=> 'text',
						'label'	=> __('Line-Specific Line-Height', $this->id)
					),
					array(
						'key'	=> 'bigtext_small_caps0',
						'type'	=> 'select',
						'label'	=> __('Line-Specific Small-Caps', $this->id),
						'opts'	=> array(
							'1'	=> array('name' => __('Small-Caps this Line', $this->id) )
						)
					),
	/*
					array(
						'key'	=> 'bigtext_transparent_text0',
						'type'	=> 'select',
						'label'	=> __('Line-Specific Transparent Text. (Read warnings in Default Settings above.)', $this->id),
						'opts'	=> array(
							'1'	=> array('name' => __('Make this Line Text Transparent', $this->id) )
						)
					),
	*/
					array(
						'key'	=> 'bigtext_color0',
						'type'	=> 'color',
						'default'	=> '',
						'label' => __('Line-Specific Text Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_stroke0',
						'type'	=> 'color',
						'default'	=> '',
						'label' => __('Line-Specific 1px Stroke/Outline', $this->id)
					),
/*
					array(
						'key'	=> 'bigtext_color_stroke_width0',
						'type'	=> 'text',
						'label' => __('Stroke Width (default: <em>1px</em> if Stroke Color is set)', $this->id)
					),
*/
					array(
						'key'	=> 'bigtext_color_shadow0',
						'type'	=> 'color',
						'default'	=> '',
						'label'	=> __('Line-Specific Shadow Color', $this->id)
					),
					array(
						'key'	=> 'bigtext_color_shadow_length0',
						'type'	=> 'text',
						'label' => __('Line-Specific Shadow Length (default: <em>2px</em> if Shadow Color is set)', $this->id)
					)
				  )
	    );



		return $options;

	}


	function section_template(){

		$clone_id = $this->get_the_id();

		// The Lines
		$bigtextdms_array = $this->opt('bigtextdms_array');

		if( !$bigtextdms_array || $bigtextdms_array == 'false' || !is_array($bigtextdms_array) ){
			$bigtextdms_array = array( array(), array(), array() );
		}

		if( is_array($bigtextdms_array) ) {
			$numberoflines = count( $bigtextdms_array ); // number of accordians available for input, not necessarily having input

			//code snippets
			$smallcapscode = 'font-variant:small-caps;';
			$transparenttextcode = '-webkit-background-clip:text; -webkit-text-fill-color:transparent;';


			//add globals here
			// widths
			$width = $this->opt('bigtext_width') ? $this->opt('bigtext_width') : '100%';
				$width = esc_html($width);
			$maxwidth = $this->opt('bigtext_max_width') ? $this->opt('bigtext_max_width') : '100%';
				$maxwidth = esc_html($maxwidth);


			//background color
			$colorbg = $this->opt('bigtext_color_bg') ? pl_hashify($this->opt('bigtext_color_bg')) : '';

			//background image
			$bgimage = $this->opt('bigtext_image_bg');
				if($bgimage) {
					$bgimagesize = $this->opt('bigtext_image_bg_size') ? $this->opt('bigtext_image_bg_size') : 'auto';
					$bgimageposition = $this->opt('bigtext_image_bg_position') ? $this->opt('bigtext_image_bg_position') : 'center center';
					$bgimagecode = sprintf('background: url("%s") no-repeat; background-position: %s; -webkit-background-size: %s; -moz-background-size: %s; background-size: %s;',
						$bgimage,
						$bgimageposition,
						$bgimagesize,
						$bgimagesize,
						$bgimagesize);
				}


			$smallcaps = $this->opt('bigtext_small_caps');
			$transparenttext = $this->opt('bigtext_transparent_text'); // DOES NOT WORK LINE-BY-LINE UNLESS BACKGROUND IS LINE-BY-LINE

			//text color
			$color = $this->opt('bigtext_color') ? pl_hashify($this->opt('bigtext_color')) : '';

			//stroke
			$colorstroke = $this->opt('bigtext_color_stroke') ? pl_hashify($this->opt('bigtext_color_stroke')) : '';
				if($colorstroke) {
					$strokewidth = $this->opt('bigtext_color_stroke_width') ? $this->opt('bigtext_color_stroke_width') : '1px';
					$strokewidth = esc_html($strokewidth);
					$stroketextcode = "text-shadow: -$strokewidth -$strokewidth 0 $colorstroke, $strokewidth -$strokewidth 0 $colorstroke, -$strokewidth $strokewidth 0 $colorstroke, $strokewidth $strokewidth 0 $colorstroke;";
				}

			//shadow color
			$colorshadow = $this->opt('bigtext_color_shadow') ? pl_hashify($this->opt('bigtext_color_shadow')) : '';
				if($colorshadow) {
					$shadowlength = $this->opt('bigtext_color_shadow_length') ? $this->opt('bigtext_color_shadow_length') : '2px';
					$shadowlength = esc_html($shadowlength);
					$shadowcode = "text-shadow: $shadowlength $shadowlength $colorshadow;";
				}


			$textalign = $this->opt('bigtext_text_align') ? $this->opt('bigtext_text_align') : 'center' ;

			// text-decoration
			$textdecoration = $this->opt('bigtext_text_decoration') ? $this->opt('bigtext_text_decoration') : 'none' ;

			// line-height
			$lineheight = $this->opt('bigtext_line_height') ? $this->opt('bigtext_line_height') : '1';
				$lineheight = esc_html($lineheight);




			//start BigText Area
			echo "<div id='bigtextdms-$clone_id' class='bigtextdms' style='width: $width; max-width: $maxwidth; line-height: $lineheight; text-align: $textalign; text-decoration:$textdecoration;";
				if($color){ echo " color: $color;"; }
				if($colorbg){ echo " background-color: $colorbg;"; }
				if($bgimage){ echo " $bgimagecode"; }
				if($colorstroke){ " $stroketextcode"; }
				if($colorshadow){ " $shadowcode"; }
				if($smallcaps){ echo " $smallcapscode"; }
				if($transparenttext){ echo " $transparenttextcode"; }
			echo "'>";

			//start line by line
			$count = 1;
			foreach( $bigtextdms_array as $bigtext ){

				$count0 = $count - 1; //BigText script starts at Line 0

				$text0 = pl_array_get( 'bigtext_text0', $bigtext );
					do_shortcode($text0);
					// cannot do esc_html() to protect input on all these because then HTML will not work -- so do not insert your own malicious scripts ;-)
					if(!$text0 && current_user_can('edit_theme_options')){
						$text0 = "BigTextDMS: enter <em>Line $count</em> text or delete it.";
					}

				$nbspbefore0 = pl_array_get( 'bigtext_text_nbsp_before0', $bigtext ) ? pl_array_get( 'bigtext_text_nbsp_before0', $bigtext ) : 0;
					$nbspbefore0 = str_repeat('&nbsp;', $nbspbefore0);
				$nbspafter0 = pl_array_get( 'bigtext_text_nbsp_after0', $bigtext ) ? pl_array_get( 'bigtext_text_nbsp_after0', $bigtext ) : 0;
					$nbspafter0 = str_repeat('&nbsp;', $nbspafter0);

				$exempt0 = pl_array_get( 'bigtext_exempt0', $bigtext );
				$textalign0 = pl_array_get( 'bigtext_text_align0', $bigtext );
				$textdecoration0 = pl_array_get( 'bigtext_text_decoration0', $bigtext, 'none' );
				$lineheight0 = pl_array_get( 'bigtext_line_height0', $bigtext );
					$lineheight0 = esc_html($lineheight0);
				$smallcaps0 = pl_array_get( 'bigtext_small_caps0', $bigtext );
				$color0 = pl_array_get( 'bigtext_color0', $bigtext );
				$colorstroke0 = pl_array_get( 'bigtext_color_stroke0', $bigtext );
				$colorshadow0 = pl_array_get( 'bigtext_color_shadow0', $bigtext );

				if($color0) {
					$color0 = pl_hashify($color0);
				};

				if($colorstroke0) {
					$colorstroke0 = pl_hashify($colorstroke0);
					$strokewidth0 = pl_array_get( 'bigtext_color_stroke_width0', $bigtext, '1px' );
					$strokewidth0 = esc_html($strokewidth0);
					$stroketextcode0 = "text-shadow: -$strokewidth0 -$strokewidth0 0 $colorstroke0, $strokewidth0 -$strokewidth0 0 $colorstroke0, -$strokewidth0 $strokewidth0 0 $colorstroke0, $strokewidth0 $strokewidth0 0 $colorstroke0;";
				}

				if($colorshadow0) {
					$colorshadow0 = pl_hashify($colorshadow0);
					$shadowlength0 = pl_array_get( 'bigtext_color_shadow_length0', $bigtext, '2px' );
					$shadowlength0 = esc_html($shadowlength0);
					$shadowcode0 = "text-shadow: $shadowlength0 $shadowlength0 $colorshadow0;";
				}


				echo "<div class='bigtextdms btline$count0";
					if(!$exempt0){ echo "'"; } else { echo " bigtext-exempt'"; }
					echo " style='text-decoration:$textdecoration0;"; // just so style tag isn't empty
					if($lineheight0){ echo " line-height: $lineheight0;"; }
					if($textalign0){ echo " text-align: $textalign0;"; }
					if($color0){ echo " color: $color0;"; }
					if($colorstroke0){ echo " $stroketextcode0"; }
					if($colorshadow0){ echo " $shadowcode0"; }
					if($smallcaps0){ echo " $smallcapscode"; }
				echo "'>$nbspbefore0$text0$nbspafter0</div>";


				$count++;


			}//end of foreach


			//end BigText Area
			echo "</div>";

		} //end of is_array
	} // end of function



} // end of section