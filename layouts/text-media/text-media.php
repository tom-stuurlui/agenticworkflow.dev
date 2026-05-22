<?php

$heading            = get_sub_field( 'heading' );
$text               = get_sub_field( 'text' );
$image              = get_sub_field( 'image' );
$image_position     = get_sub_field( 'image_position' ) ?: 'right';
$vertical_alignment = get_sub_field( 'vertical_alignment' ) ?: 'center';

$classes = array(
	'layout',
	'layout--text-media',
	'layout--text-media--image-' . $image_position,
	'layout--text-media--align-' . $vertical_alignment,
);
?>
<section class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="layout--text-media__content">
		<?php if ( $heading ) : ?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php if ( $text ) : ?>
			<p><?php echo esc_html( $text ); ?></p>
		<?php endif; ?>
	</div>

	<?php if ( is_array( $image ) && ! empty( $image['ID'] ) ) : ?>
		<div class="layout--text-media__media">
			<?php
			echo wp_get_attachment_image(
				(int) $image['ID'],
				'large',
				false,
				array(
					'class'   => 'layout--text-media__image',
					'loading' => 'lazy',
				)
			);
			?>
		</div>
	<?php endif; ?>
</section>
