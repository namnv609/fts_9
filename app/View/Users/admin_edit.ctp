<?php
$answers = $this->data;
$flashMessage = $this->Session->flash();
$validationErrs = array_filter($this->validationErrors);

echo $this->Form->create('User', array(
	'class' => 'form-horizontal',
	'url' => ADMIN_ALIAS . '/users/save',
	'inputDefaults' => array(
		'div' => array('class' => 'form-group'),
		'between' => '<div class="col-md-10">',
		'after' => '</div>',
		'class' => 'form-control',
		'error' => FALSE
	),
	'type' => 'file',
	'novalidate' => 'novalidate'
));

echo $this->Custom->validationSummary($flashMessage, 'alert alert-success widget-inner');
echo $this->Custom->validationSummary($validationErrs, 'alert alert-danger widget-inner');

echo $this->Form->hidden('id');
echo $this->Form->input('name', array(
	'label' => array(
		'class' => 'col-md-2 control-label',
		'text' => __('Name')
	)
));
echo $this->Form->input('email', array(
	'label' => array(
		'class' => 'col-md-2 control-label',
		'text' => __('Email')
	),
	'disabled' => 'disabled'
));
echo $this->Form->input('password', array(
	'label' => array(
		'class' => 'col-md-2 control-label',
		'text' => __('Password')
	),
	'value' => ''
));
echo $this->Form->input('confirm_password', array(
	'label' => array(
		'class' => 'col-md-2 control-label',
		'text' => __('Confirm password')
	),
	'type' => 'password'
));
echo $this->Form->input('avatar', array(
	'label' => array(
		'text' => __('Avatar'),
		'class' => 'control-label col-md-2'
	),
	'type' => 'file'
));
?>
<div class="form-group">
	<label for="UserAvatar" class="control-label col-md-2">&nbsp;</label>
	<div class="col-md-10">
		<?php
			echo $this->Html->image($this->data["User"]["avatar"], array(
				'class' => 'user-profile-img',
				'alt' => __('User avatar')
			));
		?>
	</div>
</div>
<?php
	echo $this->Form->input('status', array(
		'label' => array(
			'text' => __('Status'),
			'class' => 'control-label col-md-2'
		),
		'type' => 'select',
		'options' => UsersController::$userStatus
	));
?>
<div class="form-group">
	<label class="control-label col-md-2"></label>
	<div class="col-md-10">
		<p class="alert-danger">
			<?php echo __("* Leave blank password if don't want to change"); ?>
		</p>
		<?php
			echo $this->Form->button('<i class="fa fa-save"></i> ' . __('Save'), array(
				'class' => 'btn btn-primary btn-success'
			));
		?>
	</div>
</div>
<?php
	echo $this->Form->end();
