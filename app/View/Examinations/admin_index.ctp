<?php
	echo $this->Form->create('Examination', array(
		'class' => 'form-horizontal',
		'type' => 'get',
		'inputDefaults' => array(
			'div' => FALSE,
			'class' => 'form-control',
			'label' => FALSE
		),
		'autocomplete' => 'off'
	));
?>
<div class="form-group">
	<label class="control-label col-md-2"><?php echo __('Search & Filter'); ?></label>
	<div class="col-md-3">
		<?php
			echo $this->Form->input('user', array(
				'default' => $queryString["user"]
			)); 
		?>
	</div>
	<div class="col-md-3">
		<?php
			echo $this->Form->input('subject', array(
				'default' => $queryString["subject"]
			));
		?>
	</div>
	<div class="col-md-2">
		<?php
			echo $this->Form->input('status', array(
				'default' => $queryString["status"],
				'type' => 'select',
				'options' => $examinationStatus
			));
		?>
	</div>
	<div class="col-md-2">
		<?php echo $this->Form->button(__('Search'), array(
			'class' => 'btn btn-primary btn-success form-control'
		)); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>
<div class="table-reposive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th><?php echo __('ID'); ?></th>
				<th><?php echo __('User'); ?></th>
				<th><?php echo __('Subject'); ?></th>
				<th><?php echo __('Test at'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th><?php echo __('Status'); ?></th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbdoy>
			<?php
				if (count($examinations) > 0) :
					foreach ($examinations as $examination) :
			?>
			<tr>
				<td>
					<?php echo $examination["Examination"]["id"]; ?>
				</td>
				<td>
					<?php
						echo $examination["User"]["name"];
					?>
				</td>
				<td>
					<?php echo $examination["Subject"]["name"]; ?>
				</td>
				<td>
					<?php echo $examination["Examination"]["created"]; ?>
				</td>
				<td>
					<?php echo $examination["Examination"]["modified"]; ?>
				</td>
				<td>
					<?php echo $examinationStatus[$examination["Examination"]["status"]]; ?>
				</td>
				<td>
					<?php
						echo $this->Html->link(
							'<i class="fa fa-pencil"></i>',
							ADMIN_ALIAS . '/answers_sheets/' . $examination["Examination"]["id"],
							array(
								"escape" => FALSE,
								"class" => "btn btn-primary btn-sm"
							)
						);
					?>
				</td>
			</tr>
			<?php
					endforeach;
				else :
			?>
			<tr>
				<td colspan="6">
					<?php
						echo __('No examination here.');
					?>
				</td>
			</tr>
			<?php
				endif;
			?>
		</tbdoy>
	</table>
</div>
<div class="datatable-footer">
	<div class="pagination dataTables_paginate pull-right">
		<?php
			echo $this->Paginator->prev(__('Previous'), array('tag' => 'li'));
			echo $this->Paginator->numbers(array('tag' => 'li'));
			echo $this->Paginator->next(__('Next'), array('tag' => 'li'));
		?>
	</div>
</div>