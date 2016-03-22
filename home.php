<?php get_header(); ?>
<div id="primary-content">
		<?php if(have_posts()): while(have_posts()): the_post(); ?>
		<h2 class="h-title"><?php the_title(); ?></h2>
			<div class="bg-post">
				<?php 
					if(has_post_thumbnail()) {?>
				<?php the_post_thumbnail(); ?>
				<?php } else {?>
				<?php
					  }
				?>
			</div>
			<div class="entry">
				<div class="pr-content">
					<?php the_content(); ?>
				</div>
			</div>
		<?php endwhile ; ?>
		<?php else : ?>
			<div class="entry">
				<p>Updating...</p>
			</div>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>