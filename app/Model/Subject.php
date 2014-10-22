<?php

class Subject extends AppModel {
	public $hasMany = array(
		"Question"
	);
}
