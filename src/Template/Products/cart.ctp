<?php
/* display message saved in session if any */
use Cake\View\Helper\SessionHelper;

echo $this->Flash->render();
?>

<h2>Cart</h2>
<table border='1'>
    <tr>
        <th>Name</th>
        <th>Image</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Sub-total</th>
        <th>Action</th>
    </tr>
  
    <?php $totalPrice = 0; ?>
    <?php foreach ($cart as $key => $product): ?>
    <tr>
        <td>
            <?php 
              //link to product page
              echo $this->Html->link($product->name, array('action'=> 'view', $product->id)); 
            ?>
        </td>
        <td>
             <?php echo $this->Html->image($product->image,['class' => 'thumbnail', 'width' => '120', 'height' => '120']) ;?>
        </td>
        <td>
            <?php 
              //show product price
              echo $product->price; 
            ?> 
        </td>
        <td>
            <?php 
              //show product quantity
 			 $quantity = $this->Session->read('Cart.Quantity.'.$product->id); 
			echo $quantity;
			echo '<br>';
			
              //remove product from a cart
              echo $this->Html->link('+', array('action' => 'update_cart_plus', $product->id)); 
				echo "  ";
			  echo $this->Html->link('-', array('action' => 'update_cart_minus', $product->id)); 
            ?>
			
           
        </td>
        <td>
            <?php 
              //show sub-total
			  $sub = $quantity*$product->price;
              echo $sub; 
            ?>
        </td>
        
        <td>
            <?php 
              //remove product from a cart
              echo $this->Html->link('delete', array('action' => 'delete', $product->id)); 
            ?>
        </td>
    </tr>
    <?php 
    //calculate total price of all products in a cart
    $totalPrice = $totalPrice + $sub; 
    ?>
<?php endforeach; ?>

    <tr>
        <th>Total Price: </th>
        <th></th>
        <th> </th>
        <th> </th>     
        <th><?php 
          //show total price
           echo $totalPrice; 
           ?>
        </th>
        <th>
          <?php
            //delete all elements from a cart
            echo $this->Html->link('empty', array('action'=>'empty_cart'));
          ?>
        </th>
    </tr>
</table>

<div>
    <?php 
      //link to products page
      echo $this->Html->link('Products', array('action' => 'index')); 
    ?>
</div>

<div>

     <?php 
	//Checkout
		echo $this->Form->create('Orders',[
        'type'=>'get',
        'url'=> ['controller'=>'Orders','action'=>'add']
        ]);?>
        
            
            <?php echo $this->Form->submit('Checkout', ['class'=> 'btn-success btn btn-lg']);?>
            <?php echo $this->Form->end();?>
</div>