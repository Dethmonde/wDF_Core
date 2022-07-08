<div class="entry-meta">
	
	<?php if (is_single()) { ?>
		<span class="entry-category"><?php videolife_first_category(); ?></span>
	<?php } ?>

	<?php if ( (!is_category()) && (!is_single()) ) { ?>
		<span class="entry-category"><?php videolife_first_category(); ?></span>
	<?php } ?>

	<span class="entry-date"><?php echo get_the_date(); ?></span>
	<span class="sep">&middot;</span>
	<span class='entry-comment'><?php comments_popup_link( __('0 Comment','videolife'), __('1 Comment','videolife'), __('% Comments','videolife'), 'comments-link', __('Comments off','videolife')); ?></span>

</div><!-- .entry-meta -->