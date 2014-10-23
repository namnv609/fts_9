<?php

App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	
	public $actsAs = array('Multivalidatable');
	public $validationSets = array(
		'userRegister' => array(
			'name' => array(
				'rule' => 'notEmpty',
				'message' => 'Full name is required'
			),
			'email' => array(
				'valid' => array(
					'rule' => 'email',
					'message' => 'Email is empty or is invalid'
				),
				'unique' => array(
					'rule' => 'isUnique',
					'message' => 'This email is already used by another user.'
				)
			),
			'confirm_email' => array(
				'rule' => array('compareTwoFields', 'email'),
				'message' => 'Confirm email does not match'
			),
			'password' => array(
				'rule' => array('minLength', 8),
				'message' => 'Password require minimum 8 characters long'
			),
			'confirm_password' => array(
				'rule' => array('compareTwoFields', 'password'),
				'message' => 'Confirm password does not match'
			)
		),
		'userLogin' => array(
			'email' => array(
				'rule' => 'email',
				'message' => 'Email is empty or invalid'
			),
			'password' => array(
				'rule' => 'notEmpty',
				'message' => 'Password is required'
			)
		),
		'userUpdate' => array(
			'name' => array(
				'rule' => 'notEmpty',
				'message' => 'Name is required'
			),
			'password' => array(
				'rule' => array('minLength', 8),
				'message' => 'Password require minimum 8 characters long'
			),
			'confirm_password' => array(
				'rule' => array('compareTwoFields', 'password'),
				'message' => 'Confirm password does not match'
			),
			'avatar' => array(
				'rule' => array('extension', array('png', 'jpg', 'bmp', 'jpeg')),
				'message' => 'Please supply a valid image (png, jpg, bmp, jpeg)',
				'last' => TRUE
			)
		)
	);
	
	/**
	 * Compare two fields
	 * 
	 * @param type $field Fields list
	 * @param type $compareField Field to compare
	 * @return boolean Is match
	 */
	public function compareTwoFields($field = array(), $compareField = NULL) {
		$fieldName = "";
		
		foreach($field as $key => $value) {
			$fieldName = $key;
			break;
		}
		
		if ($this->data[$this->name][$fieldName] === $this->data[$this->name][$compareField]) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	/**
	 * Encrypt password before save
	 * 
	 * @param type $options
	 * @return boolean
	 */
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]["password"])) {
			$passwordHasher = new BlowfishPasswordHasher();
			
			$this->data[$this->alias]["password"] = $passwordHasher->hash($this->data[$this->alias]["password"]);
		}
		
		return TRUE;
	}
}
