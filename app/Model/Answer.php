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
}
