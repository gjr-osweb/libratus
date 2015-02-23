<?php include ('inc-header.php'); ?>

		<div id="page-header" class="wrap" style="background-image: linear-gradient(rgba(0, 0, 0, 0.65),rgba(0, 0, 0, 0.65)), url(<?php echo $bg; ?>);">
			<div class="inner">
				<h1><?php echo gettext('404'); ?></h1>
			</div>
		</div>
		
		<div class="bar">
			<div class="inner">
				<?php echo $quickmenu; ?>
				<div class="pad" id="breadcrumb">
					<a href="<?php echo getGalleryIndexURL(); ?>"><i class="fa fa-home"></i>&nbsp;<?php printGalleryTitle(); ?></a>&nbsp;/
					<?php echo gettext('404 Page Not Found'); ?>
				</div>
			</div>
		</div>
			
		<div id="main" class="wrap clearfix">
			<div class="inner">
				<div class="page pad">
					<h1><?php echo gettext('404 not found'); ?></h1>
					<p><?php echo gettext('The page you are requesting cannot be found.'); ?></p>
				</div>

				<div class="page-sidebar pad">
					<!-- Insert any sidebar content here... -->
				</div>
			</div>
		</div>
		
<?php include('inc-footer.php'); ?>