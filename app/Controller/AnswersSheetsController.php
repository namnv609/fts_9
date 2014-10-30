<?php

class AnswersSheetsController extends AppController {
	
	public $uses = array(
		"Answer",
		"AnswersSheet",
		"Subject",
		"UsersAnswer",
		"Examination"
	);
	
	public function index($id = 0) {
		$questionIDs = $this->AnswersSheet->find("list", array(
			"conditions" => array(
				"AnswersSheet.examination_id" => $id
			),
			"fields" => array("AnswersSheet.id", "AnswersSheet.question_id")
		));
		$examinationStatus = $this->Examination->find("list", array(
			"conditions" => array(
				"Examination.id" => $id
			),
			"fields" => array("Examination.id", "Examination.status")
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
		$isCorrect = array(
			0 => FALSE,
			1 => TRUE
		);
		
		if ($this->Auth->user("admin") == 1) {
			$this->layout = "admin";
			$this->view = "admin_index";
		} else {
			$this->layout = "default";
			if ($examinationStatus[$id] > 0) {
				$isCorrect = array(
					0 => __("Incorrect"),
					1 => __("Correct")
				);
				
				$this->view = "view";
			}
		}
		
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
				"endTime",
				"answerCorrect",
				"isCorrect"
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
				$endTime,
				$this->UsersAnswer->answerCorrect($questionIDs),
				$isCorrect
			)
		);
	}
	
	public function save() {
		if ($this->request->is("post")) {
			$userAnswers = $this->request->data;
			$this->UsersAnswer->set($userAnswers);
			
			if ($this->UsersAnswer->validates()) {
				$answersSheet = $this->AnswersSheet->prepareUserAnswers($userAnswers);
				
				$this->Examination->save($userAnswers["Examination"]);
				$this->UsersAnswer->create();
				$this->UsersAnswer->saveMany($answersSheet);
			} 
		}
		
		$this->redirect('/');
	}
	
	public function admin_check() {
		if ($this->request->is("post")) {
			$this->loadModel("Examination");
			$userAnswers = $this->request->data["Answer"];
			$answerCheck = array();
			
			foreach ($userAnswers as $id => $answer) {
				$answerCheck["UsersAnswer"][] = array(
					"id" => $id,
					"answer_correct" => $answer["answer_correct"]
				);
			}
			
			$examinationID = $this->AnswersSheet->find("list", array(
				"conditions" => array(
					"AnswersSheet.id" => $answerCheck["UsersAnswer"][0]['id']
				),
				"fields" => array("AnswersSheet.examination_id")
			));
			$answerCheck["Examination"] = array(
				"id" => reset($examinationID),
				"status" => 2
			);
			
			if (!$this->UsersAnswer->saveAll($answerCheck["UsersAnswer"])) {
				throw new Exception(__("An error occurred. Please try again later"));
			} else {
				$this->loadModel('Examination');
				$this->Examination->save($answerCheck["Examination"]);
			}
		}
		
		$this->redirect(array("controller" => "examinations", "action" => "index", "admin" => TRUE));
	}
}
