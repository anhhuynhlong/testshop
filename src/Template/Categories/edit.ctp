<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(
				__('Delete'),
				['action' => 'delete', $category->id],
				['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]
			)
		?></li>
		<li><?= $this->Html->link(__('List Categories'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Shops'), ['controller' => 'Shops', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Shop'), ['controller' => 'Shops', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="categories form large-10 medium-9 columns">
	<?= $this->Form->create($category); ?>
	<fieldset>
		<legend><?= __('Edit Category') ?></legend>
		<?php
			echo $this->Form->input('parent_id', ['options' => $parentCategories, 'empty' => 'Select category']);
			echo $this->Form->input('name');
			echo $this->Form->input('description');
			echo $this->Form->input('shop_id', ['options' => $shops]);
			
		?>
	</fieldset>
	<?= $this->Form->button(__('Submit')) ?>
	<?= $this->Form->end() ?>
</div>
