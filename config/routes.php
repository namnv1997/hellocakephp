<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    $routes->connect('/admin', ['controller' => 'Admins', 'action' => 'index']);
    $routes->connect('/frontend', ['controller' => 'Frontend', 'action' => 'index']);

    $routes->connect('/admin/categories', ['controller' => 'Categories', 'action' => 'categories']);
    $routes->connect('/admin/categories/getNameCategory', ['controller' => 'Categories', 'action' => 'getNameCategory']);
    $routes->connect('/admin/categories/paginationCallData', ['controller' => 'Categories', 'action' => 'paginationCallData']);
    $routes->connect('/admin/categories/add', ['controller' => 'Categories', 'action' => 'add']);
    $routes->connect('/admin/categories/edit', ['controller' => 'Categories', 'action' => 'edit']);
    $routes->connect('/admin/categories/delete', ['controller' => 'Categories', 'action' => 'delete']);

    $routes->connect('/admin/posts', ['controller' => 'Posts', 'action' => 'posts']);
    $routes->connect('/admin/posts/paginationCallData', ['controller' => 'Posts', 'action' => 'paginationCallData']);
    $routes->connect('/admin/posts/getTitlePost', ['controller' => 'Posts', 'action' => 'getTitlePost']);
    $routes->connect('/admin/posts/getInfoPost', ['controller' => 'Posts', 'action' => 'getInfoPost']);
    $routes->connect('/admin/posts/add', ['controller' => 'Posts', 'action' => 'add']);
    $routes->connect('/admin/posts/edit', ['controller' => 'Posts', 'action' => 'edit']);
    $routes->connect('/admin/posts/delete', ['controller' => 'Posts', 'action' => 'delete']);
    $routes->connect('/admin/posts/uploadFiles', ['controller' => 'Posts', 'action' => 'uploadFiles']);
    $routes->connect('/posts/getMorePost', ['controller' => 'Posts', 'action' => 'getMorePost']);

    $routes->connect('/admin/comments', ['controller' => 'Comments', 'action' => 'comments']);
    $routes->connect('/admin/comments/changePaginationComment', ['controller' => 'Comments', 'action' => 'changePaginationComment']);
    $routes->connect('/admin/comments/confirmComment', ['controller' => 'Comments', 'action' => 'confirmComment']);

    $routes->connect('/frontend/details', ['controller' => 'Frontend', 'action' => 'details']);
    $routes->connect('/frontend/category-info', ['controller' => 'Frontend', 'action' => 'categoryOInfo']);
    $routes->connect('/frontend/login', ['controller' => 'Frontend', 'action' => 'login']);
    $routes->connect('/frontend/sign-up', ['controller' => 'Frontend', 'action' => 'signUp']);


});

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
