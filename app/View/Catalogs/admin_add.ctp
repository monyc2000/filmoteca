<?php
$this->extend('/Commons/admin_add');
$this->Html->addCrumb('Admin Catálogo', array('action'=>'index'));
$this->assign('Agregar Catálogo');


$this->start('extra-info');?>

<p> Tipo de archivos permitidos: <b>pdf</b></p>
<div class="note">
	<p>Nota: los archivos subidos son renombrados como:
	catalogo_<b>fecha_actual</b>.<b>extension</b></p>

	<p>Donde <b>fecha_actual</b> es sustituida por la fecha actual y
	<b>extension</b> por el nombre del achivo.</p>

	<p> Si el archivo es subido el mismo día, es decir, ya existe,
	éste sera sobreescrito.</p>
</div>


<?php
$this->end();

$this->start('extra-inputs');

echo $this->element(
	'upload-files', 
	array(
		'model' => $model,
		'filesNumber' => 1,
		'types' => 'pdf',
		'maxSize' => 2));

$this->end();