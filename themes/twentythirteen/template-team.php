<?php
/**
 * Template Name: Team
 */
get_header();

the_post();

// Get 'team' posts
$team_posts = get_posts( array(
	'post_type' => 'team',
	'posts_per_page' => -1, // Unlimited posts
	'orderby' => 'title', // Order alphabetically by name
) );

if ( $team_posts ):
?>
<section class="row profiles">
	<div class="intro">
		<h2>Meet The Team</h2>
		<p class="lead">&ldquo;Individuals can and do make a difference, but it takes a team<br>to really mess things up.&rdquo;</p>
	</div>
	
	<?php 
	foreach ( $team_posts as $post ): 
	setup_postdata($post);
	
	// Resize and CDNize thumbnails using Automattic Photon service
	$thumb_src = null;
	if ( has_post_thumbnail($post->ID) ) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'team-thumb' );
		$thumb_src = $src[0];
	}
	?>
	<article class="col-sm-6 profile">
		<div class="profile-header">
			<?php if ( $thumb_src ): ?>
			<img src="<?php echo $thumb_src; ?>" alt="<?php the_title(); ?>, <?php the_field('team_position'); ?>" class="img-circle">
			<?php endif; ?>
		</div>
		
		<div class="profile-content">
			<h3><?php the_title(); ?></h3>
			<p class="lead position"><?php the_field('position'); ?></p>
			<?php the_content(); ?>
		</div>
		
		<div class="profile-footer">
			<a href="mailto:<?php echo antispambot( get_field('email') ); ?>" target="_blank">
				<i class="icon-large icon-envelope"></i></a>
			<?php if ( $twitter = get_field('twitter') ): ?>
			<a href="<?php echo $twitter; ?>" target="_blank"><i class="icon-large icon-twitter"></i></a>
			<?php endif; ?>
			<?php if ( $linkedin = get_field('linkedin') ): ?>
			<a href="<?php echo $linkedin; ?>" target="_blank"><i class="icon-large icon-linked-in"></i></a>
			<?php endif; ?>
		</div>
	</article><!-- /.profile -->
	<?php endforeach; ?>
</section><!-- /.row -->
<?php endif; ?>
<?php get_footer(); ?>