<?php get_header(); ?>
<div id="primary-content">
		<h2 class="h-title">404 Erorr!</h2>
			<div class="bg-post">
				<img width="2667" height="1403" src="http://new.hunters.co.jp/wp-content/uploads/2016/03/news-bg.jpg" class="attachment-full size-full wp-post-image" alt="about-us-bg"/>	
			</div>
			<div class="entry">
				<div class="pr-content">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'hunters' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'hunters' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
			</div>
			</div>
	</div>
<?php get_footer(); ?>
