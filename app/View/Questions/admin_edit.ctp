<?php
$answers = $this->data;
$flashMessage = $this->Session->flash();
$validationErrs = array_filter($this->validationErrors);

echo $this->Form->create('Question', array(
	'class' => 'form-horizontal',
	'url' => ADMIN_ALIAS . '/questions/save',
	'inputDefaults' => array(
		'div' => array('class' => 'form-group'),
		'between' => '<div class="col-md-10">',
		'after' => '</div>',
		'class' => 'form-control',
		'error' => FALSE
	),
	'type' => 'post',
	'novalidate' => 'novalidate'
));

echo $this->Custom->validationSummary($flashMessage, 'alert alert-success widget-inner');
echo $this->Custom->validationSummary($validationErrs, 'alert alert-danger widget-inner');

echo $this->Form->hidden('id');
echo $this->Form->input('question', array(
	'type' => 'textarea',
	'label' => array(
		'class' => 'col-md-2 control-label',
		'text' => __('Question')
	)
));
?>
<div class="form-group">
	<label class="col-md-2 control-label">
		<?php echo __('Answers'); ?>
	</label>
	<div class="col-md-10 bordered">
		<?php
		echo $this->Form->button(__('<i class="fa fa-plus"></i> ' . __('Add answer')), array(
			'class' => 'btn btn-primary btn-success',
			'type' => 'button',
			'id' => 'addNewAnswer'
		));
		?>
		<div id="list-answer" data-confirm-message="<?php echo __('Are you sure you want to delete this answer?'); ?>">
			<?php
				if (isset($answers["Answer"]) && count($answers["Answer"]) > 0) :
					foreach ($answers["Answer"] as $key => $value) :
			?>
			<div class="form-group">
				<div class="col-md-9">
					<?php
						echo $this->Form->hidden("Answer.$key.id");
						echo $this->Form->input("Answer.$key.answer", array(
							"label" => FALSE,
							'class' => 'form-control',
							'between' => FALSE,
							'after' => FALSE,
							'div' => FALSE
						));
					?>
				</div>
				<div class="col-md-1">
					<?php
						echo $this->Form->input("Answer.$key.correct", array(
							'type' => 'checkbox',
							'label' => FALSE,
							'class' => 'form-control',
							'div' => FALSE
						));
					?>
				</div>
				<div class="col-md-1">
					<?php
						echo $this->Form->button('<i class="fa fa-times"></i>', array(
							'class' => 'btn btn-primary btn-danger remove-answer',
							'type' => 'button'
						));
					?>
				</div>
			</div>
			<?php
					endforeach;
				else :
			?>
			<div class="form-group">
				<div class="col-md-9">
					<?php
						echo $this->Form->hidden("Answer.0.id");
						echo $this->Form->input("Answer.0.answer", array(
							"label" => FALSE,
							'class' => 'form-control',
							'between' => FALSE,
							'after' => FALSE,
							'div' => FALSE
						));
					?>
				</div>
				<div class="col-md-1">
					<?php
						echo $this->Form->input("Answer.0.correct", array(
							'type' => 'checkbox',
							'label' => FALSE,
							'class' => 'form-control',
							'div' => FALSE
						));
					?>
				</div>
			</div>
			<?php
				endif;
			?>
		</div>
	</div>
</div>
<?php
	echo $this->Form->input('subject_id', array(
		'options' => $subjects,
		'label' => array(
			'text' => __('Subject'),
			'class' => 'control-label col-md-2'
		)
	));
?>
<div class="form-group">
	<label class="control-label col-md-2"></label>
	<div class="col-md-10">
		<?php
			echo $this->Form->button('<i class="fa fa-save"></i> ' . __('Save'), array(
				'class' => 'btn btn-primary btn-success'
			));
		?>
	</div>
</div>
<?php
	echo $this->Form->end();
?>
<div id="form-template" class="hidden">
	<div class="form-group">
		<div class="col-md-9">
			<input type="hidden" value="" />
			<input type="text" class="form-control" />
		</div>
		<div class="col-md-1">
			<input type="hidden" value="0" />
			<input type="checkbox" class="form-control" value="1" />
		</div>
		<div class="col-md-1">
			<button type="button" class="btn btn-primary btn-danger remove-answer">
				<i class="fa fa-times"></i>
			</button>
		</div>
	</div>
</div>
