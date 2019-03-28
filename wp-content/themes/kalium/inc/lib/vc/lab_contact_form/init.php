<?php
/**
 *	Portable Contact Form
 *	
 *	Laborator.co
 *	www.laborator.co 
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

// Element Information
$lab_vc_element_icon = kalium()->locateFileUrl( 'inc/lib/vc/lab_contact_form/contact.svg' );

vc_map( array(
	'base'             => 'lab_contact_form',
	'name'             => 'Contact Form',
	"description"      => "Insert AJAX form",
	'category'         => 'Laborator',
	'icon'             => $lab_vc_element_icon,
	'params' => array(
		array(
			'type'           => 'textfield',
			'heading'        => 'Name field title',
			'param_name'     => 'name_title',
			'value'          => 'Name:'
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Email field title',
			'param_name'     => 'email_title',
			'value'          => 'Email:'
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Message field title',
			'param_name'     => 'message_title',
			'value'          => 'Message:'
		),
		array(
			'type'           => 'checkbox',
			'heading'        => 'Subject field',
			'param_name'     => 'show_subject_field',
			'std'            => 'no',
			'value'          => array(
				'Show subject field' => 'yes',
			),
		),
		array(
			'type'       => 'textfield',
			'heading'    => 'Subject field title',
			'param_name' => 'subject_title',
			'value'      => 'Subject:',
			'dependency' => array(
				'element'   => 'show_subject_field',
				'value'     => array('yes')
			),
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Submit button title',
			'param_name'     => 'submit_title',
			'value'          => 'Send Message'
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Success message',
			'param_name'     => 'submit_success',
			'value'          => 'Thank you #, message sent!'
		),
		array(
			'type'           => 'checkbox',
			'heading'        => 'Show error alerts',
			'param_name'     => 'alert_errors',
			'std'            => 'no',
			'value'          => array(
				'Yes' => 'yes',
			),
			'description' => 'Show JavaScript alert message when required field is not filled.'
		),
		array(
			'type'       => 'checkbox',
			'heading'    => 'Use subject field as email subject',
			'param_name' => 'subject_field_as_email_subject',
			'value'          => array(
				'Yes' => 'yes',
			),
			'dependency' => array(
				'element'   => 'show_subject_field',
				'value'     => array( 'yes' )
			),
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Receiver',
			'description'	 => 'Enter an email to receive contact form messages. If empty default admin email will be used ('.get_option('admin_email').')',
			'param_name'     => 'email_receiver'
		),
		array(
			'type'       => 'checkbox',
			'heading'    => 'Enable reCAPTCHA',
			'param_name' => 'enable_recaptcha',
			'value'          => array(
				'Yes' => 'yes',
			),
			'description' => 'In order to use reCAPTCHA you must install and configure <a href="' . admin_url( 'plugin-install.php?s=wp-recaptcha-integration&tab=search&type=term' ) . '" target="_blank">WordPress ReCaptcha Integration</a> plugin.<br>Captcha will be visible to the user after the name and email fields are filled properly.'
		),
		array(
			'type'           => 'exploded_textarea_safe',
			'heading'        => 'Privacy policy',
			'description'	 => 'Optionally add some text about your site privacy policy to show when submitting the form. You can include links as well.',
			'param_name'     => 'privacy_policy_text'
		),
		array(
			'type'           => 'textfield',
			'heading'        => 'Extra class name',
			'param_name'     => 'el_class',
			'description'    => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.'
		),
		array(
			'type'       => 'css_editor',
			'heading'    => 'Css',
			'param_name' => 'css',
			'group'      => 'Design options'
		)
	)
) );

class WPBakeryShortCode_Lab_Contact_Form extends WPBakeryShortCode {}

// Contact form request processing
function kalium_vc_contact_form_request() {
	$success = false;
	$response_data = array();
	
	// Form options
	$form_options = kalium()->post( 'form_options' );
	$uniqid = get_array_key( $form_options, 'uniqid' );
	
	// Form fields
	$form_fields = array(
		'name' => kalium()->post( 'name' ),
		'email' => kalium()->post( 'email' ),
		'subject' => kalium()->post( 'subject' ),
		'message' => kalium()->post( 'message' ),
	);
	
	// Form validity checker
	$hash = get_array_key( $form_options, 'hash' );
	$form_hash = wp_hash( $uniqid );
	$form_hash_recaptcha = wp_hash( "{$uniqid}-recaptcha" );
	
	// Check captcha verification
	$success = $form_hash == $hash;
	
	if ( $form_hash_recaptcha === $hash ) {
		$success = $form_hash_recaptcha == $hash && apply_filters( 'recaptcha_valid' , null ) !== false;
		
		if ( ! $success ) {
			$response_data['errors'] = __( 'Captcha verification failed, please try again!', 'kalium' );
		}
	} else if ( ! $success ) {
		$response_data['errors'] = 'Invalid Form Hash';
	}
	
	// Form verification passed
	if ( $success ) {
		// Newline
		$newline = "\n\n";
		
		// Page if
		$page_id = get_array_key( $form_options, 'page_id' );
		
		// Receiver
		$receiver = get_array_key( $form_options, 'receiver' );
		
		if ( ! is_email( $receiver ) ) {
			$receiver = get_option( 'admin_email' );
		}
		
		// Subject field
		if ( ! wp_validate_boolean( get_array_key( $form_options, 'has_subject' ) ) ) {
			unset( $form_fields['subject'] );
		}
		
		// Email subject
		$email_subject = sprintf( _x( '[%s] New Contact Form message has been received.', 'contact form subject', 'kalium' ), get_bloginfo( 'name' ) );
		
		if ( wp_validate_boolean( get_array_key( $form_options, 'use_subject' ) ) ) {
			$email_subject = sprintf( '[%s] %s', get_bloginfo( 'name' ), $form_fields['subject'] );
		}
		
		// Email body
		$email_body = _x( 'You have received new contact form message.', 'contact form', 'kalium' );
		$email_body .= $newline . $newline;
		$email_body .= _x( '----- Message Details -----', 'contact form', 'kalium' );
		$email_body .= $newline;
		
		foreach ( $form_fields as $field_id => $field_value ) {
			$field_title = trim( get_array_key( $form_options, "{$field_id}_title" ), ':' );
			$field_value = trim( $field_value );
			
			if ( 'message' == $field_id ) {
				$field_value = $newline . $field_value;
			}
			
			$email_body .= sprintf( '%s: %s', $field_title, empty( $field_value ) ? '/' : $field_value );
			$email_body .= $newline;
		}
		
		$email_body .= str_repeat( '-', 27 );
		$email_body .= $newline . $newline;
		$email_body .= sprintf( _x( 'This message has been sent from IP: %s', 'contact form', 'kalium' ), $_SERVER['REMOTE_ADDR'] );
		$email_body .= $newline;
		$email_body .= sprintf( _x( 'Site URL: %s', 'contact form', 'kalium' ), home_url() );

		// Strip slashes
		$email_body = stripslashes( $email_body );
		
		// Filter email subject and body
		$email_subject = apply_filters( 'kalium_contact_form_subject', html_entity_decode( $email_subject ), $form_fields, $form_options );
		$email_body = apply_filters( 'kalium_contact_form_message_body', $email_body, $form_fields, $form_options );
		
		// Headers
		$email_headers = array();
		$email_headers[] = "Reply-To: {$form_fields['name']} <{$form_fields['email']}>";
		
		$email_headers = apply_filters( 'kalium_contact_form_mail_headers', $email_headers );
		
		// Send email
		$wp_mail_response = wp_mail( $receiver, $email_subject, $email_body, $email_headers );
		$response_data['status'] = $wp_mail_response;
		
		// Execute actions after email are sent
		$email_sent_action_args = array(
			'receiver' => $receiver,
			'headers' => $email_headers,
			'subject' => $email_subject,
			'message' => $email_body,
			'fields' => $form_fields,
			'opts' => $form_options,
			'wp_mail_response' => $wp_mail_response,
		);
		
		do_action( 'kalium_contact_form_email_sent', $email_sent_action_args );
	}
	
	// Send response
	if ( $success ) {
		wp_send_json_success( $response_data );
	} else {
		wp_send_json_error( $response_data );
	}
}

add_action( 'wp_ajax_kalium_vc_contact_form_request', 'kalium_vc_contact_form_request' );
add_action( 'wp_ajax_nopriv_kalium_vc_contact_form_request', 'kalium_vc_contact_form_request' );
