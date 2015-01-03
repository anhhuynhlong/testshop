<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Error\Debugger;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Event\Event;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController {

public function index() {
	$shop_id = $this->request->session()->read('shopid');
	
	//Check if shop id selected otherwise redirect to select shop page
	if(!$shop_id)
	{
		$this->Flash->error('Please select a shop to go.');
		return $this->redirect(
				['controller' => 'Shops', 'action' => 'select']);
	}
	$this->loadModel("Products");
	$q = $this->Products->find()->where(['shop_id' => $shop_id]);
	
	$this->set('products', $this->paginate($q));
		
    }
    
    public function beforeFilter(Event $event) {
    	parent::beforeFilter($event);
    	$this->Auth->allow(['index', 'add_to_cart', 'view', 'cart', 'empty_cart', 'update_cart_minus', 'update_cart_plus']);
    }
    
    
    /**
     * Add method
     *
     * @return void
     */
    public function add() {
    	
    	    	
    	$product = $this->Products->newEntity($this->request->data);
    	if ($this->request->is('post')) {
    		
    		//Process upload file
    		$upload_file_name = $_FILES['productimage']['tmp_name'];
    		$file = new File ($upload_file_name);
    		$img = '/img/upload/'.date('His');
    		$file->copy(WWW_ROOT . $img, true);
    		$file->delete();
    		
    		//Save product
    		$product->image = $img;
    		//Debugger::dump($product);
    		//Debugger::dump($this->request->data);
    		if ($this->Products->save($product)) {
    			$this->Flash->success('The product has been saved.');
    			//return $this->redirect(['action' => 'index']);
    		} else {
    			$this->Flash->error('The product could not be saved. Please, try again.');
    		}
    	}
    	//$users = $this->Shops->Users->find('list', ['limit' => 200]);
    	
    	$this->loadModel("Categories");
    	$this->loadModel("Shops");
    	$userid = $this->Auth->user('id');
    	$shops = $this->Shops->find('list', ['limit' => 200])->where(['user_id' => $userid]);
    	    	
    	$categories = $this->Categories->find('list', ['limit' => 200])->where(['shop_id' => array_keys($shops->toArray())], ['shop_id' => 'integer[]']);
    	
    	$this->set(compact('categories', 'shops', 'product'));
    	    	
    }

    public function upload() {
    	 
    if ($this->request->is('post')) {
  // Debugger::dump($_FILES);
//     	[
//     	'submittedfile' => [
//     			'name' => '1104 3.jpg',
//     			'type' => 'image/jpeg',
//     			'tmp_name' => '/tmp/phpPh0GOD',
//     			'error' => (int) 0,
//     			'size' => (int) 53401
//     	]
//     	]
		
  // Debugger::dump ($this->data['Image']);
		$upload_file_name = $_FILES['productimage']['tmp_name'];
    	//$dir = new Folder(WWW_ROOT . 'img');
		//$file = new File(WWW_ROOT . 'img/'.data('His') , true, 0755);
		$file = new File ($upload_file_name);
    	$file->copy(WWW_ROOT . 'img/upload/'.date('His'), true);
    	$file->delete();
    	$this->Flash->success('File uploaded.');
    	
    }
    }
    
    
    public function view($id) {
            if (!$this->Products->exists($id)) {
                    throw new NotFoundException(__('Invalid product'));
            }
                 
            $product = $this->Products->get($id);
            
            
            $this->set('products', $product);
            $this->set(compact('product'));
    }  
    
    
    public function update_cart_plus($id) {
    	    	
    	$session = $this->request->session();
    	    	
    	if($session->check('Cart.Product.' . $id))
    	{
    		$quantity = $session->read('Cart.Quantity.'. $id);
    		$quantity = $quantity + 1;
    		$session->write('Cart.Quantity.'. $id, $quantity);
    		
    	}
    	else
    	{
    		
    		//Error ocurr
    		$this->Flash->error("An error has occured");
    		
    	}
    	
    	        
    return $this->redirect(
        ['controller' => 'Products', 'action' => 'cart']);

    }

    public function update_cart_minus($id) {
    
    	$session = $this->request->session();
    
    	if($session->check('Cart.Product.' . $id))
    	{
    		$quantity = $session->read('Cart.Quantity.'. $id);
    		$quantity = $quantity - 1;
    		if($quantity == 0)
    		{
    			$this->setAction('delete', $id);
    			return $this->redirect(
    					['controller' => 'Products', 'action' => 'cart']);
    		}
    		$session->write('Cart.Quantity.'. $id, $quantity);
    
    	}
    	else
    	{
    
    		//Error ocurr
    		$this->Flash->error("An error has occured");
    
    	}
    	 
    	 
    	return $this->redirect(
    			['controller' => 'Products', 'action' => 'cart']);
    
    }
    public function add_to_cart($id = null) {
    	//$this->Product->id = $id;
    	//check if product exists in database
    	//if (!$this->Product->exists()) {
    	//	throw new NotFoundException(__('Invalid product'));
    	//}
    
    	$id = $this->request->data['product_id'];
    	$quantity = $this->request->data['quantity'];
    	$session = $this->request->session();
    	$counter = $session->read('Cart.Counter');
    	if(!$counter)
    	{
    		$counter = 0;
    	}
    	 
    	if(!$session->check('Cart.Product.' . $id))
    	{
    		$session->write('Cart.Product.'. $id, $this->Products->get($id));
    		$session->write('Cart.Quantity.'. $id, $quantity);
    		$session->write('Cart.Counter', $counter + 1);
    	}
    	else
    	{
    
    		//Product already exists
    		$this->Flash->set("Product already exists in Cart");
    		//$num = $session->read('Cart.Quantity.'. $id);
    		//$session->write('Cart.Quantity.'. $id, $num + 1);
    	}
    	 
    	 
    	return $this->redirect(
    			['controller' => 'Products', 'action' => 'index']);
    
    }
    
    
    public function delete($id = null) {
    	
    	//$id = $this->request->data['product_id'];
    	if (!$this->request->session()->check('Cart.Product.' . $id))
    	{
    		throw new NotFoundException(__('Invalid request. Product does not exist in cart'));
    		
    	}
    	
    	//delete product from cart
    	$this->request->session()->delete('Cart.Product.' . $id);
    	$this->request->session()->delete('Cart.Quantity.' . $id);
    	//updeate counter
    	$this->request->session()->write('Cart.Counter', $this->request->session()->read('Cart.Counter') - 1);
    	$this->Flash->success(__('Product has been deleted'));
    	
    	return $this->redirect(
       ['controller' => 'Products', 'action' => 'index']);
    }
    
    
    public function cart() {
    	//show all elemnts in a cart
    	$cart = array();
    
    	if ($this->request->session()->check('Cart.Product')) {
    		$cart = $this->request->session()->read('Cart.Product');
    	}
    
    	$this->set(compact('cart'));
    }
    
    public function empty_cart() {
    	//delete cart with all elements and counter
    	$this->request->session()->delete('Cart');
    	
 		return $this->redirect(
        ['controller' => 'Products', 'action' => 'index']);
    	
    }
    
}
