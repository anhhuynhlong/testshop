<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Model\Behavior\TimestampBehavior;

/**
 * Orders Model
 */
class OrdersTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('orders');
	
		$this->displayField('id');
		$this->primaryKey('id');
		$this->hasMany('Orderitems', [
			'alias' => 'Orderitems',
			'foreignKey' => 'order_id'
		]);
		$this->addBehavior('Timestamp');
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
			->add('table_number', 'valid', ['rule' => 'numeric', 'message' => __('Provide a number')])
			->notEmpty('table_number', 'Table number must not be empty')
			->requirePresence('status', 'create')
			->notEmpty('status');

		return $validator;
	}

}
