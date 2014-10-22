<?php
	$flashMessage = $this->Session->flash();
	
	echo $this->Form->create('User', array(
		'url' => '/register',
		'autocomplete' => 'off',
		'inputDefaults' => array(
			'div' => FALSE,
			'class' => 'text'
		),
		'novalidate' => 'novalidate'
	));
	echo $this->Custom->validationSummary($flashMessage);

	echo $this->Form->input('name', array(
		'class' => 'text',
		'autofocus' => 'autofocus',
		'label' => __('Name')
	));
	echo $this->Form->input('email', array(
		'label' => __('Email')
	));
	echo $this->Form->input('confirm_email', array(
		'label' => __('Repeat Email')
	));
	echo $this->Form->input('password', array(
		'label' => __('Password'),
		'type' => 'password'
	));
	echo $this->Form->input('confirm_password', array(
		'label' => __('Repeat Password'),
		'type' => 'password'
	));
	echo $this->Form->button(__('Register'), array(
		'class' => 'ok'
	));
	echo $this->Html->link(__("Have an account? Login here!"), '/login');