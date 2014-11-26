				

					
		
			<?php // let's display three selected categories now!
			
			
			function showTaxonomy($this_category) {
				$args = array('slug' => $this_category, 'hide_empty'=>FALSE);
  			$terms = apply_filters('taxonomy-images-get-terms', '', array('having_images'=>FALSE, 'term_args'=>$args, 'hide_empty'=>FALSE));
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
  	   
  	     echo '<div class="grid_8 alpha category-preview '.$three.'">';
  	     echo '<a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '"><img src="' . $imageurl . '" /></a>';
  	     echo '<div class="subcat"><h2><a href="' . esc_url( get_term_link( $term, $term->taxonomy ) ) . '"><span class="subcat-title">' .$subcat_title. '<span></a></h2>';
         echo "<p>". string_limit_sentences($term->description, 1) ."</p>";
         echo '</div></div>';
        }
			}
			
	   
	   
		 showTaxonomy ('whos-who-in-your-state');      
	   showTaxonomy ('donate');
     showTaxonomy ('grants-and-awards');	
	   
	   
	   
	     
	   
 
	  ?> 
	    
		
					
					<?php if ( is_active_sidebar( 'home_r' ) ) : ?>

						<?php dynamic_sidebar( 'home_r' ); ?>

					<?php else : ?>

						<!-- This content shows up if there are no widgets defined in the backend. -->
						
						<div class="help">
						
							<p>Please activate some Widgets.</p>
						
						</div>

					<?php endif; ?>

