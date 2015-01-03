<?php
namespace App\Controller;

use Cake\Error\Debugger;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 */
class OrdersController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index($status = null) {
		//$this->set('orders', $this->paginate($this->Orders));
		
		//Only show list of shops for the user
		$user_id = $this->Auth->user('id');
		if(!$user_id)
		{
			$this->Flash->error('Please login');
			return $this->redirect(['controller' => 'Users', 'action' => 'login']);
		}
		//Look for list of shops of the authenticated user
		$this->loadModel("Shops");
		$q_shop_list = $this->Shops->find()->where(['user_id' => $user_id]);
		$shop_list = $q_shop_list->toArray();
		$list = array();
		foreach($shop_list as $sh)
		{
			array_push($list, $sh->id);
		}
		if($status != null)
		{
			$q = $this->Orders->find()->where(['shop_id' => $list, 'status' => $status], ['shop_id' => 'integer[]']);
		}
		else {
			$q = $this->Orders->find()->where(['shop_id' => $list], ['shop_id' => 'integer[]']);
		}
		$this->set('orders', $this->paginate($q));
	}

	
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		$this->Auth->allow(['add']);
	}
/**
 * View method
 *
 * @param string|null $id Order id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$order = $this->Orders->get($id, [
			'contain' => ['Orderitems']
		]);
		 
		$this->set('order', $order);
	}



/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$order = $this->Orders->newEntity($this->request->data);
		$shop_id = $this->request->session()->read('shopid');
		if($shop_id)
		{
			$order->shop_id = $shop_id;
		}
		//Order statuses
		//Cancelled: 4
		//New: 3
		//Served: 2
		//Paid: 1
		
		$order->status = 3;
				
		if ($this->request->is('post')) {
			
			//save order
			//$order->date = DboSource::expression('NOW()');
			if ($this->Orders->save($order)) {
				$this->Flash->success('The order has been saved.');
									
			} else {
				$this->Flash->error('The order could not be saved. Please, try again.');
				return $this->redirect(['action' => 'index']);
			}
						
			//save order items
			$products = $this->request->session()->read('Cart.Product');
			if(!$products)
			{
				$this->Flash->error('There is no order items');
				return $this->redirect(['action' => 'index']);
				
			}
			else
			{
				$orderitems = TableRegistry::get('Orderitems');
				$this->loadModel('Orderitems');
				
				foreach ($products as $product)
				{
					
					
					$item = $this->Orderitems->newEntity();
					$item->product_id = $product->id;
					$item->order_id = $order->id;
					$item->quantity = $this->request->session()->read('Cart.Quantity.'. $product->id);
					$this->Orderitems->save($item);
					//Debugger::dump($item);
					
										
				}
				
				//Empty cart
				//$this->Products->empty_cart();
				
				//delete cart with all elements and counter
				$this->request->session()->delete('Cart');
				 
				return $this->redirect(
						['controller' => 'Products', 'action' => 'index']);
			}
			
		}
		
		$this->set(compact('order'));
	}

/**
 * Edit method
 *
 * @param string|null $id Order id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$order = $this->Orders->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$order = $this->Orders->patchEntity($order, $this->request->data);
			if ($this->Orders->save($order)) {
				$this->Flash->success('The order has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The order could not be saved. Please, try again.');
			}
		}
		$this->set(compact('order'));
	}

	public function process($id = null, $status = null) {
		$order = $this->Orders->get($id, [
				'contain' => []
		]);
		$order->status = $status;
		if ($this->Orders->save($order)) {
			$this->Flash->success('The order has been saved.');
			return $this->redirect(['action' => 'index']);
		} else {
			$this->Flash->error('The order could not be saved. Please, try again.');
		}
		 return $this->redirect(
        ['action' => 'index']);
	}
	
	
/**
 * Delete method
 *
 * @param string|null $id Order id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$order = $this->Orders->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Orders->delete($order)) {
			$this->Flash->success('The order has been deleted.');
		} else {
			$this->Flash->error('The order could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}

}
