<?php get_header(); ?>
<div id="primary-content">
		<?php if(have_posts()): while(have_posts()): the_post(); ?>
		<h2 class="h-title"><?php the_title(); ?></h2>
			<div class="bg-post">
				<img width="2667" height="1403" src="http://new.hunters.co.jp/wp-content/uploads/2016/03/news-bg.jpg" class="attachment-full size-full wp-post-image" alt="about-us-bg"/>	
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