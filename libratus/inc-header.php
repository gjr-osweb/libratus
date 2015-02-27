<?php 
if (!defined('WEBPATH')) die(); 
$_zp_page_check = 'checkPageValidity'; 
$zenpage = extensionEnabled('zenpage'); 
$galleryactive = ($_zp_gallery_page == 'index.php' || $_zp_gallery_page == 'album.php' || $_zp_gallery_page == 'image.php') ? true : false;
require_once (SERVERPATH . '/' . ZENFOLDER . '/' . PLUGIN_FOLDER . '/print_album_menu.php');
require_once (SERVERPATH . '/' . ZENFOLDER . '/' . PLUGIN_FOLDER . '/image_album_statistics.php');

setOption('flag_thumbnail_use_text',true,false);
setOption('flag_thumbnail_new_text','<i title="'.gettext("New Image").'" class="fa fa-flag fa-fw"></i>',false);
setOption('flag_thumbnail_geodata_text','<i title="'.gettext("Geotagged").'" class="fa fa-map-marker fa-fw"></i>',false);
setOption('flag_thumbnail_locked_text','<i title="'.gettext("Protected").'" class="fa fa-lock fa-fw"></i>',false);
setOption('flag_thumbnail_unpublished_text','<span title="'.gettext("Unpublished").'" class="fa-stack"><i class="fa fa-circle fa-stack-1x fa-fw"></i><i class="fa fa-exclamation-circle fa-stack-1x fa-fw red"></i></span>',false);

$quickmenu = '<div id="quickmenu">';
$quickmenu .= '<a id="nav-icon" class="quick-menu menu-btn"><i class="fa fa-bars fa-lg"></i></a>';
$quickmenu .= '<a id="search-icon" class="quick-menu" href="'.getCustomPageURL('archive').'" title="'.gettext('Archive/Search').'"><i class="fa fa-search fa-lg"></i></a>';
$quickmenu .= '<a id="scrollup" class="quick-menu scrollup" title="'.gettext('Scroll to top').'"><i class="fa fa-chevron-circle-up fa-lg"></i></a>';
$quickmenu .= '</div>';

if ($_zp_current_album && $_zp_gallery_page != 'favorites.php' && $_zp_gallery_page != '404.php') {
$randomImage = getRandomImagesAlbum($_zp_current_album);
} else {
$randomImage = getRandomImages();
}
if (is_object($randomImage) && $randomImage->exists) {
	$bg = html_encode(pathurlencode($randomImage->getCustomImage(1200,null,null,null,null,null,null,true)));
} else {
	$bg = '';
} ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php echo LOCAL_CHARSET; ?>" />
	<?php 
	zp_apply_filter('theme_head');
	printHeadTitle(); 
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/css/normalize.css">
	<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/css/skeleton.css">
	<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/css/font-awesome.min.css" type="text/css" />
	<link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/css/pushy.css">
	<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/css/ss.css" />

	<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/js/swipebox/css/swipebox.css" />
	<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/js/justifiedgallery/justifiedGallery.min.css" />
	<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/css/style.css">

	<script src="<?php echo $_zp_themeroot; ?>/js/modernizr.custom.js"></script>
	
	<link rel="shortcut icon" href="<?php echo $_zp_themeroot; ?>/images/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="<?php echo $_zp_themeroot; ?>/images/favicon-152.png">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo $_zp_themeroot; ?>/images/favicon-144.png">
	
	<style>
		<?php if (is_numeric(getOption('libratus_maxwidth'))) { echo '.inner{max-width:'.getOption('libratus_maxwidth').'px;}'; } else { echo '.inner{max-width:1400px;}'; } ?>
		<?php if (getOption('libratus_customcss') != null) { echo getOption('libratus_customcss'); } ?>
	</style>

</head>
<body>
	<?php if ( (getOption('libratus_analytics')) && (!zp_loggedin(ADMIN_RIGHTS)) ) { ?>
	<script>
		<?php if (getOption('libtratus_analytics_type') == 'universal') { ?>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', '<?php echo getOption('zpbase_analytics'); ?>', 'auto');
		ga('send', 'pageview');
		<?php } else { ?>
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', '<?php echo getOption('libratus_analytics'); ?>']);
		_gaq.push(['_trackPageview']);
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		<?php } ?>
	</script>
	<?php } ?>
	<?php zp_apply_filter('theme_body_open'); ?>
	<!-- Pushy Menu -->
	<nav class="pushy pushy-right">
		<?php if (file_exists(UPLOAD_FOLDER.'/logo.png')) { ?>
		<img id="nav-logo" src="<?php echo WEBPATH.'/'.UPLOAD_FOLDER.'/logo.png'; ?>" alt="<?php printGalleryTitle(); ?>" />
		<?php } else { ?>
		<h3 id="nav-logo-text" ><?php printGalleryTitle(); ?></h3>
		<?php } ?>
		<ul id="nav">
			<?php 
			$hometext = gettext('Home');
			if ($_zp_gallery->getWebsiteURL()) { ?>
			<li><?php printHomeLink(); ?><li>
			<?php $hometext = gettext('Gallery'); 
			} ?>
			<li <?php if ($_zp_gallery_page == 'index.php') { ?>class="active" <?php } ?>>
				<a href="<?php echo html_encode(getGalleryIndexURL()); ?>" title="<?php echo $hometext; ?>"><?php echo $hometext; ?></a>
			</li>
			<?php if (($zenpage) && (getNumNews(true) > 0) && (ZP_NEWS_ENABLED)) { ?>
			<li>
				<a <?php if (($_zp_gallery_page == "news.php") && (is_null($_zp_current_category))) { ?>class="active" <?php } ?>href="<?php echo getNewsIndexURL(); ?>"><?php echo gettext('News'); ?></a>
				<?php printAllNewsCategories('',false,'','active open',true,'submenu','active open','list',true,null); ?>
			</li>
			<?php } ?>
			<?php if (($zenpage) && (ZP_PAGES_ENABLED)) printPageMenu('list','','active open','submenu','active open','',true,false); ?>
			<li <?php if (($_zp_gallery_page == "archive.php") || ($_zp_gallery_page == "search.php")) { ?>class="active" <?php } ?>>
				<a href="<?php echo getCustomPageURL('archive'); ?>" title="<?php echo gettext('Archive/Search'); ?>"><?php echo gettext('Archive/Search'); ?></a>
			</li>
			<?php if (function_exists('printContactForm')) { ?>
			<li <?php if ($_zp_gallery_page == "contact.php") { ?>class="active" <?php } ?>>
				<?php printCustomPageURL(gettext('Contact'),"contact"); ?>
			</li>
			<?php } ?>
			<li><span class="gallery-menu-divider"><?php echo gettext('Gallery'); ?></span>
				<?php printAlbumMenuList('list',false,'','active','sub','active','',true); ?>
			</li>
		</ul>
	</nav>

	<!-- Site Overlay -->
	<div class="site-overlay"></div>

	<!-- Content, closed in inc-footer.php-->
	<div id="container">