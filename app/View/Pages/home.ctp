<?php
$this->Html->css(
		array('inicio',
	'miniBillboard',
	'inicio-mq',
	'../js/libs/fancybox/jquery.fancybox.css'), null, array('inline' => false));

$this->Html->script(
		array(
			'libs/jquery-ui-1.10.0.min',
	'libs/fancybox/jquery.fancybox.js',
	'libs/jquery.scrollTo-1.4.3.1.min',
	'libs/jquery.serialScroll-1.2.3b.min',
	'my_plugins/miniBillboard',
	'inicio'), array('inline' => false));
?> 
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
	<div id="billboard" data-url="<?php echo Router::url(array('controller'=>'exhibitions','action'=>'minibillboard'))?>">
		<?php echo $this->element('minibillboard',array('films' => $films,'time' => mktime(0,0,0,'01','24','2014')))?>
		<?php echo $this->Html->link('Salas', array('controller'=> 'auditoriums','action'=>'index'), array('class'=>'link-salas'))?>
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