<?php

class AnswersSheetsController extends AppController {
	
	public $uses = array(
		"Answer",
		"AnswersSheet",
		"Subject",
		"UsersAnswer"
	);
	
	public function index($id = 0) {
		$questionIDs = $this->AnswersSheet->find("list", array(
			"conditions" => array(
				"AnswersSheet.examination_id" => $id
			),
			"fields" => array("AnswersSheet.id", "AnswersSheet.question_id")
		));
		$questions = $this->Answer->prepareQuestionsSheet($questionIDs);
		$subjectID = $questions[key($questions)];
		$startTime = $this->AnswersSheet->find("first", array(
			"conditions" => array(
				"AnswersSheet.examination_id" => $id
			),
			"fields" => array("AnswersSheet.start")
		));
		$subject = array(
			"Subject" => array(
				"name" => __("n/a")
			)
		);
		$answerType = array(
			0 => "radio",
			1 => "select"
		);
		$answerLabel = array(
			0 => TRUE,
			1 => FALSE
		);
		if (isset($subjectID) && count($subjectID) > 0) {
			$subject = $this->Subject->find("first", array(
				"fields" => "Subject.name, Subject.time",
				"conditions" => array(
					"Subject.id" => $subjectID["Question"]["subject_id"]
				)
			));
		}
		$endTime = date("m/d/Y H:i:s",
			strtotime(
				"+".$subject["Subject"]["time"]." mins",
				strtotime($startTime["AnswersSheet"]["start"]
			))
		);
		
		$this->set(
			array(
				"questions",
				"title_for_layout",
				"answerType",
				"answerLabel",
				"examinationID",
				"subject",
				"startTime",
				"userAnswers",
				"endTime"
			),
			array(
				$questions,
				$subject["Subject"]["name"],
				$answerType,
				$answerLabel,
				$id,
				$subject,
				$startTime,
				$this->UsersAnswer->prepareUserAnswers($questionIDs),
				$endTime
			)
		);
		
		if ($this->Auth->user("admin") == 1) {
			$this->layout = "admin";
		} else {
			$this->layout = "default";
		}
	}
}
