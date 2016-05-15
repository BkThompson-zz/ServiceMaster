<?php
function phptemplate_breadcrumb($breadcrumb) {

$separator = '';

  /*** Define your custom breadcrumb prefix here ***/
  $corporate_breadcrumb = array(l('Home','http://www.servicemaster.com')  ,l('Investors','')) ;
  

  //Remove "Home" and "Press" and replace it with our breadcrumb prefix
array_shift($breadcrumb);
//array_shift($breadcrumb);
  $corporate_breadcrumb_length = sizeof($corporate_breadcrumb);
  //Prepend the custom breadcrumb prefix to the current page breadcrumb
  for ($counter = $corporate_breadcrumb_length - 1; $counter >=0; $counter--) {
    array_unshift($breadcrumb, $corporate_breadcrumb[$counter]);
  }
  
  if (!empty($breadcrumb)) {
    if (!drupal_is_front_page()) {

      $is_search_page = array();
      if (isset($breadcrumb[$corporate_breadcrumb_length])) {
        preg_match('/\/search">Search/', $breadcrumb[$corporate_breadcrumb_length], $is_search_page);
      }

      // Cut off excess breadcrumb for search pages
      //We don't need the title of search page to be included in breadcrumb.
      if ($is_search_page) {
        $breadcrumb[$corporate_breadcrumb_length] = '<div class="breadcrumb-current">Search</div>';
        $breadcrumb = array_slice($breadcrumb, 0, $corporate_breadcrumb_length + 2);
      }
      else { 
        // If page has title, add it to the breadcrumb
        $title = drupal_get_title();
        if (!empty($title)) {
          $breadcrumb[] = $title;
        }
      }
    }

    	
	// Below is the old breadcrumb code
	// return '<div class="breadcrumb">'. implode('<span class="breadcrumb_arrow">&nbsp;</span>', $breadcrumb) .'</div>';
	
	
	// Below is the breadcrumb list code
	
	if (!empty($breadcrumb)) {
    $lastitem = sizeof($breadcrumb);
    $title = drupal_get_title();
    $crumbs = '<ul class="breadcrumbs">';
    $a = 1;
	
    foreach($breadcrumb as $value) {
	
		if ($a == 1) {
			$crumbs .= '<li>'. $value . '</li>';
			$a++;
		} else {
	
			if ($a!=$lastitem){
				$crumbs .= '<li>'. $value . '</li>';
				$a++;
			}
			else {
				$crumbs .= '<li>'.$value.'</li>';
			}
		}
	}
	
    $crumbs .= '</ul>';
  }
  return $crumbs;

// End of breadcrumb list code
	
	
	
  }
}

#
# Menu <ul> wrapper - classes, ids, and structure
#
function servicemaster_investorhq_2016_theme_menu_tree($tree) {
  return '<ul class="section-nav">'. $tree .'</ul>';
}


#
# Menu <li> - classes, ids, and structure
#
function servicemaster_investorhq_2016_theme_menu_item($link, $has_children, $menu = '', $in_active_trail = FALSE, $extra_class = NULL) {
  $class = ($menu ? 'expanded' : ($has_children ? 'collapsed' : 'leaf'));
  if (!empty($extra_class)) {
    $class .= ' '. $extra_class;
  }
  if ($in_active_trail) {
    $class .= ' active-trail';
  }
 
  // Add semi-unique class
  $class .= ' ' . preg_replace("/[^a-zA-Z0-9]/", "", strip_tags($link));
 
  $menu_item = str_replace(" ", "-", $menu);
  $menu_item = preg_replace("/[^a-zA-Z]+/", "", $menu_item);
  $menu_item = strtolower($menu_item);


  return '<li class="section-nav__li--primary '. $class . $menu_item .'">'. $link . $menu ."</li>\n";
}





// A THIRD OPTION
// we can also create a custom function(s) to handle the $primary_links or other array to be called from the page.tpl.php
// this can be very useful when the client has different markup for mobile and desktop menus
// to get the full menu array, define the following variable in your page.tpl.php and call it in the custom function
// $primary_links_full_tree = menu_tree_page_data('primary-links'); // or use menu_tree_all_data('primary-links') to show sub navs on all pages, useful for mobile
// if (isset($primary_links_full_tree)) { print servicemaster_investorhq_2016_custom_primary_links($primary_links_full_tree); }
// (note: it could also be passed the normal $primary_links array )
//

function servicemaster_investorhq_2016_custom_primary_links($tree) {
  // If client needs second levels, change class to 'cd-secondary-nav is-hidden'
  $output = '<ul class="single-level-nav is-hidden investors-submenu submenu">'; 
  $output .= '<li class="go-back"><a href="#">Back to Main Menu</a></li>';
  $items = array();
    if ($tree) {
        foreach ($tree as $item) {
         
            // Test to see if the item is enabled
            if ($item['link']['hidden'] == 0 ) {
             
                // test to see if item has a submenu, $item['below']
                if ($item['below']) {
                  $output .= '<li class="has-children">';
                  $output .= '<a href="#">'.t($item['link']['title']).'</a>';
                 
                  // and the output with a dropdown +/- icon
                  // this is the wrapper for our array of our sub-menu items
                  $output .= '<ul class="is-hidden">';
                  $output .= '<li class="go-back"><a href="#">Back to '.t($item['link']['title']).'</a></li>';
             
                    // this foreach $items prints the array of submenu items as plain links
                    foreach ($item['below'] as $subitem) {
                        if ($subitem['link']['hidden'] == 0 ) {
                          $output .=  '<li>'.l(t($subitem['link']['title']), $subitem['link']['href'], array( 'attributes' => array('class'=> ''), 'html' => true, 'query' => $subitem['link']['options']['query'] ) ).'</li>';
                        } // if subitem[link][hidden]
                    } // foreach subitem
                 
                    // close sub item list wrapper
                    $output .= "</ul>";
                    $output .= "</li>";
                } else {
                  $output .=  '<li>'.l(t($item['link']['title']), $item['link']['href'], array( 'attributes' => array('class'=> ''), 'html' => true, 'query' => $item['link']['options']['query'] )).'</li>';
                } // if/else item['below']
            } // if item[link][hidden]
        } // foreeach item
    } // if tree
    // close the mobile item wrapper
    $output .= "</ul>";
     
    // return our menu with markup
    return $output;
}


/**
 * Theme function for any file that is managed by FileField.
 *
 * It doesn't really format stuff by itself but rather redirects to other
 * formatters that are telling us they want to handle the concerned file.
 *
 * This function checks if the file may be shown and returns an empty string
 * if viewing the file is not allowed for any reason. If you need to display it
 * in any case, please use theme('filefield_file') instead.
 */
function servicemaster_investorhq_2016_filefield_item($file, $field) {
  if (filefield_view_access($field['field_name']) && filefield_file_listed($file, $field)) {
    return servicemaster_investorhq_2016_filefield_file($file);
  }
  return '';
}

/**
* Theme function for the 'generic' single file formatter. Added Filesize
*/
// overwrites bw_global_filefield_file($file)
function servicemaster_investorhq_2016_filefield_file($file) {
  // Views may call this function with a NULL value, return an empty string.
  if (empty($file['fid'])) {
    return '';
  }
  $path = $file['filepath'];
  $url = file_create_url($path);
  $icon = theme('filefield_icon', $file);
  // Set options as per anchor format described at
  // http://microformats.org/wiki/file-format-examples
  // TODO: Possibly move to until I move to the more complex format described
  // at http://darrelopry.com/story/microformats-and-media-rfc-if-you-js-or-css
  $options = array(
    'attributes' => array(
      'type' => $file['filemime'] . '; length=' . $file['filesize'],
    ),
  );
  // Use the description as the link text if available.
  if (empty($file['data']['description'])) {
    $link_text = $file['filename'];
  }
  else {
    $link_text = $file['data']['description'];
    $options['attributes']['title'] = $file['filename'];
  }
  // originally was "return '<div class="filefield-file">'. $icon . l($link_text, $url, $options) . ' (' . format_size($file['filesize']) . ')</div>';"

  $link_text_full = '<span>' . $link_text .'</span><span class="table-list__span--download">'. $file['filemime'] .'(' . format_size($file['filesize']) . ')</span>';

  return '<div class="filefield-file type-'.$file['filemime'].'">' . l($link_text_full, $url, $options) .'</div>';
  
}

