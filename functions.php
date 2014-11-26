<?php
/*
Author: sarah semark
URL: htp://triggersandsparks.com

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

// Get Bones Core Up & Running!
require_once('library/bones.php');            // core functions (don't remove)
require_once('library/plugins.php');          // plugins & extra functions (optional)
require_once('library/custom-post-type.php'); // custom post type example

// Admin Functions (commented out by default)
// require_once('library/admin.php');         // custom admin functions

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
add_image_size( 'category-preview', 220, 220, true ); 
add_image_size( 'category-main', 580, 220, true ); 
add_image_size( 'category-sidebar', 260, 400, true ); 


/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
    	'id' => 'home_l',
    	'name' => 'Left Homepage Sidebar',
    	'description' => 'The left-hand side of the homepage.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));

    register_sidebar(array(
    	'id' => 'home_r',
    	'name' => 'Right Homepage Sidebar',
    	'description' => 'The right-hand side of the homepage.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    

    register_sidebar(array(
    	'id' => 'footer1',
    	'name' => 'First Footer Area',
    	'description' => 'This is the first column that appears in the footer.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s grid_2 push_1 alpha">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));

    register_sidebar(array(
    	'id' => 'footer2',
    	'name' => 'Second Footer Area',
    	'description' => 'This is the second column that appears in the footer.',
      'before_widget' => '<div id="%1$s" class="widget %2$s grid_3 push_1">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
    	'id' => 'footer3',
    	'name' => 'Third Footer Area',
    	'description' => 'This is the third column that appears in the footer.',
      'before_widget' => '<div id="%1$s" class="widget %2$s grid_6 push_1">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));

    register_sidebar(array(
    	'id' => 'footer4',
    	'name' => 'Fourth Footer Area',
      'description' => 'This is the fourth column that appears in the footer.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s grid_4 push_1 omega">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));


    
} // don't remove this bracket!


/*************** CATEGORY DISPLAY MANAGEMENT *********************

 * Tests if any of a post's assigned categories are descendants of target categories
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7
 * @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
 */
if ( ! function_exists( 'post_is_in_descendant_category' ) ) {
	function post_is_in_descendant_category( $cats, $_post = null ) {
		foreach ( (array) $cats as $cat ) {
			// get_term_children() accepts integer ID only
			$descendants = get_term_children( (int) $cat, 'category' );
			if ( $descendants && in_category( $descendants, $_post ) )
				return true;
		}
		return false;
	}
}



/************* WRAP HEADERS WITH SPANS  *********************/



function add_title_spans($content) {
  $words = explode(' ', $content);
  $count = 1;
  foreach ($words as $word) {
    $return .= '<span class="word_'.$count.'">'.$word.'</span> ';
    $count++;
  }
  return $return;
}

// add to widget titles

//add_filter('widget_title', 'add_title_spans');
//add_filter('link_category', 'add_title_spans');
//add_filter('twitter-widget-title', 'add_title_spans');
//add_filter('mc_subheader_content', 'add_title_spans');




/************* COUNT LINE-HEIGHT OF .SUBCAT H2s  *********************/
function count_lines_old($string) {
  $words = explode(' ', $string);
  $lines = 0;
  $prev_line_length = 0;
  foreach ($words as $word) {
    $word_length = strlen($word);
    $cur_line_length = $word_length + $prev_line_length;
    if ($cur_line_length > 19) {
      $lines++;
      $prev_line_length = $cur_line_length;
    } else {
      $prev_line_length = $cur_line_length;
    }
  }
  $lines++;
  return $lines;
}

/************* COUNT LINE-HEIGHT OF .SUBCAT H2s  *********************/
function count_lines($string) {
  $words = explode(' ', $string);
  $num_words =  count($words);
  $wordcount = array('');
  foreach ($words as $word) {
    array_push($wordcount, strlen($word));
  }
  
  if ($num_words == 2 or $num_words == 1) {
    $lines = 2;
  } else {
    if ($wordcount[1] > 8 AND $wordcount[2] > 8 AND $wordcount[3] + $wordcount[4] > 3) {
      $lines = 3;
    } elseif ($wordcount[2] > 12) {
      $lines = 3;
    } elseif ($num_words > 3 AND $wordcount[1] + $wordcount[2] + $wordcount[3] > 15 AND $wordcount[3] + $wordcount[4] > 14) {
      $lines = 3;
    } elseif ($wordcount[1] + $wordcount[2] + $wordcount[3] > 32) {
      $lines = 3;
    } elseif ($num_words > 3 AND $wordcount[1] + $wordcount[2] > 6 AND $wordcount[3] > 8 AND $wordcount[4] > 4) {
      $lines = 3;
    } elseif ($num_words > 5 AND $wordcount[1] + $wordcount[2] + $wordcount[3] > 15 AND $wordcount[4] + $wordcount[5] + $wordcount[6] > 12) {
      $lines = 3;
    } elseif ($num_words == 3 AND $wordcount[1] + $wordcount[2] > 13 AND $wordcount[2] + $wordcount[3] > 13) {
      $lines = 3;
    } else {
      $lines = 2;
    }
  } 
  return $lines;
}





/************* COUNT WORDS  *********************/
function count_words($string) {
  $words = explode(' ', $string);
  $words = count($words);
  return $words;
}






/************* CUSTOM EXCERPT LENGTHS  *********************/

 
function string_limit_words($string, $word_limit) {
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit) {
    array_pop($words);
    //add a ... at last article when more than limit word count
    $return = implode(' ', $words)."..."; 
  } else {
    $return = implode(' ', $words); 
  }
  return $return;
}



/************* CUSTOM EXCERPT LENGTHS (SENTENCE-BASED)  *********************/

 
function string_limit_sentences($string, $sentence_limit) {
  $sentences = explode('.', $string, ($sentence_limit + 1));
  if(count($sentences) > $sentence_limit) {
    array_pop($sentences);
    //add a ... at last article when more than limit word count
    $return = implode(' ', $sentences)."."; 
  } else {
    $return = implode(' ', $sentences); 
  }
  return $return;
} 




/************* FILTER OUT SIMPLEMAP'S FORM *********************/

function change_search_title($original_value) {
    return '<h4>Find locations</h4>';
}
add_filter( 'sm-location-search-title', 'change_search_title' );







/************* CUSTOM MAP ICONS *********************/
function sm_insert_custom_markers() {
    ?>
     <script type='text/javascript'>
    function simplemapCustomMarkers( locationData ) {
        // http://code.google.com/apis/maps/documentation/javascript/overlays.html#ComplexIcons

        var options = {};
            options.icon = new google.maps.MarkerImage( 
                '/wp-content/themes/actrees_bones/library/images/map_icon.png', // URL of the marker image
                new google.maps.Size(20, 27),   // Size of image is 20px wide by 30px tall
                new google.maps.Point(0,0),     // We're just creating a base point here
                new google.maps.Point(0,30)     // This is the anchor of the image... the part of the image that points to the location
            );

            //options.shadow = new google.maps.MarkerImage( 
                //'http://code.google.com/apis/maps/documentation/javascript/examples/images/beachflag_shadow.png', // URL of the marker image
                //new google.maps.Size(20, 32),   // Size of image is 20px wide by 30px tall
                //new google.maps.Point(0,0),     // We're just creating a base point here
                //new google.maps.Point(0,32)     // This is the anchor of the image... the part of the image that points to the location
           // );

            // You don't need to do the shape if you want the whole image clickable. This makes only the flag clickable, not the pole or the shadow.
            //options.shape = {
              //  coord: [1, 1, 1, 20, 18, 20, 18 , 1],
               // type: 'poly'
          //  }
        return options;
    }
    </script>
    <?php
}
add_action('wp_head','sm_insert_custom_markers');






/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php echo get_avatar($comment,$size='32',$default='<path_to_url>' ); ?>
				<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
				<?php edit_comment_link(__('(Edit)'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
       			<div class="help">
          			<p><?php _e('Your comment is awaiting moderation.') ?></p>
          		</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
  google.load(\'search\', \'1\');
  google.setOnLoadCallback(function() {
    google.search.CustomSearchControl.attachAutoCompletion(
      \'008674024808968027636:zcio2evmbzo\',
      document.getElementById(\'q\'),
      \'cse-search-box\');
  });
</script>
<form action="/search-results" id="cse-search-box" class="grid_6 push_1 omega">
    <input type="hidden" name="cx" value="008674024808968027636:zcio2evmbzo" />
    <input type="hidden" name="cof" value="FORID:10" />
    <input type="hidden" name="ie" value="UTF-8" />
    <input type="text" name="q" id="q" autocomplete="off" size="31" />
    <input type="submit" name="sa" value="Search" />
</form>
<script type="text/javascript" src="http://www.google.com/cse/brand?form=cse-search-box&lang=en"></script>';
    return $form;
} // don't remove this bracket!


?>