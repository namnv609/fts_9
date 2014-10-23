<?php
$flashMessage = $this->Session->flash();
$validationErrs = array_filter($this->validationErrors);

echo $this->Form->create('Subject', array(
	'class' => 'form-horizontal',
	'url' => ADMIN_ALIAS . '/subjects/save',
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
echo $this->Form->input('name', array(
	'label' => array(
		'class' => 'col-md-2 control-label',
		'text' => __('Subject')
	)
));
echo $this->Form->input('time', array(
	'label' => array(
		'class' => 'col-md-2 control-label',
		'text' => __('Time (mins)')
	)
))
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
