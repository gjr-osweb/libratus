<?php if (function_exists('printRegistrationForm')) {
include ('inc-header.php'); ?>

		<div id="page-header" class="wrap" style="background-image: linear-gradient(rgba(0, 0, 0, 0.65),rgba(0, 0, 0, 0.65)), url(<?php echo $bg; ?>);">
			<div class="inner">
				<h1><?php echo gettext('User Registration') ?></h1>
			</div>
		</div>
		
		<div class="bar">
			<div class="inner">
				<?php echo $quickmenu; ?>
				<div class="pad" id="breadcrumb">
					<a href="<?php echo getGalleryIndexURL(); ?>"><i class="fa fa-home"></i>&nbsp;<?php printGalleryTitle(); ?></a>&nbsp;/
					<?php echo gettext('User Registration') ?>
				</div>
			</div>
		</div>
			
		<div id="main" class="wrap clearfix">
			<div class="inner">
				<div class="page pad">
					<p><?php printRegistrationForm(); ?></p>
				</div>

				<div class="page-sidebar pad">
					<!-- Insert any sidebar content here... -->
				</div>
			</div>
		</div>
		
<?php 
include('inc-footer.php');
} else {
include(SERVERPATH . '/' . ZENFOLDER . '/404.php');
} ?>