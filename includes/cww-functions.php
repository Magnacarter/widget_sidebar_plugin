<?php
/**
 * Functions
 */

/**
 * Build extensible HTML form
 * 
 * @param string $custom_class 
 * @param string $title 
 * @param string $action 
 * @param boolean $client 
 * @param boolean $placeholder 
 * @param string $name 
 * @param string $email 
 * @param string $message 
 * @param string $submit
 *
 * @return apply_filters cw_build_form
 */
function cw_form_html( $custom_class, $title, $action, $client, $placeholder, $name, $email, $message, $submit ) {

	$html  = sprintf( '<div class="side-block %s">', esc_attr( $custom_class ) );
	$html .= sprintf( '<form class="support-form custom-form" action="%s">', esc_url( $action ) );
	$html .= sprintf( '<fieldset>' );
	$html .= sprintf( '<div class="sb-title"><h3>%s</h3></div>', esc_html( $title ) );
	$html .= sprintf( '<div class="form-group">' );

	if( $placeholder === 'false' ) {

		$html .= sprintf( '<div class="text-block">' );
		$html .= sprintf( '<label for="name">%s</label>', esc_html( $name ) );
		$html .= sprintf( '<span class="text-info"><span class="star">*</span>Required</span>' );
		$html .= sprintf( '</div>' );
		$html .= sprintf( '<input name="name" id="name" type="text" class="form-control">' );

	} else {

		$html .= sprintf( '<input name="name" id="name" type="text" class="form-control" placeholder="%s">', esc_attr( $name ) );

	}

	$html .= sprintf( '</div>' );

	$html .= sprintf( '<div class="form-group">' );

	if( $placeholder === 'false' ) {

		$html .= sprintf( '<div class="text-block">' );
		$html .= sprintf( '<label for="phone_or_email">%s<span class="star">*</span> </label>', esc_html( $email ) );
		$html .= sprintf( '</div>' );
		$html .= sprintf( '<input name="phone_or_email" id="email" type="email" class="form-control"></div>' );

	} else {

		$html .= sprintf( '<input name="phone_or_email" id="email" type="email" class="form-control" placeholder="%s"></div>', esc_attr( $email ) );

	}

	if( $client === 'true' ) {

		$html .= sprintf( '<div class="form-group">' );
		$html .= sprintf( '<div class="text-block">' );
		$html .= sprintf( '<span>Are you a current client? <span class="star">*</span></span>' );
		$html .= sprintf( '</div>' );
		$html .= sprintf( '<div class="radio-holder">' );
		$html .= sprintf( '<label class="radio-inline" for="radio1">' );
		$html .= sprintf( '<input type="radio" id="radio1" name="radio" checked="checked">Yes' );
		$html .= sprintf( '</label>' );
		$html .= sprintf( '<label class="radio-inline" for="radio2">' );
		$html .= sprintf( '<input type="radio" id="radio2" name="radio">No' );
		$html .= sprintf( '</label></div></div>' );

	}


	$html .= sprintf( '<div class="form-group">' );

	if( $placeholder === 'false' ) {

		$html .= sprintf( '<div class="text-block">' );
		$html .= sprintf( '<label for="message">%s</label>', esc_html( $message ) );
		$html .= sprintf( '</div>' );
		$html .= sprintf( '<textarea name="message" id="textarea" cols="30" rows="10" class="form-control"></textarea>' );

	} else {

		$html .= sprintf( '<textarea name="message" id="textarea" cols="30" rows="10" class="form-control" placeholder="%s"></textarea>', esc_attr( $message ) );

	}

	$html .= sprintf( '</div>' );

	$html .= sprintf( '<input name="submit" type="submit" value="%s" class="btn btn-block">', esc_html( $submit ) );

	$html .= sprintf( '</fieldset></form></div>' );

	return apply_filters( 'cw_build_form', $html );

}

/**
 * Set the $max_length var to filter the number of charactors that can be output in a 
 * string and escape output.
 *
 * @param string $quote testimony
 * @param int $limit
 *
 * @return string $string_slice filtered testimony
 * @return string $quote
 */
function cw_max_characters( $string, $limit = 400 ) {

	if ( $limit == 0 ) {

		$limit = 400;

	}

	if ( strlen( $string ) > $limit ) {

		$string_slice = substr( $string, 0, $limit );

		return esc_html( $string_slice ) . "...";

	} else {

		return esc_html( $string );

	}

}

/**
 * Get post excerpt outside the loop and set a character limit
 *
 * @param int $post_id
 * @return string $the_excerpt
 */
function cw_excerpt_by_id( $post_id, $limit = 50 ){

	$the_post       = get_post( $post_id ); //Gets post ID
	$the_excerpt    = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
	$excerpt_length = $limit; //Sets excerpt length by word count
	$the_excerpt    = strip_tags( strip_shortcodes( $the_excerpt ) ); //Strips tags and images
	$words          = explode( ' ', $the_excerpt, $excerpt_length + 1 );

	if( count( $words ) > $excerpt_length ) {

		array_pop( $words );
		array_push( $words, '…' );
		$the_excerpt = implode( ' ', $words );

	}

	return $the_excerpt;

}