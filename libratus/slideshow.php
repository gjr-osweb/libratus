<?php
// force UTF-8 Ø
if (!defined('WEBPATH'))
	die();
if (function_exists('printSlideShow')) {
	?>
	<!DOCTYPE html>
	<html>
		<head>
			<?php zp_apply_filter('theme_head'); ?>
			<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
			<title><?php printBareGalleryTitle(); ?> <?php echo gettext("Slideshow"); ?></title>
			<meta charset="<?php echo LOCAL_CHARSET; ?>">
			<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/css/style.css" type="text/css" />
			<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/css/slideshow.css" type="text/css" />
		</head>
		<body id="slideshow-page">
			<?php zp_apply_filter('theme_body_open'); ?>
			<?php printSlideShow(true, true); ?>
			<?php zp_apply_filter('theme_body_close'); ?>
		</body>
	</html>
	<?php
} else {
	include(SERVERPATH . '/' . ZENFOLDER . '/404.php');
}
?>