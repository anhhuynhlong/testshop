<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('New Category'), ['action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('List Shops'), ['controller' => 'Shops', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Shop'), ['controller' => 'Shops', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="categories index large-10 medium-9 columns">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>


			<!--  <th><?= $this->Paginator->sort('parent_id') ?></th> -->
			<th>Parent Name</th>
			<th><?= $this->Paginator->sort('name') ?></th>
			<th><?= $this->Paginator->sort('description') ?></th>
			<th><?= $this->Paginator->sort('shop_id') ?></th>
			
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($categories as $category): ?>
		<tr>
			
			<td><?php
			
			$parent_name = "";
			if($category['parent_id'])
			{
				$parent_name = $parentCategories[$category['parent_id']];
			}
			echo $parent_name;
			?>
			<td><?= h($category['name']) ?></td>
			<td><?= h($category['description']) ?></td>
			<td>
				<?= $shops->toArray()[$category->shop_id] ?>
			</td>
			
			<td class="actions">
				<?= $this->Html->link(__('View'), ['action' => 'view', $category->id]) ?>
				<?= $this->Html->link(__('Edit'), ['action' => 'edit', $category->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]) ?>
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
