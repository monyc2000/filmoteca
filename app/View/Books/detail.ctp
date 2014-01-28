<?php
$this->Html->addCrumb('Tienda', 'items/index');
$this->Html->addCrumb('Libros', 'books/detail/' . $id);
?>
<div class="details">
	<h1 class="title"><?php echo $titulo ?></h1>
	<?php echo $this->Html->image('books/full_' . $id . '.jpg') ?>
	<?php foreach ($bookDetails as $key => $val): ?>
		<b><?php echo strtoupper($key) ?></b><?php echo $val ?><br>
	<?php endforeach ?>
	<p class="sinopsis"><?php echo $sinopsis ?></p>
</div>