<?php
$the_process = get_field('the_process');
if ( $the_process ) : ?>

	<section id="front-the-process" class="section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="left-side wow fadeIn" data-wow-delay="100ms">
						<?php if ( $the_process['left_side']['section_title'] ) : ?>
							<header class="section-title mb-4">
								<h2 class=""><?= $the_process['left_side']['section_title']; ?></h2>
							</header>
						<?php endif; ?>
						<?php if ( $the_process['left_side']['content'] ) : ?>
							<div class="entry-content font-primary mb-5">
								<?= $the_process['left_side']['content']; ?>
							</div>
						<?php endif; ?>
						<?= $the_process['left_side']['image'] ? '<img class="img-fluid" src="'.$the_process['left_side']['image']['sizes']['medium_large'].'" loading="lazy" alt="'.$the_process['left_side']['image']['alt'].'">' : null ; ?>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<?php if ( $the_process['the_process'] ) : ?>
						<ul class="list-group">
							<?php foreach ( $the_process['the_process'] as $item ) : ?>
								<li class="list-group-item d-flex position-relative wow fadeInUp" data-wow-delay="100ms" data-wow-offset="40">
									<i class="icon"></i>
									<div class="content font-secondary">
										<h3 class="title mb-2"><?= $item['title']; ?></h3>
										<?= $item['description']; ?>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					
				</div>
			</div>
			
			
			
		</div>
	</section>
<?php endif; ?>

