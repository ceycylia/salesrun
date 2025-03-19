<?php

use App\Controllers\ClosingPipeline;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\Home;
use App\Controllers\Pipeline;
use App\Controllers\Master\Product;
use App\Controllers\VisitPipeline;

/**
 * @var RouteCollection $routes
 */

// Auth Route
$routes->get('/', 'Login::index');
$routes->post('/login/authenticate', 'Login::authenticate');



//  Home Route
$routes->get('/home', [Home::class, 'index']);


// Pipeline Route

$routes->get('/pipeline', [Pipeline::class, 'index']);

// Create
$routes->get('/pipeline/create', [Pipeline::class, 'create']);
$routes->post('/pipeline/store', [Pipeline::class, 'store']);
$routes->get('/pipeline/getPipelineDetails/(:num)', 'VisitPipeline::getPipelineDetails/$1');

// Update
$routes->get('/pipeline/edit/(:num)', [Pipeline::class, 'edit']);
$routes->post('pipeline/update/(:num)', [Pipeline::class, 'update']);

// Delete
$routes->delete('pipeline/delete/(:num)', [Pipeline::class, 'delete']);

// Fetch/Get Data
$routes->get('/pipeline/datatable', [Pipeline::class, 'pipelineData']); // iini url datatable nya
$routes->get('pipeline/getPipelines', 'VisitPipeline::getPipelines');

// master data 
$routes->get('/admin/master/product', [Product::class, 'index']);
$routes->get('/admin/master/product/datatable', [Product::class, 'productData']);
$routes->get('/admin/master/product/create', [Product::class, 'create']); // ini url nya berarti bukan product/create doang
$routes->get('/admin/master/product/edit/(:num)', [Product::class, 'edit']); // ini url nya berarti bukan product/create doang

// Visit Pipeline Route
$routes->get('/pipeline/visit', [VisitPipeline::class, 'index']);
$routes->get('/pipeline/visit/create', [VisitPipeline::class, 'createForm']);
$routes->post('/pipeline/visit/store', [VisitPipeline::class, 'store']);
// Edit
$routes->get('/pipeline/visit/edit/(:num)', [VisitPipeline::class, 'editForm']);
$routes->get('/pipeline/visit/datatable', [VisitPipeline::class, 'visitPipelineData']);


// Closing Pipeline Route
$routes->get('/pipeline/closing', [ClosingPipeline::class, 'index']);
$routes->post('/pipeline/closing', [ClosingPipeline::class, 'store']);
$routes->get('/pipeline/closing/datatable', [ClosingPipeline::class, 'visitPipelineData']);

service('auth')->routes($routes);



// $routes->get('/', 'Dashboard::index');