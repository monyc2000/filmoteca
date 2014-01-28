<?php
$this->Html->script('libs/jquery.validate.min',array('inline'=>false));
$this->Html->css('admin',null,array('inline'=>false));
$this->Html->script('ItemsAdd', array('inline' => false));
$this->Html->script('hideFlash', array('inline' => false));

$formOptions = array(
	'action' => 'add',
	'type' => 'file',
	'inputDefaults' => array(
		'div' => 'field-input',
	)
);
?>

<h2>Agregar Artículo</h2>

<?php
echo $this->Form->create('Item', $formOptions);
echo $this->Form->input('Item.precio_general');
echo $this->Form->input('Item.precio_especial');
echo $this->Form->input('Item.existencias');
echo $this->Form->input('Item.shop_category_id', array('selected' => 1,'label' => 'Categoría'));
?>

<div id="items">
	<div class="item1 item4 item5 item6 item7" style="display:none">
		<?php echo $this->Form->input('Souvenir.nombre'); ?>
		<?php echo $this->element('form-to-upload-image',array('model' => 'Souvenir'))?>
	</div>
	<div class="item2" style="display:none">
		<?php echo $this->Form->inputs($bookFields, $bookBlackList); ?>
		<?php echo $this->element('form-to-upload-image',array('model' => 'Book'))?>
	</div>
	<div class="item3" style="display:none">
		<?php echo $this->Form->inputs($filmFields, $filmBlackList); ?>
		<?php echo $this->element('form-to-upload-image',array('model' => 'Film'))?>
	</div>
</div>
<?php
echo $this->Form->end('Agregar');
?>