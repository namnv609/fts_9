<?php

class QuestionsController extends AppController {
	
	public $helpers = array('Paginator');
	public $paginate = array();
	public $subjects = array();
	
	public function beforeFilter() {
		parent::beforeFilter();
		
		$this->subjects = array('' => __('---Subjects---'));
		$this->loadModel('Subject');
		$this->subjects += $this->Subject->find("list");
	}
	
	public function index() {
	}
	
	public function admin_index() {
		$queryString = $this->request->query;
		$searchConditions = array();
		
		if (isset($queryString["subject"])
			&& is_numeric($queryString["subject"])
			&& $queryString["subject"] > 0
		) {
			$searchConditions["Question.subject_id"] = $queryString["subject"];
		}
		if (isset($queryString["keyword"]) && !empty($queryString["keyword"])) {
			$searchConditions += array(
				"OR" => array(
					"Question.question LIKE" => "%$queryString[keyword]%",
					"Subject.name LIKE" => "%$queryString[keyword]%"
				)
			);
		}
		
		$this->paginate = array(
			'limit' => AppController::$ITEM_PER_PAGE,
			'paramType' => 'querystring',
			'order' => array('Question.id' => 'DESC'),
			'fields' => array(
				'Question.*',
				'Subject.name'
			),
			'conditions' => $searchConditions
		);
		
		$questions = $this->paginate('Question');
		
		$this->set(
			array(
				'title_for_layout',
				'questions',
				'subjects',
				'queryString'
			),
			array(
				__('Question Manage'),
				$questions,
				$this->subjects,
				$queryString
			)
		);
	}
	
	public function admin_edit($id = 0) {
		$question = $this->Question->findById($id);
		
		if ($id != NULL && $question == NULL) {
			throw new Exception(__('Question ID is invalid'));
		}
		if ($id != NULL) {
			$this->request->data = $question;
		}
		
		$this->set(
			array(
				'title_for_layout',
				'subjects'
			),
			array(
				__('Edit Question'),
				$this->subjects
			)
		);
	}
	
	public function admin_save() {
		if ($this->request->is('post')) {
			$question = $this->request->data;
			$this->Question->set($question);
			$redirectUrl = ADMIN_ALIAS . '/questions/' . $question["Question"]["id"];
			$message = __('Update question successful.');
			
			if ($question["Question"]["id"] == "" || $question["Question"]["id"] == 0) {
				$this->Question->create();
				$redirectUrl = ADMIN_ALIAS . '/questions/add';
				$message = __('Insert new question successful');
			}
			if (isset($question["Answer"])) {
				$correctNumber = array_count_values(array_map(function($answers){
					return $answers["correct"];
				}, $question["Answer"]));
				
				if (isset($correctNumber["1"]) && $correctNumber["1"] >= 2) {
					$question["Question"]["type"] = Question::$MULTIPLE_CHOICE;
				} else {
					$question["Question"]["type"] = Question::$SINGLE_CHOICE;
				}
				
				$excludeAnswerIDs = array_map(function($answers){
					return $answers["id"];
				}, $question["Answer"]);
				
			}
			if ($this->Question->saveAll($question, array("validate" => "first", "deep" => TRUE))) {
				
				$this->Session->setFlash($message);
				
				$this->loadModel('Answer');
				$this->Answer->deleteAll(array(
					"NOT" => array(
						"Answer.id" => $excludeAnswerIDs
					),
					"Answer.question_id" => $question["Question"]["id"]
				), FALSE);
			}
		}
		
		$this->setAction('admin_edit');
	}

}
