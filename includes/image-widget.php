<?php
/**
 * Custom class for CWS Image
 */
class CWS_Image extends WP_Widget {

	function __construct() {
		$widget_ops = array( 
			'description' => 'Add an image to your sidebar.'
		);
		parent::__construct( false, 'CWS Image', $widget_ops );

		add_action( 'admin_enqueue_scripts', array($this, 'upload_scripts' ) );
	}

	/**
	 * Upload the Javascripts for the media uploader
	 */
	public function upload_scripts() {
		wp_enqueue_script( 'media-upload' ); //Provides all the functions needed to upload, validate and give format to files.
		wp_enqueue_script( 'thickbox' ); //Responsible for managing the modal window.
		wp_enqueue_style ( 'thickbox' ); //Provides the styles needed for this window.
		wp_enqueue_script( 'script', plugins_url( '../js/cw-plugin.js', __FILE__ ), array('jquery'), '', true); //It will initialize the parameters needed to show the window properly.
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );

		$title        = ! empty( $instance['title'] )        ? $instance['title']        : null;
		$link_url     = ! empty( $instance['link_url'] )     ? $instance['link_url']     : null;
		$text         = ! empty( $instance['text'] )         ? $instance['text']         : null;
		$image        = ! empty( $instance['image'] )        ? $instance['image']        : null;
		$custom_class = ! empty( $instance['custom_class'] ) ? $instance['custom_class'] : null;

		echo $before_widget;

			printf( '<section class="side-block %s">', $custom_class );

			printf( '%s<a href="%s">%s</a>%s', $before_title, esc_url( $link_url ), esc_html( $title ), $after_title );

			printf( '<a href="%s"><img src="%s" alt="%s"></a>', esc_url( $link_url ), esc_url( $image ), esc_attr( $title ) );

			printf( '<p>%s</p>', esc_html( $text ) );

			printf( '</section>' );

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']        = strip_tags  ( $new_instance['title'] );
		$instance['custom_class'] = strip_tags  ( $new_instance['custom_class'] );
		$instance['link_url']     = esc_url_raw ( $new_instance['link_url'] );
		$instance['text']         = wp_kses_post( $new_instance['text'] );
		$instance['image']        = esc_url_raw ( $new_instance['image'] );

		return $instance;
	}

	function form( $instance ) {
		$args = array(
			'title'     => null,
			'image_url' => null,
			'link_url'  => null,
			'text'      => null
		);

		$instance = wp_parse_args( (array) $instance, $args );

		$title        = ! empty( $instance['title'] )        ? $instance['title']        : null;
		$link_url     = ! empty( $instance['link_url'] )     ? $instance['link_url']     : null;
		$text         = ! empty( $instance['text'] )         ? $instance['text']         : null;
		$image        = isset  ( $instance['image'] )        ? $instance['image']        : null;
		$custom_class = ! empty( $instance['custom_class'] ) ? $instance['custom_class'] : null;

		?>
		<p>
			<label for="<?php echo $this->get_field_name( 'title' ); ?>">
				<?php _e( 'Title:' ) ?>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_name( 'image' ); ?>">
				<?php _e( 'Image:' ) ?>
				<input name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $image ); ?>" />
				<input class="upload_image_button" type="button" value="Upload Image" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'custom_class' ); ?>">
				<?php _e( 'Custom Class:' ) ?></br>
				Add a custom class for easy styling.
				<input type="text" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" id="<?php echo $this->get_field_id( 'custom_class' ); ?>" class="widefat" value="<?php echo esc_attr( $custom_class ); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_url' ); ?>">
				<?php _e( 'Link URL:' ) ?></br>
				<input type="text" name="<?php echo $this->get_field_name( 'link_url' ); ?>" id="<?php echo $this->get_field_id( 'link_url' ); ?>" class="widefat" placeholder="http://" value="<?php echo esc_url( $link_url ); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Text:' ) ?>
				<textarea name="<?php echo $this->get_field_name( 'text' ); ?>" id="<?php echo $this->get_field_id( 'text' ); ?>" class="widefat"><?php echo wp_kses_post( $text ); ?></textarea>
			</label>
		</p>
		<?php
	}
}