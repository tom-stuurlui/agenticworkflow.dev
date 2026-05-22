<?php

$heading = get_sub_field( 'heading' );
$text    = get_sub_field( 'text' );
$image   = get_sub_field( 'image' );
?>
<section class="layout layout--text-media">
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
