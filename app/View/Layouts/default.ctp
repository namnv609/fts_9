<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php echo $title_for_layout; ?></title>
		<?php
			echo $this->Html->css(array(
				'foundation.min',
				'font-awesome.min',
				'style'
			));
		?>
	</head>
	<body>
		<div class="top-nav full-witdh">
			<div class="row">
				<nav class="top-bar large-12 columns" data-topbar role="navigation">
					<ul class="title-area">
						<li class="name">
							<h1 class="logo">
								<?php
									echo $this->Html->link(__('Test App'), '/');
								?>
							</h1>
						</li>
					</ul>
					<section class="top-bar-section">
						<!-- Right Nav Section -->
						<ul class="right">
							<li>
								<?php echo $this->Html->link(__('Home'), '/'); ?>
							</li>
							<li>
								<?php echo $this->Html->link(__('Help'), '#'); ?>
							</li>
							<li class="has-dropdown">
								<?php
									echo $this->Html->link(AuthComponent::user('name'), "#");
								?>
								<ul class="dropdown">
									<li>
										<?php echo $this->Html->link(__('Profile'), '/profile'); ?>
									</li>
									<li>
										<?php echo $this->Html->link(__('Sign Out'), '/logout'); ?>
									</li>
								</ul>
							</li>
						</ul>
					</section>
				</nav>
			</div>
		</div>
		<!-- 1 exam panel -->
		<?php echo $this->fetch('content'); ?>
		<!-- /1 exam panel -->
		<div class="row">
			<footer class="large-12 columns">
				<div class="boder">
					<div class="left">
						<?php echo __('&copy;2014 by Framgia Test System'); ?>
					</div>
					<ul class="right">
						<li>
							<?php echo $this->Html->link(__('About'), '#'); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('Contact'), '#'); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('News'), '#'); ?>
						</li>
					</ul>
				</div>
			</footer>
		</div>
		<?php
		echo $this->Html->script(array(
			'jquery.min',
			'foundation.min'
		));
		echo $scripts_for_layout;
		?>
		<script>
			$(document).foundation();
		</script>
	</body>
</html>