<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * API RESTfull
 *
 * Methods:
 *   POST   : Create
 *   GET    : Read
 *   PUT    : Update
 *   DELETE : Delete
 * 
 * Ex:
 * 
 *   $route['products']['put'] = 'product/insert';
 *   $route['products/(:num)']['DELETE'] = 'product/delete/$1';
 */

$route['default_controller'] = 'Welcome';

/* Chinchilla section */
$route['Chinchilla'] = 'Chinchilla';

$route['Chinchilla/(:any)']['DELETE'] = 'Chinchilla/$1';
$route['Chinchilla/(:any)']['GET'] = 'Chinchilla/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = false;
