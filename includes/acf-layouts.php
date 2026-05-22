<?php

/**
 * @return list<string> Layout folder slugs.
 */
function agentic_workflow_layout_slugs(): array {
	$layouts_dir = THEME_DIR . '/layouts';

	if ( ! is_dir( $layouts_dir ) ) {
		return array();
	}

	$slugs = array();

	foreach ( array_diff( scandir( $layouts_dir ), array( '..', '.' ) ) as $entry ) {
		if ( is_dir( $layouts_dir . '/' . $entry ) ) {
			$slugs[] = $entry;
		}
	}

	return $slugs;
}

/**
 * Load layout definitions from /layouts/{slug}/fields.php.
 *
 * @return array<string, array<string, mixed>>
 */
function agentic_workflow_get_layouts(): array {
	$layouts = array();

	foreach ( agentic_workflow_layout_slugs() as $slug ) {
		$fields_file = THEME_DIR . '/layouts/' . $slug . '/fields.php';

		if ( ! file_exists( $fields_file ) ) {
			continue;
		}

		include $fields_file;
	}

	return $layouts;
}

/**
 * Layout slugs used on a page.
 *
 * @param int $post_id Post ID.
 * @return list<string>
 */
function agentic_workflow_page_layout_slugs( int $post_id ): array {
	if ( ! function_exists( 'get_field' ) ) {
		return array();
	}

	$rows = get_field( 'layouts', $post_id, false );

	if ( ! is_array( $rows ) ) {
		return array();
	}

	$slugs = array();

	foreach ( $rows as $row ) {
		if ( is_array( $row ) && isset( $row['acf_fc_layout'] ) ) {
			$slugs[] = (string) $row['acf_fc_layout'];
		}
	}

	return array_values( array_unique( $slugs ) );
}

/**
 * Register local ACF field groups once ACF is ready.
 */
function agentic_workflow_acf_init(): void {
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
					'button_label' => __( 'Add layout', 'agentic-workflow' ),
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
add_action( 'acf/init', 'agentic_workflow_acf_init' );

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

/**
 * Enqueue style.css for layouts used on the current page.
 */
function agentic_workflow_enqueue_layout_styles(): void {
	if ( is_admin() || ! is_singular( 'page' ) ) {
		return;
	}

	$slugs = agentic_workflow_page_layout_slugs( (int) get_queried_object_id() );

	foreach ( $slugs as $slug ) {
		$path = THEME_DIR . '/layouts/' . $slug . '/style.css';

		if ( ! file_exists( $path ) ) {
			continue;
		}

		wp_enqueue_style(
			'agentic-workflow-layout-' . $slug,
			THEME_URI . '/layouts/' . $slug . '/style.css',
			array( 'agentic-workflow-main' ),
			(string) filemtime( $path )
		);
	}
}
add_action( 'wp_enqueue_scripts', 'agentic_workflow_enqueue_layout_styles', 20 );

/**
 * Enqueue script.js for layouts used on the current page.
 */
function agentic_workflow_enqueue_layout_scripts(): void {
	if ( is_admin() || ! is_singular( 'page' ) ) {
		return;
	}

	$slugs = agentic_workflow_page_layout_slugs( (int) get_queried_object_id() );

	foreach ( $slugs as $slug ) {
		$path = THEME_DIR . '/layouts/' . $slug . '/script.js';

		if ( ! file_exists( $path ) ) {
			continue;
		}

		wp_enqueue_script(
			'agentic-workflow-layout-' . $slug,
			THEME_URI . '/layouts/' . $slug . '/script.js',
			array(),
			(string) filemtime( $path ),
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'agentic_workflow_enqueue_layout_scripts', 20 );
