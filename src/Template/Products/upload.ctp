<div class="shops form large-10 medium-9 columns">
	<?= $this->Form->create($product, ['type' => 'file', 'controller' => 'upload']); ?>
	<fieldset>
		<legend><?= __('Upload file') ?></legend>
		<?php
			echo $this->Form->file('productimage');
		?>
	</fieldset>
	<?= $this->Form->button(__('Submit')) ?>
	<?= $this->Form->end() ?>
	
	
</div>
