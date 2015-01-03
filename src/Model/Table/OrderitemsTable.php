<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Orderitems Model
 */
class OrderitemsTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('orderitems');
		$this->displayField('id');
		$this->primaryKey('id');
		$this->belongsTo('Products', [
			'alias' => 'Products',
			'foreignKey' => 'product_id'
		]);
		$this->belongsTo('Orders', [
			'alias' => 'Orders',
			'foreignKey' => 'order_id'
		]);
	}

/**
 * Default validation rules.
 *
 * @param \Cake\Validation\Validator $validator instance
 * @return \Cake\Validation\Validator
 */
	public function validationDefault(Validator $validator) {
		$validator
			->add('id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('id', 'create')
			->add('quantity', 'valid', ['rule' => 'numeric'])
			->requirePresence('quantity', 'create')
			->notEmpty('quantity')
			->add('product_id', 'valid', ['rule' => 'numeric'])
			->requirePresence('product_id', 'create')
			->notEmpty('product_id')
			->add('order_id', 'valid', ['rule' => 'numeric'])
			->requirePresence('order_id', 'create')
			->notEmpty('order_id');

		return $validator;
	}

}
