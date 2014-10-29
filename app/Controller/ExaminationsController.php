<?php

class ExaminationsController extends AppController {
	
	public $uses =array(
		"User",
		"Subject",
		"Examination",
		"Question",
		"AnswersSheet"
	);
	
	public function index() {
	}
	
	public function add() {
		if ($this->request->is("post")) {
			$this->Question->unbindModel(array(
				"hasMany" => array(
					"AnswersSheet",
					"Answer"
				)
			));
			
			$examination = $this->request->data;
			$userID = $this->Auth->user("id");
			$examination["Examination"]["user_id"] = $userID;
			$subjects = $this->Question->find("all", array(
				"conditions" => array(
					"Question.subject_id" => $examination["Examination"]["subject_id"]
				),
				"limit" => 20,
				"order" => "rand()"
			));
			
			if ($this->Examination->save($examination)) {
				$examinationID = $this->Examination->id;
				$answersSheets = array();
				
				foreach ($subjects as $subject) {
					$answersSheets[]["AnswersSheet"] = array(
						"user_id" => $userID,
						"examination_id" => $examinationID,
						"question_id" => $subject["Question"]["id"]
					);
				}
				
				$this->AnswersSheet->create();
				if (!$this->AnswersSheet->saveMany($answersSheets)) {
					throw new Exception(__("An error occurred when trying add new examination."));
				}
			}
		}
		
		$this->redirect('/');
	}
	
	public function admin_index() {
		$queryString = $this->request->query;
		$searchConditions = array();
		$examinationStatus = array(
			"" => __("---Status---"),
			"0" => __("Not yet started"),
			"1" => __("Unchecked"),
			"2" => __("Checked")
		);
		
		if (isset($queryString["user"])
			&& is_numeric($queryString["user"])
			&& $queryString["user"] > 0
		) {
			$searchConditions["Examination.user_id"] = $queryString["user"];
		} else {
			$queryString["user"] = "";
		}
		if (isset($queryString["subject"])
			&& is_numeric($queryString["subject"])
			&& $queryString["subject"] > 0
		) {
			$searchConditions["Examination.subject_id"] = $queryString["subject"];
		} else {
			$queryString["subject"] = "";
		}
		if (isset($queryString["status"])
			&& is_numeric($queryString["status"])
			&& $queryString["status"] >= 0
		) {
			$searchConditions["Examination.status"] = $queryString["status"];
		} else {
			$queryString["status"] = "";
		}
		
		$this->paginate = array(
			"limit" => AppController::$ITEM_PER_PAGE,
			"order" => array("Examination.id" => "DESC"),
			"paramType" => "querystring",
			"fields" => array(
				"Examination.*",
				"User.name",
				"Subject.name"
			),
			"conditions" => $searchConditions
		);
		
		$examinations = $this->paginate("Examination");
		$users = array('' => __('---User---'));
		$subjects = array('' => __('---Subject---'));
		
		$users += $this->User->find("list");
		$subjects += $this->Subject->find("list");
		
		$this->set(
			array(
				'title_for_layout',
				'examinations',
				'subjects',
				'users',
				'queryString',
				'examinationStatus'
			),
			array(
				__('Examinations Manage'),
				$examinations,
				$subjects,
				$users,
				$queryString,
				$examinationStatus
			)
		);
	}
}
