<?php include ('inc-header.php'); ?>

		<div id="page-header" class="wrap" style="background-image: linear-gradient(rgba(0, 0, 0, 0.75),rgba(0, 0, 0, 0.75)), url(<?php echo $bg; ?>);">
			<div class="inner">
				<h1><?php printAlbumTitle(); ?></h1>
			</div>
		</div>
		
		<div class="bar">
			<div class="inner">
				<?php echo $quickmenu; ?>
				<div class="pad" id="breadcrumb">
					<a href="<?php echo getGalleryIndexURL(); ?>"><i class="fa fa-home"></i>&nbsp;<?php printGalleryTitle(); ?></a>&nbsp;/
					<?php printParentBreadcrumb('',' / ',' / '); printAlbumTitle(); ?>
				</div>
			</div>
		</div>
	
		<div id="main" class="wrap clearfix">
			<div class="inner">
				<div class="gallery pad">
					<div class="gallery-thumbs-large">
						<?php while (next_album()): ?>
						<div>
							<a href="<?php echo html_encode(getAlbumURL());?>">
								<?php printAlbumThumbImage(getBareAlbumTitle(),'check-flagthumb'); ?>
							</a>
							<div class="caption clearfix">
								<div class="album-details">
									<?php if (getNumAlbums()) { ?><div class="album-sub-count"><i class="fa fa-folder"></i><span> <?php echo getNumAlbums(); ?></span></div><?php } ?>
									<?php if (getNumImages()) { ?><div class="album-img-count"><i class="fa fa-photo"></i><span> <?php echo getNumImages(); ?></span></div><?php } ?>
									<?php if (function_exists('getCommentCount')) {
										if (($_zp_current_album->getCommentsAllowed()) && (getCommentCount() > 0)) { ?>
										<div class="album-com-count"><i class="fa fa-comments"></i><span> <?php echo getCommentCount(); ?></span></div>
										<?php }
									} ?>
								</div>
								<?php if (getOption('libratus_date_albums')) { ?><div class="album-date"><?php printAlbumDate(); ?></div><?php } ?>
								<h3 class="album-title"><?php printBareAlbumTitle();?></h3>
							</div>
							<i class="fa fa-angle-up mobile-click-details"></i>
						</div>	
						<?php endwhile; ?>
					</div>
					
					<div class="gallery-thumbs">
						<?php 
						$gmap_c = 0;
						while (next_image()): 
						// check for geo-coordinates if enabled 
						if (($gmap_c == 0) && ((function_exists('printGoogleMap')) || (function_exists('printOpenStreetMap')))) { // still checking
							if (function_exists('printGoogleMap')) {
								if (getGeoCoord($_zp_current_image)) {
									$gmap_c++; // Print the map, at least one...
									setOption('gmap_width',null,false); // wipe out any px settings for plugin, flex set in css
									setOption('gmap_height',400,false);
								}
							} elseif (function_exists('printOpenStreetMap')) {
								$map = new zpOpenStreetMap();
								if ($map->getGeoData()) {
									$gmap_c++; // Print the map, at least one...
									setOption('osmap_width','100%',false); // wipe out any px settings for plugin, flex set in css
									setOption('osmap_height','400px',false);
								}
							}
						} ?>
						<div>
							<a href="<?php echo html_encode(getImageURL()); ?>" title="<?php echo getBareImageTitle(); ?>">
								<?php printImageThumb(null,'check-flagthumb scale'); ?>
							</a>
							<div class="caption caption-image">
								<?php if (isImagePhoto()) { ?>
								<a class="swipebox image-zoom" title="<?php echo html_encode('<a href="'.getImageURL().'">'.getBareImageTitle().'</a>'); ?>" href="<?php echo html_encode(getDefaultSizedImage()); ?>"><i class="fa fa-search-plus fa-lg"></i></a>
								<?php } ?>
								<?php if (function_exists('getCommentCount')) {
									if (($_zp_current_image->getCommentsAllowed()) && (getCommentCount() > 0)) { ?>
									<div class="image-cr"><i class="fa fa-comments"></i><span> <?php echo getCommentCount(); ?></span></div>
									<?php }
								} ?>
								<?php if (function_exists('getRating')) { 
								if (getRating($_zp_current_image)) { ?>
								<div class="image-cr"><i class="fa fa-star"></i><span> <?php echo getRating($_zp_current_image); ?></span></div>
								<?php } 
								} ?>
							</div>
							<i class="fa fa-angle-up mobile-click-details"></i>
						</div>
						<?php endwhile; ?>
					</div>
				
					<?php if (hasNextPage() || hasPrevPage()) { ?><div class="pad"><hr /><?php printPageListWithNav('« '.gettext('prev'),gettext('next').' »',false,true,'pagination'); ?></div><?php } ?>
				</div>
				
				<div class="gallery-sidebar pad">
					<?php if ($_zp_gallery_page == 'album.php') { ?>
					<div class="single-nav">
						<?php if ($prev = getPrevAlbum()) { ?>
						<a class="button prev-link" href="<?php echo html_encode(getPrevAlbumURL()); ?>" title="<?php echo gettext('Prev album').': '.html_encode($prev->getTitle()); ?>"><i class="fa fa-caret-left"></i> <?php echo gettext("Prev album"); ?></a>
						<?php } else { ?>
						<span class="button prev-link"><i class="fa fa-caret-left"></i> <?php echo gettext("Prev Album"); ?></span>
						<?php } ?>
						
						<?php if ($next = getNextAlbum()) { ?>
						<a class="button next-link" href="<?php echo html_encode(getNextAlbumURL()); ?>" title="<?php echo gettext('Next album').': '.html_encode($next->getTitle()); ?>"><?php echo gettext("Next album"); ?> <i class="fa fa-caret-right"></i></a>
						<?php } else { ?>
						<span class="button next-link"><?php echo gettext("Next Album"); ?> <i class="fa fa-caret-right"></i></span>
						<?php } ?>
					</div>
					<hr />
					<?php if ((getOption('libratus_date_albums')) && ($_zp_gallery_page == 'album.php')) { ?><div><i class="fa fa-calendar fa-fw"></i> <?php printAlbumDate(); ?></div><?php } ?>
					<?php } ?>
					
					<?php if (getNumAlbums() > 0) { ?><div><i class="fa fa-folder fa-fw"></i> <?php echo getNumAlbums().' '.gettext("albums"); ?></div><?php } ?>
					<?php if (getNumImages() > 0) { ?><div><i class="fa fa-photo fa-fw"></i> <?php echo getNumImages().' '.gettext("images"); ?></div><?php } ?>
					<br />
					<div class="desc"><?php printAlbumDesc(); ?></div>
					<?php $singletag = getTags(); $tagstring = implode(', ', $singletag); 
					if (strlen($tagstring) > 0) { ?>
					<div class="tags"><i class="fa fa-tags fa-fw"></i> <?php printTags('links','','taglist', ', '); ?></div>
					<?php } ?>
					
					<?php if (function_exists('printSlideShowLink') && (getNumImages() > 1)) { ?><hr /><div class="slideshow-link"><i class="fa fa-play fa-fw"></i> <?php printSlideShowLink(); ?></div><?php } ?>
					<hr />
					
					<?php if ($_zp_gallery_page == 'album.php') {
					if ((class_exists('RSS')) && (getOption('RSS_album_image'))) { ?>
					<div><i class="fa fa-rss fa-fw"></i> <?php printRSSLink('Collection','',gettext('Album RSS'),'',false); ?></div>
					<?php } 
					if (getOption('libratus_social')) include ('inc-socialshare.php');
					} ?>
					
					<?php printCodeblock(); ?>

					<?php if (!function_exists('printCommentForm') || $_zp_gallery_page == 'favorites.php') {
					if (function_exists('printRating') && $_zp_gallery_page != 'favorites.php') { ?>
					<div id="rating" class="block"><?php printRating(); ?></div>
					<?php } 
					if (function_exists('printAddToFavorites')) include ('inc-favorites.php');
					} ?>
					
				</div>
				
			</div>	
		</div>
		
		<?php if ($gmap_c) { ?>
		<div id="map-gallery" class="clearfix">
			<div id="map-wrap">
				<?php if (function_exists('printOpenStreetMap')) { 
					printOpenStreetMap();
				} else {
					printGoogleMap(gettext('Show Google Map'),null,'show'); 
				} ?>
			</div>
		</div>
		<?php } ?>
		
		<?php if (function_exists('printCommentForm') && $_zp_gallery_page != 'favorites.php') { ?>
		<div id="comments-gallery" class="wrap clearfix">
			<div class="inner">
				<div class="comments-sidebar pad">
					<?php if (function_exists('printRating')) { ?>
					<div id="rating" class="block"><?php printRating(); ?></div>
					<?php } 
					if (function_exists('printAddToFavorites')) include ('inc-favorites.php');
					?>
				</div>
				<div class="comments-main pad">
					<?php if (function_exists('printCommentForm')) printCommentForm(); ?>
				</div>
			</div>
		</div>
		<?php } ?>
		
		<?php if (function_exists('printRelatedItems')) { 
		$result = getRelatedItems('albums',null);
		$resultcount = count($result);
		if ($resultcount != 0) { ?>
		<div id="related-items-gallery" class="wrap clearfix">
			<div class="inner pad">
				<div class="bold-header"><?php echo gettext('Related Albums'); ?></div>
				<div class="gallery-thumbs-large">
					<?php $count = 0; if (is_numeric(getOption('libratus_related_maxnumber'))) { $number = getOption('libratus_related_maxnumber'); } else { $number = 10; } 
					foreach ($result as $item) {
						if ($count == $number) break;
						$obj = newAlbum($item['name']);
						$url = $obj->getLink();
						$thumburl = $obj->getThumb(); ?>
						<a href="<?php echo html_encode($url);?>" title="<?php echo html_encode($obj->getTitle()); ?>">
							<img src="<?php echo html_encode(pathurlencode($thumburl)); ?>" alt="<?php echo html_encode($obj->getTitle()); ?>" />
							<div class="caption clearfix">
								<div class="album-details">
									<?php if ($obj->getNumAlbums()) { ?><div class="album-sub-count"><i class="fa fa-folder"></i><span> <?php echo $obj->getNumAlbums(); ?></span></div><?php } ?>
									<?php if ($obj->getNumImages()) { ?><div class="album-img-count"><i class="fa fa-photo"></i><span> <?php echo $obj->getNumImages(); ?></span></div><?php } ?>
									<?php if (function_exists('getCommentCount')) {
										if (($obj->getCommentsAllowed()) && ($obj->getCommentCount() > 0)) { ?>
										<div class="album-com-count"><i class="fa fa-comments"></i><span> <?php echo $obj->getCommentCount(); ?></span></div>
										<?php }
									} ?>
								</div>
								<div class="album-date"><?php echo zpFormattedDate(DATE_FORMAT, strtotime($obj->getDateTime())); ?></div>
								<h3 class="album-title"><?php echo html_encode($obj->getTitle()); ?></h3>
							</div>
						</a>
					<?php  $count++; } ?>
				</div>
			</div>
		</div>
		<?php }
		} ?>
		
<?php include ('inc-footer.php'); ?>	