<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Error\Debugger;


/**
 * Orderitem Entity.
 */
class Orderitem extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'quantity' => true,
		'product_id' => true,
		'order_id' => true,
		'product' => true,
		'order' => true,
	];

	
	public function getProduct($product_id = null)
	{
		
		$products = TableRegistry::get('Products');
		//echo "PRODUCT ID: " . $product_id;
		//Debugger::dump($product);
		return $products->get($product_id);
	}
}
