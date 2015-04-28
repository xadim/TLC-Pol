<?php
/**
 * Template Name: Staff
 */
get_header();

the_post();



/*Content elements
	'post_status'
   'post_type'
   'post_author'
   'ping_status'
   'post_parent'
   'menu_order'
   'to_ping'
   'pinged'
   'post_password'
   'guid'
   'post_content_filtered'
   'post_excerpt'
   'import_id'
   'post_content'
   'post_title'
   'ID'
   'post_date'
   'post_date_gmt'
   'comment_status'
   'post_name'
   'post_modified'
   'post_modified_gmt'
   'post_mime_type'
   'comment_count'
   'ancestors'
   'post_category'
   'tags_input'
   'filter'
*/




// Get 'team' posts
   $x = 2;
$team_posts = get_posts( array(
	'post_type' => 'team',
	'posts_per_page' => -1, // Unlimited posts
	'orderby' => 'title', // Order alphabetically by name
) );

if ( $team_posts ):
?>
<a href="#down" class="smoothScroll scroll-down-team animate">
    <img src="http://www.tlcpolitical.com/wp-content/themes/twentythirteen/images/sroll-down-white.png">
</a>
<!--
<div class="scrollDown"> 
	<a href="#down" class="smoothScroll">
		<img src="http://www.tlcpolitical.com/wp-content/themes/twentythirteen/images/arrow-down.png">
	</a>
</div>
-->
<section class="row profiles no-gutter">
	<h2>Our Team</h2>
	<?php 
	foreach ( $team_posts as $post ): 
	setup_postdata($post);
	
	// Resize and CDNize thumbnails using Automattic Photon service
	$thumb_src = null;
	if ( has_post_thumbnail($post->ID) ) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'team-thumb' );
		$thumb_src = $src[0];
	}
	$Link = "http://tlcpolitical.com/?team=".$strNameFinal;
	//si x est divisible par 2 ou en d'autre terme x est modulo de 2
	if($x % 2 ==0)
		{
			$divLeft = "withLeft";
			$LeftHover = "noLeftHover";
		} 
		else 
			{
				$divLeft = "noLeft";
				$LeftHover = "withLeftHover";
			}
	?>
		<div class="col-md-6 smallcontainer">
			<?php if ( $thumb_src ): ?>
			<img src="<?php echo $thumb_src; ?>" alt="<?php the_title(); ?>, <?php the_field('team_position'); ?>" class="img-square <?php echo $divLeft;?>">
			<?php endif; ?>
				<div class="textbox <?php echo $LeftHover;?>">
					<div class="smallcontent">
						<a href="<?php the_permalink();?>" class="title"><?php the_title();?></a>
						<p class="position"><?php the_field('position'); ?></p>
						<span class="content">
							<?php //the_content(); 
							the_field('intro') ?>
						</span>
						<div class="staffsocials">
							<?php if (get_field('email') && get_field('email') != '#'): $email = get_field('email');?>
							<?php //if (get_field('email') != '#'): $email = get_field('email');?>
							<a href="mailto:<?php echo antispambot( $email); ?>">
								<img class="twit" src="http://www.tlcpolitical.com/wp-content/themes/twentythirteen/images/email-envelope.png">
							</a>
							<?php endif; ?>
							<?php if (get_field('twitter') && get_field('twitter') != '#'): $twitter = get_field('twitter');?>
							<?php //if (get_field('twitter') != '#'): $twitter = get_field('twitter'); ?>
							<a href="<?php echo $twitter; ?>">
								<img class="twit" src="http://www.tlcpolitical.com/wp-content/themes/twentythirteen/images/twitter-small.png">
							</a>
							<?php endif; ?>
							<?php if (get_field('linkedin') && get_field('linkedin') != '#'): $linkedin = get_field('linkedin');?>
							<?php //if (get_field('linkedin') != '#'): $linkedin = get_field('linkedin'); ?>
							<a href="<?php echo $linkedin; ?>">
								<img class="twit" src="http://www.tlcpolitical.com/wp-content/themes/twentythirteen/images/linkedin-small.png">
							</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
		</div>
	<?php $x = $x+1;endforeach; ?>

</section><!-- /.row -->
<?php endif; ?>
<section id="down" class="downScrolling" >
</section>
<?php get_footer(); ?>

