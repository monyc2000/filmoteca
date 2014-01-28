<?php

class ShopCategory extends AppModel{
	public $name = 'ShopCategory';
	public $hasMany = 'Item';
}

