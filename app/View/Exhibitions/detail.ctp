<?php
$this->Html->addCrumb('Programación', 'exhibitons/index');
$this->Html->addCrumb('Película', 'exhibitions/detail/' . $details['Film']['id']);

foreach ($mt as $val) {
	$this->Html->meta($val, array('inline' => false));
}
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id))
			return;
		js = d.createElement(s);
		js.id = id;
		js.src = "http://connect.facebook.net/es_LA/all.js#xfbml=1";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
<div class="details">
	<h2><?php echo $details['Film']['título'] ?></h2>
	<div class="cartel">
		<?php echo $this->Html->image('films/full_' . $details['Film']['id'] . '.jpg', array('alt' => $details['Film']['título'])); ?>
		<?php $id = $details['Film']['id']; ?>
		<?php unset($details['Film']['id']) ?>
	</div>
	<div class="fb-like" 
		 data-href="<?php echo Router::url('/', true) . 'exhibitions/detail/' . $id ?>" 
		 data-layout="standard" 
		 data-action="like" 
		 data-show-faces="true" 
		 data-share="true"></div>
	<div class="ficha-tecnica">
		<?php foreach ($details['Film'] as $key => $val): ?>
			<p>
				<?php if (!empty($val)): ?>
					<b><?php echo strtoupper($key) ?>: </b> <?php echo $val ?><br>
				<?php endif ?>
			<?php endforeach ?>
		</p>
		<p>
			<?php echo $sinopsis ?>
		</p>
	</div>
	<div class="exhibition-details">
		<table class="timetable">
			<tr>
				<th>Fecha</th>
				<th>Horara</th>
			</tr>
			<?php foreach ($details['Timetable'] as $v): ?>
				<tr>
					<td><?php echo $v['fecha']; ?></td><td><?php echo $v['hora'] ?></td>
				</tr>
			<?php endforeach ?>
		</table>
		<p>Sala: <?php echo $details['Auditorium']['nombre'] ?>
			<?php
			echo $this->Html->link(
					'¿Dónde se ubica?', '/auditoriums/detail/' .
					$details['Auditorium']['id']);
			?>
		</p>
	</div>

	<div class="trailer">
		<?php echo $this->Html->image('background-trailer.jpg') ?>
		<div class="wrapper-iframe">
			<?php if (strpos(substr($url_trailer, 0, 30), 'iframe')): ?>
				<?php echo $url_trailer ?>
			<?php else: ?>
				<video src="">Viedo no disponible</video>
			<?php endif ?>
		</div>
	</div>
</div>

