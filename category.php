<?php get_header(); ?>
			
    <div id="content" class="container">	
			

			
  <?php 
  
  // First, let's figure out if this category has any subcategories.
  
  
  // get data about your category
  $cat = get_query_var('cat');
  $yourcat = get_category ($cat);


  // grab category's subcategories
  $args=array(
    'child_of' => $cat,
    'order' => 'ASC'
    );
  $categories = get_categories( $args );   
  
  
  // oh, and while we're at it, we'll also figure out its image url, and resize it for two different use cases
  $image = apply_filters( 'taxonomy-images-queried-term-image-url', '', array('image_size' => 'full') );
 	if ($image == "") {
     $image  = get_template_directory_uri()."/library/images/default.png";
   }
  $main_img = get_template_directory_uri().'/library/timthumb.php?src='.$image.'&h=250&w=560'; 
  $sidebar_img = get_template_directory_uri().'/library/timthumb.php?src='.$image.'&h=400&w=260'; 
	         
  
  ?>


 		

  

	
				<?php 
				
				// Oh hey! There are no subcategories.
				if (count($categories) == 0): 
				
				
				// So, let's show the category image and some sidebar stuff.
				?>			
				
				
					<div class="grid_5">
					   <img src="<?php echo $sidebar_img; ?>" class="category" />					     
			       <h1 class="sidebar"><span><?php single_cat_title(); ?></span></h1>
             <?php get_sidebar(); ?>
          </div>
			
			
		<div id="main" class="grid_11 omega" role="main">

       
       
       
       
       
       
       
       
       
       
       
       
        <?php // time to output all those posts! 
        if (have_posts()) : ?>
				
				
				
        <?php get_template_part( 'list-category-posts', get_post_format() ); ?>
				
				
				
				 
				 
				 
				 
				 
		   
		   	<?php else: // if no posts are found ?>
					
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
      
      
      
      
      
      
      
      


				
				
				<?php else:
				// this will be a category with sub-categories. First we'll display a nice big header image:
		
		    ?>
		    		<div id="main" class="grid_16 omega" role="main">
		
		        <div class="grid_10 alpha">
		         
	           <img src="<?php echo $main_img; ?>" class="category" />
			       <h1 class="main"><span><?php single_cat_title(); ?></span></h1>
			       </div>
			       
			       <div class="category-description grid_6 omega">
			       <div><?php echo category_description(); ?></div>
			       </div>
		
		
		
		
		
			<?php // and then we'll display every sub-category below the category, along with its image
			
	   $args = array('parent' => $yourcat->term_id, 'hide_empty'=>FALSE);
	   $terms = apply_filters('taxonomy-images-get-terms', '', array('having_images'=>FALSE, 'term_args'=>$args, 'hide_empty'=>FALSE));
	   
	   
	   $i = "alpha";
	   foreach ($terms as $term) {
	   $image = wp_get_attachment_image_src($term->image_id, 'full');
	   if ($image[0] == "") {
	     $image[0] = get_template_directory_uri()."/library/images/default.png";
	   }
	   $imageurl = get_template_directory_uri().'/library/timthumb.php?src='.$image[0].'&amp;h=200&amp;w=200';
	   
		 $num_lines = count_lines($term->name); 				
	   if ($num_lines == 3) { 
	     $three = " three-line"; 
	   } else {
	     $three = "";
	   }
	   $subcat_title = $term->name;
	   if (count_words($subcat_title) == 2) {
	     $subcat_title = str_replace(' ', ' <br/>', $subcat_title);
	   }
	   
	     echo '<div class="grid_8 category-preview '.$i. $three.'">';
	     echo '<a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '"><img src="' . $imageurl . '" /></a>';
	     echo '<div class="subcat"><h2><a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '"><span class="subcat-title">' .$subcat_title. '<span></a></h2>';
       echo "<p>". string_limit_sentences($term->description, 1) ."</p>";
       //echo $num_lines;
       echo '</div></div>';
          if ($i == "alpha") {
            $i = "omega";
          } else {
            $i = "alpha";
          }
        }
   
	   
 
		
  // if this is the What We Do page, show a link to NeighborWoods
  if (is_category('what-we-do')) { ?>
    <div class="grid_8 category-preview <?php echo $i; ?> three-line"><a href="http://neighborwoodsmonth.org"><img src="http://actrees.org/wp-content/themes/actrees_bones/library/timthumb.php?src=http://actrees.org/wp-content/uploads/2012/03/42.jpg&amp;h=200&amp;w=200" /></a><div class="subcat"><h2><a href="http://neighborwoodsmonth.org"><span class="subcat-title"><span class="word_1">National</span> <span class="word_2">NeighborWoods&trade;</span> <span class="word_3">Month</span> <span></a></h2><p>Support this national Fall event  that puts the spotlight on trees.</p></div></div>
 <?php  }	


   // if this is the What We Do page, show a link to NeighborWoods
  if (is_category('plant-our-future')) { ?>
    <div class="grid_8 category-preview <?php echo $i; ?> two-line"><a href="https://donatenow.networkforgood.org/1438087"><img src="http://actrees.org/wp-content/themes/actrees_bones/library/timthumb.php?src=http://actrees.org/wp-content/uploads/2014/05/351GS3_1929.jpg&amp;h=200&amp;w=200" /></a><div class="subcat"><h2><a href="https://donatenow.networkforgood.org/1438087"><span class="subcat-title"><span class="word_1">Become a Sponsor</span></a></h2><p>Make a donation to the Plant Our Future program.</p></div></div>
 <?php  }   	
				
				 endif; ?>

					
					
					
					
					
									
					
					
								
					

			
				
    
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
