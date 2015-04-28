<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
		$thePostName = "team";
		$currentUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
		$teamResult = strpos($currentUrl,$thePostName);
		//$teamID = array(69, 77, 101, 79, 81, 86, 87, 83, 121, 111, 85, 119);
		?>


		<?php if ($teamResult) { ?>
		<div  class="row innercontent">	
		<div class="col-md-6">
		<?php } else { ?>
		<div  class="row contentPost">	
		<div class="col-md-3">
		<?php }?>

			<header class="entry-header">
				<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
				<div class="img-single-square">
					<?php the_post_thumbnail('team-thumb');?>
					<?php if(empty($teamResult)){ ?>
					<?php the_date('l, F j, Y, g:i');
					echo do_shortcode('[hupso]');
					?>
					<?php }?>
				</div>
				<?php endif; ?>
			</header>

		</div>

		<?php if($teamResult){ ?>
		<div class="col-md-6 bio">
		<?php } else { ?>
		<div class="col-md-9 bio">
		<?php }?>

			<?php if ( is_single() ) : ?>
			<h1 class="entry-title title"><?php  echo $thePostID;  the_title(); ?></h1>
			<?php else : ?>
			<h1 class="entry-title title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<?php endif; // is_single() ?>
			<p class="position"><?php the_field('position'); ?></p>
			<div class="staffsocials">
				<?php if (get_field('email') && get_field('email') != '#'): $email = get_field('email');?>
					<?php //if ( $email = get_field('email') ): ?>
						<a href="mailto:<?php echo antispambot( $email); ?>">
							<img class="twit" src="http://www.tlcpolitical.com/wp-content/themes/twentythirteen/images/email-envelope-black.png">
						</a>
					<?php endif; ?>
					<?php if (get_field('twitter') && get_field('twitter') != '#'): $email = get_field('twitter');?>
					<?php //if ( $twitter = get_field('twitter') ): ?>
					<a href="<?php echo $twitter; ?>">
						<img src="http://www.tlcpolitical.com/wp-content/themes/twentythirteen/images/twitter-small-black.png">
					</a>
					<?php endif; ?>
					<?php if (get_field('linkedin') && get_field('linkedin') != '#'): $email = get_field('linkedin');?>
					<?php // if ( $linkedin = get_field('linkedin') ): ?>
					<a href="<?php echo $linkedin; ?>">
						<img src="http://www.tlcpolitical.com/wp-content/themes/twentythirteen/images/linkedin-small-black.png">
					</a>
					<?php endif; ?>
				</div>

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading ', 'twentythirteen' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">
			<?php if ( comments_open() && ! is_single() ) : ?>
				<div class="comments-link">
					<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?>
				</div><!-- .comments-link -->
			<?php endif; // comments_open() ?>

			<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
				<?php get_template_part( 'author-bio' ); ?>
			<?php endif; ?>
		</footer><!-- .entry-meta -->
	</div>
</div>
</article><!-- #post -->
