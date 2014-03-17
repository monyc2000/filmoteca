<?php
$this->Html->addCrumb('Programación', '/exhibitions');

$numbersOptions = array(
	'tag' => 'li',
	'separator' => '',
	'currentClass' => 'active',
	'currentTag' => 'a');

$formOptions = array(
	'type' => 'get'
);
?>


<h2>Histórico de programación</h2>

<?php
	echo $this->Form->create(false, $formOptions);
	echo $this->Form->input('director');
	echo $this->Form->input('titulo', array('label' => 'Título'));
	echo $this->Form->input('year', array('label' => 'Año','name'=>'year'));
	echo $this->Form->submit('Buscar', array('class' => 'btn btn-success'));
	echo $this->Form->end();
?>

<ul class='pagination'>
	<?php echo $this->Paginator->prev('<< Anterior', array('tag' => 'li'), null, array('escape' => false, 'tag' => 'li', 'disabledTag' => 'a', 'class' => 'disabled prev')); ?>
	<?php echo $this->Paginator->numbers($numbersOptions); ?>
	<?php echo $this->Paginator->next('Siguiente >>', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'disabled next')); ?>
</ul>
<table class="table">
	<tr>
		<?php foreach ($titles as $column_name => $title): ?>
			<th><?php echo $this->Paginator->sort($column_name, $title) ?></th>
		<?php endforeach; ?>
		<th>Ver datalles</th>
	<tr>
	<?php foreach ($data as $datum): ?>
		<tr>
			<?php foreach ($datum['Film'] as $value): ?>
				<td><?php echo $value ?></td>
			<?php endforeach; ?>
			<td>
				<?php foreach($actions as $action):?>
					<?php echo $this->element($action, array('datum' => $datum[$modelName]))?>
				<?php endforeach;?>
			</td>
		</tr>
	<?php endforeach; ?>
</table>


<ul class='pagination'>
	<?php echo $this->Paginator->prev('<< Anterior', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'disabled prev')); ?>
	<?php echo $this->Paginator->numbers($numbersOptions); ?>
	<?php echo $this->Paginator->next('Siguiente >>', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'disabled next')); ?>
</ul>

<?php echo $this->element('sql_dump'); ?>