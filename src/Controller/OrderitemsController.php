<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Orderitems Controller
 *
 * @property \App\Model\Table\OrderitemsTable $Orderitems
 */
class OrderitemsController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->paginate = [
			'contain' => ['Products', 'Orders']
		];
		$this->set('orderitems', $this->paginate($this->Orderitems));
	}

/**
 * View method
 *
 * @param string|null $id Orderitem id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$orderitem = $this->Orderitems->get($id, [
			'contain' => ['Products', 'Orders']
		]);
		$this->set('orderitem', $orderitem);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$orderitem = $this->Orderitems->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Orderitems->save($orderitem)) {
				$this->Flash->success('The orderitem has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The orderitem could not be saved. Please, try again.');
			}
		}
		$products = $this->Orderitems->Products->find('list', ['limit' => 200]);
		$orders = $this->Orderitems->Orders->find('list', ['limit' => 200]);
		$this->set(compact('orderitem', 'products', 'orders'));
	}

/**
 * Edit method
 *
 * @param string|null $id Orderitem id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$orderitem = $this->Orderitems->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$orderitem = $this->Orderitems->patchEntity($orderitem, $this->request->data);
			if ($this->Orderitems->save($orderitem)) {
				$this->Flash->success('The orderitem has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The orderitem could not be saved. Please, try again.');
			}
		}
		$products = $this->Orderitems->Products->find('list', ['limit' => 200]);
		$orders = $this->Orderitems->Orders->find('list', ['limit' => 200]);
		$this->set(compact('orderitem', 'products', 'orders'));
	}

/**
 * Delete method
 *
 * @param string|null $id Orderitem id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$orderitem = $this->Orderitems->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Orderitems->delete($orderitem)) {
			$this->Flash->success('The orderitem has been deleted.');
		} else {
			$this->Flash->error('The orderitem could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}

}
