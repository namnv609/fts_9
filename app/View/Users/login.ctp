<?php
	$flashMessage = $this->Session->flash();
	
	echo $this->Form->create('User', array(
		'url' => '/login',
		'autocomplete' => 'off',
		'inputDefaults' => array(
			'div' => FALSE,
			'class' => 'text'
		),
		'novalidate' => 'novalidate'
	));
	echo $this->Custom->validationSummary($flashMessage);

	echo $this->Form->input('email', array(
		'label' => __('Email')
	));
	echo $this->Form->input('password', array(
		'label' => __('Password'),
		'type' => 'password'
	));
	echo $this->Form->input('remember_me', array(
		'label' => __('Remember me'),
		'type' => 'checkbox',
		'class' => FALSE
	));
	echo $this->Form->button(__('Login'), array(
		'class' => 'ok'
	));
	echo $this->Html->link(__("Don't have account? Register here"), '/register');
