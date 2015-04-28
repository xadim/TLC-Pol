<?php
/**
 * Template Name: The Latest
 */
get_header();
?>

<div class="mainLatest">
  <div class="row">  
    <div class="col-md-12">
      <h2>The Latest</h2>
    </div>  
    <div class="col-md-8">
      <div class="post">
           <div class="row">  
              <?php
              $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

              query_posts(array(
                'post_type'      => 'post', // You can add a custom post type if you like
                'paged'          => $paged,
                'posts_per_page' => 6,
                //'category' => 2
              )); 
                if(have_posts()) : ?>
                   <?php while(have_posts()) : the_post(); ?>  
                                          
                              <div class="date col-md-12"><?php echo "Posted: ".the_time("D, F d Y"); ?></div>
                           <div class='col-md-4'><?php the_post_thumbnail( 'medium' )?></div>
                           <div class="col-md-8">
                           <span class="title"><strong><?php the_title(); ?> </strong></span>
                           <p><?php the_excerpt(); ?></p>
                           <a class="readmore" href = "<?php the_permalink(); ?>">Read more...</a>
                           </div>
                  <?php endwhile;?>
                  <div class="blog-pagination">
                    <?php my_pagination(); ?>
                  </div>
              <?php endif; ?>
          </div>
        </div>
    </div>
    <div class="col-md-4 right">
      <img class="rightimg" src="http://www.tlcpolitical.com/wp-content/themes/twentythirteen/images/tlc_twit.jpeg">
      Don’t miss any updates from <strong>The Lukens Company</strong><br>
      <a class="rightlink" href="https://twitter.com/LukensPolitico" target="_blank">@LukensPolitico</a><br>
      <?php echo do_shortcode ('[fts twitter twitter_name=LukensPolitico]');?>
    </div>
  </div>
</div>
<?php get_footer(); ?>