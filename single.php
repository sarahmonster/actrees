<?php get_header(); ?>
			
			
			
    <div id="content" class="container">	
			

		
			
			<?php 

			   $category=get_the_category();			   
			   
			   
			   $images = get_option('taxonomy_image_plugin');
         $image = wp_get_attachment_image_src($images[$category[0]->term_id], 'full' );
		     	
		    if ($image == "") {
          $image  = get_template_directory_uri()."/library/images/default.png";
        }
      $sidebar_img = get_template_directory_uri().'/library/timthumb.php?src='.$image[0].'&h=400&w=260'; 
?>	         
			
			
					<div class="grid_5">
					   <img src="<?php echo $sidebar_img; ?>" class="category" />					     
			       <h1 class="sidebar"><span><?php $category = get_the_category(); echo $category[0]->cat_name; ?></span></h1>
             <?php get_sidebar(); ?>
          </div>
			
			
			
				<div id="main" class="grid_11 omega" role="main">
				
				
				

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
							
							<h2 class="single-title" itemprop="headline"><?php the_title(); ?></h2>
							
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
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
              
                  
              <?php } */?>
							
					
				

					
					</article> <!-- end article -->
					
					<?php // comments_template(); ?>
					
					<?php endwhile; ?>			
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1>Not Found</h1>
					    </header>
					    <section class="post_content">
					    	<p>Sorry, but the requested resource was not found on this site.</p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
   </div> <!-- end #content -->


<?php get_footer(); ?>