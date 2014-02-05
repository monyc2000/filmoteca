<?php
$this->Html->css(
		array('inicio',
	'miniBillboard',
	'inicio-mq',
	'../js/libs/fancybox/jquery.fancybox.css',
	'presentation'), null, array('inline' => false));

$this->Html->script(
		array(
	'libs/jquery-ui-1.10.0.min',
	'libs/fancybox/jquery.fancybox.js',
	'libs/jquery.scrollTo-1.4.3.1.min',
	'libs/jquery.serialScroll-1.2.3b.min',
	'my_plugins/miniBillboard',
	'my_plugins/presentation',
	'inicio'), array('inline' => false));
?>


<?php $this->start('presentation'); ?>
<div id="presentation" class="presentation">
	<ul>
		<li>
			<!--<div class="info"> 
				<h1>55 Muestra</h1>
				<h3>Internacional</h3>
				<h2>Cineteca Nacional</h2>

				<p class="font-purple">
					Del 8 de noviembre<br>
					al 6 de diciembre</p>
				<h3>Sala Julio Bracho</h3>
				<h4>Centro Cultural Universitario</h4>
			</div>-->
			<a href="#"><?php echo $this->Html->image("portada_carrusel/blue_jasmin_text.jpg") ?></a>
		</li>
		<li>
			<!--<div class="info"> Dos </div>-->
			<a href="#"><?php echo $this->Html->image("portada_carrusel/dulce_vida.jpg") ?></a>
		</li>
		<li>
			<!--<div class="info"> Tres </div>-->
			<a href="#"><?php echo $this->Html->image("portada_carrusel/ConvocatoriaFosforo_2014_txt.jpg") ?></a>
		</li>
		<li>
			<!--<div class="info"> 4 </div>-->
			<a href="#"><?php echo $this->Html->image("portada_carrusel/solo_dios_perdona_text.jpg") ?></a>
		</li>
	</ul>
	<div class="controls">
		<a data-index="0" class="selected"><?php echo $this->Html->image("portada_carrusel/blue_jasmin.jpg") ?></a>
		<a data-index="1"><?php echo $this->Html->image("portada_carrusel/dulce_vida.jpg") ?></a>
		<a data-index="2"><?php echo $this->Html->image("portada_carrusel/dulce_vida.jpg") ?></a>
		<a data-index="3"><?php echo $this->Html->image("portada_carrusel/dulce_vida.jpg") ?></a>
	</div>
</div>
<?php $this->end() ?>


<div class="col-sites-news">
	<div class="row-sites">
		<h2>No te puedes perder, visita:</h2>
		<div class="muvac block first-block">
			<h3>Museo Virtual<br>
				de Aparatos<br>
				Cinematográficos</h3>
		</div>
		<div class="cine-en-linea block">
			<h2>Lo último</h2>
			<h3>Cine en línea</h3>
			<p>Ramón Alva de la Canal<br>
				Un retrato encontrado<br>
				México, 1988<br>
				Director: Javier Audirac</p>
		</div>
	</div>

	<div class="row-news">
		<h2>Noticias</h2>
		<div class="block first-block noticias1">
			&nbsp;
		</div>
		<div class="block noticias2">
			<h2>Entrega</h2>
			<h4>Premios Jośe Rovirosa</h4>
		</div>
	</div>
</div>

<div class="wrapper-billboard">	
	<div class="wrapper-calendar">
		<button id="calendar-button">Calendario</button>
		<div id="calendar"></div>
	</div>
	<div id="billboard" data-url="<?php echo Router::url(array('controller' => 'exhibitions', 'action' => 'minibillboard')) ?>">
		<?php echo $this->element('minibillboard', array('films' => $films, 'time' => mktime(0, 0, 0, '01', '24', '2014'))) ?>
		<?php echo $this->Html->link('Salas', array('controller' => 'auditoriums', 'action' => 'index'), array('class' => 'link-salas')) ?>
	</div>
</div>
<div class="row-others">
	<div class="block-small c">
		<div>Otras cosas</div>
	</div> 
	<div class="block-small">
		<div class="facebook-comments">Face</div>
		<div class="consultar-salas">
			salas
		</div>
	</div>
</div>