<div class="table-reposive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th><?php echo __('ID'); ?></th>
				<th><?php echo __('Subject'); ?></th>
				<th><?php echo __('Time'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbdoy>
			<?php
				if (count($subjects) > 0) :
					foreach ($subjects as $subject) :
			?>
			<tr>
				<td>
					<?php echo $subject["Subject"]["id"]; ?>
				</td>
				<td>
					<?php echo $subject["Subject"]["name"]; ?>
				</td>
				<td>
					<?php echo $subject["Subject"]["time"] .  __(' (mins)'); ?>
				</td>
				<td>
					<?php echo $subject["Subject"]["created"]; ?>
				</td>
				<td>
					<?php echo $subject["Subject"]["modified"]; ?>
				</td>
				<td>
					<?php
						echo $this->Html->link(
							'<i class="fa fa-pencil"></i>',
							ADMIN_ALIAS . '/subjects/' . $subject["Subject"]["id"],
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
						echo __('No subject here.');
						echo $this->Html->link(
							__(' Click here to add new subject'),
							ADMIN_ALIAS . '/subjects/add'
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