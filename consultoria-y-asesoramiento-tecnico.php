<!DOCTYPE html>
<html lang="es">

<?php
	include("head.php");
?>

<?php
	include("body.php");
?>
	<div class="body">
		<?php
            include('header.php');
        ?>
	<div class="section-angled-layer-bottom bg-light" style="padding: 0rem 0;"></div>
	<div role="main" class="main  video-container" >
		<section
			class="section section-concept section-no-border section-dark section-angled section-angled-reverse pt-5 m-0"
			id="section-concept">
			<div class="container pt-5 mt-5">
				<div class="row custom-header-min-height-1 align-items-center pt-3" style="padding: 10px;backdrop-filter: blur(5px);border-radius: 15px;">
					<div class="col-lg-5 mb-5"
						style="background: -webkit-linear-gradient(rgb(65 0 255), rgba(0, 204, 115, 1));-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
						<h5 class="text-primary font-weight-bold mb-1 custom-letter-spacing-1">CONSULTORIA Y
						</h5>
						<h1 class="font-weight-bold text-12 line-height-2 mb-3"
							style="background: -webkit-linear-gradient(rgb(6 0 255), rgba(0, 204, 115, 1));-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
							ASESORAMIENTO TECNICO
						</h1>
						<p class="custom-font-size-1 pt-2" style="text-align: justify;">
                        ¿Por qué debería adquirir este servicio? La tecnología está en constante evolución y mantenerse al día puede ser un desafío. 
                        La consultoría técnica proporciona una visión experta y estratégica para asegurar que su empresa aproveche al máximo las oportunidades tecnológicas.
						<br>
                        Ofrecemos servicios de consultoría y asesoramiento técnico que abarcan desde la evaluación de tecnologías hasta la implementación de soluciones complejas. 
                        Nuestro objetivo es ayudarlo a tomar decisiones informadas y estratégicas para el crecimiento y éxito de su negocio.
						</p>

					</div>
					<div class="col-lg-6 offset-lg-1 mb-5">
						<div class="position-relative border-width-10 border-color-light clearfix border border-radius"
							data-remove-min-height style="min-height: 394px;">
							<?
   								include('--embed-video-consultoría-y-asesoramiento-técnico.php');
 							?>

						</div>
					</div>
					<div class="col-md-8 col-lg-6 col-xl-5 custom-header-bar position-relative py-4 pe-5 z-index-2">
						<div>
							<div class="star-rating-wrap d-flex align-items-center justify-content-center position-relative text-5 py-2 mb-2"
								style="background: -webkit-linear-gradient(rgb(65 0 255), rgba(0, 204, 115, 1));
								-webkit-background-clip: text;
								-webkit-text-fill-color: transparent;">
								<i class="fas fa-star"></i><i class="fas fa-star ms-1"></i><i
									class="fas fa-star ms-1"></i><i class="fas fa-star ms-1"></i><i
									class="fas fa-star ms-1"></i>
							</div>

							<h4 class="position-relative text-center font-weight-bold text-7 line-height-2 mb-0">
								EL FUTURO ES AHORA</h4>

							<p class="position-relative text-center font-weight-normal mb-1">TU
								SOCIO TECNOLÓGICO
							</p>
						</div>
					</div>
				</div>
			</div>
		</section>


		<hr>

	</div>
    <?php
    include('footer.php')
    ?>
	</div>
	<?php
		include("endBody.php")
	?>

</html>