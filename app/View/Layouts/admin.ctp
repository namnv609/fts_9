<?php
	$linkDefaults = array(
		'escape' => FALSE
	)
?>
<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $title_for_layout; ?></title>
		<?php
			echo $this->Html->css(array(
				'admin/bootstrap.min',
				'admin/brain-theme',
				'admin/styles',
				'admin/font-awesome.min'
			));
		?>
		<link href='http://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<?php
			echo $this->Html->script(array(
				'admin/bootstrap.min',
				'admin/script'
			));
		?>
	</head>
	<body>
		<!-- Navbar -->
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<ul class="nav navbar-nav navbar-left-custom">
						<li class="user dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown">
								<img src="http://placehold.it/500" alt="">
								<span><?php echo $this->Session->read("UserSession.userName"); ?></span>
								<i class="caret"></i>
							</a>
							<ul class="dropdown-menu">
								<li>
									<?php
										echo $this->Html->link(
											'<i class="fa fa-user"></i> ' . __('Profile'),
											ADMIN_ALIAS . '/user-profile-' . 
												$this->Session->read("UserSession.userID"),
											$linkDefaults
										);
									?>
								</li>
								<li>
									<?php
										echo $this->Html->link(
											'<i class="fa fa-mail-forward"></i> ' . __('Logout'),
											'/logout',
											$linkDefaults
										);
									?>
								</li>
							</ul>
						</li>
						<li><a class="nav-icon sidebar-toggle"><i class="fa fa-bars"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /navbar -->
		<!-- Page header -->
		<div class="container-fluid">
			<div class="page-header">
				<div class="logo">
					<?php
						echo $this->Html->link(
							'<img src="img/admin/logo.png" alt="">',
							ADMIN_ALIAS,
							$linkDefaults
						);
					?>
				</div>
			</div>
		</div>
		<!-- /page header -->
		<!-- Page container -->
		<div class="page-container container-fluid">

			<!-- Sidebar -->
			<div class="sidebar collapse">
				<ul class="navigation">
					<li class="active">
						<a><i class="fa fa-laptop"></i> <?php echo __('Dashboard'); ?></a>
						<ul>
							<li>
								<?php
									echo $this->Html->link(
										'&raquo; ' . __('Dashboard'),
										ADMIN_ALIAS,
										$linkDefaults
									);
								?>
							</li>
							<li>
								<?php
									echo $this->Html->link(
										'&raquo; ' . __('Website configuration'),
										ADMIN_ALIAS .  '/website-configuration',
										$linkDefaults
									);
								?>
							</li>
						</ul>
					</li>
					<li class="active">
						<a><i class="fa fa-th-large"></i> <?php echo __('Subjects'); ?></a>
						<ul>
							<li>
								<?php
									echo $this->Html->link(
										'&raquo; ' . __('Subjects Manage'),
										ADMIN_ALIAS .  '/subjects-manage',
										$linkDefaults
									);
								?>
							</li>
							<li>
								<?php
									echo $this->Html->link(
										'&raquo; ' . __('Add new subject'),
										ADMIN_ALIAS .  '/add-new-subject',
										$linkDefaults
									);
								?>
							</li>
						</ul>
					</li>
					<li class="active">
						<a><i class="fa fa-th-large"></i> <?php echo __('Question'); ?></a>
						<ul>
							<li>
								<?php
									echo $this->Html->link(
										'&raquo; ' . __('Questions Manage'),
										ADMIN_ALIAS .  '/questions-manage',
										$linkDefaults
									);
								?>
							</li>
							<li>
								<?php
									echo $this->Html->link(
										'&raquo; ' . __('Add new Question'),
										ADMIN_ALIAS .  '/add-new-question',
										$linkDefaults
									);
								?>
							</li>
						</ul>
					</li>
					<li class="active">
						<?php
							echo $this->Html->link(
								'<i class="fa fa-user"></i>' . __('Examinations Manage'),
								ADMIN_ALIAS . '/examinations-manage',
								$linkDefaults
							);
						?>
					</li>
					<li class="active">
						<?php
							echo $this->Html->link(
								'<i class="fa fa-user"></i>' . __('Users Manage'),
								ADMIN_ALIAS . '/users-manage',
								$linkDefaults
							);
						?>
					</li>
				</ul>
			</div>
			<!-- /sidebar -->

			<!-- Page content -->
			<div class="page-content">
				<!-- Page title -->
				<div class="page-title">
					<h5><i class="fa fa-bars"></i> <?php echo $title_for_layout; ?></h5>
				</div>
				<!-- /page title -->
				<div class="panel-default panel">
					<div class="panel-body">
						<?php echo $this->fetch('content'); ?>
					</div>
				</div>
				<!-- Footer -->
				<div class="footer">
					<?php echo __('&copy; Copyright 2014. All rights reserved.'); ?>
				</div>
				<!-- /footer -->
			</div>
		</div>
	</body>
</html>
