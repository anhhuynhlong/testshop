<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Order'), ['action' => 'edit', $order->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Order'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Orders'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Order'), ['action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Orderitems'), ['controller' => 'Orderitems', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Orderitem'), ['controller' => 'Orderitems', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="orders view large-10 medium-9 columns">
	TEST
</div>

