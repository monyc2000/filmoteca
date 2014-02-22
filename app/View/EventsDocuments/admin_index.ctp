<?php $this->Html->css('DocumentManager.style', null, array('inline' => false)); ?>
<?php
$this->Html->script(array(
	'DocumentManager.script',
	'DocumentManager.jquery.zclip.min'
		), array('inline' => false));
?>
<?php $this->Html->addCrumb('Admin Eventos','/admin/events')?>

<h2><?php echo __d("document_manager", "Gestion des documents"); ?></h2>

<div id="files-top">

	<?php
	echo __d("document_manager", "Dossier: ") . $this->Html->link(
			sprintf("/ %s /", Configure::read('DocumentManager.baseDir')), array('action' => 'index'));
	?>
	<?php foreach ($pathFolderNames as $i => $pathFolderName): ?>
		<?php
		echo $this->Html->link(
				$pathFolderName . ' /', array_slice($pathFolderNames, 0, $i + 1)
		);
		?>
<?php endforeach; ?>

</div>

<div class="wrapper name-row even">
	<?php if (count($pathFolderNames) - 1): ?>
		<?php
		echo $this->Html->link(
				__d("document_manager", "Remonter dans l'arborescence"), count($pathFolderNames) > 1 ? array_slice($pathFolderNames, 0, count($pathFolderNames) - 1) : array('action' => 'index'), array('class' => 'backlink name-index')
		);
		?>
<?php endif; ?>
</div>

<?php $i = 0; ?>
	<?php foreach ($folders as $folder): ?>
	<div class="wrapper name-row row <?php echo ++$i % 2 ? 'odd' : 'even'; ?>">
	<?php echo $this->element('DocumentManager.folder', compact('pathFolderNames', 'folder')); ?>
	</div>
<?php endforeach; ?>

	<?php foreach ($files as $file): ?>
	<div class="wrapper name-row row <?php echo ++$i % 2 ? 'odd' : 'even'; ?>">
	<?php echo $this->element('DocumentManager.file', compact('pathFolderNames', 'file')); ?>
	</div>
<?php endforeach; ?>

<?php if (!(empty($pathFolderNames) && Configure::read('DocumentManager.excludeRootFiles'))): ?>
	<?php
	echo $this->Form->create(false, array(
		'url' => array_merge(
				$pathFolderNames, array('action' => 'admin_upload_file')
		),
		'enctype' => 'multipart/form-data'
	));
	?>
	<fieldset>
		<legend><?php echo __d("document_manager", "Ajouter un fichier"); ?></legend>
		<div class="control-group">
			<label class="control-label"><?php echo __d("document_manager", "Ajouter un fichier"); ?></label>
			<div class="controls">

	<?php echo $this->Form->file('file'); ?>
			</div>
		</div>
		<?php echo $this->Form->input('comments', array('type' => 'textarea', 'label' => array('text' => __d("document_manager", "Description du fichier"), 'class' => 'control-label'))); ?>
	<?php echo $this->Form->submit(__d("document_manager", "Mettre en ligne"), array('div' => false, 'class' => 'btn btn-default')); ?>
		<div class="clear"></div>
	</fieldset>
	<?php echo $this->Form->end(); ?>
<?php endif; ?>

