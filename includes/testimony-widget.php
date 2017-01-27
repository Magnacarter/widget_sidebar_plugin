<?php

/**
 * Custom class for CWS Testimonials
 */
class CWS_Testimony extends WP_Widget {

	function __construct() {
		$widget_ops = array( 
			'description' => 'Add a testimony to your sidebar from your "testimonial" CPT.'
		);
		parent::__construct( false, 'CWS Testimony', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );

		$limit        = ! empty( $instance['limit'] ) ? $instance['limit'] : null;
		$custom_class = ! empty( $instance['custom_class'] ) ? $instance['custom_class'] : null;
		$title        = ! empty( $instance['title'] ) ? $instance['title'] : null;

		global $wpdb;

		/* get a random testimonial */
		$testimonials = "
			SELECT *
			FROM $wpdb->posts wposts, $wpdb->postmeta metadate, $wpdb->postmeta metatime
			WHERE (wposts.ID = metadate.post_id AND wposts.ID = metatime.post_id)
			AND wposts.post_type = 'testimonial'
			AND wposts.post_status = 'publish'
			ORDER BY RAND() 
			LIMIT 1
		";

		$testimony = $wpdb->get_results( $testimonials, OBJECT );

		if( $testimony ) :

			global $post;

			foreach( $testimony as $post ) :

				setup_postdata( $post );

				$content        = get_the_content();
				$content_filter = cw_max_characters( $content, $limit ); 
				$client         = get_the_title();

				echo $before_widget;

					printf( '<section class="side-block %s">', esc_attr( $custom_class ) );

					printf( '<div class="sb-title"><h3>%s</h3></div>', esc_html( $title ) );

					printf( '<blockquote>' );

					printf( '<q>%s</q>', $content_filter );

					printf( '<footer>%s</footer>', esc_html( $client ) );

					printf( '</blockquote>' );

					printf( '</section>' );

				echo $after_widget;

			endforeach; 

		endif; wp_reset_postdata();

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['limit']        = strip_tags( $new_instance['limit'] );
		$instance['custom_class'] = strip_tags( $new_instance['custom_class'] );
		$instance['title']        = strip_tags( $new_instance['title'] );

		return $instance;
	}

	function form( $instance ) {
		$args = array(
			'custom_class' => null,
			'title'        => null
		);

		$instance     = wp_parse_args( (array) $instance, $args );
		$custom_class = $instance['custom_class'];
		$title        = $instance['title'];
		$limit        = ! empty( $instance['limit'] ) ? $instance['limit'] : 50;

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
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>">
				Max Characters:</br>
				Some quotes are very long. Set a number to limit the ammount of characters allowed in the testimony.</br>
				( Default is 50 )
				<input type="text" name="<?php echo $this->get_field_name( 'limit' ); ?>" id="<?php echo $this->get_field_id( 'limit' ); ?>" class="widefat" value="<?php echo esc_attr( $limit ); ?>" />
			</label>
		</p>
		<?php
	}
}