<?php

class Order extends AppModel{
	public $hasMany = "OrderItem";
}

