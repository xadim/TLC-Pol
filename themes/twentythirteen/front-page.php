<?php get_header(); ?>

	<div class="bgimage-container">   
        <div class="bgimage" id="bgimage-1" style="z-index: 0;">
        	 <?php echo do_shortcode("[lbg_zoominoutslider settings_id='1']");?>
        </div>

	    <header id="hero">
	        <div id="logo">
	            
	           <div class="tagline">
	           	<?php echo do_shortcode('[bne_testimonials_slider animation="fade" arrows="true" nav="false" image_style="flat-square"]');?>
	           </div>
	        </div>

	        <a href="/#news" class="scroll-down smoothScroll">
	            <img src="http://www.tlcpolitical.com/wp-content/themes/twentythirteen/images/scroll-down-mouse.png">
	        </a>
	    </header>
	</div>


	<div class="rd_part">
		<div class="row">

			<div class="col-md-6 rightborder">
				<?php $the_query = new WP_Query( 'showposts=1' ); ?>
				<div class="col-md-4">
					<a href="<?php the_permalink() ?>"><?php echo get_the_post_thumbnail( $page->ID); ?></a>
				</div>
				<div class="col-md-8">
				  <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
				  <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
				  <p><?php the_excerpt();?></p>
				  <?php endwhile;?>
				</div>
			</div>


			<div class="col-md-6">
				 <?php
					 global $post;
					 $myposts = get_posts('numberposts=1&offset=1');
					 foreach($myposts as $post) :
					 setup_postdata($post);
				?>	
				<div class="col-md-4">
					<a href="<?php the_permalink() ?>"><?php echo get_the_post_thumbnail( $page->ID); ?></a>
				</div>
				<div class="col-md-8">
				  
				  <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
				  <p><?php the_excerpt();?></p>
				  <?php endforeach;?>
				</div>
			</div>
		</div>
	</div>
<div id="news"></div>
<?php get_footer(); ?>




