<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

	public $components = array(
		'Session',
		'Cookie',
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'email'),
					'passwordHasher' => 'Blowfish'
				)
			),
			'loginRedirect' => array(
				'controller' => 'home',
				'action' => 'index'
			),
			'logoutRedirect' => array(
				'controller' => 'users',
				'action' => 'login'
			),
			'loginAction' => array(
				'controller' => 'users',
				'action' => 'login',
				'admin' => FALSE
			)
		)
	);

	public function beforeFilter() {
		$this->Auth->allow('register');
		
		if ($this->Auth->user()) {
			if (empty($this->params["prefix"])) {
				$this->Auth->allow($this->action);
			} elseif (isset($this->params["prefix"])
				&& $this->Auth->user('admin') != 1
			) {
				$this->redirect('/');
			} else {
				$this->layout = "admin";
			}
		} else {
			$this->__checkCookie();
		}
	}
	
	/**
	 * Check user rememeber status
	 * 
	 * @return void User login state and redirect user
	 */
	private function __checkCookie() {
		$cookie = $this->Cookie->read('UserCookie');

		if (isset($cookie)) {
			$this->Session->write('Auth.User', $cookie);
			
			$this->redirect($this->Auth->redirectUrl());
		}
	}
}
