<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Shop'), ['action' => 'edit', $shop->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Shop'), ['action' => 'delete', $shop->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shop->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Shops'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Shop'), ['action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="shops view large-10 medium-9 columns">
	<h2><?= h($shop->name) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Address') ?></h6>
			<p><?= h($shop->address) ?></p>
			<h6 class="subheader"><?= __('Url') ?></h6>
			<p><?= h($shop->url) ?></p>
		</div>
		<div class="large-2 columns numbers end">
			<h6 class="subheader"><?= __('Name') ?></h6>
			<p><?= h($shop->name) ?></p>
			<h6 class="subheader"><?= __('Description') ?></h6>
			<p><?= h($shop->description) ?></p>
						
		</div>
	</div>
</div>
<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Orders') ?></h4>
	<?php if (!empty($shop->orders)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Table Number') ?></th>
			<th><?= __('Info') ?></th>
			<th><?= __('Status') ?></th>
			<th><?= __('created') ?></th>
			<th><?= __('modified') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($shop->orders as $orders): ?>
		<tr>
			<td><?= h($orders->table_number) ?></td>
			<td><?= h($orders->info) ?></td>
			<td><?= h($orders->status) ?></td>
			<td><?= h($orders->created) ?></td>
			<td><?= h($orders->modified) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Orders', 'action' => 'view', $orders->id]) ?>
			</td>
		</tr>

		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>
</div>
<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Products') ?></h4>
	<?php if (!empty($shop->products)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Name') ?></th>
			<th><?= __('Price') ?></th>
			<th><?= __('Image') ?></th>
			
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($shop->products as $products): ?>
		<tr>
			<td><?= h($products->id) ?></td>
			<td><?= h($products->name) ?></td>
			<td><?= h($products->price) ?></td>
			<td><?= $this->Html->image($products->image, ['class' => 'thumbnail', 'width' => '60', 'height' => '60']) ?></td>
			

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
