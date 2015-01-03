<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity.
 */
class Order extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'info' => true,
		'status' => true,
		'orderitems' => true,
			'shop_id' => true,
			'table_number' => true,
	];

}
