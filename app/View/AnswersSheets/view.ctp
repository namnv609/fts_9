<div class="row">
	<div class="large-3 columns">
		<?php echo __("Start at: ") .  $startTime["AnswersSheet"]["start"]; ?>
	</div>
	<div class="large-3 columns">
		<?php
			echo __("Time left:");
		?>
		<span>
			00:00:00
		</span>
	</div>
</div>
<div class="row">
	<h1><?php echo $title_for_layout; ?></h1>
</div>
<?php
	echo $this->Form->create("Result", array(
		'url' => '#',
		'type' => 'post',
		'inputDefaults' => array(
			'div' => array('class' => 'large-12 columns'),
			'between' => '<div class="answer">',
			'after' => '</div>'
		),
		'id' => 'AnswersSheet'
	));
	
	if (count($questions) > 0) :
	
		foreach ($questions as $question) :
			$answerSheetID = $question["Question"]["answers_sheet_id"];
			$userAnswerID = $userAnswers["UsersAnswer"][$answerSheetID][0];
?>
	<div class="row">
		<div class="question">
			<?php echo $question["Question"]["question"]; ?>
			<p class="answer-correct">
				<?php echo $isCorrect[$answerCorrect[$userAnswerID]]; ?>
			</p>
		</div>
		<?php
			echo $this->Form->input("UsersAnswer.$answerSheetID.answer_id", array(
				"type" => $answerType[$question["Question"]["type"]],
				"options" => $question["Answer"],
				"legend" => FALSE,
				"multiple" => "checkbox",
				"label" => $answerLabel[$question["Question"]["type"]],
				"disabled" => TRUE,
				"value" => $userAnswers["Answers"][$answerSheetID]
			));
		?>
	</div>
<?php
		endforeach;
	endif;

	echo $this->Form->end();
