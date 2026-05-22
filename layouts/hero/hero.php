<?php

$heading = get_sub_field( 'heading' );
$text    = get_sub_field( 'text' );
?>
<section class="layout layout--hero">
	<?php if ( $heading ) : ?>
		<h1><?php echo esc_html( $heading ); ?></h1>
	<?php endif; ?>

	<?php if ( $text ) : ?>
		<p><?php echo esc_html( $text ); ?></p>
	<?php endif; ?>
</section>
