<?php

class ShopCategory extends AppModel{
	public $name = 'ShopCategory';
	public $hasMany = 'Item';
	public $displayField = 'nombre';
}

