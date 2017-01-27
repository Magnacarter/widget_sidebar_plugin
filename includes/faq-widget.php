<?php

/**
 * Custom class for CWS FAQ Accordion
 */
class CWS_FAQ_Accordion extends WP_Widget {

	function __construct() {
		$widget_ops = array( 
			'description' => 'Make an FAQ Accordion sidebar.'
		);
		parent::__construct( false, 'CWS FAQ Accordion', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );

		$custom_class = ! empty( $instance['custom_class'] ) ? $instance['custom_class'] : null;
		$title        = ! empty( $instance['title'] ) ? $instance['title'] : null;
		$count        = ! empty( $instance['count'] ) ? $instance['count'] : null;

		echo $before_widget;

			$args = array(
				'post_type'      => 'frequent_question',
				'posts_per_page' => $count,
			);

			$faq = new WP_Query( $args );

			printf( '<div class="faqs %s">', esc_attr( $custom_class ) );

			printf( '<div class="faq-title"><h4>%s</h4></div>', esc_html( $title ) );

			$i = 0;

			if( $faq->have_posts() ) : while( $faq->have_posts() ) : $faq->the_post();

				$i++;
				$permalink = get_permalink();
				$faq_title = get_the_title();
				$answer    = get_the_content();

				printf( '<div class="faq-content">' );

				printf( '<a class="faq-trigger" data-toggle="collapse" data-target="#faq-%s">%s</a>', esc_attr( $i ), esc_html( $faq_title ) );

				printf( '<div id="faq-%s" class="collapse">', esc_attr( $i ) );

				printf( '<p>%s</p>', esc_html( $answer ) );

				printf( '</div></div>' );

			endwhile; endif; wp_reset_postdata();

			printf( '</div>' );

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
				Enter the number of Results to display in sidebar.
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