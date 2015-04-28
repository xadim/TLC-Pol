<?php
/*
WP Post Template: Case Study Posts
*/
get_header();
?>

<article class="caseStudySingle" id="post-<?php $my_postid = the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( is_single() ) : ?>
			<div class="row">
				<div class="row intro">
					<div class="col-md-8">
						<h1><?php the_title(); ?></h1>
						<h3><?php the_excerpt(); ?></h3>
					</div>
					<div class="col-md-4">
						<img src="http://www.tlcpolitical.com/wp-content/themes/twentythirteen/images/case-study.png">
					</div>
				</div>	
				<div class="col-md-12">
					<div class="sliderZ">
						<?php 
							//$my_postid = the_ID();//This is page id or post id
							$content_post = get_post($my_postid);
							$content = $content_post->post_content;
							$content = apply_filters('the_content', $content);
							$content = str_replace(']]>', ']]&gt;', $content);
							echo $content;
						?>
					</div>
				</div>	
				<div class="col-md-12">
					<div class="more"><a href="http://tlcpolitical.com/clients/">More case studies</a></div>
				</div>
			</div>				
			<?php endif; // is_single() ?>
			
</article><!-- #post -->



<?php get_footer(); ?>