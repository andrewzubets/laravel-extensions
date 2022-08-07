<?php 
/**
 * Href or route
 * 
 * Second parameter route. If it not empty it will use laravel's route function to make href otherwise use provided first parameter
 * 
 * @param string $href
 * @param string $route
 * @return string
 */
function az_routes_href_route($href, $route){
	if(empty($route)) return $href;
	return route($route);
}


?>