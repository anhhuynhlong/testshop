<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<?php if($order->status == 3){

		echo '<li>' . $this->Form->postLink(__('Cancel Order'), ['action' => 'process', $order->id, 4], ['confirm' => __('Are you sure you want to cancel # {0}?', $order->id)]) . '</li>';
		
		echo '<li>' . $this->Html->link(__('Serve Order'), ['action' => 'process', $order->id, 2]) . '</li>';
		echo '<li>' . $this->Html->link(__('Bill Order'), ['action' => 'process', $order->id, 1])  . '</li>';
		
		}
		if($order->status == 2){
		echo '<li>' . $this->Html->link(__('Bill Order'), ['action' => 'process', $order->id, 1])  . '</li>';
		}
		echo '<li>' . $this->Html->link(__('List Orders'), ['action' => 'index'])  . '</li>';
		?>
					
	</ul>
</div>
<div class="orders view large-10 medium-9 columns">
	<h2><?= h($order->table_number) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Info') ?></h6>
			<p><?= h($order->info) ?></p>
			<?php $status = array("Paid", "Served", "Waiting", "Cancelled");?>
			
			<h6 class="subheader"><?= __('Status:  ') ?> <?= h($status[$order->status -1]) ?> </h6>
			
		</div>
		<div class="large-2 columns numbers end">
			<h6 class="subheader"><?= __('Table') ?></h6>
			<p><?= $this->Number->format($order->table_number) ?></p>
		</div>
	</div>
</div>
<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Order details') ?></h4>
	<?php if (!empty($order->orderitems)): ?>
	
	<table cellpadding="0" cellspacing="0" border='1'>
		<tr>
			<th><?= __('Name') ?></th>
			<th><?= __('Image') ?></th>
			<th><?= __('Quantity') ?></th>
			<th><?= __('Price') ?></th>
			<th><?= __('Sub-total') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php $total = 0;?>
		<?php foreach ($order->orderitems as $orderitems): ?>
		<?php $product = $orderitems->getProduct($orderitems->product_id);?>
		<tr>
			<td><?= h($product->name) ?></td>
			<td><?php echo $this->Html->image($product->image, ['class' => 'thumbnail', 'height' => '120', 'width' => '120']);?></td>
			<td><?= h($orderitems->quantity) ?></td>
			<td><?= h($product->price) ?></td>
			<td>
			<?php echo $orderitems->quantity * $product->price;
				$total += $orderitems->quantity * $product->price
			?> </td>
			
				<td class="actions">
				
				<!-- Only for waiting order -->
				<?php if($order->status == 3) {
				echo $this->Form->postLink(__('Cancel'), ['controller' => 'Orderitems', 'action' => 'Cancel', $orderitems->id], ['confirm' => __('Are you sure you want to cancel # {0}?', $orderitems->id)]);
				} ?>
			</td>
		</tr>

		<?php endforeach; ?>
		<tr> 
		<th> 		</th>
		<th> 		</th>
		<th> 		</th>
		<th> 		</th>
		<th><?php echo $total ?></th>
		<th> 		</th>
		</tr>
		
		 
	</table>
	

	
	<div class="orders form large-10 medium-9 columns">
		<?php 
		//Only for waiting orders
		if($order->status == 3){
		echo $this->Html->link('Serve Order', array('action' => 'process', $order->id, 2)); 
		}
		if($order->status == 2){
		echo $this->Html->link('Bill Order', array('action' => 'process', $order->id, 1)); 
		}
	?>
    </div>
	
	<?php endif; ?>
	</div>
</div>
