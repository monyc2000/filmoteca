<?php
$js = array(
	'libs/fancybox/jquery.fancybox',
	'libs/fancybox/helpers/jquery.fancybox-menu',
	'Events');
$css = array(
	'../js/libs/fancybox/jquery.fancybox',
	'../js/libs/fancybox/helpers/jquery.fancybox-menu'
);
$this->Html->script($js, array('inline' => false));
$this->Html->css($css, null, array('inline' => false));
pr($data);
?>

<div class="item" id="item1">
	<img src="http://farm4.staticflickr.com/3824/9041440555_2175b32078_b.jpg">
	<ul class="events-menu" data-itemid="item1">
		<li><a href="#"
			   data-linkto="link-to-images"
			   class="menu-images">Galeria
			</a>
		</li>
		<li><a href="#"
			   data-linkto="link-to-video"
			   class="menu-images">Vídeo
			</a>
		</li>
		<li><a href="#"
			   data-linkto="link-to-audio"			   
			   class="menu-images">
				Audio
			</a>
		</li>
		<li>
			<a href="#"
			   data-linkto="link-to-text"
			   class="menu-text">Información
			</a>
		</li>
	</ul>
	<div class="event-resource">
		<a class="fancybox-menu link-to-images" 
		   rel="gallery1" 
		   href="http://farm4.staticflickr.com/3824/9041440555_2175b32078_b.jpg" 
		   title="Calm Before The Storm (One Shoe Photography Ltd.)">
			<img src="http://farm4.staticflickr.com/3824/9041440555_2175b32078_m.jpg" 
				 alt="" />
		</a>
		<a class="fancybox-menu"
		   rel="gallery1" 
		   href="http://farm3.staticflickr.com/2870/8985207189_01ea27882d_b.jpg" 
		   title="Lambs Valley (JMImagesonline.com)">
			<img src="http://farm3.staticflickr.com/2870/8985207189_01ea27882d_m.jpg" 
				 alt="" />
		</a>
		<a class="gallery fancybox-menu" 
		   rel="gallery1" 
		   href="http://farm4.staticflickr.com/3677/8962691008_7f489395c9_b.jpg" 
		   title="Grasmere Lake (Phil 'the link' Whittaker (gizto29))">
			<img src="http://farm4.staticflickr.com/3677/8962691008_7f489395c9_m.jpg" 
				 alt="" />
		</a>
	</div>

	<div class="event-resource"
		 <a class="fancybox-menu fancybox.iframe link-to-video"
	   href="http://www.youtube.com/embed/L9szn1QQfas?autoplay=1"
	   rel="gallery2">
			<h2 class="title">Video</h2>
		</a>
	</div>
	<div class="event-resource">
		<a class="fancybox-menu fancybox.iframe"
		   style="display:none"
		   rel="gallery2" 
		   href="http://www.youtube.com/watch?v=opj24KnzrWo" 
		   title="Calm Before The Storm (One Shoe Photography Ltd.)">
		</a>
	</div>

	<div class="event-resource">
		<a class="fancybox-menu fancybox.ajax link-to-text" 
		   href="/pages/libreria_y_tienda" 
		   style="display:none">
			<h2 class="title">Evento1</h2>
			<p class="font-white">Audio del evento 1</p>
		</a>
	</div>
</div>

<!--<div id="yy">
	<a class="gallery fancybox-menu"
	   rel="gallery1" href="http://farm4.staticflickr.com/3824/9041440555_2175b32078_b.jpg" title="Calm Before The Storm (One Shoe Photography Ltd.)">
		<img src="http://farm4.staticflickr.com/3824/9041440555_2175b32078_m.jpg" alt="" />
	</a>
	<a class="gallery fancybox-menu"
	   style="display:none"
	   rel="gallery1" href="http://farm3.staticflickr.com/2870/8985207189_01ea27882d_b.jpg" title="Lambs Valley (JMImagesonline.com)">
		<img src="http://farm3.staticflickr.com/2870/8985207189_01ea27882d_m.jpg" alt="" />
	</a>
	<a class="gallery fancybox-menu" 
	   style="display:none"
	   rel="gallery1" href="http://farm4.staticflickr.com/3677/8962691008_7f489395c9_b.jpg" title="Grasmere Lake (Phil 'the link' Whittaker (gizto29))">
		<img src="http://farm4.staticflickr.com/3677/8962691008_7f489395c9_m.jpg" alt="" />
	</a>

	<a class="fancybox-menu fancybox.iframe"  id="video"
	   href="http://www.youtube.com/embed/L9szn1QQfas?autoplay=1"
	   rel="gallery2">
		<h2 class="title">Video</h2>
	</a>
	<a class="video fancybox-menu fancybox.iframe"
	   style="display:none"
	   rel="gallery2" href="http://www.youtube.com/watch?v=opj24KnzrWo" title="Calm Before The Storm (One Shoe Photography Ltd.)">
	</a>

	<a class="fancybox-menu fancybox.ajax text" id="text" 
	   href="/pages/laboratorio" 
	   style="display:none">
		<h2 class="title">Evento1</h2>
		<p class="font-white">Audio del evento 1</p>
	</a>
</div>-->