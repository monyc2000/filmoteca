<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<?php
		if (isset($isHome) && $isHome) {
			$this->Html->css('presentation', null, array('inline' => false));
			$this->Html->script('my_plugins/presentation', array('inline' => false));
		}
		?>
		<?php
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->Html->css(
				array(
					'jquery-ui-1.10.3.min',
					'filmoteca.css',
					'filmoteca-mediaqueries'));
		echo $this->Html->script('libs/jquery-1.9.1.min');
		echo $this->Html->script('libs/jquery-ui-1.10.0.min');
		echo $this->fetch('script'); //estos srcripts sólo deben agregar funciones al arreglo functions
		echo $this->Html->script('filmoteca');
		?>
        <title>Filmoteca UNAM</title>
    </head>

    <body>
        <div class="wrapper">
            <header>
				<div class="higher-links">
					<ul>
						<li>
							<?php
							echo $this->Html->link(
									$this->Html->image(
											'print.png', array('alt' => 'Imprimir')), '#', array(
								'escape' => false));
							?>
						</li>
						<li>
							<?php
							echo $this->Html->link(
									$this->Html->image(
											'accessibility.png', array(
										'alt' => 'Imprimir')), '#', array(
								'escape' => false));
							?>	
						</li>
						<li><a href="#">Contacto</a></li>
						<li><a href="#">Mapa del Sitio</a></li>
						<li><a href="#">Directorio</a></li>
						<li><a href="#">Inicio</a></li>
					</ul>
				</div>
				<div class="banner-filmoteca">
					<?php echo $this->Html->image('../css/imgs/logoUNAM.png', array('class' => 'logo-unam'))
					?>
					<div class="definicion unam">
						<span>
							Universidad Nacional<br>
							Autonoma de Mexico
						</span>
					</div>
					<?php echo $this->Html->image('../css/imgs/logoFilmoteca.png', array('class' => 'logo-filmoteca'))
					?>
					<div class="definicion filmoteca">
						<span>
							Dirección General de<br>
							Actividades Cinematográficas
						</span>
					</div>
				</div>
				<?php if (isset($isHome) && $isHome): ?>
					<?php echo $this->element('presentation') ?>
				<?php endif ?>
				<div class="main-menu">
                    <ul>
						<li>
							<a href="quienes_somos.html">QUIENES SOMOS</a>
							<ul>
								<li>
									<a href="#">Misión y Visión</a>
								</li>
								<li>
									<a href="#">Objetivos y Funciones</a>
								</li>
								<li>
									<a href="#">Organigrama</a>
								</li>
								<li>
									<a href="#">Consejo Asesor</a>
								</li>
								<li>
									<a href="#">Memoria Filmoteca</a>
								</li>
								<li>
									<a href="#">Cronología</a>
								</li>
								<li>
									<a href="#">Directorio</a>
								</li>
                                <li>
									<a href="#">Medalla Filmoteca</a>

								</li>
							</ul>
						</li>
						<li>
							<a href="acervo.html">ACERVO</a>
                            <ul>
								<li>
									<a href="#">Depósito y resguardo</a>
								</li>
								<li>
									<a href="#">Acervo fílmico</a>
								</li>
								<li>
									<a href="#">Filmografía Nacional</a>
								</li>
								<li>
									<a href="#">Acervo de aparatos antigüos</a>
								</li>
								<li>
									<a href="#">Museo virtual de aparatos cinematográficos</a>
								</li>                                

                            </ul>


						</li>

                        <li>
							<a href="acervo.html">SERVICIOS</a>
                            <ul>
								<li>
									<a href="#">Lineamientos generales para acceso al material</a>
								</li>
								<li>
									<a href="#">Préstamo y alquiler de películas</a>
								</li>
								<li>
									<a href="#">Banco de imagen</a>
								</li>
								<li>
									<a href="#">Exposiciones</a>
								</li>
								<li>
									<a href="#">Producción</a>
								</li>                                


                                <li>
									<a href="#">Catalogación</a>
                                </li>
                                <li>
									<a href="#">Laboratorio digital</a>
                                </li>

                            </ul>


						</li>

						<li>
							<a href="centro_de_documentacion.html">CENTRO DE DOCUMENTACIÓN</a>
							<ul>
                                <li>
									<a href="#">Iconoteca</a>
								</li>
								<li>
									<a href="#">Fototeca</a>
								</li>
								<li>
									<a href="#">Biblioteca</a>
								</li>
								<li>
									<a href="#">Videoteca</a>
								</li>
								<li>
									<a href="#">Hemeroteca</a>
								</li>
								<li>
									<a href="#">Libros digitales</a>
								</li>
								<li>
									<a href="#">Colecciones</a>
								</li>
								<li>
									<a href="#">Reglamento</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="programacion.html">PROGRAMACIÓN</a>
                            <ul>
								<li>
									<a href="#">Consulta programación</a>
								</li>
								<li>
									<a href="#">Salas de cine</a>
								</li>
								<li>
									<a href="#">Ciclos de cine</a>
								</li>
								<li>
									<a href="#">Funciones especiales</a>
								</li>
								<li>
									<a href="#">Histórico de programación</a>
								</li>
								<li>
									<a href="#">Cartelera digital</a>
								</li>
								<li>
									<a href="#">Invitaciones</a>
								</li>


							</ul>
						</li>
						<li>
							<a href="prensa.html">PRENSA</a>
                            <ul>
								<li>
									<a href="#">Noticias</a>
								</li>
								<li>
									<a href="#">Filmoteca en los medios</a>
								</li>
								<li>
									<a href="#">Contacto medios</a>
								</li>
								<li>
									<a href="#">Galería</a>
								</li>
								<li>
									<a href="#">Entrevistas</a>
								</li>
                            </ul>

						</li>
						<li>
							<a href="extension_academica.html">EXTENSIÓN ACADÉMICA</a>
							<ul>
								<li>
									<a href="#">Cursos y talleres</a>
								</li>
								<li>
									<a href="#">Atención a alumnos</a>
								</li>
								<li>
									<a href="#">Servicio Social</a>
								</li> 
								<li>
									<a href="#">Becarios</a>
								</li> 
								<li>
									<a href="#">Visitas guiadas</a>
								</li> 
							</ul> 
						</li>
						<li>
							<a href="concursos.html">CONCURSOS</a>
							<ul>
								<li>
									<a href="#">Fósforo</a>
								</li>
								<li>
									<a href="#">José Rovirosa</a>
								</li>
                                <li>
									<a href="#">Corto Móvil</a>
								</li> 
								<li>
									<a href="#">Convocatorias</a>
								</li> 
                            </ul> 

						</li>
						<li>
							<a href="libreria.html">LIBRERIA Y TIENDA</a>
						</li>
					</ul>

					<div class="search"><input type="text" placeholder="  Buscador"></div>	
					<div class="breadcrumbs">
						<?php echo $this->Html->getCrumbs('>', 'Inicio'); ?>
					</div>
                </div>
            </header>

            <div class="body">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>

                <div style="clear:both"></div>
                <footer>
                    <div class="copyright">
                        <p>Hecho en México, todos los derechos reservados 2013.
                            Ésta página puede ser reprodución con fines no lucrativos, siempre
                            y cuando no se mutile, se cite la fuente completa y su dirección electrónica.
                            De otra forma requiere permiso previo por escrito de la 
                            institución. Creditos</p>
                        <p class="sitios-amigos"><a href="#"> Sitios Amigos </a></p>
                    </div>
                    <div class="fiaf">
                        <div class="definicion">
                            MIEMBRO<br>
                            DE LA<br>
                            FIAF
                        </div>
                        <div class="logo">
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
