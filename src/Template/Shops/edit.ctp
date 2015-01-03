<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<!-- TODO -->
		<li><?= $this->Html->link(__('List Shops'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="shops form large-10 medium-9 columns">
	<?= $this->Form->create($shop); ?>
	<fieldset>
		<legend><?= __('Edit Shop') ?></legend>
		<?php
			echo $this->Form->input('name');
			echo $this->Form->input('description');
			echo $this->Form->input('address');
			echo $this->Form->input('url');
		?>
	</fieldset>
	<?= $this->Form->button(__('Update')) ?>
	<?= $this->Form->end() ?>
</div>
