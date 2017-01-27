<?php

/**
 * Custom class for CWS Sidebar Form
 */
class CWS_Sidebar_Form extends WP_Widget {

	function __construct() {
		$widget_ops = array( 
			'description' => 'Build a custom sidebar form.'
		);
		parent::__construct( false, 'CWS Sidebar Form', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );

		$custom_class = ! empty( $instance['custom_class'] ) ? $instance['custom_class'] : null;
		$title        = ! empty( $instance['title'] ) ? $instance['title'] : null;
		$action       = ! empty( $instance['action'] ) ? $instance['action'] : null;
		$client       = ! empty( $instance['client'] ) ? 'true' : 'false';
		$placeholder  = ! empty( $instance['placeholder'] ) ? 'true' : 'false';
		$name         = ! empty( $instance['name'] ) ? $instance['name'] : 'name';
		$email        = ! empty( $instance['email'] ) ? $instance['email'] : 'email';
		$message      = ! empty( $instance['message'] ) ? $instance['message'] : 'message';
		$submit       = ! empty( $instance['submit'] ) ? $instance['submit'] : 'Submit';

		echo $before_widget;

			//cw_form_html location in includes->cww-functions.php
			$form = cw_form_html( $custom_class, $title, $action, $client, $placeholder, $name, $email, $message, $submit );

			echo $form;

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['custom_class'] = strip_tags( $new_instance['custom_class'] );
		$instance['title']        = strip_tags( $new_instance['title'] );
		$instance['action']       = strip_tags( $new_instance['action'] );
		$instance['client']       = $new_instance['client']; //boolean value
		$instance['placeholder']  = $new_instance['placeholder']; //boolean value
		$instance['submit']       = strip_tags( $new_instance['submit'] );
		$instance['name']         = strip_tags( $new_instance['name'] );
		$instance['email']        = strip_tags( $new_instance['email'] );
		$instance['message']      = strip_tags( $new_instance['message'] );

		return $instance;
	}

	function form( $instance ) {
		$args = array(
			'custom_class' => null,
			'title'        => null,
			'action'       => null,
		);

		$instance     = wp_parse_args( (array) $instance, $args );
		$custom_class = $instance['custom_class'];
		$title        = $instance['title'];
		$action       = $instance['action'];
		$name         = ! empty( $instance['name'] ) ? $instance['name'] : 'Name';
		$email        = ! empty( $instance['email'] ) ? $instance['email'] : 'Email or Phone';
		$message      = ! empty( $instance['message'] ) ? $instance['message'] : 'Message';
		$submit       = ! empty( $instance['submit'] ) ? $instance['submit'] : 'Submit';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				Sidebar Title:
				<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" value="<?php echo esc_attr( $title ); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'custom_class' ); ?>">
				Custom Class:</br>
				Add a custom class for easy styling.
				<input type="text" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" id="<?php echo $this->get_field_id( 'custom_class' ); ?>" class="widefat" value="<?php echo esc_attr( $custom_class ); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'action' ); ?>">
				Enter the Consult Webs form URL for the action attribute.
				<input type="text" name="<?php echo $this->get_field_name( 'action' ); ?>" id="<?php echo $this->get_field_id( 'action' ); ?>" class="widefat" value="<?php echo esc_attr( $action ); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'client' ); ?>">
				Former client field group.
				<input class="checkbox" type="checkbox" <?php checked( $instance[ 'client' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'client' ); ?>" name="<?php echo $this->get_field_name( 'client' ); ?>" /> 
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'placeholder' ); ?>">
				Check to use placeholder text as value of input field. If not checked, it will be a label.
				<input class="checkbox" type="checkbox" <?php checked( $instance[ 'placeholder' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'placeholder' ); ?>" name="<?php echo $this->get_field_name( 'placeholder' ); ?>" /> 
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>">
				Name field input label:</br>
				<input type="text" name="<?php echo $this->get_field_name( 'name' ); ?>" id="<?php echo $this->get_field_id( 'name' ); ?>" class="widefat" value="<?php echo esc_attr( $name ); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>">
				Email field input label:</br>
				<input type="text" name="<?php echo $this->get_field_name( 'email' ); ?>" id="<?php echo $this->get_field_id( 'email' ); ?>" class="widefat" value="<?php echo esc_attr( $email ); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'message' ); ?>">
				Messsage field input label:</br>
				<input type="text" name="<?php echo $this->get_field_name( 'message' ); ?>" id="<?php echo $this->get_field_id( 'message' ); ?>" class="widefat" value="<?php echo esc_attr( $message ); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'submit' ); ?>">
				Submit Button Text:</br>
				Change the submit button text.
				<input type="text" name="<?php echo $this->get_field_name( 'submit' ); ?>" id="<?php echo $this->get_field_id( 'submit' ); ?>" class="widefat" value="<?php echo esc_attr( $submit ); ?>" />
			</label>
		</p>
		<?php
	}
}