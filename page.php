<?php get_header(); ?>
<div id="primary-content">
		<?php if(have_posts()): while(have_posts()): the_post(); ?>
		<?php
			if(empty( $post->post_parent )){
				echo '<h2 class="h-title">';
				echo get_the_title( $post->ID );
				echo '</h2>';
				echo '<h3 class="sub-h-title">';
				if(get_post_meta($post->ID,'Sub-japanese-title',true)==""){
				}else{
					echo get_post_meta($post->ID,'Sub-japanese-title',true);
				}
				echo '</h3>';
			}else{
				echo get_the_title( $post->post_parent );
			}
		?>
		<h2 class="h-title"><?php the_title();
			echo empty( $post->post_parent ) ? get_the_title( $post->ID ) : get_the_title( $post->post_parent );
		?>
		</h2>
		<h3 class="sub-h-title"><?php if(get_post_meta($post->ID,'Sub-japanese-title',true)==""){ }else{ echo get_post_meta($post->ID,'Sub-japanese-title',true);}?></h3>
			<div class="bg-post">
				<?php 
					if(has_post_thumbnail()) {?>
				<?php the_post_thumbnail('full'); ?>
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