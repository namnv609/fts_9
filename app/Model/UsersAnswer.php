<?php

class UsersAnswer extends AppModel {
	public $belongsTo = array(
		"AnswersSheet" => array(
			"foreignKey" => "answers_sheet_id"
		),
		"Answer"
	);
	
	public $validate = array(
		'answer_id' => array(
			'rule' => array('multiple', array(
				'min' => 1
			))
		)
	);
	
	/**
	 * Group answer id to answer sheet
	 * 
	 * @param array $questionIDS List question id. In case user not yet started examination
	 * @return array List answer id for checkbox or radio
	 */
	public function prepareUserAnswers($questionIDs) {
		$userAnswers = $this->find("all", array(
			"conditions" => array(
				"UsersAnswer.answers_sheet_id" => array_keys($questionIDs)
			)
		));
		
		$answerIDs = array();
		if (count($userAnswers) > 0) {
			foreach ($userAnswers as $userAnswer) {
				$answersSheetID = $userAnswer["UsersAnswer"]["answers_sheet_id"];
				$answerID = $userAnswer["UsersAnswer"]["answer_id"];

				$answerIDs["Answers"][$answersSheetID][] = $answerID;
				$answerIDs["UsersAnswer"][$answersSheetID][] = $userAnswer["UsersAnswer"]["id"];
			}

			foreach ($answerIDs["Answers"] as $key => $value) {
				if (count($value) <= 1) {
					$answerIDs["Answers"][$key] = (string) $value[0];
				}
			}
		} else {
			foreach ($questionIDs as $key => $question) {
				$answerIDs["Answers"][$key][] = array();
				$answerIDs["UsersAnswer"][$key][] = $question;
			}
		}
		
		return $answerIDs;
	}
	
	/**
	 * Get answer correct status
	 * 
	 * @param array $answerSheetIDs List answer sheet
	 * @return array List status correct of answer
	 */
	public function answerCorrect($answerSheetIDs) {
		$this->unbindModel(array(
			"belongsTo" => array(
				"AnswersSheet",
				"Answer"
			)
		));
		
		$answerCorrect = $this->find("list", array(
			"conditions" => array(
				"answers_sheet_id" => array_keys($answerSheetIDs)
			),
			"group" => "answers_sheet_id",
			"fields" => array(
				"id",
				"answer_correct"
			)
		));
		
		if (count($answerCorrect) <= 0) {
			foreach ($answerSheetIDs as $id) {
				$answerCorrect[$id] = 0;
			}
		}
		
		return $answerCorrect;
	}
}
