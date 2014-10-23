<?php

class Subject extends AppModel {
	public $hasMany = array(
		"Question"
	);
	public $validate = array(
		"name" => array(
			"rule" => "notEmpty",
			"message" => "Name is required"
		),
		"time" => array(
			"empty" => array(
				"rule" => "notEmpty",
				"message" => "Time is required"
			),
			"numeric" => array(
				"rule" => "numeric",
				"message" => "Time must be numeric"
			),
			"greaterThan" => array(
				"rule" => array("comparison", ">=", 10),
				"message" => "Time must be greater than or equals 10 minutes"
			)
		)
	);
}
