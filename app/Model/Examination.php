<?php

class Examination extends AppModel {
	public $belongsTo = array(
		"Subject",
		"User"
	);
	public $hasMany = array("AnswersSheet");
}
