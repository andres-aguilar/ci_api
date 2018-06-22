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
$route['Chinchilla']['GET']    = 'Chinchilla/test';
$route['Chinchilla']['POST']   = 'Chinchilla/testPost';
$route['Chinchilla']['PUT']    = 'Chinchilla/testPut';
$route['Chinchilla']['DELETE'] = 'Chinchilla/testDelete';

$route['404_override'] = '';
$route['translate_uri_dashes'] = false;
