<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'home', 'action' => 'index'));
	Router::connect('/register', array(
		'controller' => 'users',
		'action' => 'register'
	));
	Router::connect('/login', array(
		'controller' => 'users',
		'action' => 'login'
	));
	Router::connect('/logout', array(
		'controller' => 'users',
		'action' => 'logout'
	));
	Router::connect('/profile', array(
		'controller' => 'users',
		'action' => 'index'
	));
	Router::connect('/answers_sheets/:id',
		array(
			'controller' => 'answers_sheets',
			'action' => 'index',
			'id' => 0
		),
		array(
			'pass' => array('id'),
			'id' => '[0-9]+'
		)
	);
	
	Router::connect(ADMIN_ALIAS, array(
		'controller' => 'home',
		'action' => 'index',
		'admin' => TRUE
	));
	Router::connect(ADMIN_ALIAS . '/questions', array(
		'controller' => 'questions',
		'action' => 'index',
		'admin' => TRUE
	));
	Router::connect(ADMIN_ALIAS . '/questions/add',
		array(
			'controller' => 'questions',
			'action' => 'edit',
			'admin' => TRUE,
			'id' => 0
		),
		array(
			'pass' => array('id'),
			'id' => '[0]'
		)
	);
	Router::connect(ADMIN_ALIAS . '/questions/:id',
		array(
			'controller' => 'questions',
			'action' => 'edit',
			'admin' => TRUE,
			'id' => 0
		),
		array(
			'pass' => array('id'),
			'id' => '[0-9]+'
		)
	);
	Router::connect(ADMIN_ALIAS . '/questions/save', array(
		'controller' => 'questions',
		'action' => 'save',
		'admin' => TRUE
	));
	Router::connect(ADMIN_ALIAS . '/subjects', array(
		'controller' => 'subjects',
		'action' => 'index',
		'admin' => TRUE
	));
	Router::connect(ADMIN_ALIAS . '/subjects/add',
		array(
			'controller' => 'subjects',
			'action' => 'edit',
			'admin' => TRUE,
			'id' => 0
		),
		array(
			'pass' => array('id'),
			'id' => '[0]'
		)
	);
	Router::connect(ADMIN_ALIAS . '/subjects/:id',
		array(
			'controller' => 'subjects',
			'action' => 'edit',
			'admin' => TRUE,
			'id' => 0
		),
		array(
			'pass' => array('id'),
			'id' => '[0-9]+'
		)
	);
	Router::connect(ADMIN_ALIAS . '/subjects/save', array(
		'controller' => 'subjects',
		'action' => 'save',
		'admin' => TRUE
	));
	Router::connect(ADMIN_ALIAS . '/users', array(
		'controller' => 'users',
		'action' => 'index',
		'admin' => TRUE
	));
	Router::connect(ADMIN_ALIAS . '/users/:id',
		array(
			'controller' => 'users',
			'action' => 'edit',
			'admin' => TRUE,
			'id' => 0
		),
		array(
			'pass' => array('id'),
			'id' => '[0-9]+'
		)
	);
	Router::connect(ADMIN_ALIAS . '/users/save', array(
		'controller' => 'users',
		'action' => 'save'
	));
	Router::connect(ADMIN_ALIAS . '/examinations', array(
		'controller' => 'examinations',
		'action' => 'index',
		'admin' => TRUE
	));
	Router::connect(ADMIN_ALIAS . '/examinations/:id',
		array(
			'controller' => 'examinations',
			'action' => 'view',
			'admin' => TRUE
		),
		array(
			'pass' => array('id'),
			'id' => '[0-9]+'
		)
	);
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
