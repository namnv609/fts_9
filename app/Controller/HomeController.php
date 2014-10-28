<?php

class HomeController extends AppController {
	
	public $uses = array("Subject", "Examination", "AnswersSheet");
	
	public function index() {
		$userID = $this->Auth->user('id');
		$subjects = $this->Subject->find("list");
		$examinatons = $this->Examination->find("all", array(
			"conditions" => array(
				"Examination.user_id" => $userID
			),
			"order" => array("Examination.id" => "DESC")
		));
		$examinationStatus = array(
			0 => __("Not yet start"),
			1 => __("Uncheck"),
			2 => __("Checked")
		);
		
		$this->set(
			array(
				'title_for_layout',
				'subjects',
				'examinations',
				'examinationStatus'
			),
			array(
				__('Framgia Test Sytem'),
				$subjects,
				$examinatons,
				$examinationStatus
			)
		);
	}
	
	public function admin_index() {
	}
}
