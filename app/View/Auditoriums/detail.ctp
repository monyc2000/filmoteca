<?php
$this->Html->addCrumb('Salas', '/auditoriums/detail/' . $auditorium['id']);
?>
<div class="details">
    <header>
        <h2><?php echo $auditorium['nombre'] ?></h2>
    </header>
	<?php echo $this->Html->image('auditoriums/full_' . $auditorium['id'] . '.jpg'); ?>
    <div class="direccion">
        <span class="bold"> Dirección:</span> <br> 
		<?php echo $auditorium['dirección'] ?>
    </div>
    <span class="bold">Teléfonos: </span> <?php echo $auditorium['teléfono'] ?><br>
    <span class="bold">Horario: </span> <?php echo $auditorium['horario'] ?><br>
    <span class="bold">Costo General: </span><?php echo $auditorium['costo_general'] ?><br>
    <span class="bold">Costo Estudiantes/Trabajadores: </span><?php echo $auditorium['costo_especial'] ?><br>
	<?php
	$road = array(
		'controller' => 'exhibitions',
		'action' => 'index',
		'filter' =>
		mb_strtolower(
				str_replace(' ', '_', $auditorium['nombre'])));
	echo $this->Html->link('Consultar películas que se exhiben en esta sala.'
			, $road);
	?>
	<div class="map">
		<?php echo $this->Html->image('background-trailer.jpg') ?>
		<div class="wrapper-iframe">
			<?php if (strpos(substr($auditorium['url_mapa'], 0, 30), 'iframe')): ?>
				<?php echo $auditorium['url_mapa'] ?>
			<?php else: ?>
				<img src="<?php echo $auditorium['url_mapa'] ?>">
			<?php endif ?>
		</div>
	</div>
</div>
