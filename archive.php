<?php get_header(); ?>
			
    <div id="content" class="container">	
			
			
			<div class="grid_5">
			
			<?php ciii_category_images( 'category_ids=$cat' ); ?>
			<?php single_cat_title(); ?>
        
			
			<?php get_sidebar(); // sidebar 1 ?>

			</div>
			
			
		<div id="main" class="grid_11 omega" role="main" style="border: 1px solid green">

				
					<?php if (is_category()) { ?>
						<h1 class="archive_title h2">
							<span><?php _e("", "bonestheme"); ?></span> <?php single_cat_title(); ?>
						</h1>
					<?php } elseif (is_tag()) { ?> 
						<h1 class="archive_title h2">
							<span><?php _e("Posts Tagged:", "bonestheme"); ?></span> <?php single_tag_title(); ?>
						</h1>
					<?php } elseif (is_author()) { ?>
						<h1 class="archive_title h2">
							<span><?php _e("Posts By:", "bonestheme"); ?></span> <?php get_the_author_meta('display_name'); ?>
						</h1>
					<?php } elseif (is_day()) { ?>
						<h1 class="archive_title h2">
							<span><?php _e("Daily Archives:", "bonestheme"); ?></span> <?php the_time('l, F j, Y'); ?>
						</h1>
					<?php } elseif (is_month()) { ?>
					    <h1 class="archive_title h2">
					    	<span><?php _e("Monthly Archives:", "bonestheme"); ?>:</span> <?php the_time('F Y'); ?>
					    </h1>
					<?php } elseif (is_year()) { ?>
					    <h1 class="archive_title h2">
					    	<span><?php _e("Yearly Archives:", "bonestheme"); ?>:</span> <?php the_time('Y'); ?>
					    </h1>
					<?php } ?>

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					
								
								
				<?php 
			
	           // get the current category
              $category = get_the_category();
              // get the sticky post in the category, order by title - ascending
              query_posts(array( 'post__in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'DESC' , 'cat' => ''.$cat.'' ));
              while ( have_posts() ) : the_post();
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );

            endwhile; 


            //We already have the category array
            // get all the posts (non-sticky) in this category order by title - ascending
            query_posts(array( 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'DESC' , 'cat' => ''.$cat.'' ) );
            while ( have_posts() ) : the_post();
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );

endwhile; ?>				

					
					
					
					
					
									
					<?php endwhile; ?>	
					
						<nav class="wp-prev-next">
							<ul class="clearfix">
								<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "bonestheme")) ?></li>
								<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "bonestheme")) ?></li>
							</ul>
						</nav>
								
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("No Posts Yet", "bonestheme"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, What you were looking for is not here.", "bonestheme"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
    
			</div> <!-- end #content -->

<?php get_footer(); ?>