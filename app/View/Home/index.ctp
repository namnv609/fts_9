<div class="row">
	<div class="large-12 columns sign-form">
		<h1><?php echo __('All Examinations'); ?></h1>
		<?php
			echo $this->Form->create('Examination', array(
				'url' => '/examinations/add',
				'type' => 'post',
				'inputDefaults' => array(
					'div' => array('class' => 'form-group'),
					'between' => '<div class="col-md-10">',
					'after' => '</div>',
					'class' => 'form-control',
					'error' => FALSE
				),
				'class' => 'form-horizontal'
			));
			
			echo $this->Form->input('subject_id', array(
				'label' => array(
					'text' => __('Subjects'),
					'class' => 'control-label col-md-2'
				)
			));
			
			echo $this->Form->button(__('Start new'), array(
				'class' => 'btn btn-primary'
			))
		?>
	</div>
</div>
<div class="row">
	<table>
		<thead>
			<tr>
				<th><?php echo __('Time'); ?></th>
				<th><?php echo __('Subject'); ?></th>
				<th><?php echo __('Status'); ?></th>
				<th><?php echo __('&nbsp;'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				if (count($examinations) > 0) :
					foreach ($examinations as $examination) :
			?>
			<tr>
				<td>
					<?php echo $examination["Examination"]["created"]; ?>
				</td>
				<td>
					<?php echo $examination["Subject"]["name"]; ?>
				</td>
				<td>
					<?php echo $examinationStatus[$examination["Examination"]["status"]]; ?>
				</td>
				<td>
					<?php
						echo $this->Html->link(__('[ View ]'), '/answers_sheets/' . $examination["Examination"]["id"]);
					?>
				</td>
			</tr>
			<?php
					endforeach;
				else :
			?>
			<tr>
				<td colspan="4">
					<?php echo __('No examination(s) here :/'); ?>
				</td>
			</tr>
			<?php
				endif;
			?>
		</tbody>
	</table>
</div>
