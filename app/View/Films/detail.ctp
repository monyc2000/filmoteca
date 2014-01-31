<?php

foreach($mt as $val){
	$this->Html->meta($val,null,array('inline' => false));
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
	<h2><?php echo $titulo?></h2>
	<div class="cartel">
		<?php echo $this->Html->image('films/full_' . $id . '.jpg');?>u
	</div>
	<div class="fb-like" 
		 data-href="<?php echo Router::url('/',true) . 'films/detail/' . $id?>"
		 data-layout="standard" 
		 data-action="like" 
		 data-show-faces="true" 
		 data-share="true"></div>
	<div class="ficha-tecnica">
		<?php foreach( $details as $key => $val ):?>
		<p>
			<?php if (!empty($val)): ?>
					<b><?php echo mb_strtoupper($key) ?>: </b> <?php echo $val ?><br>
				<?php endif ?>
			<?php endforeach?>
		</p>
		<p>
			<?php echo $sinopsis?>
		</p>
	</div>
	<div class="trailer">
		<?php echo $this->Html->image('background-trailer.jpg') ?>
		<div class="wrapper-iframe">
			<?php if( strpos( substr( $url_trailer, 0, 30), 'iframe' )): ?>
                <?php echo $url_trailer ?>
            <?php else:?>
			<video src="">Viedo no disponible</video>
            <?php endif?>
		</div>
	</div>
</div>

