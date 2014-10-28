<div class="row">
	<div class="large-6 large-centered columns sign-form">
		<h1><?php echo __("Update your profile"); ?></h1>
		<?php
			echo $this->Session->flash();
			
			echo $this->Form->create("User", array(
				"url" => "/users/save",
				"inputDefaults" => array(
					"div" => array(
						'class' => 'row'
					)
				),
				'type' => 'file'
			));
			
			echo $this->Form->input("name", array(
				"label" => __("Fullname")
			));
			echo $this->Form->input("email", array(
				"label" => __("Email"),
				"disabled" => "disabled"
			));
			echo $this->Form->input("password", array(
				"label" => __("Password"),
				'value' => ''
			));
			echo $this->Form->input("confirm_password", array(
				"label" => __("Confirm Password"),
				"type" => "password"
			));
			echo $this->Form->input("avatar", array(
				"label" => __("Avatar"),
				"type" => "file"
			));
			echo $this->Html->image(AuthComponent::user('avatar'), array(
				"alt" => __("User avatar"),
				"class" => 'user-profile-img'
			));
			;
		?>
		<div class="row padding-tb">
			<?php
				echo $this->Form->button(__("Update"), array(
					"class" => "btn"
				));
				echo $this->Form->end();
			?>
		</div>
	</div>
</div>