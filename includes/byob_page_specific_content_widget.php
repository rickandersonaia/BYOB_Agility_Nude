<?php

/**
 * Description of byob_page_specidic_content_widget
 *
 * @author Rick
 */
class byob_page_specific_content_widget extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	/**
	 * Constructor. Set the default widget options and create widget.
	 *
	 * @since 2.1.10
	 */
	function __construct() {

		$this->defaults = array(
			'title'             => '',
			'show_widget_title' => 0
		);

		$widget_ops = array(
			'classname'   => 'byob_page_specific_content_widget',
			'description' => __( 'Displays the "Page Specific Widget Content" under Agility Page Details', 'byobagn' ),
		);

		$control_ops = array(
			'id_base' => 'page_specific_content',
			'width'   => 200,
			'height'  => 250,
		);


		parent::__construct( 'page_specific_content', __( 'Agility Page Specific Content', 'byobagn' ), $widget_ops, $control_ops );
	}

	/**
	 * Echo the widget content.
	 *
	 * @since 2.1.10
	 *
	 * @global WP_Query $wp_query Query object.
	 * @global integer $more
	 *
	 * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {

		global $wp_query, $post;
		//* Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		$post_meta = get_post_meta( $post->ID, 'byob_widget_content', true );

		if ( ! empty( $post_meta ) ) {

			remove_filter( 'the_content', 'WPCW_units_processUnitContent' );
			$content = apply_filters( 'the_content', $post_meta );

			echo $args['before_widget'];

			if ( ! empty( $instance['title'] ) && ! empty( $instance['show_widget_title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];
			}

			echo $content;

			echo $args['after_widget'];
		}
	}

	/**
	 * Update a particular instance.
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * @since 2.1.10
	 *
	 * @param array $new_instance New settings for this instance as input by the user via form()
	 * @param array $old_instance Old settings for this instance
	 *
	 * @return array Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {
		$instance                      = array();
		$instance['title']             = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['show_widget_title'] = ! empty( $new_instance['show_widget_title'] ) ? true : false;

		return $instance;
	}

	/**
	 * Echo the settings update form.
	 *
	 * @since 0.1.8
	 *
	 * @param array $instance Current settings
	 */
	function form( $instance ) {

		//* Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'byobagn' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>"
			       value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat"/>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'show_widget_title' ); ?>" type="checkbox"
			       name="<?php echo $this->get_field_name( 'show_widget_title' ); ?>"
			       value="1"<?php checked( $instance['show_widget_title'] ); ?> />
			<label for="<?php echo $this->get_field_id( 'show_widget_title' ); ?>"><?php _e( 'Show Widget Title', 'byobagn' ); ?></label>
		</p>
		<?php
	}

}
