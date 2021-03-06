<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('New Shop'), ['action' => 'add']) ?></li>
				
		<li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?> </li>
		
		<li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="shops index large-10 medium-9 columns">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><?= $this->Paginator->sort('name') ?></th>
			<th><?= $this->Paginator->sort('description') ?></th>
			<th><?= $this->Paginator->sort('address') ?></th>
			<th><?= $this->Paginator->sort('url') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($shops as $shop): ?>
		<tr>
			<td><?= h($shop->name) ?></td>
			<td><?= h($shop->description) ?></td>
			<td><?= h($shop->address) ?></td>
			<td><?= h($shop->url) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['action' => 'view', $shop->id]) ?>
				<?= $this->Html->link(__('Edit'), ['action' => 'edit', $shop->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $shop->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shop->name)]) ?>
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
