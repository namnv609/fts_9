<?php
	if (!isset($queryString["subject"])) {
		$queryString["subject"] = "";
	}
	if ( !isset($queryString["keyword"])) {
		$queryString["keyword"] = "";
	}
	
	echo $this->Form->create('Question', array(
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
	<div class="col-md-5">
		<?php
			echo $this->Form->input('keyword', array(
				'default' => $queryString["keyword"]
			)); 
		?>
	</div>
	<div class="col-md-3">
		<?php
			echo $this->Form->input('subject', array(
				'type' => 'select',
				'options' => $subjects,
				'default' => $queryString["subject"]
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
				<th><?php echo __("ID"); ?></th>
				<th><?php echo __("Question"); ?></th>
				<th><?php echo __("Subject"); ?></th>
				<th><?php echo __("Created"); ?></th>
				<th><?php echo __("Modified"); ?></th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbdoy>
			<?php
				if (count($questions) > 0) :
					foreach ($questions as $question) :
			?>
			<tr>
				<td>
					<?php echo $question["Question"]["id"]; ?>
				</td>
				<td>
					<?php
						echo String::truncate($question["Question"]["question"], 30, array(
							'ellipsis' => '...',
							'exact' => FALSE
						));
					?>
				</td>
				<td>
					<?php echo $question["Subject"]["name"]; ?>
				</td>
				<td>
					<?php echo $question["Question"]["created"]; ?>
				</td>
				<td>
					<?php echo $question["Question"]["modified"]; ?>
				</td>
				<td>
					<?php
						echo $this->Html->link(
							'<i class="fa fa-pencil"></i>',
							ADMIN_ALIAS . '/questions/' . $question["Question"]["id"],
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
						echo __('No question here.');
						echo $this->Html->link(
							__(' Click here to add new question'),
							ADMIN_ALIAS . '/questions/add'
						);
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