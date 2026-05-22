<?php

get_header();

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		agentic_workflow_render_layouts();
	}
}

get_footer();
