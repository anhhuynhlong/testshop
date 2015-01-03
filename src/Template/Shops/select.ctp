<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<!-- TODO -->
	</ul>
</div>
<div class="shops form large-10 medium-9 columns">
	<?= $this->Form->create($shop, ['action' => 'select']); ?>
	<fieldset>
		<legend><?= __('Select a Shop') ?></legend>
		<?php
			echo $this->Form->input('shop_id', ['type' => 'text']);
			
		?>
	</fieldset>
	<?= $this->Form->button(__('Go')) ?>
	<?= $this->Form->end() ?>
</div>
