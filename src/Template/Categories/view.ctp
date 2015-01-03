<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $category->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Category'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Categories'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Category'), ['action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Shops'), ['controller' => 'Shops', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Shop'), ['controller' => 'Shops', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="categories view large-10 medium-9 columns">
	<h2><?= h($category->name) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Name') ?></h6>
			<p><?= h($category->name) ?></p>
			<h6 class="subheader"><?= __('Shop') ?></h6>
			<p><?= $category->has('shop') ? $this->Html->link($category->shop->id, ['controller' => 'Shops', 'action' => 'view', $category->shop->id]) : '' ?></p>
		</div>
		<div class="large-2 columns numbers end">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= $this->Number->format($category->id) ?></p>
			<h6 class="subheader"><?= __('Parent Id') ?></h6>
			<p><?= $this->Number->format($category->parent_id) ?></p>
			<h6 class="subheader"><?= __('Description') ?></h6>
			<p><?= $this->Number->format($category->description) ?></p>
			<h6 class="subheader"><?= __('Lft') ?></h6>
			<p><?= $this->Number->format($category->lft) ?></p>
			<h6 class="subheader"><?= __('Rght') ?></h6>
			<p><?= $this->Number->format($category->rght) ?></p>
		</div>
	</div>
</div>
<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Products') ?></h4>
	<?php if (!empty($category->products)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Name') ?></th>
			<th><?= __('Price') ?></th>
			<th><?= __('Image') ?></th>
			<th><?= __('Shop Id') ?></th>
			<th><?= __('Category Id') ?></th>
			<th><?= __('Description') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($category->products as $products): ?>
		<tr>
			<td><?= h($products->id) ?></td>
			<td><?= h($products->name) ?></td>
			<td><?= h($products->price) ?></td>
			<td><?= h($products->image) ?></td>
			<td><?= h($products->shop_id) ?></td>
			<td><?= h($products->category_id) ?></td>
			<td><?= h($products->description) ?></td>

			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $products->id]) ?>

				<?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $products->id]) ?>

				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $products->id], ['confirm' => __('Are you sure you want to delete # {0}?', $products->id)]) ?>

			</td>
		</tr>

		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>
</div>
