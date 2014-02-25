<?php

$this->extend('/Commons/admin_add');
$this->Html->addCrumb('Admin Eventos', '/admin/events');
$this->assign('subtitle','Agregar Evento');

$this->start('extra-inputs');
echo $this->element('form-to-upload-image', array('model' => $model));
$this->end();
?>