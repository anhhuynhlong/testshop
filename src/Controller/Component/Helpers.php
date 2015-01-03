<?php

namespace App\Controller\Component;

class Helpers{
	
	public function _construct()
	{
		
		
	}
	
	public static function getShops()
	{
		$this->loadModel("Shops");
		$this->loadModel("Categories");
		$user_id = $this->Auth->user('id');
		
		$shops = $this->Shops->find('list')->where(['user_id' => $user_id]);
		$cat = $this->Categories->find("list")->where(['shop_id' => array_keys($shops->toArray())], ['shop_id' => 'integer[]']);
		
		return array($shops, $cat);
	}

}

