<?php $this->extend('admin_add') ?>
<?php $this->assign('subtitle', $subtitle) ?>
<?php $this->Html->addCrumb('Admin Programación', '/admin/exhibitions')?>
<?php
$this->start('extra-inputs');
$this->Form->input('type' => 'file', array('label' => 'Cartelera PDF'));
$this->end();
?>

