<!DOCTYPE html>
<html lang="vi-VN">
	<head>
		<meta charset="utf-8" />
		<meta name="author" content="NamNV609" />
		<title><?php echo $title_for_layout; ?></title>
		<?php
			echo $this->Html->css(array(
				'admin/login'
			));
		?>
	</head>
	<body>
		<div class="wrap">
			<div id="content">
				<div id="main">
					<div class="full_w">
						<?php
							echo $this->fetch('content');
						?>
					</div>
					<div class="footer">
						&raquo; <?php echo $this->Html->link(__('Framgia Test System'), 'http://framgia.com'); ?> | NamNV609
					</div>
				</div>
			</div>
		</div>
	</body>
</html>