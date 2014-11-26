<div id="sidebar">
				

<?php add_filter( 'wp_nav_menu_objects', 'submenu_limit', 10, 2 );

function submenu_limit( $items, $args ) {

    if ( empty($args->submenu) )
        return $items;

    $parent_id = array_pop( wp_filter_object_list( $items, array( 'title' => $args->submenu ), 'and', 'ID' ) );
    $children  = submenu_get_children_ids( $parent_id, $items );

    foreach ( $items as $key => $item ) {

        if ( ! in_array( $item->ID, $children ) )
            unset($items[$key]);
    }

    return $items;
}

function submenu_get_children_ids( $id, $items ) {

    $ids = wp_filter_object_list( $items, array( 'menu_item_parent' => $id ), 'and', 'ID' );

    foreach ( $ids as $id ) {

        $ids = array_merge( $ids, submenu_get_children_ids( $id, $items ) );
    }

    return $ids;
}



  
    
if (is_post) {  
  $category = get_the_category();
  $cat = $category[0]->cat_ID; 
}




// if we're on a 404 page, show the entire menu tree. 
if (is_404()) {
  $args = array('menu'    => 'Main Menu');
// otherwise, show only the menu tree from the parent category of the post or category we're currently on
} else {
  $parentCatList = get_category_parents($cat,false,',');
  $parentCatListArray = split(",",$parentCatList);
  $topParentName = $parentCatListArray[0];
  $sdacReplace = array(" " => "-", "(" => "", ")" => "");
  $topParent = strtolower(strtr($topParentName,$sdacReplace));
  $args = array(
    'menu'    => 'Main Menu',
    'submenu' => $topParentName,
  );
}



wp_nav_menu( $args );

?>




</div>