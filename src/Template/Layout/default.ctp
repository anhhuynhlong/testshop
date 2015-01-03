<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
         vnStore
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
  	<?= $this->Html->css('bootstrap.min.css');?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    
    
     <style>
    body {
      padding-top: 20px;
      padding-bottom: 20px;
    }
     
    .navbar {
      margin-bottom: 20px;
    }
    </style>
 
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
 
</head>
<body>
    <header>
        <div class="header-title">
      		 <span><?= $this->fetch('title') ?></span>
        </div>
        <div class="header-help">
        
        <?php 
        $user = $this->Session->read("Auth.User");
        if($user)
		{
		   echo '<span> '.$this->Session->read("Auth.User.username").'</span>'; 
                                  
           echo $this->Html->link('<span class="badge" id="cart-counter">Sign Out</span>',
                                        array('controller'=>'Users','action'=>'logout'),array('escape'=>false));
                                   
          
		}
        else
		{
 		echo $this->Html->link('<span class="badge" id="cart-counter">Sign In</span>',
                                        array('controller'=>'Users','action'=>'login'),array('escape'=>false));
        echo $this->Html->link('<span class="badge" id="cart-counter">Register?</span>',
                                        array('controller'=>'Users','action'=>'add'),array('escape'=>false));
                                   
		
		}
        
        echo $this->Html->link('<span class="glyphicon glyphicon-shopping-cart"></span> My Cart <span class="badge" id="cart-counter">'.$counter.'</span>',
                                        array('controller'=>'Products','action'=>'cart'),array('escape'=>false)); 
        ?>
          
        </div>
        
    </header>
    
    
    <div class="container2">
     
    <nav class="navbar navbar-default" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">vnStore Online</a>
        <?php 
        	$shop_name = $this->Session->read('shopname');
			echo '<a class="navbar-brand" href="/products">'. $shop_name.'</a>';
        ?>
        
      </div>
     
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li>
            
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </nav>
     
    
</div>
<div id="container1">
   
   <?= $this->Flash->render() ?>
  </div>
    <div id="container">
 
     
    <?php echo $this->fetch('content'); ?>
   

       
    </div>
</body>
 
      
</html>
