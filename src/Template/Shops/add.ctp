<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Shops'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="shops form large-10 medium-9 columns">
	<?= $this->Form->create($shop); ?>
	<fieldset>
		<legend><?= __('Add Shop') ?></legend>
		<?php
			echo $this->Form->input('name');			
			echo $this->Form->input('description');
			echo $this->Form->input('address');
			//echo $this->Form->input('user_id', ['value'=> $users, 'type' => "hidden"]);
			echo $this->Form->input('url');
		?>
	</fieldset>
	<?= $this->Form->button(__('Add Shop')) ?>
	<?= $this->Form->end() ?>
</div>
