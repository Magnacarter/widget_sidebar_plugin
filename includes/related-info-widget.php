<?php
/**
 * Custom class for CWS Related Info
 */
class CWS_Related_Info extends WP_Widget {

	function __construct() {
		$widget_ops = array( 
			'description' => 'Add child page links to a parent page.'
		);
		parent::__construct( false, 'CWS Related Info', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );

		$custom_class  = ! empty( $instance['custom_class'] ) ? $instance['custom_class'] : null;
		$title         = ! empty( $instance['title'] ) ? $instance['title'] : null;
		$select        = ! empty( $instance['select'] ) ? $instance['select'] : null;

		echo $before_widget;

			global $post;

			$kids = array(
				'post_parent' => $post->ID,
				'post_type'   => 'page',
				'order'       => 'ASC'
			);

			$children = get_children( $kids );

			printf( '<section class="side-block %s">', esc_attr( $custom_class ) );

			printf( '<div class="sb-title"><h3>%s</h3></div>', esc_html( $title ) );

			printf( '<ul class="side-block-list">' );

			if( $select != null  ) {

				foreach( $select as $id ) {

					printf(
						'<li class="related-info-list"><a href="%s">%s</a></li>',
						get_permalink( $id ),
						get_the_title( $id )
					);

				}

			}

			printf( '</ul></section>' );

			if( count( $children ) != 0 && $select == null ) {

				printf( '<section class="side-block %s">', esc_attr( $custom_class ) );

				printf( '<ul class="side-block-list">' );

				foreach( $children as $child ) {

					printf( '<li class="related-info-list"><a href="%s"><span></span>%s</a></li>', get_page_link( $child->ID ), $child->post_title );

				}

				printf( '</ul></section>' );

			} else {

				return;

			}

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['select']        = esc_sql( $new_instance['select'] );
		$instance['custom_class']  = strip_tags( $new_instance['custom_class'] );
		$instance['title']         = strip_tags( $new_instance['title'] );

		return $instance;
	}

	function form( $instance ) {
		$args = array(
			'custom_class'  => null,
			'title'         => null
		);

        $select        = $instance['select'];
		$instance      = wp_parse_args( (array) $instance, $args );
		$custom_class  = $instance['custom_class'];
		$title         = $instance['title'];
		$ids           = get_all_page_ids();
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
			<label for="<?php echo $this->get_field_id( 'select' ); ?>">
				Related Pages:</br>
				To select multiple pages use command + select on Mac, control + select on PC.</br>
				If no pages are selected and the page has children, this widget will display child pages of parent.

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
		<?php
	}
}