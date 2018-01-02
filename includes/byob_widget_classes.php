<?php

class BYOB_Agility_Widget_Classes {

	// This class provides extra widget functionality to widgets - it allows the user
	// to select a widget style, specifiy a custom class and indicate that

	public function __construct() {
		add_action( 'in_widget_form', array( $this, 'in_widget_form' ), 10, 3 );
		add_filter( 'widget_update_callback', array( $this, 'widget_update_callback' ), 10, 4 );
		add_filter( 'dynamic_sidebar_params', array( $this, 'dynamic_sidebar_params' ) );
		add_filter( 'widget_title', array( $this, 'widget_title_display' ) );
	}

	function in_widget_form( $widget, $return, $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'class' => '' ) );
		$style    = ! empty( $instance['style'] ) ? strip_tags( $instance['style'] ) : '';
		$class    = ! empty( $instance['class'] ) ? strip_tags( $instance['class'] ) : '';

		$return = null;
		$this->style_form( $widget->get_field_id( 'style' ), $widget->get_field_name( 'style' ), $style );
		$this->class_form( $widget->get_field_id( 'class' ), $widget->get_field_name( 'class' ), $class );
	}

	function style_form( $id, $name, $value ) {
		$selected = ! empty( $value ) ? ' selected="selected"' : '';
		?>
		<p>
			<label>Select a Custom Style for this widget:</label>
			<select id="<?php echo $id; ?>" name="<?php echo $name; ?>">
				<option value=""<?php echo $selected; ?>>Select a style</option>
				<option value="supplemental"<?php echo $selected = $value == 'supplemental' ? ' selected="selected"' : ''; ?>>
					Supplemental
				</option>
				<option value="supplemental-2"<?php echo $selected = $value == 'supplemental-2' ? ' selected="selected"' : ''; ?>>
					Supplemental 2
				</option>
				<?php
				if ( is_array( $this->pages ) ) {
					foreach ( $this->pages as $id => $title ) {
						$selected = $value == $id ? ' selected="selected"' : '';
						echo "\t\t\t<option value=\"$id\"$selected>$title</option>\n";
					}
				}
				?>
			</select>

		</p>
		<?php
	}

	function class_form( $id, $name, $value ) {
		?>
		<p>
			<label>
				or, Add add your own class:
				<input class="widefat" id="<?php echo $id; ?>" name="<?php echo $name; ?>" type="text" size="33"
				       value="<?php echo esc_attr( $value ); ?>">
			</label>
		</p>
		<?php
	}

	function widget_update_callback( $instance, $new_instance, $old_instance, $widget ) {

		if ( array_key_exists( 'class', $new_instance ) ) {
			$instance['class'] = str_replace( ',', ' ', $new_instance['class'] );
		}
		if ( array_key_exists( 'style', $new_instance ) ) {
			$instance['style'] = str_replace( ',', ' ', $new_instance['style'] );
		}

		return $instance;
	}

	function dynamic_sidebar_params( $params ) {
		global $wp_registered_widgets;
		//                print_r($params);

		$widget_id  = $params[0]['widget_id'];
		$widget_obj = $wp_registered_widgets[ $widget_id ];
		$widget_opt = get_option( $widget_obj['callback'][0]->option_name );
		$widget_num = $widget_obj['params'][0]['number'];
		$style      = isset( $widget_opt[ $widget_num ]['style'] ) && ! empty( $widget_opt[ $widget_num ]['style'] ) ? $widget_opt[ $widget_num ]['style'] : false;

		if ( $style ) {
			$class = esc_attr( $style );
		} else {
			$class = isset( $widget_opt[ $widget_num ]['class'] ) && ! empty( $widget_opt[ $widget_num ]['class'] ) ? esc_attr( $widget_opt[ $widget_num ]['class'] ) : false;
		}

		if ( $class ) {
			$params[0]['before_widget'] = preg_replace( '/class="/', "class=\"$class ", $params[0]['before_widget'], 1 );
		}

		return $params;
	}

	public function widget_title_display( $widget_title ) {
		if ( substr( $widget_title, 0, 1 ) == '!' ) {
			return;
		} else {
			return ( $widget_title );
		}
	}

}
