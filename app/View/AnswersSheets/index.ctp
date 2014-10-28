<div class="row">
	<div class="large-3 columns">
		<?php echo __("Start at: ") .  $startTime["AnswersSheet"]["start"]; ?>
	</div>
	<div class="large-3 columns">
		<?php
			echo __("Time left:");
		?>
		<span id="time-left" data-end-time="<?php echo $endTime; ?>">
			<span class="hours">00</span>:<span class="minutes">00</span>:<span class="seconds">00</span>
		</span>
	</div>
</div>
<div class="row">
	<h1><?php echo $title_for_layout; ?></h1>
</div>
<?php
	echo $this->Form->create("UsersAnswer", array(
		'url' => '/answers_sheets/save',
		'type' => 'post',
		'inputDefaults' => array(
			'div' => array('class' => 'large-12 columns'),
			'between' => '<div class="answer">',
			'after' => '</div>'
		),
		'id' => 'AnswersSheet'
	));
	
	if (count($questions) > 0) :
		echo $this->Form->hidden("Examination.id", array(
			'default' => $examinationID
		));
		echo $this->Form->hidden('Examination.status', array(
			'default' => '1'
		));
	
		foreach ($questions as $question) :
			$answerSheetID = $question["Question"]["answers_sheet_id"];
?>
	<div class="row">
		<div class="question">
			<?php echo $question["Question"]["question"]; ?>
		</div>
		<?php
			echo $this->Form->input("UsersAnswer.$answerSheetID.answer_id", array(
				"type" => $answerType[$question["Question"]["type"]],
				"options" => $question["Answer"],
				"legend" => FALSE,
				"multiple" => "checkbox",
				"label" => $answerLabel[$question["Question"]["type"]],
			));
		?>
	</div>
<?php
		endforeach;
	endif;
?>
	<div class="row">
		<?php echo $this->Form->button(__("Save"), array('class' => 'btn')); ?>
	</div>
<?php
	echo $this->Form->end();
	echo $this->Html->script('jquery.downCount', array('inline' => FALSE));
	echo $this->Html->scriptStart(array('inline' => FALSE));
?>
	$(function(){
		var endTime = $("#time-left").data("end-time");
		
		$("#time-left").downCount({
			date: endTime,
			offset: +7
		}, function(){
			$("#AnswersSheet input[type=radio], #AnswersSheet input[type=checkbox]").prop("disabled", "disabled");
		});
	});
<?php
	echo $this->Html->scriptEnd();
