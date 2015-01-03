<?php
    echo $this->MenuBuilder->build('main-menu');
?>

<div class="row">
    <?php foreach ($products as $product):?>
    <div class="col-sm-6 col-md-4">
        <div class="">
            <?php echo $this->Html->image($product->image,[ 
            'url' => ['controller' => 'Products', 'action' => 'view', $product->id],
            'class' => 'thumbnail']) ;?>
            <div class="caption">
                <h5>
                    <?php echo $product->name;?>
                </h5>
                <h5>
                    Price: $
                    <?php echo $product->price;?>
                </h5>
            </div>
        </div>
    </div>
    <?php endforeach;?>
</div>
