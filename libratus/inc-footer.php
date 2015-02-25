		<div id="bottom-links" class="clearfix">
			<div class="inner pad">
				
				<div id="login-register">
				<?php if(function_exists("printUserLogin_out")) { ?>
				<span>
				<?php if (zp_loggedin()) { ?>
					<i class="fa fa-key fa-fw"></i> <?php printUserLogin_out(''); ?>
				<?php } else { ?>
					<i class="fa fa-key fa-fw"></i> <?php printCustomPageURL(gettext('Login'),'password',''); ?>
				<?php } ?>
				</span>
				<?php } ?>			
				<?php if (!zp_loggedin() && function_exists('printRegistrationForm')) { ?>
				&middot; <i class="fa fa-users fw"></i> <?php printCustomPageURL(gettext('Register'),'register','',''); ?>
				<?php } ?>
				</div>
				
				<?php if (class_exists('RSS')) { ?>
				<div id="rsslinks">
					<i class="fa fa-rss fa-fw"></i>
					<?php if (($_zp_gallery_page == 'news.php') && (getOption('RSS_articles'))) {
					printRSSLink('News','',gettext('RSS News'),'',false); 
					} elseif (($_zp_gallery_page == 'pages.php') && (getOption('RSS_pages'))) {
					printRSSLink('Pages','',gettext('RSS Pages'),'',false);
					} elseif (getOption('RSS_album_image')) {
					printRSSLink('Gallery','',gettext('RSS Gallery'),'',false);
					} ?>
				</div>
				<?php } ?>

			</div>
		</div>
		
		<?php if (getOption('libratus_bottom_stats_perrow')) { $c=0; 
		
		if (getOption('libratus_bottom_stats_perrow') == 1) $class = 'twelve columns';
		if (getOption('libratus_bottom_stats_perrow') == 2) $class = 'six columns';
		if (getOption('libratus_bottom_stats_perrow') == 3) $class = 'four columns';
		if (getOption('libratus_bottom_stats_perrow') == 4) $class = 'three columns';
		
		if (is_numeric(getOption('libratus_bottom_stats_number'))) { $number = getOption('libratus_bottom_stats_number'); } else { $number = 5; }
		?>
		<div id="bottom-modules" class="wrap clearfix">
			<div class="inner pad">
				<div class="row">
				
				<?php if (getOption('libratus_stats_gal_desc_bottom')) { ?>
					<div class="<?php echo $class; ?>">
						<div class="gal-desc-bottom"><?php printGalleryDesc(); ?></div>
					</div>
				<?php $c++; } ?>
				
				<?php if (getOption('libratus_stats_news_latest_bottom') && class_exists('Zenpage') && ZP_NEWS_ENABLED) { ?>
					<div class="<?php echo $class; ?>">
						<h5><?php echo gettext('Latest News'); ?></h5>
						<div><?php printLatestNews(3) ?></div>
					</div>
				<?php $c++; } ?>
				
				<?php if (getOption('libratus_stats_comments_latest_bottom') && class_exists('comment_form')) { ?>
					<div class="<?php echo $class; ?>">
						<h5><?php echo gettext('Latest Comments'); ?></h5>
						<div><?php printLatestComments(3); ?></div>
					</div>
				<?php $c++; } ?>
				
				<?php if (getOption('libratus_stats_images_popular_bottom')) {
					if ($c==getOption('libratus_bottom_stats_perrow')) { echo '</div><div class="row">'; $c=0; } ?>
					<div class="<?php echo $class; ?>">
						<h5>
							<?php echo gettext('Popular Images'); ?>
							<?php if (getOption('libratus_stats_images_popular')) { ?>&nbsp;<a class="stats-more" title="<?php echo gettext('More'); ?>" href="<?php echo getCustomPageURL('archive').'?set=popularimages'; ?>"><i class="fa fa-caret-right"></i></a><?php } ?>
						</h5>
						<?php $items = getImageStatistic($number,'popular', '', false, 1); ?>
						<div class="gallery-thumbs">
						<?php foreach ($items as $item) { ?>
							<a href="<?php echo html_encode($item->getLink()); ?>" title="<?php echo html_encode($item->getTitle()); ?>">
								<?php echo '<img src="' . html_encode(pathurlencode($item->getCustomImage(null,140,140,140,140,null,null,true))) . '" alt="' . html_encode($item->getTitle()) . "\" />\n<br />"; ?>
							</a>
						<?php } ?>
						</div>
					</div>
				<?php $c++; } ?>
				
				<?php if (getOption('libratus_stats_images_latestbyid_bottom')) {
					if ($c==getOption('libratus_bottom_stats_perrow')) { echo '</div><div class="row">'; $c=0; } ?>
					<div class="<?php echo $class; ?>">
						<h5>
							<?php echo gettext('Latest Images (ID)'); ?>
							<?php if (getOption('libratus_stats_images_latestbyid')) { ?>&nbsp;<a class="stats-more" title="<?php echo gettext('More'); ?>" href="<?php echo getCustomPageURL('archive').'?set=latestimagesbyid'; ?>"><i class="fa fa-caret-right"></i></a><?php } ?>
						</h5>
						<?php $items = getImageStatistic($number,'latestbyid', '', false, 1); ?>
						<div class="gallery-thumbs">
						<?php foreach ($items as $item) { ?>
							<a href="<?php echo html_encode($item->getLink()); ?>" title="<?php echo html_encode($item->getTitle()); ?>">
								<?php echo '<img src="' . html_encode(pathurlencode($item->getCustomImage(null,140,140,140,140,null,null,true))) . '" alt="' . html_encode($item->getTitle()) . "\" />\n<br />"; ?>
							</a>
						<?php } ?>
						</div>
					</div>
				<?php $c++; } ?>
				
				<?php if (getOption('libratus_stats_images_latestbymtime_bottom')) {
					if ($c==getOption('libratus_bottom_stats_perrow')) { echo '</div><div class="row">'; $c=0; } ?>
					<div class="<?php echo $class; ?>">
						<h5>
							<?php echo gettext('Latest Images (mTime)'); ?>
							<?php if (getOption('libratus_stats_images_latestbymtime')) { ?>&nbsp;<a class="stats-more" title="<?php echo gettext('More'); ?>" href="<?php echo getCustomPageURL('archive').'?set=latestimagesbymtime'; ?>"><i class="fa fa-caret-right"></i></a><?php } ?>
						</h5>
						<?php $items = getImageStatistic($number,'latestbymtime', '', false, 1); ?>
						<div class="gallery-thumbs">
						<?php foreach ($items as $item) { ?>
							<a href="<?php echo html_encode($item->getLink()); ?>" title="<?php echo html_encode($item->getTitle()); ?>">
								<?php echo '<img src="' . html_encode(pathurlencode($item->getCustomImage(null,140,140,140,140,null,null,true))) . '" alt="' . html_encode($item->getTitle()) . "\" />\n<br />"; ?>
							</a>
						<?php } ?>
						</div>
					</div>
				<?php $c++; } ?>
				
				<?php if (getOption('libratus_stats_images_latestbydate_bottom')) {
					if ($c==getOption('libratus_bottom_stats_perrow')) { echo '</div><div class="row">'; $c=0; } ?>
					<div class="<?php echo $class; ?>">
						<h5>
							<?php echo gettext('Latest Images (Date)'); ?>
							<?php if (getOption('libratus_stats_images_latestbydate')) { ?>&nbsp;<a class="stats-more" title="<?php echo gettext('More'); ?>" href="<?php echo getCustomPageURL('archive').'?set=latestimagesbydate'; ?>"><i class="fa fa-caret-right"></i></a><?php } ?>
						</h5>
						<?php $items = getImageStatistic($number,'latestbydate', '', false, 1); ?>
						<div class="gallery-thumbs">
						<?php foreach ($items as $item) { ?>
							<a href="<?php echo html_encode($item->getLink()); ?>" title="<?php echo html_encode($item->getTitle()); ?>">
								<?php echo '<img src="' . html_encode(pathurlencode($item->getCustomImage(null,140,140,140,140,null,null,true))) . '" alt="' . html_encode($item->getTitle()) . "\" />\n<br />"; ?>
							</a>
						<?php } ?>
						</div>
					</div>
				<?php $c++; } ?>
				
				<?php if (getOption('libratus_stats_images_latestbypdate_bottom')) {
					if ($c==getOption('libratus_bottom_stats_perrow')) { echo '</div><div class="row">'; $c=0; } ?>
					<div class="<?php echo $class; ?>">
						<h5>
							<?php echo gettext('Latest Images (Pub. Date)'); ?>
							<?php if (getOption('libratus_stats_images_latestbypdate')) { ?>&nbsp;<a class="stats-more" title="<?php echo gettext('More'); ?>" href="<?php echo getCustomPageURL('archive').'?set=latestimagesbypdate'; ?>"><i class="fa fa-caret-right"></i></a><?php } ?>
						</h5>
						<?php $items = getImageStatistic($number,'latestbypdate', '', false, 1); ?>
						<div class="gallery-thumbs">
						<?php foreach ($items as $item) { ?>
							<a href="<?php echo html_encode($item->getLink()); ?>" title="<?php echo html_encode($item->getTitle()); ?>">
								<?php echo '<img src="' . html_encode(pathurlencode($item->getCustomImage(null,140,140,140,140,null,null,true))) . '" alt="' . html_encode($item->getTitle()) . "\" />\n<br />"; ?>
							</a>
						<?php } ?>
						</div>
					</div>
				<?php $c++; } ?>
				
				<?php if (getOption('libratus_stats_images_mostrated_bottom')) {
					if ($c==getOption('libratus_bottom_stats_perrow')) { echo '</div><div class="row">'; $c=0; } ?>
					<div class="<?php echo $class; ?>">
						<h5>
							<?php echo gettext('Most Rated Images'); ?>
							<?php if (getOption('libratus_stats_images_mostrated')) { ?>&nbsp;<a class="stats-more" title="<?php echo gettext('More'); ?>" href="<?php echo getCustomPageURL('archive').'?set=mostratedimages'; ?>"><i class="fa fa-caret-right"></i></a><?php } ?>
						</h5>
						<?php $items = getImageStatistic($number,'mostrated', '', false, 1); ?>
						<div class="gallery-thumbs">
						<?php foreach ($items as $item) { ?>
							<a href="<?php echo html_encode($item->getLink()); ?>" title="<?php echo html_encode($item->getTitle()); ?>">
								<?php echo '<img src="' . html_encode(pathurlencode($item->getCustomImage(null,140,140,140,140,null,null,true))) . '" alt="' . html_encode($item->getTitle()) . "\" />\n<br />"; ?>
							</a>
						<?php } ?>
						</div>
					</div>
				<?php $c++; } ?>
				
				<?php if (getOption('libratus_stats_images_toprated_bottom')) {
					if ($c==getOption('libratus_bottom_stats_perrow')) { echo '</div><div class="row">'; $c=0; } ?>
					<div class="<?php echo $class; ?>">
						<h5>
							<?php echo gettext('Top Rated Images'); ?>
							<?php if (getOption('libratus_stats_images_toprated')) { ?>&nbsp;<a class="stats-more" title="<?php echo gettext('More'); ?>" href="<?php echo getCustomPageURL('archive').'?set=topratedimages'; ?>"><i class="fa fa-caret-right"></i></a><?php } ?>
						</h5>
						<?php $items = getImageStatistic($number,'toprated', '', false, 1); ?>
						<div class="gallery-thumbs">
						<?php foreach ($items as $item) { ?>
							<a href="<?php echo html_encode($item->getLink()); ?>" title="<?php echo html_encode($item->getTitle()); ?>">
								<?php echo '<img src="' . html_encode(pathurlencode($item->getCustomImage(null,140,140,140,140,null,null,true))) . '" alt="' . html_encode($item->getTitle()) . "\" />\n<br />"; ?>
							</a>
						<?php } ?>
						</div>
					</div>
				<?php $c++; } ?>
				
				
				
				<?php if (getOption('libratus_stats_albums_popular_bottom')) {
					if ($c==getOption('libratus_bottom_stats_perrow')) { echo '</div><div class="row">'; $c=0; } ?>
					<div class="<?php echo $class; ?>">
						<h5>
							<?php echo gettext('Popular Albums'); ?>
							<?php if (getOption('libratus_stats_albums_popular')) { ?>&nbsp;<a class="stats-more" title="<?php echo gettext('More'); ?>" href="<?php echo getCustomPageURL('archive').'?set=popularalbums'; ?>"><i class="fa fa-caret-right"></i></a><?php } ?>
						</h5>
						<?php $items = getAlbumStatistic($number,'popular', '', false, 1); ?>
						<div class="gallery-thumbs">
						<?php foreach ($items as $item) { $image = $item->getAlbumThumbImage(); ?>
							<a href="<?php echo html_encode($item->getLink()); ?>" title="<?php echo html_encode($item->getTitle()); ?>">
								<?php echo '<img src="' . html_encode(pathurlencode($image->getCustomImage(null,140,140,140,140,null,null,true))) . '" alt="' . html_encode($item->getTitle()) . "\" />\n<br />"; ?>
							</a>
						<?php } ?>
						</div>
					</div>
				<?php $c++; } ?>
				
				<?php if (getOption('libratus_stats_albums_latestbyid_bottom')) {
					if ($c==getOption('libratus_bottom_stats_perrow')) { echo '</div><div class="row">'; $c=0; } ?>
					<div class="<?php echo $class; ?>">
						<h5>
							<?php echo gettext('Latest Albums (ID)'); ?>
							<?php if (getOption('libratus_stats_albums_latestbyid')) { ?>&nbsp;<a class="stats-more" title="<?php echo gettext('More'); ?>" href="<?php echo getCustomPageURL('archive').'?set=latestalbumsbyid'; ?>"><i class="fa fa-caret-right"></i></a><?php } ?>
						</h5>
						<?php $items = getAlbumStatistic($number,'latestbyid', '', false, 1); ?>
						<div class="gallery-thumbs">
						<?php foreach ($items as $item) { $image = $item->getAlbumThumbImage(); ?>
							<a href="<?php echo html_encode($item->getLink()); ?>" title="<?php echo html_encode($item->getTitle()); ?>">
								<?php echo '<img src="' . html_encode(pathurlencode($image->getCustomImage(null,140,140,140,140,null,null,true))) . '" alt="' . html_encode($item->getTitle()) . "\" />\n<br />"; ?>
							</a>
						<?php } ?>
						</div>
					</div>
				<?php $c++; } ?>
				
				<?php if (getOption('libratus_stats_albums_latestbymtime_bottom')) {
					if ($c==getOption('libratus_bottom_stats_perrow')) { echo '</div><div class="row">'; $c=0; } ?>
					<div class="<?php echo $class; ?>">
						<h5>
							<?php echo gettext('Latest Albums (mTime)'); ?>
							<?php if (getOption('libratus_stats_albums_latestbymtime')) { ?>&nbsp;<a class="stats-more" title="<?php echo gettext('More'); ?>" href="<?php echo getCustomPageURL('archive').'?set=latestalbumsbymtime'; ?>"><i class="fa fa-caret-right"></i></a><?php } ?>
						</h5>
						<?php $items = getAlbumStatistic($number,'latestbymtime', '', false, 1); ?>
						<div class="gallery-thumbs">
						<?php foreach ($items as $item) { $image = $item->getAlbumThumbImage(); ?>
							<a href="<?php echo html_encode($item->getLink()); ?>" title="<?php echo html_encode($item->getTitle()); ?>">
								<?php echo '<img src="' . html_encode(pathurlencode($image->getCustomImage(null,140,140,140,140,null,null,true))) . '" alt="' . html_encode($item->getTitle()) . "\" />\n<br />"; ?>
							</a>
						<?php } ?>
						</div>
					</div>
				<?php $c++; } ?>
				
				<?php if (getOption('libratus_stats_albums_latestbydate_bottom')) {
					if ($c==getOption('libratus_bottom_stats_perrow')) { echo '</div><div class="row">'; $c=0; } ?>
					<div class="<?php echo $class; ?>">
						<h5>
							<?php echo gettext('Latest Albums (Date)'); ?>
							<?php if (getOption('libratus_stats_albums_latestbydate')) { ?>&nbsp;<a class="stats-more" title="<?php echo gettext('More'); ?>" href="<?php echo getCustomPageURL('archive').'?set=latestalbumsbydate'; ?>"><i class="fa fa-caret-right"></i></a><?php } ?>
						</h5>
						<?php $items = getAlbumStatistic($number,'latestbydate', '', false, 1); ?>
						<div class="gallery-thumbs">
						<?php foreach ($items as $item) { $image = $item->getAlbumThumbImage(); ?>
							<a href="<?php echo html_encode($item->getLink()); ?>" title="<?php echo html_encode($item->getTitle()); ?>">
								<?php echo '<img src="' . html_encode(pathurlencode($image->getCustomImage(null,140,140,140,140,null,null,true))) . '" alt="' . html_encode($item->getTitle()) . "\" />\n<br />"; ?>
							</a>
						<?php } ?>
						</div>
					</div>
				<?php $c++; } ?>
				
				<?php if (getOption('libratus_stats_albums_mostrated_bottom')) {
					if ($c==getOption('libratus_bottom_stats_perrow')) { echo '</div><div class="row">'; $c=0; } ?>
					<div class="<?php echo $class; ?>">
						<h5>
							<?php echo gettext('Most Rated Albums'); ?>
							<?php if (getOption('libratus_stats_albums_mostrated')) { ?>&nbsp;<a class="stats-more" title="<?php echo gettext('More'); ?>" href="<?php echo getCustomPageURL('archive').'?set=mostratedalbums'; ?>"><i class="fa fa-caret-right"></i></a><?php } ?>
						</h5>
						<?php $items = getAlbumStatistic($number,'mostrated', '', false, 1); ?>
						<div class="gallery-thumbs">
						<?php foreach ($items as $item) { $image = $item->getAlbumThumbImage(); ?>
							<a href="<?php echo html_encode($item->getLink()); ?>" title="<?php echo html_encode($item->getTitle()); ?>">
								<?php echo '<img src="' . html_encode(pathurlencode($image->getCustomImage(null,140,140,140,140,null,null,true))) . '" alt="' . html_encode($item->getTitle()) . "\" />\n<br />"; ?>
							</a>
						<?php } ?>
						</div>
					</div>
				<?php $c++; } ?>
				
				<?php if (getOption('libratus_stats_albums_toprated_bottom')) {
					if ($c==getOption('libratus_bottom_stats_perrow')) { echo '</div><div class="row">'; $c=0; } ?>
					<div class="<?php echo $class; ?>">
						<h5>
							<?php echo gettext('Top Rated Albums'); ?>
							<?php if (getOption('libratus_stats_albums_toprated')) { ?>&nbsp;<a class="stats-more" title="<?php echo gettext('More'); ?>" href="<?php echo getCustomPageURL('archive').'?set=topratedalbums'; ?>"><i class="fa fa-caret-right"></i></a><?php } ?>
						</h5>
						<?php $items = getAlbumStatistic($number,'toprated', '', false, 1); ?>
						<div class="gallery-thumbs">
						<?php foreach ($items as $item) { $image = $item->getAlbumThumbImage(); ?>
							<a href="<?php echo html_encode($item->getLink()); ?>" title="<?php echo html_encode($item->getTitle()); ?>">
								<?php echo '<img src="' . html_encode(pathurlencode($image->getCustomImage(null,140,140,140,140,null,null,true))) . '" alt="' . html_encode($item->getTitle()) . "\" />\n<br />"; ?>
							</a>
						<?php } ?>
						</div>
					</div>
				<?php $c++; } ?>
				
				<?php if (getOption('libratus_stats_albums_latestupdated_bottom')) {
					if ($c==getOption('libratus_bottom_stats_perrow')) { echo '</div><div class="row">'; $c=0; } ?>
					<div class="<?php echo $class; ?>">
						<h5>
							<?php echo gettext('Latest Updated Albums'); ?>
							<?php if (getOption('libratus_stats_albums_latestupdated')) { ?>&nbsp;<a class="stats-more" title="<?php echo gettext('More'); ?>" href="<?php echo getCustomPageURL('archive').'?set=latestupdatedalbums'; ?>"><i class="fa fa-caret-right"></i></a><?php } ?>
						</h5>
						<?php $items = getAlbumStatistic($number,'latestupdated', '', false, 1); ?>
						<div class="gallery-thumbs">
						<?php foreach ($items as $item) { $image = $item->getAlbumThumbImage(); ?>
							<a href="<?php echo html_encode($item->getLink()); ?>" title="<?php echo html_encode($item->getTitle()); ?>">
								<?php echo '<img src="' . html_encode(pathurlencode($image->getCustomImage(null,140,140,140,140,null,null,true))) . '" alt="' . html_encode($item->getTitle()) . "\" />\n<br />"; ?>
							</a>
						<?php } ?>
						</div>
					</div>
				<?php $c++; } ?>
				
				</div>

			</div>
		</div>
		<?php } ?>
		
		<div id="footer" class="clearfix">	
			<div class="inner pad">
				<?php if (function_exists('printLanguageSelector')) { ?><?php printLanguageSelector("langselector"); ?><?php } ?>
			
				<div id="copyright"><?php echo getOption('libratus_copy'); ?></div>
				
				<?php $libratus_sociallinks = false;
				if ($fb_linkurl = getOption('libratus_facebook')) $libratus_sociallinks = true;
				if ($tw_linkurl = getOption('libratus_twitter')) $libratus_sociallinks = true;
				if ($g_linkurl = getOption('libratus_google')) $libratus_sociallinks = true;
				if ($libratus_sociallinks) { ?>
				<div id="sociallinks">
					&nbsp;&middot;
					<?php if ($fb_linkurl) { ?><a target="_blank" href="<?php echo $fb_linkurl; ?>" title="<?php echo gettext('Facebook'); ?>"><i class="fa fa-facebook fa-fw"></i></a><?php } ?>
					<?php if ($tw_linkurl) { ?><a target="_blank" href="<?php echo $tw_linkurl; ?>" title="<?php echo gettext('Twitter'); ?>"><i class="fa fa-twitter fa-fw"></i></a><?php } ?>
					<?php if ($g_linkurl) { ?><a target="_blank" href="<?php echo $g_linkurl; ?>" title="<?php echo gettext('Google+'); ?>"><i class="fa fa-google-plus fa-fw"></i></a><?php } ?>
				</div>
				<?php } ?>
			</div>
		</div>

	</div><!-- close #container -->

<script src="<?php echo $_zp_themeroot; ?>/js/jquery.imagesloaded.min.js"></script>
<script src="<?php echo $_zp_themeroot; ?>/js/justifiedgallery/jquery.justifiedGallery.min.js"></script>
<script src="<?php echo $_zp_themeroot; ?>/js/swipebox/js/jquery.swipebox.js"></script>
<script src="<?php echo $_zp_themeroot; ?>/js/pushy.min.js"></script>
<script src="<?php echo $_zp_themeroot; ?>/js/scrollfix.js"></script>
<script src="<?php echo $_zp_themeroot; ?>/js/libratus_zp.js"></script>

<?php if ($_zp_gallery_page == 'index.php') { ?>
<script>
/**
 * cbpBGSlideshow.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Codrops
 * http://www.codrops.com
 */
var cbpBGSlideshow = (function() {

	var $slideshow = $( '#cbp-bislideshow' ),
		$items = $slideshow.children( 'li' ),
		itemsCount = $items.length,
		$controls = $( '#cbp-bicontrols' ),
		navigation = {
			$navPrev : $controls.find( 'span.cbp-biprev' ),
			$navNext : $controls.find( 'span.cbp-binext' ),
			$navPlayPause : $controls.find( 'span.cbp-bipause' )
		},
		// current item´s index
		current = 0,
		// timeout
		slideshowtime,
		// true if the slideshow is active
		isSlideshowActive = true,
		// it takes 3.5 seconds to change the background image
		interval = <?php if (is_numeric(getOption('libratus_ss_interval'))) { echo getOption('libratus_ss_interval'); } else { echo '5000'; } ?>;

	function init( config ) {

		// preload the images
		$slideshow.imagesLoaded( function() {
			
			if( Modernizr.backgroundsize ) {
				$items.each( function() {
					var $item = $( this );
					$item.css( 'background-image', 'url(' + $item.find( 'img' ).attr( 'src' ) + ')' );
				} );
			}
			else {
				$slideshow.find( 'img' ).show();
				// for older browsers add fallback here (image size and centering)
			}
			// show first item
			$items.eq( current ).css( 'opacity', 1 );
			// initialize/bind the events
			initEvents();
			// start the slideshow
			startSlideshow();

		} );
		
	}

	function initEvents() {

		navigation.$navPlayPause.on( 'click', function() {

			var $control = $( this );
			if( $control.hasClass( 'cbp-biplay' ) ) {
				$control.removeClass( 'cbp-biplay' ).addClass( 'cbp-bipause' );
				startSlideshow();
			}
			else {
				$control.removeClass( 'cbp-bipause' ).addClass( 'cbp-biplay' );
				stopSlideshow();
			}

		} );

		navigation.$navPrev.on( 'click', function() { 
			navigate( 'prev' ); 
			if( isSlideshowActive ) { 
				startSlideshow(); 
			} 
		} );
		navigation.$navNext.on( 'click', function() { 
			navigate( 'next' ); 
			if( isSlideshowActive ) { 
				startSlideshow(); 
			}
		} );

	}

	function navigate( direction ) {

		// current item
		var $oldItem = $items.eq( current );
		
		if( direction === 'next' ) {
			current = current < itemsCount - 1 ? ++current : 0;
		}
		else if( direction === 'prev' ) {
			current = current > 0 ? --current : itemsCount - 1;
		}

		// new item
		var $newItem = $items.eq( current );
		// show / hide items
		$oldItem.css( 'opacity', 0 );
		$newItem.css( 'opacity', 1 );

	}

	function startSlideshow() {

		isSlideshowActive = true;
		clearTimeout( slideshowtime );
		slideshowtime = setTimeout( function() {
			navigate( 'next' );
			startSlideshow();
		}, interval );

	}

	function stopSlideshow() {
		isSlideshowActive = false;
		clearTimeout( slideshowtime );
	}

	return { init : init };

})();

$(function() {
	cbpBGSlideshow.init();
});
</script>
<?php } ?>
	
<?php zp_apply_filter('theme_body_close'); ?>
</body>
</html>