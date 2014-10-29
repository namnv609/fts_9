<?php
	echo $this->Form->create("UsersAnswer", array(
		'class' => 'answers-sheet',
		'url' => ADMIN_ALIAS . '/answers_sheets/check',
		'inputDefaults' => array(
			'div' => array('class' => 'answer-group'),
			'error' => FALSE
		),
	));
	
	if (count($questions) > 0) :
		foreach ($questions as $question) :
			$questionID = $question["Question"]["id"];
			$answerSheetID = $question["Question"]["answers_sheet_id"];
			$userAnswerID = $userAnswers["UsersAnswer"][$answerSheetID][0];

			echo $question["Question"]["question"];
			echo $this->Form->input("UsersAnswer.$questionID.answer_id", array(
				"type" => $answerType[$question["Question"]["type"]],
				"options" => $question["Answer"],
				"legend" => FALSE,
				"multiple" => "checkbox",
				"label" => $answerLabel[$question["Question"]["type"]],
				"readonly" => "readonly",
				"value" => $userAnswers["Answers"][$answerSheetID],
				"disabled" => TRUE
			));

			echo $this->Form->input("Answer.$userAnswerID.answer_correct", array(
				"type" => "checkbox",
				"label" => array(
					"text" => __("Is correct?")
				),
				'checked' => $isCorrect[$answerCorrect[$userAnswerID]]
			));
		endforeach;
	endif;
	echo $this->Form->button(__("Checked"), array(
		'class' => 'btn btn-primary btn-success'
	));
	echo $this->Form->end();