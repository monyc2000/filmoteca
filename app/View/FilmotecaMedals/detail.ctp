<div class="details">
	<h2><?php echo $person['nombre']?></h2>
	<div class="details-photo">
		<?php echo $this->Html->image( $person['foto'], array('alt' => $person['nombre']))?>
	</div>
	<p>Fecha en la que recibió la medalla: <?php echo $person['fecha']?></p>
	<h2>Biografia</h2>
	<?php echo $person['biografia']?>
</div>

