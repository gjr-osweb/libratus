<?php 
if ((class_exists('Zenpage')) && (ZP_NEWS_ENABLED)) {
include('inc-header.php'); ?>

		<div id="page-header" class="wrap" style="background-image: linear-gradient(rgba(0, 0, 0, 0.65),rgba(0, 0, 0, 0.65)), url(<?php echo $bg; ?>);">
			<div class="inner">
				<?php if (is_NewsArticle()) { ?>
				<h1><?php printNewsTitle(); ?></h1>
				<?php } elseif (in_context(ZP_ZENPAGE_NEWS_DATE)) { ?>
				<h1><?php printCurrentNewsArchive(''); ?></h1>
				<?php } elseif (in_context(ZP_ZENPAGE_NEWS_CATEGORY)) { ?>
				<h1><?php printCurrentNewsCategory(''); ?></h1>
				<div id="desc"><?php printNewsCategoryDesc(); ?></div>
				<?php } else { ?>
				<h1><?php echo gettext('News'); ?></h1>
				<?php } ?>
			</div>
		</div>

		<div class="bar">
			<div class="inner">
				<?php echo $quickmenu; ?>
				<div class="pad" id="breadcrumb">
					<a href="<?php echo getGalleryIndexURL(); ?>"><i class="fa fa-home"></i>&nbsp;<?php printGalleryTitle(); ?></a>&nbsp;/
					<?php printNewsIndexURL(null,''); echo ' / '; ?>
					<?php printZenpageItemsBreadcrumb('',' / '); ?>
					<?php if (is_NewsArticle()) { printNewsTitle(); } ?>
				</div>
			</div>
		</div>
		
		<div id="main" class="wrap clearfix">
			<div class="inner">
				<div class="page pad">
				
					<?php if (is_NewsArticle()) { ?>
					<div class="news-info">
						<?php if (getNewsDate() && getOption('libratus_date_news')) { ?><span><i class="fa fa-calendar-o"></i>&nbsp;<?php printNewsDate(); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span><?php } ?>
						<?php if (function_exists('getCommentCount')) { ?>
						<span><i class="fa fa-comments-o"></i>&nbsp;<?php echo gettext('Comments:').' '.getCommentCount(); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
						<?php } ?>
						<?php if (getNewsCategories()) { ?><span><i class="fa fa-folder-o"></i>&nbsp;<?php printNewsCategories(', ','','taglist'); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span><?php } ?>
					</div>
					<hr />
					<div class="news-content">
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
						<?php } ?>
						<?php printNewsContent(); ?>
					</div>
					<?php $singletag = getTags(); $tagstring = implode(', ', $singletag); 
					if (strlen($tagstring) > 0) { ?>
					<div class="block"><i class="fa fa-tags fa-fw"></i> <?php printTags('links','','taglist', ', '); ?></div>
					<?php } ?>
					<?php if (getCodeBlock(1)) { ?><div class="codeblock"><?php printCodeblock(1); ?></div><?php } ?>

					<?php } else { ?>
					
					<?php while (next_news()): ?>
					<div class="news-clip clearfix">
						<h5><?php printNewsURL(); ?></h5>
						<div class="news-info">
							<?php if (getNewsDate() && getOption('libratus_date_news')) { ?><span><i class="fa fa-calendar-o"></i>&nbsp;<?php printNewsDate(); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span><?php } ?>
							<?php if (function_exists('getCommentCount')) { ?>
							<span><i class="fa fa-comments-o"></i>&nbsp;<?php echo gettext('Comments:').' '.getCommentCount(); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<?php } ?>
							<?php if (getNewsCategories()) { ?><span><i class="fa fa-folder-o"></i>&nbsp;<?php printNewsCategories(', ','','taglist'); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span><?php } ?>
						</div>
						<div class="news-content">
							<?php $hasFeaturedImage = false; if (function_exists('printSizedFeaturedImage')) $hasFeaturedImage = getFeaturedImage();
							if ($hasFeaturedImage) { ?>
							<div class="featured-image news-reel">
								<?php printSizedFeaturedImage(null,null,getOption('thumb_size'),null,null,null,null,null,null,'scale',null,true,null); ?>
							</div>
							<?php } ?>
							<?php printNewsContent(); ?>
						</div>
					</div>
					<?php endwhile; ?>
					<?php if (getNextNewsPageURL() || getPrevNewsPageURL()) { ?><?php printNewsPageListWithNav(gettext('next').' »','« '.gettext('prev'),true,'pagination', true); } ?>
					<?php } ?>
					
				</div>
				
				<div class="page-sidebar pad">
					<?php if (is_NewsArticle()) { ?>
					<div class="single-nav">
						<?php if ($prev = getNextPrevNews('prev')) { ?>
						<a class="button prev-link" href="<?php echo $prev['link']; ?>" title="<?php echo $prev['title']; ?>"><i class="fa fa-caret-left"></i> <?php echo gettext("Prev Article"); ?></a>
						<?php } else { ?>
						<span class="button prev-link"><i class="fa fa-caret-left"></i> <?php echo gettext("Prev Article"); ?></span>
						<?php } ?>
						
						<?php if ($next = getNextPrevNews('next')) { ?>
						<a class="button next-link" href="<?php echo $next['link']; ?>" title="<?php echo $next['title']; ?>"><?php echo gettext("Next Article"); ?> <i class="fa fa-caret-right"></i></a>
						<?php } else { ?>
						<span class="button next-link"><?php echo gettext("Next Article"); ?> <i class="fa fa-caret-right"></i></span>
						<?php } ?>
					</div>

					<?php if (getPageExtraContent()) printPageExtraContent(); ?>
					<?php if (getOption('libratus_social')) include ('inc-socialshare.php'); ?>
					<?php if (!function_exists('printCommentForm')) { ?>
					<?php if (function_exists('printRating')) { ?>
					<div id="rating" class="block"><?php printRating(); ?></div>
					<?php } 
					} ?>
					<?php if (function_exists('printRelatedItems')) { ?>
					<?php if (getRelatedItems()) { ?><hr />
					<?php printRelatedItems(5,'news',null,null,true); ?>
					<?php } ?>
					<?php } ?>
					<?php if ($_zp_zenpage->getAllCategories()) { ?>
					<hr /><h5><?php echo gettext('News Categories'); ?></h5>
					<?php printAllNewsCategories(gettext('All News'),true,'','menu-active',true,'submenu','menu-active'); ?>
					<?php } ?>
					<?php } else { ?>
					<?php if ($_zp_zenpage->getAllCategories()) { ?>
					<h5><?php echo gettext('News Categories'); ?></h5>
					<?php printAllNewsCategories(gettext('All News'),true,'','menu-active',true,'submenu','menu-active'); ?>
					<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
		
		<?php if ((function_exists('printCommentForm')) && (is_NewsArticle())) { ?>
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