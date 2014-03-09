<div class="field-input">
<h3>Subir achivos</h3>
<?php for($i = 0; $i< $filesNumber; $i++):?>
	<input 
		type="file" 
		name="<?php echo 'data[' . $model . '][files][' . $i . ']'?>">
<?php endfor?>
</div>

