<?php

class AnswersSheet extends AppModel {
	
	/**
	 * Build answer data to save
	 * 
	 * @param array $userAnswers User answers data
	 * @return array Answers sheet data to save
	 */
	public function prepareUserAnswers($userAnswers) {
		$answersSheet = array();
		
		foreach ($userAnswers["UsersAnswer"] as $answerSheetID => $answers) {
			if (is_array($answers["answer_id"])) {
				foreach ($answers["answer_id"] as $answer) {
					$answersSheet[]["UsersAnswer"] = array(
						"answers_sheet_id" => $answerSheetID,
						"answer_id" => $answer
					);
				}
			} else {
				$answersSheet[]["UsersAnswer"] = array(
					"answers_sheet_id" => $answerSheetID,
					"answer_id" => $answers["answer_id"]
				);
			}
		}
		
		return $answersSheet;
	}
}
