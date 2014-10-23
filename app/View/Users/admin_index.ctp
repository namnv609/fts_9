<div class="table-reposive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th><?php echo __('ID'); ?></th>
				<th><?php echo __('Avatar'); ?></th>
				<th><?php echo __('Name'); ?></th>
				<th><?php echo __('Email'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th><?php echo __('Status'); ?></th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbdoy>
			<?php
				if (count($users) > 0) :
					foreach ($users as $user) :
			?>
			<tr>
				<td>
					<?php echo $user["User"]["id"]; ?>
				</td>
				<td>
					<?php
						echo $this->Html->image($user["User"]["avatar"], array(
							'class' => 'user-profile-img',
							'alt' => __('User avatar')
						));
					?>
				</td>
				<td>
					<?php echo $user["User"]["name"]; ?>
				</td>
				<td>
					<?php echo $user["User"]["email"]; ?>
				</td>
				<td>
					<?php echo $user["User"]["created"]; ?>
				</td>
				<td>
					<?php echo $user["User"]["modified"]; ?>
				</td>
				<td>
					<?php echo UsersController::$userStatus[$user["User"]["status"]]; ?>
				</td>
				<td>
					<?php
						echo $this->Html->link(
							'<i class="fa fa-pencil"></i>',
							ADMIN_ALIAS . '/users/' . $user["User"]["id"],
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
				<td colspan="8">
					<?php
						echo __('No user here :/');
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