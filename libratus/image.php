<?php include ('inc-header.php'); ?>

		<div id="page-header" class="wrap" style="background-image: linear-gradient(rgba(0, 0, 0, 0.75),rgba(0, 0, 0, 0.75)), url(<?php echo $bg; ?>);">
			<div class="inner">
				<h1><?php printAlbumTitle(); ?></h1>
				<div class="desc"><?php echo shortenContent(getAlbumDesc(),300,'...'); ?></div>
			</div>
		</div>
		<a id="view"></a>
		
		<div class="bar">
			<div class="inner">
				<?php echo $quickmenu; ?>
				<div class="pad" id="breadcrumb">
					<a href="<?php echo getGalleryIndexURL(); ?>"><i class="fa fa-home"></i>&nbsp;<?php printGalleryTitle(); ?></a>&nbsp;/
					<?php printParentBreadcrumb('',' / ',' / '); printAlbumBreadcrumb(' ', ' / '); printImageTitle(); ?>
					&nbsp;<span>(<em><?php echo imageNumber().' of '.getNumImages(); ?></em>)</span>
				</div>
			</div>
		</div>
	
		<div id="main" class="wrap clearfix">
			<div class="inner">
				<div class="gallery pad fullimage">
					<div class="gallery-fullimage">
						<?php if (isImagePhoto()) { ?>
						<a class="swipebox" title="<?php echo getBareImageTitle(); ?>" href="<?php echo html_encode(getDefaultSizedImage()); ?>">
						<?php } ?>
						<?php printDefaultSizedImage(getBareImageTitle(),'scale'); ?>
						<?php if (isImagePhoto()) { ?>
						</a>
						<?php } ?>
						<?php if (getImageData('copyright')) { ?><p class="image-copy"><i class="fa fa-copyright"></i> <?php echo getImageData('copyright'); ?></p><?php } ?>
					</div>
				</div>

				<div class="gallery-sidebar pad">
					<div class="single-nav">
						<?php if (hasPrevImage()) { ?>
						<a class="button prev-link" href="<?php echo html_encode(getPrevImageURL()).'#view'; ?>" title="<?php echo gettext("Previous Image"); ?>"><i class="fa fa-caret-left"></i> <?php echo gettext("Prev Image"); ?></a>
						<?php } else { ?>
						<span class="button prev-link"><i class="fa fa-caret-left"></i> <?php echo gettext("Prev Image"); ?></span>
						<?php } ?>
						
						<?php if (hasNextImage()) { ?>
						<a class="button next-link" href="<?php echo html_encode(getNextImageURL()).'#view'; ?>" title="<?php echo gettext("Next Image"); ?>"><?php echo gettext("Next Image"); ?> <i class="fa fa-caret-right"></i></a>
						<?php } else { ?>
						<span class="button next-link"><?php echo gettext("Next Image"); ?> <i class="fa fa-caret-right"></i></span>
						<?php } ?>
					</div>
					<hr />
					<h5><?php printImageTitle(); ?></h5>
					<div class="desc"><?php printImageDesc(); ?></div>
					<?php $singletag = getTags(); $tagstring = implode(', ', $singletag); 
					if (strlen($tagstring) > 0) { ?>
					<div class="block"><i class="fa fa-tags fa-fw"></i> <?php printTags('links','','taglist', ', '); ?></div>
					<?php } ?>
					<hr />
					<?php if (getOption('libratus_date_images')) { ?><div><i class="fa fa-calendar fa-fw"></i> <?php printImageDate(); ?></div><?php } ?>
					<?php if (getOption('libratus_download')) { ?><div><i class="fa fa-download fa-fw"></i> <a href="<?php echo html_encode(getFullImageURL()); ?>" title="<?php echo gettext('Download'); ?>"><?php echo gettext('Download').' ('.getFullWidth().' x '.getFullHeight().')'; ?></a></div><?php } ?>
					<?php if (function_exists('printSlideShowLink') && (getNumImages() > 1) && isImagePhoto()) { ?><hr /><div class="slideshow-link"><i class="fa fa-play fa-fw"></i> <?php printSlideShowLink(); ?></div><?php } ?>
					
					<?php if (getOption('libratus_social')) include ('inc-socialshare.php'); ?>
					
					<?php if ((function_exists('printGoogleMap')) || (function_exists('printOpenStreetMap'))) {
						if (function_exists('printOpenStreetMap')) {
							$map = new zpOpenStreetMap();
							if ($map->getGeoData()) {
								setOption('osmap_width','100%',false); // wipe out any px settings for plugin, flex set in css
								setOption('osmap_height','300px',false);
								printOpenStreetMap();
							}
						} elseif (function_exists('printGoogleMap')) {
							if (getGeoCoord($_zp_current_image)) {
								setOption('gmap_width',null,false); // wipe out any px settings for plugin, flex set in css
								setOption('gmap_height',300,false);
								printGoogleMap(gettext('Show Google Map'),null,'show'); 
							}
						}
					} ?>
						
					<?php printCodeblock(); ?>
					
					<?php if (getImageMetaData()) { ?><p><?php printImageMetadata('',false,'imagemetadata'); ?></p><?php } ?>
					
					<?php if (!function_exists('printCommentForm')) { ?>
					<?php if (function_exists('printRating')) { ?>
					<div id="rating" class="block"><?php printRating(); ?></div>
					<?php } 
					if (function_exists('printAddToFavorites')) include ('inc-favorites.php');
					} ?>
					
					
				</div>
				
			</div>	
		</div>
		
		<?php if (function_exists('printCommentForm')) { ?>
		<div id="comments-gallery" class="wrap clearfix">
			<div class="inner">
				<div class="comments-sidebar pad">
					<?php if (function_exists('printRating')) { ?>
					<div id="rating" class="block"><?php printRating(); ?></div>
					<?php } 
					if (function_exists('printAddToFavorites')) include ('inc-favorites.php'); ?>
				</div>
				<div class="comments-main pad">
					<?php printCommentForm(); ?>
				</div>
			</div>
		</div>
		<?php } ?>

		<?php if (function_exists('printRelatedItems')) { 
		$result = getRelatedItems('images',null);
		$resultcount = count($result);
		if ($resultcount != 0) { ?>
		<div id="related-items-gallery" class="wrap clearfix">
			<div class="inner pad">
				<div class="bold-header"><?php echo gettext('Related Images'); ?></div>
				<div class="gallery-thumbs">
					<?php $count = 0; if (is_numeric(getOption('libratus_related_maxnumber'))) { $number = getOption('libratus_related_maxnumber'); } else { $number = 10; } 
					foreach ($result as $item) { 
						if ($count == $number) break;
						$alb = newAlbum($item['album']);
						$obj = newImage($alb, $item['name']);
						$url = $obj->getLink();
						$thumburl = $obj->getThumb(); ?>
						<div>
							<a href="<?php echo html_encode($url);?>" title="<?php echo html_encode($obj->getTitle()); ?>">
								<img src="<?php echo html_encode(pathurlencode($thumburl)); ?>" alt="<?php echo html_encode($obj->getTitle()); ?>" />
							</a>
							<div class="caption caption-image">
								<?php if (isImagePhoto($obj)) { ?>
								<a class="swipebox image-zoom" title="<?php echo html_encode('<a href="'.$obj->getLink().'">'.$obj->getTitle().'</a>'); ?>" href="<?php echo html_encode($obj->getSizedImage(getOption('image_size'))); ?>"><i class="fa fa-search-plus fa-lg"></i></a>
								<?php } ?>
								<?php if (function_exists('getCommentCount')) {
									if (($obj->getCommentsAllowed()) && ($obj->getCommentCount() > 0)) { ?>
									<div class="image-cr"><i class="fa fa-comments"></i><span> <?php echo $obj->getCommentCount(); ?></span></div>
									<?php }
								} ?>
								<?php if (function_exists('getRating')) { 
									if (getRating($obj)) { ?>
									<div class="image-cr"><i class="fa fa-star"></i><span> <?php echo getRating($obj); ?></span></div>
									<?php } 
								} ?>
							</div>
							<i class="fa fa-angle-up mobile-click-details"></i>
						</div>
					<?php $count++; } ?>
				</div>
			</div>
		</div>
		<?php }
		} ?>
			
<?php include ('inc-footer.php'); ?>
