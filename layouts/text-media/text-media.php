<?php

$heading            = get_sub_field( 'heading' );
$pretitle            = get_sub_field( 'pretitle' );
$text               = get_sub_field( 'text' );
$image              = get_sub_field( 'image' );
$youtube_url        = get_sub_field( 'youtube_url' );
$image_position     = get_sub_field( 'image_position' ) ?: 'right';
$vertical_alignment = get_sub_field( 'vertical_alignment' ) ?: 'center';

// Extract YouTube video ID from URL
$youtube_id = '';
if ( $youtube_url ) {
	preg_match( '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $youtube_url, $matches );
	if ( ! empty( $matches[1] ) ) {
		$youtube_id = $matches[1];
	}
}

$classes = array(
	'layout',
	'layout--text-media',
	'layout--text-media--image-' . $image_position,
	'layout--text-media--align-' . $vertical_alignment,
);
?>
<section class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="layout--text-media__content">
		<?php if ( $pretitle ) : ?>
			<div class="layout--text-media__pretitle"><?php echo esc_html( $pretitle ); ?></div>
		<?php endif; ?>

		<?php if ( $heading ) : ?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php if ( $text ) : ?>
			<p><?php echo esc_html( $text ); ?></p>
		<?php endif; ?>
	</div>

	<?php if ( $youtube_id || ( is_array( $image ) && ! empty( $image['ID'] ) ) ) : ?>
		<div class="layout--text-media__media">
			<?php if ( $youtube_id ) : ?>
				<div class="layout--text-media__video-wrapper" data-video-id="<?php echo esc_attr( $youtube_id ); ?>">
					<?php if ( is_array( $image ) && ! empty( $image['ID'] ) ) : ?>
						<div class="layout--text-media__video-thumbnail">
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
							<button class="layout--text-media__play-button" aria-label="<?php esc_attr_e( 'Play video', 'agentic-workflow' ); ?>">
								<svg width="68" height="48" viewBox="0 0 68 48" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M66.52 7.74c-.78-2.93-2.49-5.41-5.42-6.19C55.79.13 34 0 34 0S12.21.13 6.9 1.55c-2.93.78-4.63 3.26-5.42 6.19C.06 13.05 0 24 0 24s.06 10.95 1.48 16.26c.78 2.93 2.49 5.41 5.42 6.19C12.21 47.87 34 48 34 48s21.79-.13 27.1-1.55c2.93-.78 4.64-3.26 5.42-6.19C67.94 34.95 68 24 68 24s-.06-10.95-1.48-16.26z" fill="#f00"/>
									<path d="M45 24L27 14v20" fill="#fff"/>
								</svg>
							</button>
						</div>
					<?php else : ?>
						<div class="layout--text-media__video-container">
							<iframe 
								src="https://www.youtube.com/embed/<?php echo esc_attr( $youtube_id ); ?>" 
								frameborder="0" 
								allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
								allowfullscreen
								loading="lazy"
							></iframe>
						</div>
					<?php endif; ?>
				</div>
			<?php elseif ( is_array( $image ) && ! empty( $image['ID'] ) ) : ?>
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
			<?php endif; ?>
		</div>
	<?php endif; ?>
</section>
