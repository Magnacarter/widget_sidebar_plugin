<?php

/**
 * Custom class for CWS Attorneys
 */
class CWS_Attorneys extends WP_Widget {

	function __construct() {
		$widget_ops = array( 
			'description' => 'Add attorneys to your sidebar.'
		);
		parent::__construct( false, 'CWS Attorneys', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );

		$custom_class = ! empty( $instance['custom_class'] ) ? $instance['custom_class'] : null;
		$title        = ! empty( $instance['title'] ) ? $instance['title'] : null;
		$count        = ! empty( $instance['count'] ) ? $instance['count'] : null;

		echo $before_widget;

		global $post;

		$post_title = $post->post_title;

		$args = array( 
			'post_type'      => 'attorney',
			'posts_per_page' => $count
		);

		$attorney = new WP_Query( $args );

		printf( '<section class="side-block %s">', esc_attr( $custom_class ) );

		printf( '<h3>%s</h3>', esc_html( $title ) );

		printf( '<div class="row team">' );

		if( $attorney->have_posts() ) : while( $attorney->have_posts() ) : $attorney->the_post();

			$class         = "no-match";
			$permalink     = get_permalink();
			$name          = get_the_title();
			$excerpt       = get_the_excerpt();
			$picture       = get_the_post_thumbnail( $attorney->ID, array( 205, 205 ) );

			if( is_single() && $post_title === $name ) {
				$class = "hidden-lg";
			}

			printf( '<div class="col-sm-12 %s">', $class );

			printf( '<a href="%s">', esc_url( $permalink ) );

			printf( '<div class="image">' );

			printf( '%s', $picture );

			printf( '</div>' );

			printf( '<span class="name"><span>%s</span></span>', esc_html( $name ) );

			printf( '</a></div>' );

		endwhile; endif; wp_reset_postdata();

		printf( '</div></section>' );

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['custom_class'] = strip_tags( $new_instance['custom_class'] );
		$instance['title']        = strip_tags( $new_instance['title'] );
		$instance['count']        = strip_tags( $new_instance['count'] );

		return $instance;
	}

	function form( $instance ) {
		$args = array(
			'custom_class' => null,
			'title'        => null,
			'count'        => null
		);

		$instance     = wp_parse_args( (array) $instance, $args );
		$custom_class = $instance['custom_class'];
		$title        = $instance['title'];
		$count        = $instance['count'];

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				Sidebar Title:
				<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" value="<?php echo esc_attr( $title ); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>">
				Enter the number of Attorneys to display in sidebar.
				<input type="number" name="<?php echo $this->get_field_name( 'count' ); ?>" id="<?php echo $this->get_field_id( 'count' ); ?>" class="widefat" value="<?php echo esc_attr( $count ); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'custom_class' ); ?>">
				Custom Class:</br>
				Add a custom class for easy styling.
				<input type="text" name="<?php echo $this->get_field_name( 'custom_class' ); ?>" id="<?php echo $this->get_field_id( 'custom_class' ); ?>" class="widefat" value="<?php echo esc_attr( $custom_class ); ?>" />
			</label>
		</p>
		<?php
	}
}