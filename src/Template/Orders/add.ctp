<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Orders'), ['action' => 'index']) ?></li>
		
	</ul>
</div>
<div class="orders form large-10 medium-9 columns">
	<?= $this->Form->create($order); ?>
	<fieldset>
		<legend><?= __('Order info') ?></legend>
		<?php
			echo $this->Form->input('table_number', ['label' => ['text' => 'Table Number']]);
			echo $this->Form->input('info', ['label' => ['text' => 'More info']]);
			//echo $this->Form->input('status');
		?>
	</fieldset>
	<?= $this->Form->button(__('Submit')) ?>
	<?= $this->Form->end() ?>
</div>
