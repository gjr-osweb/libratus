<?php 
// check for stats archive links via GET
if (isset($_GET['set'])) {
	switch ($_GET['set']) {
		case 'latestimagesbyid':
			$stat_type = 'images';
			$stat_title = gettext('Latest Images by ID');
			$stat_option = 'latest';
			break;
		case 'popularimages':
			$stat_type = 'images';
			$stat_title = gettext('Popular Images');
			$stat_option = 'popular';
			break;
		case 'latestimagesbydate':
			$stat_type = 'images';
			$stat_title = gettext('Latest Images by Date');
			$stat_option = 'latest-date';
			break;
		case 'latestimagesbymtime':
			$stat_type = 'images';
			$stat_title = gettext('Latest Images by mTime');
			$stat_option = 'latest-mtime';
			break;
		case 'latestimagesbypdate':
			$stat_type = 'images';
			$stat_title = gettext('Latest Images by Publish Date');
			$stat_option = 'latest-publishdate';
			break;
		case 'mostratedimages':
			$stat_type = 'images';
			$stat_title = gettext('Most Rated Images');
			$stat_option = 'mostrated';
			break;
		case 'topratedimages':
			$stat_type = 'images';
			$stat_title = gettext('Top Rated Images');
			$stat_option = 'toprated';
			break;
			
		case 'latestalbumsbyid':
			$stat_type = 'albums';
			$stat_title = gettext('Latest Albums by ID');
			$stat_option = 'latest';
			break;
		case 'popularalbums':
			$stat_type = 'albums';
			$stat_title = gettext('Popular Albums');
			$stat_option = 'popular';
			break;
		case 'latestalbumsbydate':
			$stat_type = 'albums';
			$stat_title = gettext('Latest Albums by Date');
			$stat_option = 'latest-date';
			break;
		case 'latestalbumsbymtime':
			$stat_type = 'albums';
			$stat_title = gettext('Latest Albums by mTime');
			$stat_option = 'latest-mtime';
			break;
		case 'latestalbumsbypdate':
			$stat_type = 'albums';
			$stat_title = gettext('Latest Albums by Publish Date');
			$stat_option = 'latest-publishdate';
			break;
		case 'mostratedalbums':
			$stat_type = 'albums';
			$stat_title = gettext('Most Rated Albums');
			$stat_option = 'mostrated';
			break;
		case 'topratedalbums':
			$stat_type = 'albums';
			$stat_title = gettext('Top Rated Albums');
			$stat_option = 'toprated';
			break;
		case 'latestupdatedalbums':
			$stat_type = 'albums';
			$stat_title = gettext('Latest Updated Albums');
			$stat_option = 'latestupdated';
			break;	
		default:
			$stat_type = '';
			break;
	}
	if (!$stat_type) {
		include(SERVERPATH . '/' . ZENFOLDER . '/404.php');
		exit;
	} else { 
		include ('archive-stats.php'); 
		exit;
	}
}
		
// else normal archive
include ('inc-header.php'); ?>

		<div id="page-header" class="wrap" style="background-image: linear-gradient(rgba(0, 0, 0, 0.65),rgba(0, 0, 0, 0.65)), url(<?php echo $bg; ?>);">
			<div class="inner">
				<h1><?php echo gettext('Archive'); ?></h1>
			</div>
		</div>
		
		<div class="bar">
			<div class="inner">
				<?php echo $quickmenu; ?>
				<div class="pad" id="breadcrumb">
					<a href="<?php echo getGalleryIndexURL(); ?>"><i class="fa fa-home"></i>&nbsp;<?php printGalleryTitle(); ?></a>&nbsp;/
					<?php printParentBreadcrumb('',' / ',' / '); ?>
					<?php echo gettext('Archive'); ?>
				</div>
			</div>
		</div>
			
		<div id="main" class="wrap clearfix">
			<div class="inner">
				<div class="gallery archive pad">
					<?php if (getOption('libratus_date_images')) { ?>
					<div class="block archive">	
						<h5><?php echo gettext('Gallery Archive'); ?></h5>
						<div class="archive-cols">
							<?php printAllDates('archive','year','month'); ?>
						</div>
					</div>
					<?php } ?>
					
					<?php if ($zenpage && ZP_NEWS_ENABLED) { ?>
					<?php if ((getNumNews(true) > 0) && (getOption('libratus_date_news'))) { ?>
					<div class="block archive">	
						<h5><?php echo gettext('News Archive'); ?></h5>
						<div class="archive-cols">
							<?php printNewsArchive('archive','year','month'); ?>
						</div>
					</div>
					<?php }
					} ?>
					
					<div class="block archive">	
						<h5><?php echo gettext('Tags'); ?></h5>
						<div class="archive-cols">
							<?php printAllTagsAs('list','year','results',true,true,2,50,1); ?>
						</div>
					</div>

				</div>

				<div class="gallery-sidebar pad">
					<?php printSearchForm('','search',$_zp_themeroot.'/images/magnifying_glass_16x16.png',gettext('Search gallery'),$_zp_themeroot.'/images/list_12x11.png'); ?>	
					<hr />
					<?php include ('inc-archive-stats-menu.php'); ?> 	
				</div>
			</div>
		</div>
		
<?php include('inc-footer.php');