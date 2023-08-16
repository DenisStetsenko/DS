<?php
$the_process 	= get_field('the_process');
if ( $the_process ) : ?>

	<section id="front-the-process" class="section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 mb-5 mb-lg-0">
					<div class="left-side">
						<?php if ( $the_process['left_side']['section_title'] ) : ?>
							<header class="section-title mb-4">
								<h2 class=""><?= $the_process['left_side']['section_title']; ?></h2>
							</header>
						<?php endif; ?>
						<?php if ( $the_process['left_side']['content'] ) : ?>
							<div class="entry-content mobile-content-sm-size font-primary mb-3 mb-lg-10">
								<?= $the_process['left_side']['content']; ?>
							</div>
						<?php endif; ?>
						<?= $the_process['left_side']['image'] ? '<img class="img-fluid mx-auto d-none d-lg-block" src="'.$the_process['left_side']['image']['sizes']['medium_large'].'" loading="lazy" alt="'.$the_process['left_side']['image']['alt'].'">' : null ; ?>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1 ps-lg-0">
					<?php if ( $the_process['the_process'] ) : ?>
						<ul class="list-group">
							<?php foreach ( $the_process['the_process'] as $item ) : ?>
								<li class="list-group-item d-flex position-relative">
									<i class="icon"></i>
									<div class="content font-primary">
										<h3 class="title mb-2"><?= $item['title']; ?></h3>
										<?= $item['description']; ?>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<?= $the_process['left_side']['image'] ? '<img class="img-fluid mx-auto d-lg-none mt-6" src="'.$the_process['left_side']['image']['sizes']['medium_large'].'" loading="lazy" alt="'.$the_process['left_side']['image']['alt'].'">' : null ; ?>
				</div>
			</div>
			
			
			
		</div>
	</section>
<?php endif; ?>

