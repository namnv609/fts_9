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
		$isCorrect = array(
			0 => FALSE,
			1 => TRUE
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
		
		if ($this->Auth->user("admin") == 1) {
			$this->layout = "admin";
			$this->view = "admin_index";
		} else {
			$this->layout = "default";
		}
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
