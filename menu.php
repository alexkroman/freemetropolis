<?php

include_once "includes/bootstrap.inc";
include_once "includes/common.inc";



//bars
echo ".|home|?q=||\n";
echo ".|bars|?q=place/bars|66\n";
echo "..|By Location|#|By Location\n";
make_menu(26,0,'place-bar');
echo "..|By Scene||By Scene\n";
make_menu(8,0,'place-bar');
echo "..|By Features||By Features\n";
make_menu(6,0,'place-bar');
echo "..|Good For...||Good For...\n";
make_menu(21,0,'place-bar');
echo "..|<strong>Bar Finder</strong>|?q=taxonomy_browser/place-bar|Bar Finder\n";
/**
 * Restaurants
 */

echo ".|restaurants|?q=place/restaurants|97\n";
echo "..|By Location|?q=taxonomy/page/or/26/place-restaurant|By Location\n";
make_menu(26,0,'place-restaurant');
echo "..|By Price|?q=taxonomy/page/or/12/place-resturant|By Price\n";
make_menu(12,0,'place-restaurant');
echo "..|By Cuisine||By Cuisine\n";
make_menu(11,0,'place-restaurant');
echo "..|By Features||By Features\n";
make_menu(20,0,'place-restaurant');
echo "..|Good For...||Good For...\n";
make_menu(22,0,'place-restaurant');
echo "..|<strong>Restaurant Finder</strong>|?q=taxonomy_browser/place-restaurant|Restaurant Finder\n";
echo ".|events|?q=place/event|94\n";
echo "..|By Location||By Location\n";
make_menu(26,0,'event');
echo "..|By Price||By Price\n";
make_menu(32,0,'event');
make_menu(16, 1, 'event');
echo "..|<strong>Event Finder</strong>|?q=taxonomy_browser/event|Event Finder\n";
echo ".|forum|?q=forum/125|forum\n";
echo ".|add-listing|?q=node/add|122\n";
echo "..|Add Bar|?q=node/add/place-bar/|Arts\n";
echo "..|Add Restaurant|?q=node/add/place-restaurant/|Arts\n";
//echo "..|Add Event|?q=node/add/event|General\n";
echo ".|whats-new|?q=tracker|whats-new\n";


function make_menu($termid, $offset = 0, $parent = '') {
	$tree = taxonomy_get_tree($termid);
	foreach ($tree as $term) {
		$skip = false;
		$depth = $term->depth;
	 
		if ($depth == -1) {
			$periods = '..';
		}
	 
		elseif ($depth == 0) {
			$periods = '...';
		}
		elseif ($depth == 1) {
			$periods = '....';
			$skip = true;
		}
		elseif ($depth == 2) {
			$periods = '.....';
			$skip = true;
		}
		elseif ($depth == 3) {
			$periods = '......';
			$skip = true;
		}
	 
		if ($offset) {
			$periods = "..";
		}
		if (isset($parent)) {
			$count = taxonomy_term_count_nodes($term->tid, $parent);
		}
		else {
			$count = taxonomy_term_count_nodes($term->tid);
		}
	 	$terms = $term->tid;
	 	$parents = null;
	 	$the_parents = array();
	 	$parents = taxonomy_get_children($terms);
	 	
	 	foreach ($parents as $parent_value) {
	 		$the_parents[] = $parent_value->tid;
	 	}
	 	if ($the_parents) {
	 	$parents = implode(",",$the_parents);
	 	}
	 	$terms = $terms;
	 	if ($parents) {
	 		$terms .= ',' . $parents;
	 	}
		if ($skip == false) {
			
			if (isset($parent)) {
				echo "$periods|" . trim($term->name) . " ($count)|?q=taxonomy/page/or/" . $terms . "/$parent|" . trim($term->name) . "\n";
				
			}
			else {
				echo "$periods|" . trim($term->name) . " ($count)|?q=taxonomy/page/or/" . $terms . "|" . trim($term->name) . "\n";
			}
		}
		
		}
}

?>