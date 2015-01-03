<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Shop Entity.
 */
class Shop extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'description' => true,
		'address' => true,
		'name' => true,
		'user_id' => true,
		'url' => true,
		'user' => true,
		'orders' => true,
		'products' => true,
	];

}
