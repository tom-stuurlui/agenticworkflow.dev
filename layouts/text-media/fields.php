<?php

$layout_name = 'text-media';

$layouts[ $layout_name ] = array(
	'key'        => 'layout_' . $layout_name,
	'name'       => $layout_name,
	'label'      => __( 'Text + media', 'agentic-workflow' ),
	'display'    => 'block',
	'sub_fields' => array(
		array(
			'key'   => 'field_text_media_pretitle',
			'label' => __( 'Pretitle', 'agentic-workflow' ),
			'name'  => 'pretitle',
			'type'  => 'text',
		),
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
	array(
		'key'           => 'field_text_media_youtube_url',
		'label'         => __( 'YouTube URL', 'agentic-workflow' ),
		'name'          => 'youtube_url',
		'type'          => 'url',
		'instructions'  => __( 'Add a YouTube video URL. If an image is provided, it will be used as thumbnail with a play button.', 'agentic-workflow' ),
		'placeholder'   => 'https://www.youtube.com/watch?v=...',
	),
	array(
		'key'           => 'field_text_media_image_position',
		'label'         => __( 'Image position', 'agentic-workflow' ),
		'name'          => 'image_position',
		'type'          => 'select',
		'choices'       => array(
			'right' => __( 'Right', 'agentic-workflow' ),
			'left'  => __( 'Left', 'agentic-workflow' ),
		),
		'default_value' => 'right',
		'return_format' => 'value',
	),
		array(
			'key'           => 'field_text_media_vertical_alignment',
			'label'         => __( 'Vertical alignment', 'agentic-workflow' ),
			'name'          => 'vertical_alignment',
			'type'          => 'select',
			'choices'       => array(
				'center' => __( 'Center', 'agentic-workflow' ),
				'top'    => __( 'Top', 'agentic-workflow' ),
				'bottom' => __( 'Bottom', 'agentic-workflow' ),
			),
			'default_value' => 'center',
			'return_format' => 'value',
		),
	),
);
