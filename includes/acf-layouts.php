<?php

/**
 * Load layout definitions from /layouts/{slug}/fields.php.
 *
 * @return array<string, array<string, mixed>>
 */
function agentic_workflow_get_layouts(): array {
	$layouts     = array();
	$layouts_dir = THEME_DIR . '/layouts';

	if ( ! is_dir( $layouts_dir ) ) {
		return $layouts;
	}

	$entries = array_diff( scandir( $layouts_dir ), array( '..', '.' ) );

	foreach ( $entries as $entry ) {
		if ( ! is_dir( $layouts_dir . '/' . $entry ) ) {
			continue;
		}

		$fields_file = $layouts_dir . '/' . $entry . '/fields.php';

		if ( ! file_exists( $fields_file ) ) {
			continue;
		}

		include $fields_file;
	}

	return $layouts;
}

/**
 * Register the Layouts flexible content field group for pages.
 */
function agentic_workflow_register_layouts_field_group(): void {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$layouts = agentic_workflow_get_layouts();

	if ( empty( $layouts ) || ! is_array( $layouts ) ) {
		return;
	}

	$acf_layouts = array();

	foreach ( $layouts as $layout ) {
		$acf_layouts[ $layout['key'] ] = $layout;
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_page_layouts',
			'title'                 => __( 'Layouts', 'agentic-workflow' ),
			'fields'                => array(
				array(
					'key'          => 'field_page_layouts',
					'label'        => __( 'Layouts', 'agentic-workflow' ),
					'name'         => 'layouts',
					'type'         => 'flexible_content',
					'layouts'      => $acf_layouts,
					'button_label' => __( 'Add section', 'agentic-workflow' ),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'page',
					),
				),
			),
			'position'              => 'acf_after_title',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
			'hide_on_screen'        => array(
				'the_content',
			),
		)
	);
}
add_action( 'acf/init', 'agentic_workflow_register_layouts_field_group' );

/**
 * Render flexible layout sections for the current (or given) post.
 *
 * @param int|null $post_id Post ID.
 */
function agentic_workflow_render_layouts( $post_id = null ): void {
	if ( ! function_exists( 'have_rows' ) ) {
		return;
	}

	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}

	if ( ! $post_id || ! have_rows( 'layouts', $post_id ) ) {
		return;
	}

	while ( have_rows( 'layouts', $post_id ) ) {
		the_row();

		$layout   = get_row_layout();
		$template = THEME_DIR . '/layouts/' . $layout . '/' . $layout . '.php';

		if ( file_exists( $template ) ) {
			include $template;
		}
	}
}
