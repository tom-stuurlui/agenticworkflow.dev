<?php

$layout_name = 'text-media';

$layouts[ $layout_name ] = array(
	'key'        => 'layout_' . $layout_name,
	'name'       => $layout_name,
	'label'      => __( 'Text + media', 'agentic-workflow' ),
	'display'    => 'block',
	'sub_fields' => array(
		array(
			'key'   => 'field_text_media_heading',
			'label' => __( 'Heading', 'agentic-workflow' ),
			'name'  => 'heading',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_text_media_text',
			'label' => __( 'Text', 'agentic-workflow' ),
			'name'  => 'text',
			'type'  => 'textarea',
			'rows'  => 4,
		),
		array(
			'key'           => 'field_text_media_image',
			'label'         => __( 'Image', 'agentic-workflow' ),
			'name'          => 'image',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'medium',
			'library'       => 'all',
		),
	),
);
