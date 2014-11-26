<?php
/*
Template Name: Date-based Archive
*/
?>


 
 <?php get_header(); ?>
    <div id="content" class="container">	

					<div id="main" class="grid_14 push_1" role="main">







<?php
// get the category id from a custom tag
$catergory = get_post_meta($post->ID, 'Category of posts', $single);



// set year to display current years' posts first
$currentYear = date('Y');
$nextYear = $currentYear + 1;

if (get_query_var("yearID")) {
  $year = get_query_var("yearID");
} else {
  $year = $currentYear;
  while (!postsInYear($year, $catergory)) {
    $year--;
  }
}




// test to see if there are posts for a given year, in a given category
function postsInYear ($year, $catergory) {
  $args=array(
	  'cat'     => $catergory,
	  'posts_per_page' => 1,
	  'caller_get_posts'=>1,
	  'year' =>  $year
	  	);
 $my_query = new WP_Query($args);
 if(!$my_query->have_posts() ) {
    return false;
  } else {
    return true;
  }
}



// for tag1, get all posts in descending date order, on change in Month Year print heading
	$args=array(
	  'cat'     => $catergory,
	  'posts_per_page' => 500,
	  'orderby' => 'date',
	  'order' => 'ASC',
	  'caller_get_posts'=>1,
	  'year' =>  $year
	  	);


	$my_query = new WP_Query($args);
  if(!$my_query->have_posts() ) {
    echo "No posts found for ".$year."!";
	} else {
	 echo "<h2>Archived posts for ".$year."</h2>";
	  $ymdate = '';
	   while ($my_query->have_posts()) : $my_query->the_post();
		 $ympost = mysql2date("F Y", $post->post_date);
		 if ( $ympost != $ymdate) {
		   if ($ymdate != '') {
		    echo '</ul>';
		   }
		   $ymdate = $ympost;
		   echo '<h3>'.$ymdate.'</h3>';
		   echo '<ul>';
		 }
		 ?>
		<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a> (<?php the_time('F j Y'); ?>)</li>
<?php	
	  endwhile;
    echo '</ul>'; 
	} //if ($my_query)
  wp_reset_query();  // Restore global post data stomped by the_post().

  
  // generate pagination links
  $prev = $year - 1;
  while ($prev != 1990 AND !postsInYear($prev, $catergory)) {
    $prev--;
  }
  
  $next = $year + 1;
  while ($next != $nextYear AND !postsInYear($next, $catergory)) {
    $next++;
  }  
  
  $previous_link = '<a href="'.get_permalink().'/?yearID='.$prev.'">'.$prev.' posts</a>';
  $next_link = '<a href="'.get_permalink().'/?yearID='.$next.'">'.$next.' posts</a>';

?>

<div class="navigation">
  <div class="alignleft"><?php if ($prev!=1990) {echo $previous_link; } ?></div>
  <div class="alignright"><?php if ($next!=$nextYear) {echo $next_link; } ?></div>
</div>




<!-- END CONTENT -->

   
			</div> <!-- end #content -->

<?php get_footer(); ?>