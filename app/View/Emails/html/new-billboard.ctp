<h2>Nueva Cartelera</h2>

<p>Se a subido una nueva catelera</p>
<p>Puedes descargar el PDF en: 
	<?php echo $this->Html->link('Descargar (PDF)',$pdfLink);?></p>
<p>También puedes verla online en: 
	<?php echo $this->Html->link('Cartelera en linea', $issueLink);?></p>

<p>Para desuscribirte sigue el siguiente link:
	<?php echo $this->Html->link('Dessucribirme', '/billboards/unsubscribe')?>
	</p>