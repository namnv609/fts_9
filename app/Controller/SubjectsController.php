<?php

class SubjectsController extends AppController {
	
	public $helpers = array('Paginator');
	public $paginate = array();
	
	public function index() {
	}
	
	public function admin_index() {
		$this->paginate = array(
			'limit' => AppController::$ITEM_PER_PAGE,
			'paramType' => 'querystring',
			'order' => array("Subject.id" => "DESC"),
			'fields' => array('Subject.*')
		);
		
		$subjects = $this->paginate('Subject');
		
		$this->set(
			array(
				'title_for_layout',
				'subjects'
			),
			array(
				__('Subjects Manage'),
				$subjects
			)
		);
	}
	
	public function admin_edit($id = 0) {
		$subject = $this->Subject->findById($id);
		$title = __('Insert Subject');
		
		if ($id != NULL && $subject == NULL) {
			throw new Exception(__("Subject ID is invalid"));
		}
		if ($id != NULL) {
			$this->request->data = $subject;
			$title = __('Edit Subject');
		}
		
		$this->set('title_for_layout', $title);
	}
	
	public function admin_save() {
		if ($this->request->is('post')) {
			$subject = $this->request->data["Subject"];
			$this->Subject->set($subject);
			$redirectUrl = ADMIN_ALIAS . '/subjects/' . $subject["id"];
			$message = __('Update subject successful.');
			
			if ($subject["id"] == "" || $subject["id"] == 0) {
				$redirectUrl = ADMIN_ALIAS . '/subjects/add';
				$message = __('Insert subject successful.');
				$this->Subject->create();
			}
			
			if ($this->Subject->save($subject)) {
				$this->Session->setFlash($message);
				
				$this->redirect($redirectUrl);
			}
		}
		
		$this->setAction('admin_edit');
	}
}
