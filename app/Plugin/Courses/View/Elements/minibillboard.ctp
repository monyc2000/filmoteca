<h3>Programación del <?php echo date('d',$time)?> 
	de <?php echo __(date('F',$time)) ?> 
	del año <?php echo __(date('Y',$time)) ?> </h3>
<div class="screen">
	<div class="next"></div>
	<div class="prev"></div>
	<div class="sections">
		<ul>
			<?php foreach ($films as $film): ?>
				<li>
					<?php
					echo $this->Html->link(
							$this->Html->image(
									'films/thumbnail_' . $film['Film']['id'] . '.jpg'), array(
						'controller' => 'exhibitions',
						'action' => 'detail',
						$film['Exhibition']['id']), array('title' => $film['Film']['título'], 'escape' => false));
					?>
					<p class = "ver-mas">
						<?php
						echo $this->Html->link('Ver detalles', array(
							'controller' => 'exhibitions',
							'action' => 'detail',
							$film['Exhibition']['id']));
						?>
					</p>
				</li>
			<?php endforeach ?>
		</ul>
	</div>
</div>