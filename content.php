<?php
/**
 * The default template for displaying post excerpts
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<?php if (is_sticky()) { $sticky = "sticky"; } ?>


	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix '. $sticky); ?> role="article">
						
						<header>
							
							<h2 class="single-title" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							
						
						</header> <!-- end article header -->
					
					
					
					
						<section class="post_content">
						
							<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
						
							<?php the_content(); ?>
					
						</section> <!-- end article section -->
						
							<?php /*
  							if (post_is_in_descendant_category(60)  || post_is_in_descendant_category(64)) {
  							   // do nothing
                } else {
                  // show the meta 
              ?>
                  
              
              <footer>
			
							<?php the_tags('<p class="tags"><span class="tags-title">Tags:</span> ', ', ', '</p>'); ?>
							
									<p class="meta"><?php _e("Posted", "bonestheme"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> <?php //_e("by", "bonestheme"); ?> <?php //the_author_posts_link(); ?> <?php _e("under", "bonestheme"); ?> <?php the_category(', '); ?>.</p>
							
						</footer> <!-- end article footer -->
              
                  
              <?php } */ ?>
							
					
					</article> <!-- end article -->
