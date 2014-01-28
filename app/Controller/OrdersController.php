<?php

class OrdersController extends AppController {

	public $scaffold = 'admin';

	public function add() {
		$message = '';

		if ($this->request->is('post')) {
			$orderItems = $this->Session->read('cart');
			$order = array();
			$order['Order']['fecha'] = 'now()';
			$order['Order']['nombre'] = $this->request->data['Order']['nombre'];
			$order['Order']['direccion'] = $this->request->data['Order']['direccion'];
			$order['OrderItem'] = $orderItems;
			if ($this->Order->saveAssociated($order)) {
				$this->Session->delete('cart');
				$message = 'Orden Guardada.<br>'
						. ' Numero de orden: <b>' . $this->Order->id . '</b>';
			} else {
				$message = 'No se pudo realizar la orden.';
			}
		}

		$this->Session->setFlash(__($message));
	}

}
