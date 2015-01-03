<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Error\Debugger;
/**
 * Shops Controller
 *
 * @property \App\Model\Table\ShopsTable $Shops
 */
class ShopsController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		
		//Only show list of shops for the user
		$user_id = $this->Auth->user('id');
		if(!$user_id)
		{
			$this->Flash->error('Please login');
			return $this->redirect(['controller' => 'Users', 'action' => 'login']);
		}
		
		$q = $this->Shops->find()->where(['user_id' => $user_id]);
		$this->set('shops', $this->paginate($q));
	}


	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		$this->Auth->allow(['select']);
	}
/**
 * View method
 *
 * @param string|null $id Shop id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$shop = $this->Shops->get($id, [
			'contain' => ['Users', 'Orders', 'Products']
		]);
		$this->set('shop', $shop);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		
		$user_id = $this->Auth->user('id');
		if(!$user_id)
		{
			return $this->redirect(['controller' => 'Users', 'action' => 'login']);
		}
		$shop = $this->Shops->newEntity($this->request->data);
		if ($this->request->is('post')) {
			$shop->user_id = $user_id;
			if ($this->Shops->save($shop)) {
				$this->Flash->success('The shop has been created.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The shop could not be created. Please, try again.');
			}
		}
		//$users = $this->Shops->Users->find('list', ['limit' => 200]);
				
		$this->set(compact('shop'));
	}


	/**
	 * Add method
	 *
	 * @return void
	 */
	public function select() {
		$shop = $this->Shops->newEntity($this->request->data);
		if ($this->request->is('post')) {
			
			$shop_id = $this->request->data['shop_id'];
			if(!$shop_id)
			{
				$this->Flash->error('Please enter a shop id to go');
				return $this->redirect(['action' => 'select']);
			}
			
			$q = $this->Shops->find()->where(['id' => $shop_id]);
			$result = $q->toArray();
			if($result)
			{
				$shop = $result[0];
			}
			else {
				
				$this->Flash->error('The shop id entered is not in the system. Please enter correct one');
				return $this->redirect(['action' => 'select']);
			}
			
						
			// Save shop id in session data
			$this->request->session()->write('shopid', $shop_id);
			$this->request->session()->write('shopname', $shop['name']);
			$this->Flash->success('Welcome to shop '.$shop_id);
			return $this->redirect(['controller' => 'Products', 'action' => 'index']);
			
			}
	
		$this->set(compact('shop'));
	}
/**
 * Edit method
 *
 * @param string|null $id Shop id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$shop = $this->Shops->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$shop = $this->Shops->patchEntity($shop, $this->request->data);
			
			Debugger::dump($shop);
			if ($this->Shops->save($shop)) {
				$this->Flash->success('The shop has been updated.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The shop could not be updated. Please, try again.');
			}
		}
		//$users = $this->Shops->Users->find('list', ['limit' => 200]);
		$this->set(compact('shop', 'users'));
	}

/**
 * Delete method
 *
 * @param string|null $id Shop id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$shop = $this->Shops->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Shops->delete($shop)) {
			$this->Flash->success('The shop has been deleted.');
		} else {
			$this->Flash->error('The shop could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}

}
