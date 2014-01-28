<?php
$this->Html->script('hideFlash', array('inline' => false));
?>
<h2>Agregar Género</h2>
<?php
echo $this->Form->create();
echo $this->Form->input('género');
echo $this->Form->end('Agregar');
