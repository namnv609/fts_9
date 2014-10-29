<?php

class Answer extends AppModel {
	public $belongsTo = array(
		"Question"
	);
	public $validate = array(
		"answer" => array(
			"empty" => array(
				"rule" => "notEmpty",
				"message" => "Please insert at least a answer"
			)
		)
	);
	
	/**
	 * Group answer and answer sheet id to question
	 * 
	 * @param array $questionIDs List id of question
	 * @return array Question sheet data
	 */
	public function prepareQuestionsSheet($questionIDs) {
		$questions = $this->find("all", array(
			"conditions" => array(
				"Question.id" => $questionIDs
			)
		));
		
		$questionsSheet = array();
		
		foreach ($questions as $question) {
			$questionID = $question["Question"]["id"];

			if (!isset($questionsSheet[$questionID])) {
				$questionsSheet[$questionID]["Question"] = array(
					"id" => $questionID,
					"question" => $question["Question"]["question"],
					"type" => $question["Question"]["type"],
					"answers_sheet_id" => array_search($questionID, $questionIDs),
					"subject_id" => $question["Question"]["subject_id"]
				);
			}
			
			$questionsSheet[$questionID]["Answer"][$question["Answer"]["id"]] = $question["Answer"]["answer"];
		}
		
		return $questionsSheet;
	}
}
