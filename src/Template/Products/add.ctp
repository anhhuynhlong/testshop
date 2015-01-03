<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Shops'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="shops form large-10 medium-9 columns">
	<?= $this->Form->create($product, ['type' => 'file']); ?>
	<fieldset>
		<legend><?= __('Add Product') ?></legend>
		<?php
			
			echo $this->Form->input('name', [
			'label' => [
                'text' => 'Name of Product'
   				 ]]);
			echo $this->Form->input('description', [
			'label' => [
                'text' => 'Description'
   				 ]]);
			echo $this->Form->input('price',[
			'label' => [
                'text' => 'Price'
   				 ]]);
			echo $this->Form->input('category_id',['options' => $categories, 'empty' => '(choose one)',
			'label' => [
                'text' => 'Select category'
   				 ]]);
			
			echo "Select product image";
			echo $this->Form->file('productimage');
			
			echo $this->Form->select('shop_id', $shops,  ['default' => 'none', 'label' => [
                'text' => 'Select shop'
   				 ]]);
		?>
	</fieldset>
	<?= $this->Form->button(__('Submit')) ?>
	<?= $this->Form->end() ?>
	
	
</div>
