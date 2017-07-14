<?php

/**
 * This class sets up the typical options for a query box or custom query
 *
 * @author Rick & DIYTheme
 */
class byob_typical_query_options {

	/**
	 * @return array of the layout for the query options when multiple posts will be returned.
	 * This relies on the Thesis options API for defining the options form
	 */
	public function multiple() {
		global $thesis;

		$filtered_post_types = new byob_get_post_types();
		$loop_post_types = $post_types = $filtered_post_types->post_types();
		// now get the taxes associated with each post type, set up the dependents list
		$pt_has_dep = array();
		$term_args  = array(
			'number'  => 50, // get 50 terms for each tax
			'orderby' => 'count',
			'order'   => 'DESC'
		); // but only the most popular ones!
		foreach ( $loop_post_types as $name => $output ) {
			$t            = get_object_taxonomies( $name, 'objects' );
			$pt_has_dep[] = $name;
			if ( ! ! $t ) {
				$options_later                   = array(); // clear out the options_later array
				$options_later[ $name . '_tax' ] = array(// begin setup of taxonomy list for this post type
					'type'  => 'select',
					'label' => sprintf( __( "Select Query Type", 'byobagn' ), $output )
				);
				$t_options                       = array(); // $t_options will be an array of slug => label for the taxes associated with this post type
				$t_options['']                   = sprintf( __( 'Recent %s', 'byobagn' ), $output );
				foreach ( $t as $tax_name => $tax_obj ) {
					// make the post type specific list of taxonomies
					$t_options[ $tax_name ] = ! empty( $tax_obj->label ) ? $tax_obj->label : ( ! empty( $tax_obj->labels->name ) ? $tax_obj->labels->name : $tax_name );
					// now let's make the term options for this category
					$options_later[ $name . '_' . $tax_name . '_term' ]                = array(
						'type'  => 'select',
						'label' => sprintf( __( "Choose from available %s", 'byobagn' ), $t_options[ $tax_name ] )
					);
					$get_terms                                                         = get_terms( $tax_name, $term_args );
					$options_later[ $name . '_' . $tax_name . '_term' ]['options'][''] = sprintf( __( 'Select %s Entries' ), $t_options[ $tax_name ] );
					foreach ( $get_terms as $term_obj ) {
						// make the term list for this taxonomy
						$options_later[ $name . '_' . $tax_name . '_term' ]['options'][ $term_obj->term_id ] = ( ! empty( $term_obj->name ) ? $term_obj->name : $term_obj->slug );
						// tell the taxonomy it has dependents, and which one has it
						$options_later[ $name . '_tax' ]['dependents'][] = $tax_name;
					}
					$options_later[ $name . '_' . $tax_name . '_term' ]['parent'] = array( $name . '_tax' => $tax_name );
					if ( count( $get_terms ) == 50 ) { // did we hit the 50 threshhold? if so, add in a text box
						$options_later[ $name . '_' . $tax_name . '_term_text' ]['type']   = 'text';
						$options_later[ $name . '_' . $tax_name . '_term_text' ]['label']  = __( 'Optionally, provide a numeric ID.', 'byobagn' );
						$options_later[ $name . '_' . $tax_name . '_term_text' ]['width']  = 'medium';
						$options_later[ $name . '_' . $tax_name . '_term_text' ]['parent'] = array( $name . '_tax' => $tax_name );
					}
				}
				$options_later[ $name . '_tax' ]['options'] = $t_options;
				$options_grouped[ $name . '_group' ]        = array(// the group
					'type'   => 'group',
					'parent' => array( 'post_type' => $name ),
					'fields' => $options_later
				);
			}
		}

		$options['post_type'] = array(// create the post type option
			'type'       => 'select',
			'label'      => __( 'Select Post Type', 'byobagn' ),
			'options'    => $post_types,
			'dependents' => $pt_has_dep
		);
		foreach ( $options_grouped as $name => $make ) {
			$options[ $name ] = $make;
		}

		$options['num']        = array(
			'type'   => 'text',
			'width'  => 'tiny',
			'label'  => $thesis->api->strings['posts_to_show'],
			'parent' => array( 'post_type' => array_keys( $loop_post_types ) )
		);
		$options['post_by_id'] = array(
			'type'  => 'text',
			'width' => 'medium',
			'label' => __( 'Or select posts and pages by ID - enter IDs separated by commas - 2,34,198', 'byobagn' ),
		);
		$author                = array(
			'label' => __( 'Filter by Author', 'byobagn' )
		);
		if ( ! $users = wp_cache_get( 'thesis_editor_users' ) ) {
			$user_args = array(
				'orderby' => 'post_count',
				'number'  => 50
			);
			$users     = get_users( $user_args );
			wp_cache_add( 'thesis_editor_users', $users ); // use this for the users list in the editor (if needed)
		}
		$user_data = array( '' => '----' );
		foreach ( $users as $user_obj ) {
			$user_data[ $user_obj->ID ] = ! empty( $user_obj->display_name ) ? $user_obj->display_name : ( ! empty( $user_obj->user_nicename ) ? $user_obj->user_nicename : $user_obj->user_login );
		}
		$author['type']            = 'select';
		$author['options']         = $user_data;
		$more['author']            = $author;
		$more['order']             = array(
			'type'    => 'select',
			'label'   => __( 'Order', 'byobagn' ),
			'tooltip' => __( 'Ascending means 1,2,3; a,b,c. Descending means 3,2,1; c,b,a.', 'byobagn' ),
			'options' => array(
				''    => __( 'Descending', 'byobagn' ),
				'ASC' => __( 'Ascending', 'byobagn' )
			)
		);
		$more['orderby']           = array(
			'type'    => 'select',
			'label'   => __( 'Orderby', 'byobagn' ),
			'tooltip' => __( 'Choose a field to sort by', 'byobagn' ),
			'options' => array(
				''              => __( 'Date', 'byobagn' ),
				'ID'            => __( 'ID', 'byobagn' ),
				'author'        => __( 'Author', 'byobagn' ),
				'title'         => __( 'Title', 'byobagn' ),
				'modified'      => __( 'Modified', 'byobagn' ),
				'rand'          => __( 'Random', 'byobagn' ),
				'comment_count' => __( 'Comment count', 'byobagn' ),
				'menu_order'    => __( 'Menu order', 'byobagn' )
			)
		);
		$more['offset']            = array(
			'type'    => 'text',
			'width'   => 'short',
			'label'   => __( 'Offset', 'byobagn' ),
			'tooltip' => __( 'By entering an offset parameter, you can specify any number of results to skip.', 'byobagn' )
		);
		$more['sticky']            = array(
			'type'    => 'radio',
			'label'   => __( 'Sticky Posts', 'byobagn' ),
			'options' => array(
				''     => __( 'Show sticky posts in their natural position', 'byobagn' ),
				'show' => __( 'Show sticky posts at the top', 'byobagn' )
			)
		);
		$more['exclude']           = array(
			'type'    => 'checkbox',
			'label'   => __( 'Include current post', 'byobagn' ),
			'tooltip' => __( 'If your query box is being used on a page or post the query box typicaly wont display the page or post. Checking this option will include the page or post inthe query box output.', 'byobagn' ),
			'options' => array(
				'yes' => __( 'Include current post in the query box.', 'byobagn' )
			)
		);
		$more['top_level_parents'] = array(
			'type'    => 'checkbox',
			'label'   => __( 'Show only top level parents?', 'byobeqb' ),
			'tooltip' => __( 'This only works on heirarchical post types', 'byobagn' ),
			'options' => array(
				'yes' => __( 'Exclude all but top level parents.', 'byobagn' )
			)
		);
		$pt_has_dep                = array_flip( $pt_has_dep );
		$options['more']           = array(
			'type'   => 'group',
			'label'  => __( 'Advanced Query Options', 'byobagn' ),
			'fields' => $more,
			'parent' => array( 'post_type' => array_keys( $pt_has_dep ) )
		); // remove advanced options for pages since there is no need to sort

		return $options;
	}

	/**
	 * @return array of the layout for the query options when a single post will be returned.
	 * This relies on the Thesis options API for defining the options form
	 */
	public function single() {
		global $thesis, $wpdb, $wp_taxonomies;
		// get the post types - result $post_types
		$filtered_post_types = new byob_get_post_types();
		$post_types = $filtered_post_types->post_types();

		// get a list of posts for each post type - result is $list
		foreach ( $post_types as $name => $output ) {
			$pt_has_dep[] = $name;

			$count_posts = wp_count_posts( $name );
			if ( $count_posts->publish < 51 ) { // limit to 50 posts - to prevent this from having to scale
				$args = array(
					'post_type'      => $name,
					'posts_per_page' => 50,
					'orderby'        => 'title',
					'order'          => 'ASC'
				);

				$list[ $name ] = get_posts( $args );
			} else {
				$list[ $name ] = array();// if there are more than 50 posts don't bother getting them and return an empty array.
			}

		}

		$options['post_type'] = array(// create the post type option
			'type'       => 'select',
			'label'      => __( 'Select Post Type', 'byobagn' ),
			'options'    => $post_types,
			'dependents' => $pt_has_dep
		);

//                var_dump($list);
		foreach ( $list as $type_name ) { //build the select list options - $post_type_page_list
			if ( ! empty( $type_name ) && ! empty( $type_name[0] ) ) {// make a list if there between 1 and 50 posts inclusively
				$pages_option = array( '' => __( 'Select a ' . $type_name[0]->post_type . ':', 'byobagn' ) );
				foreach ( $type_name as $page_object ) {
					$pages_option[ $page_object->ID ]                = $page_object->post_title;
					$post_type_page_list[ $type_name[0]->post_type ] = $pages_option;
				}
			}
		}

		//built the page list option
		foreach ( $post_types as $name => $label ) {
			//make the name singular
			$plural_name = $label;
			$pos         = strrpos( $plural_name, 's' );
			if ( $pos ) {
				$singular_name = substr( $plural_name, 0, $pos );
			} else {
				$singular_name = $plural_name;
			}
			if ( ! empty( $post_type_page_list[ $name ] ) ) {

				//if there are less than 51 posts then build the options lists
				$options[ $name . '_list' ] = array(
					'type'   => 'group',
					'parent' => array( 'post_type' => $name ),
					'fields' => array(
						$name . '_page' => array(
							'type'    => 'select',
							'label'   => __( 'Select a ' . $singular_name, 'byobagn' ),
							'options' => $post_type_page_list[ $name ]
						)
					)
				);
			} else {
				//If there are more than 51 posts show a text box for the post id
				$options[ $name . '_list' ] = array(
					'type'   => 'group',
					'parent' => array( 'post_type' => $name ),
					'fields' => array(
						$name . '_page' => array(
							'type'  => 'text',
							'width' => 'short',
							'label' => __( 'Enter a ' . $singular_name . ' ID', 'byobagn' )
						)
					)
				);
			}
		}

//                var_dump($options);
		return $options;
	}

	public function related() {
		global $thesis, $wpdb, $wp_taxonomies, $post;
		$filtered_post_types = new byob_get_post_types();

		$loop_post_types = $post_types = $filtered_post_types->post_types();
		// now get the taxes associated with each post type, set up the dependents list
		$pt_has_dep = array();
		$term_args  = array(
			'number'  => 50, // get 50 terms for each tax
			'orderby' => 'count',
			'order'   => 'DESC'
		); // but only the most popular ones!

		foreach ( $loop_post_types as $name => $output ) {
			$t            = get_object_taxonomies( $name, 'objects' );
			$pt_has_dep[] = $name;
			if ( ! ! $t ) {
				$options_later                   = array(); // clear out the options_later array
				$options_later[ $name . '_tax' ] = array(// begin setup of taxonomy list for this post type
					'type'  => 'select',
					'label' => sprintf( __( "Select Relationship Taxonomy", 'thesis' ), $output )
				);
				$t_options                       = array(); // $t_options will be an array of slug => label for the taxes associated with this post type

				foreach ( $t as $tax_name => $tax_obj ) {
					// make the post type specific list of taxonomies
					$t_options[ $tax_name ] = ! empty( $tax_obj->label ) ? $tax_obj->label : ( ! empty( $tax_obj->labels->name ) ? $tax_obj->labels->name : $tax_name );
				}


				$options_later[ $name . '_tax' ]['options'] = $t_options;
				$options_grouped[ $name . '_group' ]        = array(// the group
					'type'   => 'group',
					'parent' => array( 'post_type' => $name ),
					'fields' => $options_later
				);
			}
		}

		$html['post_type'] = array(// create the post type option
			'type'       => 'select',
			'label'      => __( 'Select Post Type', 'thesis' ),
			'options'    => $post_types,
			'dependents' => $pt_has_dep
		);
		foreach ( $options_grouped as $name => $make ) {
			$html[ $name ] = $make;
		}

		$html['num'] = array(
			'type'   => 'text',
			'width'  => 'tiny',
			'label'  => $thesis->api->strings['posts_to_show'],
			'parent' => array( 'post_type' => array_keys( $loop_post_types ) )
		);

		$more['order']   = array(
			'type'    => 'select',
			'label'   => __( 'Order', 'thesis' ),
			'tooltip' => __( 'Ascending means 1,2,3; a,b,c. Descending means 3,2,1; c,b,a.', 'thesis' ),
			'options' => array(
				''    => __( 'Descending', 'thesis' ),
				'ASC' => __( 'Ascending', 'thesis' )
			)
		);
		$more['orderby'] = array(
			'type'    => 'select',
			'label'   => __( 'Orderby', 'thesis' ),
			'tooltip' => __( 'Choose a field to sort by', 'thesis' ),
			'options' => array(
				''              => __( 'Date', 'thesis' ),
				'ID'            => __( 'ID', 'thesis' ),
				'title'         => __( 'Title', 'thesis' ),
				'modified'      => __( 'Modified', 'thesis' ),
				'rand'          => __( 'Random', 'thesis' ),
				'comment_count' => __( 'Comment count', 'thesis' ),
				'menu_order'    => __( 'Menu order', 'thesis' )
			)
		);
		$more['offset']  = array(
			'type'    => 'text',
			'width'   => 'short',
			'label'   => __( 'Offset', 'thesis' ),
			'tooltip' => __( 'By entering an offset parameter, you can specify any number of results to skip.', 'thesis' )
		);

		$pt_has_dep = array_flip( $pt_has_dep );

		$html['more'] = array(
			'type'   => 'group',
			'label'  => __( 'Advanced Query Options', 'thesis' ),
			'fields' => $more,
			'parent' => array( 'post_type' => array_keys( $pt_has_dep ) )
		); // remove advanced options for pages since there is no need to sort

		return $html;
	}
}
