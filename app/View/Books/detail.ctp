<?php
$this->Html->addCrumb('Tienda', 'items/index');
?>
<div class="details">
	<h1 class="title"><?php echo $titulo ?></h1>
	<?php if(isset ($subtitulo)):?>
		<h3 class="subtitle"> <?php echo $subtitulo ?></h3>
	<?php endif ?>
	<?php echo $this->Html->image('books/full_' . $id . '.jpg') ?>
	<?php foreach ($bookDetails as $key => $val): ?>
		<b><?php echo mb_strtoupper($key) ?></b><?php echo $val ?><br>
	<?php endforeach ?>
	<p class="sinopsis"><?php echo $sinopsis ?></p>
</div>