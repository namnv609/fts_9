<?php

class Question extends AppModel {
	public static $SINGLE_CHOICE = 0;
	public static $MULTIPLE_CHOICE = 1;
	
	public $hasMany = array(
		"Answer"
	);
	public $belongsTo = array(
		"Subject"
	);
	public $validate = array(
		"question" => array(
			"rule" => "notEmpty",
			"message" => "Question is required"
		),
		"subject_id" => array(
			"rule" => "notEmpty",
			"message" => "Subject is required"
		)
	);
}
