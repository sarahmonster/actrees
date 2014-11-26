<?php 
			
	           // get the current category
              $category = get_the_category();
              // get the sticky post in the category, order by title - ascending
              query_posts(array( 'post__in' => get_option('sticky_posts'), 'paged' => get_query_var('page'), 'orderby' => 'date', 'order' => 'DESC' , 'cat' => ''.$cat.'' ));
              while ( have_posts() ) : the_post();
              
              
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						 
						get_template_part( 'content', get_post_format() );
            
            endwhile; 
            wp_reset_query();

 			
					?>
					
					
					
					<?php if (have_posts()) : while (have_posts()) : the_post();

				if (!is_sticky()) {
						get_template_part( 'content', get_post_format() );
        }

           
           endwhile; ?>	
           
           
           
					
					<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
						
						<?php page_navi(); // use the page navi function ?>

					<?php } else { // if it is disabled, display regular wp prev & next links ?>
						<nav class="wp-prev-next">
							<ul class="clearfix">
								<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "bonestheme")) ?></li>
								<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "bonestheme")) ?></li>
							</ul>
						</nav>
					<?php } ?>
								
					
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
