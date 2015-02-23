<?php
/*	zpBase simple social sharing include 
*	This file is included on a page to show social sharing links, if set in options
*	http://www.oswebcreations.com
================================================== */
?>
<?php 
$host = sanitize("http://" . $_SERVER['HTTP_HOST']);
$url = $host . getRequestURI();

$fb_url = 'http://www.facebook.com/sharer.php?u='.$url;
$tw_url = 'http://twitter.com/home?status='.$url;
$g_url = 'https://plus.google.com/share?url='.$url;
?>
<hr />
<div id="social-share">
	<i class="fa fa-share"></i> <?php echo gettext('Share: '); ?>
	<a target="_blank" class="share fb button" href="<?php echo $fb_url; ?>" title="<?php echo gettext('Share on Facebook'); ?>"><i class="fa fa-facebook fa-lg"></i></a>
	<a target="_blank" class="share tw button" href="<?php echo $tw_url; ?>" title="<?php echo gettext('Share on Twitter'); ?>"><i class="fa fa-twitter fa-lg"></i></a>
	<a target="_blank" class="share g button" href="<?php echo $g_url; ?>" title="<?php echo gettext('Share on Google+'); ?>"><i class="fa fa-google-plus fa-lg"></i></a>
</div>
