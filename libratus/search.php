<?php include ('inc-header.php'); 

$zpcount = 0;
$numimages = getNumImages();
$numalbums = getNumAlbums();
$total = $numimages + $numalbums;
if ($zenpage && !isArchive()) {
	if (ZP_NEWS_ENABLED) { $numnews = getNumNews(); } else { $numnews = 0; }
	if (ZP_PAGES_ENABLED) { $numpages = getNumPages(); } else { $numpages = 0; }
	$zpcount = $numpages + $numnews;
	$total = $total + $numnews + $numpages;
} else {
	$numpages = $numnews = 0;
}
if ($total == 0) {
	$_zp_current_search->clearSearchWords();
}
?>

		<div id="page-header" class="wrap" style="background-image: linear-gradient(rgba(0, 0, 0, 0.75),rgba(0, 0, 0, 0.75)), url(<?php echo $bg; ?>);">
			<div class="inner">
				<h1><?php echo gettext('Search'); ?></h1>
			</div>
		</div>

		<div class="bar">
			<div class="inner">
				<?php echo $quickmenu; ?>
				<div class="pad" id="breadcrumb">
					<a href="<?php echo getGalleryIndexURL(); ?>"><i class="fa fa-home"></i>&nbsp;<?php printGalleryTitle(); ?></a>&nbsp;/
					<?php printParentBreadcrumb('',' / ',' / '); ?> <?php echo gettext('Search'); ?>
				</div>
			</div>
		</div>
	
		<div id="main" class="wrap clearfix">
			<div class="inner">
				<div class="gallery pad">
					
					<?php 
					$searchwords = getSearchWords();
					$searchdate = getSearchDate();
					if (!empty($searchdate)) {
						if (!empty($searchwords)) {
							$searchwords .= ": ";
						}
						$searchwords .= $searchdate;
					}
					if ($total < 1 ) { ?>
					<br /><h5><?php echo gettext('Sorry, no matches found. Try refining your search.'); ?></h5>
					<?php } ?>
					
					<?php if (isAlbumPage()) { ?>
					<div class="gallery-thumbs-large">
						<?php while (next_album()): ?>
						<div>
							<a href="<?php echo html_encode(getAlbumURL());?>" title="<?php printBareAlbumTitle();?>">
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
					<?php } ?>
					
					<div class="gallery-thumbs">
						<?php while (next_image()): ?>
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
					
					<?php if ((($numalbums + $numimages) > 0) && ($zpcount > 0)) echo '<div class="pad"><hr /></div>'; ?>
					
					<?php if (($zpcount > 0) && ($_zp_page == 1)) { ?>
					<div class="row">
					<?php if ($numpages > 0) { $c=0;
					while (next_page()) { ?>
						<div class="one-half column">
							<div class="news-clip">
								<div class="bold-header"><a href="<?php echo html_encode($_zp_current_zenpage_page->getLink()); ?>"><?php printPageTitle(); ?></a> <small><em><i title="<?php echo gettext('Page Result'); ?>" class="fa fa-copy fa-fw"></i></em></small></div>
								<div class="search-excerpt"><?php echo shortenContent(strip_tags(getPageContent()),200,getOption('zenpage_textshorten_indicator')); ?></div>
							</div>
						</div>
					<?php $c++; if ($c == 2) { echo '</div><div class="row">'; $c=0; }
					} 
					}
					if ($numnews > 0) {
					while (next_news()) { ?>
						<div class="one-half column">
							<div class="news-clip">
								<div class="bold-header"><?php printNewsURL(); ?> <small><em><i title="<?php echo gettext('News Result'); ?>" class="fa fa-newspaper-o fa-fw"></i></em></small></div>
								<div class="search-excerpt"><?php echo shortenContent(strip_tags(getNewsContent()),200,getOption('zenpage_textshorten_indicator')); ?></div>
							</div>
						</div>
					<?php $c++; if ($c == 2) { echo '</div><div class="row">'; $c=0; }
					} 
					} ?>
					</div>
					<?php } ?>

				</div>
				
				<div class="gallery-sidebar pad">
					<?php printSearchForm('','search',$_zp_themeroot.'/images/magnifying_glass_16x16.png',gettext('Search gallery'),$_zp_themeroot.'/images/list_12x11.png'); ?>	
					

					<?php if ($total > 0 ) { ?>
					<hr />
					<div class="bold-header"><?php printf(ngettext('%1$u Hit for <em>%2$s</em>','%1$u Hits for <em>%2$s</em>',$total), $total, html_encode($searchwords));?></div>
					<?php } ?>

					<?php if (getNumAlbums() > 0) { ?><div><i class="fa fa-folder fa-fw"></i> <?php echo getNumAlbums().' '.gettext("albums"); ?></div><?php } ?>
					<?php if (getNumImages() > 0) { ?><div><i class="fa fa-photo fa-fw"></i> <?php echo getNumImages().' '.gettext("images"); ?></div><?php } ?>
					<?php if ($numnews > 0) { ?><div><i class="fa fa-newspaper-o fa-fw"></i> <?php echo $numnews.' '.gettext("news"); ?></div><?php } ?>
					<?php if ($numpages > 0) { ?><div><i class="fa fa-copy fa-fw"></i> <?php echo $numpages.' '.gettext("pages"); ?></div><?php } ?>
					
					
					<?php if ($numimages > 1 && function_exists('printSlideShowLink')) { ?><hr /><div class="slideshow-link"><i class="fa fa-play fa-fw"></i> <?php printSlideShowLink(); ?></div><?php } ?>
	
					<hr />
					<?php include ('inc-archive-stats-menu.php'); ?> 
					
				</div>
				
			</div>	
		</div>
		
		
<?php include ('inc-footer.php'); ?>	



				
				
				
