<?php include ('inc-header.php'); ?>

		<div id="page-header" class="wrap" style="background-image: linear-gradient(rgba(0, 0, 0, 0.65),rgba(0, 0, 0, 0.65)), url(<?php echo $bg; ?>);">
			<div class="inner">
				<h1><?php echo gettext('Archive').' - '.$stat_title; ?></h1>
			</div>
		</div>
		
		<div class="bar">
			<div class="inner">
				<?php echo $quickmenu; ?>
				<div class="pad" id="breadcrumb">
					<a href="<?php echo getGalleryIndexURL(); ?>"><i class="fa fa-home"></i>&nbsp;<?php printGalleryTitle(); ?></a>&nbsp;/
					<?php printParentBreadcrumb('',' / ',' / '); ?>
					<a href="<?php echo getCustomPageURL('archive'); ?>"><?php echo gettext('Archive'); ?></a>&nbsp;/
					<?php echo $stat_title; ?>
				</div>
			</div>
		</div>
		
		<?php if (is_numeric(getOption('libratus_stats_number'))) { $number = getOption('libratus_stats_number'); } else { $number = 30; } ?>
		
		<div id="main" class="wrap clearfix">
			<div class="inner">
				<div class="gallery pad">
				
					<?php if ($stat_type == 'albums') { 
					$albums = getAlbumStatistic($number,$stat_option,'',1); ?>

					<div class="gallery-thumbs-large">
						<?php if ($albums) {
						foreach ($albums as $album) { 
						$albumthumb = $album->getAlbumThumbImage();
						?>
						<div>
							<a href="<?php echo html_encode($album->getLink()); ?>" title="<?php echo html_encode($album->getTitle()) ;?>">
								<?php echo '<img src="' . html_encode(pathurlencode($albumthumb->getThumb())) . '" alt="' . html_encode($albumthumb->getTitle()) . '" /></a>' . "\n"; ?>
							</a>
							<div class="caption clearfix">
								<div class="album-details">
									<?php if ($album->getNumAlbums()) { ?><div class="album-sub-count"><i class="fa fa-folder"></i><span> <?php echo $album->getNumAlbums(); ?></span></div><?php } ?>
									<?php if ($album->getNumImages()) { ?><div class="album-img-count"><i class="fa fa-photo"></i><span> <?php echo $album->getNumImages(); ?></span></div><?php } ?>
									<?php if (function_exists('getCommentCount')) {
										if (($album->getCommentsAllowed()) && ($album->getCommentCount() > 0)) { ?>
										<div class="album-com-count"><i class="fa fa-comments"></i><span> <?php echo $album->getCommentCount(); ?></span></div>
										<?php }
									} 
									if ($stat_option == 'mostrated' || $stat_option == 'toprated') {
									$votes = $album->get("total_votes");
									$value = $album->get("total_value");
									if ($votes != 0) {
									$rating = round($value/$votes, 1); ?>
									<div class="image-cr"><i class="fa fa-star"></i><span title="<?php echo $votes.' '.gettext('total votes'); ?>"> <?php echo $rating; ?></span></div>
									<?php }
									}
									if ($stat_option == 'popular') {
									$hitcounter = $album->getHitcounter();
									if (empty($hitcounter)) { $hitcounter = "0"; } ?>
									<div class="image-cr"><i class="fa fa-eye"></i><span> <?php echo $hitcounter; ?></span></div>
									<?php } ?>
								</div>
								<?php if (getOption('libratus_date_albums')) { ?><div class="album-date"><?php echo zpFormattedDate(DATE_FORMAT, strtotime($album->getDateTime())); ?></div><?php } ?>
								<h3 class="album-title"><?php echo html_encode($album->getTitle()) ;?></h3>
							</div>
							<i class="fa fa-angle-up mobile-click-details"></i>
						</div>	
						<?php } 
						} else {
						echo '<br /><p>'.gettext('Sorry, no statistical page to show...').'</p>'; 
						} ?>
					</div>
					
					<?php } elseif ($stat_type == 'images') { 
					$images = getImageStatistic(25, $stat_option, '', false, 1); ?>
					
					<div class="gallery-thumbs">
						<?php if ($images) {
						foreach ($images as $image) { ?>
						<div>
							<a href="<?php echo html_encode($image->getLink()); ?>" title="<?php echo html_encode($image->getTitle()); ?>">
								<?php echo '<img src="' . html_encode(pathurlencode($image->getThumb())) . '" alt="' . html_encode($image->getTitle()) . "\" /></a>\n<br />"; ?>
							</a>
							<div class="caption caption-image">
								<?php if (isImagePhoto($image)) { ?>
								<a class="swipebox image-zoom" title="<?php echo html_encode('<a href="'.$image->getLink().'">'.$image->getTitle().'</a>'); ?>" href="<?php echo html_encode($image->getSizedImage(getOption('image_size'))); ?>"><i class="fa fa-search-plus fa-lg"></i></a>
								<?php } ?>
								<?php if (function_exists('getCommentCount')) {
									if (($image->getCommentsAllowed()) && ($image->getCommentCount() > 0)) { ?>
									<div class="image-cr"><i class="fa fa-comments"></i><span> <?php echo $image->getCommentCount(); ?></span></div>
									<?php }
								} 
								if ($stat_option == 'mostrated' || $stat_option == 'toprated') {
									$votes = $image->get("total_votes");
									$value = $image->get("total_value");
									if ($votes != 0) {
									$rating = round($value/$votes, 1); ?>
									<div class="image-cr"><i class="fa fa-star"></i><span title="<?php echo $votes.' '.gettext('total votes'); ?>"> <?php echo $rating; ?></span></div>
									<?php }
								}
								if ($stat_option == 'popular') {
								$hitcounter = $image->getHitcounter();
								if (empty($hitcounter)) { $hitcounter = "0"; } ?>
								<div class="image-cr"><i class="fa fa-eye"></i><span> <?php echo $hitcounter; ?></span></div>
								<?php } ?>
							</div>
							<i class="fa fa-angle-up mobile-click-details"></i>
						</div>
						<?php } 
						} else {
						echo '<br /><p class="pad">'.gettext('Sorry, no statistical page to show...').'</p>'; 
						} ?>
					</div>
					
					<?php } else {
					echo '<br /><p class="pad">'.gettext('Sorry, no statistical page to show...').'</p>'; 
					} ?>
				
				</div>

				<div class="gallery-sidebar pad">
					<?php printSearchForm('','search',$_zp_themeroot.'/images/magnifying_glass_16x16.png',gettext('Search gallery'),$_zp_themeroot.'/images/list_12x11.png'); ?>	
					<hr />
					<?php include ('inc-archive-stats-menu.php'); ?> 	
				</div>
			</div>
		</div>
		
<?php include('inc-footer.php');