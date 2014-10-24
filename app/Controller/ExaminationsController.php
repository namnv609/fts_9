<?php

class ExaminationsController extends AppController {
	
	public $uses =array(
		"User",
		"Subject",
		"Examination"
	);
	
	public function index() {
	}
	
	public function admin_index() {
		$queryString = $this->request->query;
		$searchConditions = array();
		$examinationStatus = array(
			"" => __("---Status---"),
			"1" => __("Checked"),
			"0" => __("Uncheck")
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
