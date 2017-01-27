<?php

/**
 * Custom class for CWS Featured Post
 */
class CWS_Featured_Post extends WP_Widget {

	function __construct() {
		$widget_ops = array( 
			'description' => 'Add your featured post by giving it a category of "featured".'
		);
		parent::__construct( false, 'CWS Featured Post', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		global $read_more;
		$read_more    = ! empty( $instance['read_more'] ) ? $instance['read_more'] : 'Continue Reading';
		$custom_class = ! empty( $instance['custom_class'] ) ? $instance['custom_class'] : null;
		$title        = ! empty( $instance['title'] ) ? $instance['title'] : null;
		$select       = ! empty( $instance['select'] ) ? $instance['select'] : null;
		$limit        = ! empty( $instance['limit'] ) ? $instance['limit'] : null;
		$id           = (int)$select[0];

		if (  $id == 0 ) {

			return;

		}

		$permalink     = get_permalink( $id );
		$blog_title    = get_the_title( $id );
		$excerpt       = cw_excerpt_by_id( $id, $limit );
		$image         = get_the_post_thumbnail( $id );
		$date_attr     = get_the_time( 'F j, Y' );
		$date          = get_the_time( 'F j, Y' );
		$author_id     = get_the_author_meta( 'ID' );
		$author        = get_author_posts_url( $author_id );
		$author_name   = get_the_author_meta( 'display_name' );
		$category      = get_the_category( $id );
		$category_name = ! empty( $category[0]->name ) ? $category[0]->name : null;
		$category_id   = ! empty( $category[0]->term_id ) ? $category[0]->term_id : null;
		$link          = get_category_link( $category_id );

		echo $before_widget;

			printf( '<section class="side-block %s">', esc_attr( $custom_class ) );

			printf( '<div class="sb-title"><h3>%s</h3></div>', esc_html( $title ) );

			printf(	'<article class="post">' );

			printf(	'<div class="img-holder"><a href="%s">%s</a></div>', esc_url( $permalink ), $image );

			printf(	'<div class="post-meta">' );

			printf(	'<time datetime="%s" class="date">%s</time>', esc_attr( $date_attr ), esc_html( $date ) );

			printf(	'<span class="post-author" itemprop="author" itemscope itemtype="https://schema.org/Person"> By <a class="author-name" itemprop="name" href="%s">%s</a><br/>In <a href="%s"> %s</a></span>', esc_url( $author ), esc_html( $author_name ), esc_url( $link ), esc_html( $category_name ) );

			printf(	'</div>' );

			printf(	'<h3><a href="%s">%s</a></h3>', esc_url( $permalink ), esc_html( $blog_title ) );

			printf( '<p>%s</p>', $excerpt );

			printf( '<a class="moretag" href="%s">%s</a>', $permalink, $read_more );

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['limit']        = strip_tags( $new_instance['limit'] );
		$instance['custom_class'] = strip_tags( $new_instance['custom_class'] );
		$instance['title']        = strip_tags( $new_instance['title'] );
		$instance['read_more']    = strip_tags( $new_instance['read_more'] );
		$instance['select']       = esc_sql( $new_instance['select'] );

		return $instance;
	}

	function form( $instance ) {
		$args = array(
			'custom_class' => null,
			'title'        => null
		);

		$instance     = wp_parse_args( (array) $instance, $args );
		$read_more    = ! empty( $instance['read_more'] ) ? $instance['read_more'] : null;
		$custom_class = $instance['custom_class'];
		$title        = $instance['title'];
		$select       = ! empty( $instance['select'] ) ? $instance['select'] : null;
		$limit        = ! empty( $instance['limit'] ) ? $instance['limit'] : 50;

		$ids = get_posts( array (
				'post_type' => 'post',
				'fields' => 'ids'
			)
		);

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
			<label for="<?php echo $this->get_field_id( 'read_more' ); ?>">
				Read More Link:</br>
				Change the read more link text.
				<input type="text" name="<?php echo $this->get_field_name( 'read_more' ); ?>" id="<?php echo $this->get_field_id( 'read_more' ); ?>" class="widefat" value="<?php echo esc_attr( $read_more ); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'select' ); ?>">
				Featured Post:</br>
				Please select one post to feature.</br>

				<select multiple name="<?php echo $this->get_field_name( 'select' ) ?>[]" id="<?php echo $this->get_field_id( 'select' ) ?>" class="widefat">

					<?php foreach( $ids as $id ) : 

						printf(
							'<option value="%s" %s>%s</option>',
							$id,
							in_array( $id, $select ) ? 'selected="selected"' : '',
							get_the_title( $id )
						);

					endforeach ?>

				</select>

			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>">
				Max Characters:</br>
				Set a number to limit the ammount of characters allowed in the excerpt.</br>
				( Default is 50 )
				<input type="text" name="<?php echo $this->get_field_name( 'limit' ); ?>" id="<?php echo $this->get_field_id( 'limit' ); ?>" class="widefat" value="<?php echo esc_attr( $limit ); ?>" />
			</label>
		</p>
		<?php
	}
}