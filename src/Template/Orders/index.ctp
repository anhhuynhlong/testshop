<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Waiting orders'), ['action' => 'index', 3]) ?> </li>
		<li><?= $this->Html->link(__('Served orders'), ['action' => 'index', 2]) ?> </li>
		<li><?= $this->Html->link(__('Paid orders'), ['action' => 'index', 1]) ?> </li>
		<li><?= $this->Html->link(__('Cancelled orders'), ['action' => 'index', 4]) ?> </li>
	</ul>
</div>
<div class="orders index large-10 medium-9 columns">
	
	<table cellpadding="0" cellspacing="0" border='1'>
	<thead>
		<tr>
			<th><?= $this->Paginator->sort('table_number') ?></th>
			<th><?= $this->Paginator->sort('info') ?></th>
			<th><?= $this->Paginator->sort('status') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php $status = array( 'Paid', 'Served','Waiting','Cancelled');?>
	<?php foreach ($orders as $order): ?>
		<tr>
			<td><?= h($order->table_number) ?></td>
			<td><?= h($order->info) ?></td>
			<td><?php 
				if($order->status <= 0)
				{
					
					echo "Invalid";
				}
				else
				{
					echo $status[$order->status - 1] ;
				}
				?></td>
			
			<td class="actions">
				<?= $this->Html->link(__('View'), ['action' => 'view', $order->id]) ?>
				
				<!-- Only waiting orders have cancel action -->
				<?php if($order->status == 3)
					{
						echo $this->Form->postLink(__('Cancel'), ['action' => 'process', $order->id, 4], ['confirm' => __('Are you sure you want to cancel # {0}?', $order->id)]);
					}
				?>
				</td>
		</tr>

	<?php endforeach; ?>
	</tbody>
	</table>
	<div class="paginator">
		<ul class="pagination">
			<?= $this->Paginator->prev('< ' . __('previous')); ?>
			<?= $this->Paginator->numbers(); ?>
			<?=	$this->Paginator->next(__('next') . ' >'); ?>
		</ul>
		<p><?= $this->Paginator->counter(); ?></p>
	</div>
</div>
