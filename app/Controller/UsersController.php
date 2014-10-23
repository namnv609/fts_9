<?php
class UsersController extends AppController {
	
	public $helpers = array('Paginator');
	public $paginate = array();
	public static $userStatus = array();
	
	public function beforeFilter() {
		parent::beforeFilter();
		
		static::$userStatus = array(
			1 => __("Activate"),
			0 => __("Inactivate")
		);
	}
	
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
		$this->paginate = array(
			'limit' => 2,
			'paramType' => 'querystring',
			'order' => array('User.id' => 'DESC'),
			'conditions' => array(
				'admin' => 0
			)
		);
		
		$users = $this->paginate('User');
		
		$this->set(
			array(
				'title_for_layout',
				'users'
			),
			array(
				__('Users Manage'),
				$users
			)
		);
	}
	
	public function admin_edit($id = 0) {
		$user = $this->User->findById($id);
		
		if ($id != NULL && $user == NULL) {
			throw new Exception(__("User ID is invalid"));
		}
		
		if ($id != NULL) {
			$this->request->data = $user;
		}
		
		$this->set(
			array(
				'title_for_layout',
				'user'
			),
			array(
				__('User Profile'),
				$user
			)
		);
	}
	
	public function save() {
		$userAction = "edit";
		$layout = "default";
		
		if ($this->request->is("post") || $this->request->is("put")) {
			$user = $this->request->data["User"];
			$this->User->setValidation("userUpdate");
			$userID = $this->Auth->user('id');
			$redirectUrl = "/profile/" . $userID;
			$userFields = array("name");
			
			if ($this->Auth->user('admin') == 1) {
				$userAction = "admin_edit";
				$userID = $user["id"];
				$redirectUrl = ADMIN_ALIAS . "/users/" . $userID;
				$layout = "admin";
			}
			
			$userAvatar = $this->__uploadAvatar($user["avatar"], $userID);
			
			if (!empty($user["password"])) {
				$userFields[] = "password";
				$userFields[] = "confirm_password";
			}
			if (!empty($user["avatar"]["name"])
				&& $userAvatar != ""
			) {
				$user["avatar"] = $userAvatar;
				$userFields[] = "avatar";
			}
			
			$this->User->set($user);
			
			if ($this->User->save(NULL, TRUE, $userFields)) {
				$this->Session->setFlash(__('Update user info successful.'));
				$this->redirect($redirectUrl);
			}
		}
		
		$this->setAction($userAction);
		$this->layout = $layout;
	}
	
	/**
	 * Upload avatar
	 * 
	 * @param array $file File info
	 * @param int $userId User id
	 * @return string File name in server. If upload fail, filename will be return empty
	 */
	private function __uploadAvatar($file, $userId) {
		$fileType = pathinfo($file["name"], PATHINFO_EXTENSION);
		$fileName = md5($userId) . '.' . $fileType;
		$destination = WWW_ROOT . 'img' . DS . $fileName;
		
		if (in_array($fileType, array('png', 'jpg', 'bmp', 'jpeg'))
			&& move_uploaded_file($file["tmp_name"], $destination)
		) {
			return $fileName;
		}
		
		return "";
	}
}
