<?php 
if ((class_exists('Zenpage')) && (ZP_PAGES_ENABLED)) {
include('inc-header.php'); ?>

		<div id="page-header" class="wrap" style="background-image: linear-gradient(rgba(0, 0, 0, 0.65),rgba(0, 0, 0, 0.65)), url(<?php echo $bg; ?>);">
			<div class="inner">
				<h1><?php printPageTitle(); ?></h1>
			</div>
		</div>

		<div class="bar">
			<div class="inner">
				<?php echo $quickmenu; ?>
				<div class="pad" id="breadcrumb">
					<a href="<?php echo getGalleryIndexURL(); ?>"><i class="fa fa-home"></i>&nbsp;<?php printGalleryTitle(); ?></a>&nbsp;/
					<?php printZenpageItemsBreadcrumb('',' / '); ?>
					<?php printPageTitle(); ?>
				</div>
			</div>
		</div>
			
		<div id="main" class="wrap clearfix">
			<div class="inner">
				<div class="page pad">
					<?php printPageContent(); ?>
					<?php $singletag = getTags(); $tagstring = implode(', ', $singletag); 
					if (strlen($tagstring) > 0) { ?>
					<div class="block"><em><?php echo gettext('Tags: '); ?></em><?php printTags('links','','taglist', ', '); ?></div>
					<?php } ?>
					<?php printCodeblock(); ?>
				</div>

				<div class="page-sidebar pad">
					<?php $hasFeaturedImage = false; if (function_exists('printSizedFeaturedImage')) $hasFeaturedImage = getFeaturedImage();
					if ($hasFeaturedImage) { 
						if (is_numeric(getOption('libratus_maxwidth'))) {
								$size = .70 * getOption('libratus_maxwidth');
							} else {
								$size = 920;
							}
					?>
					<div class="featured-image full-article">
						<?php printSizedFeaturedImage(null,null,$size,null,null,null,null,null,null,'scale',null,true,null); ?>
					</div>
					<hr />
					<?php } ?>
					<?php if (getOption('libratus_date_pages')) { ?><em><?php echo gettext('Last Updated: '); ?></em><?php echo getPageLastChangeDate(); ?><hr /><?php } ?>
					
					<?php if (getPageExtraContent()) printPageExtraContent(); ?>
					<?php if (getOption('libratus_social')) include ('inc-socialshare.php'); ?>
					<?php if (!function_exists('printCommentForm')) { ?>
					<?php if (function_exists('printRating')) { ?>
					<div id="rating" class="block"><?php printRating(); ?></div>
					<?php } 
					} ?>
					<?php if (function_exists('printRelatedItems')) { ?>
					<hr />
					<?php printRelatedItems(5,'pages',null,null,true); ?>
					<?php } ?>
				</div>
			</div>
		</div>
		
		<?php if (function_exists('printCommentForm')) { ?>
		<div id="comments-page" class="wrap clearfix">
			<div class="inner">
				<div class="comments-sidebar pad">
					<?php if (function_exists('printRating')) { ?>
					<div id="rating" class="block"><?php printRating(); ?></div>
					<?php } ?>
				</div>
				<div class="comments-main pad">
					<?php printCommentForm(); ?>
				</div>
			</div>
		</div>
		<?php } ?>
		
		
<?php 
include('inc-footer.php');
} else {
include(SERVERPATH . '/' . ZENFOLDER . '/404.php');
} ?>