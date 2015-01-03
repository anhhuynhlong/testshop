<?php
/* display message saved in session if any */
echo $this->Flash->render();
?>


<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><?php echo $this->Html->link('Home','/');?>
            </li>
            <li class="active"><?php echo $product->name;?>
            </li>
        </ol>
    </div>
</div>
 
<div class="row">
    <div class="col-lg-4 col-md-4">
        <?php echo $this->Html->image($product->image,[ 
            'url' => ['controller' => 'Products', 'action' => 'view', $product->id],
            'class' => 'thumbnail']) ;?>
    </div>
 
    <div class="col-lg-8 col-md-8">
        <h1>
            <?php echo $product->name;?>
        </h1>
        <h2>
            Price: $
            <?php echo $product->price;?>
        </h2>
        <p>
        <?php echo $this->Form->create('Products',[
        'id'=>'add-form',
        'url'=> ['controller'=>'Products','action'=>'add_to_cart']
        ]);?>
        
            <?php echo $this->Form->hidden('product_id', ['value' => $product->id]);?>
            <?php echo $this->Form->input('quantity', ['type' => 'text', 'value' => '1']);?>
            <?php echo $this->Form->submit('Add to cart', ['class'=> 'btn-success btn btn-lg']);?>
            <?php echo $this->Form->end();?>
        </p>
    </div>
</div>
