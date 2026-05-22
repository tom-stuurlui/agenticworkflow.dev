<?php

define( 'THEME_DIR', get_template_directory() );
define( 'THEME_URI', get_template_directory_uri() );

require_once THEME_DIR . '/includes/acf-layouts.php';

function agentic_workflow_setup(): void {
	load_theme_textdomain( 'agentic-workflow', THEME_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'agentic_workflow_setup' );

function agentic_workflow_enqueue_styles() {
	$styles_dir = get_template_directory() . '/assets/styles';
	$styles_uri = get_template_directory_uri() . '/assets/styles';

	wp_enqueue_style(
		'agentic-workflow-fonts',
		$styles_uri . '/fonts.css',
		array(),
		filemtime( $styles_dir . '/fonts.css' )
	);

	wp_enqueue_style(
		'agentic-workflow-main',
		$styles_uri . '/main.css',
		array( 'agentic-workflow-fonts' ),
		filemtime( $styles_dir . '/main.css' )
	);
}
add_action( 'wp_enqueue_scripts', 'agentic_workflow_enqueue_styles' );
