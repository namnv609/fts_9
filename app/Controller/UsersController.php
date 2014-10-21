<?php
class UsersController extends AppController {

	public function index() {
	}
	
	public function register() {
		if ($this->request->is("post")) {
			$user = $this->request->data["User"];
			$this->User->setValidation('userRegister');
			$this->User->set($user);
			
			if ($this->User->validates()) {
				$this->User->create();
				
				if ($this->User->save($user, FALSE)) {
					$this->Session->setFlash(__('Register successful. Please login'));
					$this->redirect('/login');
				} else {
					$this->Session->setFlash(__('An error occurred when register. Please try again little bit'));
				}
			}
		}
		
		$this->set('title_for_layout', __('Register'));
		$this->layout = "user";
	}
	
	public function login() {
		if ($this->request->is('post')) {
			$user = $this->request->data["User"];
			$this->User->setValidation('userLogin');
			$this->User->set($user);
			
			if ($this->User->validates()) {
				if ($this->Auth->login()) {
					if ($this->request->data["User"]["remember_me"] == 1) {
						$this->Cookie->write('UserCookie', $this->Auth->user());
					}

					return $this->redirect($this->Auth->redirectUrl());
				}
			
				$this->Session->setFlash('Email or password is invalid');
			}
		}
		
		$this->set('title_for_layout', __('Login'));
		$this->layout = "user";
	}
	
	public function logout() {
		$this->Cookie->delete('UserCookie');
		
		return $this->redirect($this->Auth->logout());
	}
	
	public function admin_index() {
	}
}
