<?php

$layout_name = 'hero';

$layouts[ $layout_name ] = array(
	'key'        => 'layout_' . $layout_name,
	'name'       => $layout_name,
	'label'      => __( 'Hero', 'agentic-workflow' ),
	'display'    => 'block',
	'sub_fields' => array(
		array(
			'key'   => 'field_hero_heading',
			'label' => __( 'Heading', 'agentic-workflow' ),
			'name'  => 'heading',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_hero_text',
			'label' => __( 'Text', 'agentic-workflow' ),
			'name'  => 'text',
			'type'  => 'textarea',
			'rows'  => 4,
		),
	),
);
