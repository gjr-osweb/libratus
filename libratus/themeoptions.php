<?php
/*	Libratus Theme Options
================================================== */
// 	force UTF-8 Ø
class ThemeOptions {

	function ThemeOptions() {
		// force core theme options for this theme
		setThemeOption('albums_per_row',3,null,'libratus');
		setThemeOption('images_per_row',6,null,'libratus');
		setThemeOption('image_use_side','longest',null,'libratus');
		setThemeOptionDefault('image_size', 800, null, 'libratus');
		setThemeOption('image_use_side', 'longest', null, 'libratus');
		setThemeOption('thumb_size', 300, null, 'libratus');
		// set core theme option defaults
		setThemeOptionDefault('albums_per_page',15);
		setThemeOptionDefault('images_per_page',30); 
		setThemeOptionDefault('thumb_crop',false); 
		// set libratus option defaults
		setThemeOptionDefault('libratus_maxwidth', '1400');
		setThemeOptionDefault('libratus_ss_type', 'random');
		setThemeOptionDefault('libratus_ss_album', '');
		setThemeOptionDefault('libratus_ss_interval', 5000);
		setThemeOptionDefault('libratus_index_fullwidth', false);
		setThemeOptionDefault('libratus_date_albums', true);
		setThemeOptionDefault('libratus_date_images', true);
		setThemeOptionDefault('libratus_date_news', true);
		setThemeOptionDefault('libratus_date_pages', true);
		setThemeOptionDefault('libratus_social', true);
		setThemeOptionDefault('libratus_download', true);
		setThemeOptionDefault('libratus_customcss', '');
		setThemeOptionDefault('libratus_facebook', '');
		setThemeOptionDefault('libratus_twitter', '');
		setThemeOptionDefault('libratus_google', '');
		setThemeOptionDefault('libratus_copy', '© '.date("Y"));
		setThemeOptionDefault('libratus_analytics','');
		setThemeOptionDefault('libratus_analytics_type','universal');
		setThemeOptionDefault('libratus_stats_images_popular', true);
		setThemeOptionDefault('libratus_stats_images_latestbyid', true); 
		setThemeOptionDefault('libratus_stats_images_mostrated', true); 
		setThemeOptionDefault('libratus_stats_images_toprated', true);
		setThemeOptionDefault('libratus_stats_albums_popular', true); 
		setThemeOptionDefault('libratus_stats_albums_latestbyid', true); 
		setThemeOptionDefault('libratus_stats_albums_mostrated', true); 
		setThemeOptionDefault('libratus_stats_albums_toprated', true); 
		setThemeOptionDefault('libratus_stats_albums_latestupdated', true);
		setThemeOptionDefault('libratus_stats_number', 30);
		setThemeOptionDefault('libratus_bottom_stats_number', 5);
		setThemeOptionDefault('libratus_bottom_stats_perrow', 3);
		setThemeOptionDefault('libratus_stats_images_popular_bottom', true);
		setThemeOptionDefault('libratus_stats_images_latestbyid_bottom', true);
		setThemeOptionDefault('libratus_stats_images_toprated_bottom', true);
		setThemeOptionDefault('libratus_related_maxnumber', 10);
		if (class_exists('cacheManager')) {
			$me = basename(dirname(__FILE__));
			cacheManager::deleteThemeCacheSizes($me);
			cacheManager::addThemeCacheSize($me, getThemeOption('image_size'), NULL, NULL, NULL, NULL, NULL, NULL, false, getOption('fullimage_watermark'), NULL, NULL); // full image size
			cacheManager::addThemeCacheSize($me, getThemeOption('thumb_size'), NULL, NULL, NULL, NULL, NULL, NULL, true, getOption('Image_watermark'), NULL, NULL); // default thumb
			cacheManager::addThemeCacheSize($me, NULL, getThemeOption('libratus_maxwidth'), 550, NULL, NULL, NULL, NULL, true, getOption('Image_watermark'), NULL, NULL); //big header images	
		}
	}
	
	function getOptionsDisabled() {
		return array('custom_index_page');
	}
	
	function getOptionsSupported() {
		$showdates_checkboxes = array(
			gettext('Albums') => 'libratus_date_albums', 
			gettext('Images') => 'libratus_date_images', 
			gettext('News') => 'libratus_date_news', 
			gettext('Pages') => 'libratus_date_pages'
			);
		$stats_checkboxes = array(
			gettext('Images - Popular') => 'libratus_stats_images_popular', 
			gettext('Images - Latest by ID') => 'libratus_stats_images_latestbyid', 
			gettext('Images - Latest by Date') => 'libratus_stats_images_latestbydate', 
			gettext('Images - Latest by mtime') => 'libratus_stats_images_latestbymtime', 
			gettext('Images - Latest by Publish Date') => 'libratus_stats_images_latestbypdate', 
			gettext('Images - Most Rated') => 'libratus_stats_images_mostrated', 
			gettext('Images - Top Rated') => 'libratus_stats_images_toprated',
			gettext('Albums - Popular') => 'libratus_stats_albums_popular', 
			gettext('Albums - Latest by ID') => 'libratus_stats_albums_latestbyid', 
			gettext('Albums - Latest by Date') => 'libratus_stats_albums_latestbydate', 
			gettext('Albums - Latest by mtime') => 'libratus_stats_albums_latestbymtime', 
			gettext('Albums - Latest by Publish Date') => 'libratus_stats_albums_latestbypdate', 
			gettext('Albums - Most Rated') => 'libratus_stats_albums_mostrated', 
			gettext('Albums - Top Rated') => 'libratus_stats_albums_toprated', 
			gettext('Albums - Latest Updated') => 'libratus_stats_albums_latestupdated'
			);
		$bottom_stats_checkboxes = array(
			gettext('Gallery - Description') => 'libratus_stats_gal_desc_bottom', 
			gettext('News - Latest') => 'libratus_stats_news_latest_bottom',
			gettext('Comments - Latest') => 'libratus_stats_comments_latest_bottom', 
			gettext('Images - Popular') => 'libratus_stats_images_popular_bottom', 
			gettext('Images - Latest by ID') => 'libratus_stats_images_latestbyid_bottom', 
			gettext('Images - Latest by Date') => 'libratus_stats_images_latestbydate_bottom', 
			gettext('Images - Latest by mtime') => 'libratus_stats_images_latestbymtime_bottom', 
			gettext('Images - Latest by Publish Date') => 'libratus_stats_images_latestbypdate_bottom', 
			gettext('Images - Most Rated') => 'libratus_stats_images_mostrated_bottom', 
			gettext('Images - Top Rated') => 'libratus_stats_images_toprated_bottom',
			gettext('Albums - Popular') => 'libratus_stats_albums_popular_bottom', 
			gettext('Albums - Latest by ID') => 'libratus_stats_albums_latestbyid_bottom', 
			gettext('Albums - Latest by Date') => 'libratus_stats_albums_latestbydate_bottom', 
			gettext('Albums - Latest by mtime') => 'libratus_stats_albums_latestbymtime_bottom', 
			gettext('Albums - Latest by Publish Date') => 'libratus_stats_albums_latestbypdate_bottom', 
			gettext('Albums - Most Rated') => 'libratus_stats_albums_mostrated_bottom', 
			gettext('Albums - Top Rated') => 'libratus_stats_albums_toprated_bottom', 
			gettext('Albums - Latest Updated') => 'libratus_stats_albums_latestupdated_bottom'
			);
		global $_zp_gallery;
		$albumlist = array();
		$albumlist['Entire Gallery'] = '';
		$albums = getNestedAlbumList(null, 9999999, false);
		foreach($albums as $album) {
			$albumobj = newAlbum($album['name'], true);
			$albumlist[$album['name']] = $album['name'];
		}
		return array(	
			gettext('Max Width of Site') => array('key' => 'libratus_maxwidth', 'type' => OPTION_TYPE_TEXTBOX, 
				'order'=>1, 
				'multilingual' => 0,
				'desc' => gettext('Set the max-width of site in pixels.  Site is fluid but will not expand beyond this width.')),
			gettext('Home Slideshow Type') => array('key' => 'libratus_ss_type', 'type' => OPTION_TYPE_SELECTOR,
				'order' => 2, 
				'selections' => array(
					gettext('Random') => 'random', 
					gettext('Popular') => 'popular', 
					gettext('Latest by ID') => 'latestbyid', 
					gettext('Latest by Date') => 'latestbydate', 
					gettext('Latest by mtime') => 'latestbymtime', 
					gettext('Latest by Publish Date') => 'latestbypdate', 
					gettext('Most Rated') => 'mostrated', 
					gettext('Top Rated') => 'toprated'), 
				'desc' => gettext('Select what image statistic to show on the frontpage slideshow.')),
			gettext('Home Slideshow from Album') => array('key' => 'libratus_ss_album', 'type' => OPTION_TYPE_SELECTOR,
				'order' => 3, 
				'selections' => $albumlist, 
				'desc' => gettext('Optionally select a specific album the Home Slideshow pulls from. Default is "Entire Gallery", which pulls from the entire gallery. Be careful with this option to ensure there are images that meet the statistic and they are viewable (rights), otherwise no images will show.')),
			gettext('Slideshow Interval') => array('key' => 'libratus_ss_interval', 'type' => OPTION_TYPE_TEXTBOX, 
				'order'=>4, 
				'multilingual' => 0,
				'desc' => gettext('In milliseconds (default 5000).')),
			gettext('Home Page Full-width') => array('key' => 'libratus_index_fullwidth', 'type' => OPTION_TYPE_CHECKBOX, 
				'order' => 5,
				'desc' => gettext("Check for album thumbs to full-width on home page (no sidebar statistics menu with search).")),
			gettext('Show Date') => array('key' => 'libratus_date', 'type' => OPTION_TYPE_CHECKBOX_ARRAY,
				'order' => 6,
				'checkboxes' => $showdates_checkboxes,
				'desc' => gettext("Toggle whether to display dates in albums, images, news, and pages. On \"pages\", libratus shows last updated date if checked. Note that you need to show dates on images, or on news, for those to show on the archive page.")),
			gettext('Download Button') => array('key' => 'libratus_download', 'type' => OPTION_TYPE_CHECKBOX, 
				'order' => 7,
				'desc' => gettext("Check to enable users the ability to download original image from image details page. If you want a save dialog, you will need to set the appropriate option in options->image as well (protected, download).")),
			gettext('Simple Social Sharing?') => array('key' => 'libratus_social', 'type' => OPTION_TYPE_CHECKBOX, 
				'order' => 8,
				'desc' => gettext("Check to display simple links (lightweight) for users to share to their Facebook, Google, and Twitter accounts. Make sure to enable the meta tags plugin and enable the og entries for these sites to pull the correct thumbs, titles, and descriptions upon share.")),
			gettext('Custom CSS') => array('key' => 'libratus_customcss', 'type' => OPTION_TYPE_TEXTAREA, 
				'order'=>9, 
				'multilingual' => 0,
				'desc' => gettext('Enter any custom CSS, safely carries over upon theme upgrade. Will be placed between style tags in the head.')),
			gettext('Google Tracking Code') => array('key' => 'libratus_analytics', 'type' => OPTION_TYPE_TEXTBOX, 
				'order'=>10, 
				'multilingual' => 0,
				'desc' => gettext('Enter your Google Analytics Universal Tracking Id here to auto insert the tracking code on every page (UA-...). Leave blank to omit. Note that the analytics code will not be outputted for admin users, so that administrator page visits will not be counted.')),
			gettext('Tracking Type') => array('key' => 'libratus_analytics_type', 'type' => OPTION_TYPE_RADIO, 
				'order' => 11,
				'buttons' => array(gettext('Universal')=>'universal', gettext('Classic')=>'classic'),
				'desc' => gettext("Select what type of analytics you are using. See your Google analytics account for explanations.")),
			gettext('Facebook Link') => array('key' => 'libratus_facebook', 'type' => OPTION_TYPE_TEXTBOX, 
				'order'=>12, 
				'multilingual' => 0,
				'desc' => gettext('Enter your full Facebook page link (http://....). Leave blank to omit.')),
			gettext('Twitter Link') => array('key' => 'libratus_twitter', 'type' => OPTION_TYPE_TEXTBOX, 
				'order'=>13, 
				'multilingual' => 0,
				'desc' => gettext('Enter your full Twitter page link (http://....). Leave blank to omit.')),
			gettext('Google+ Link') => array('key' => 'libratus_google', 'type' => OPTION_TYPE_TEXTBOX, 
				'order'=>14, 
				'multilingual' => 0,
				'desc' => gettext('Enter your full Google+ page link (http://....). Leave blank to omit.')),
			gettext('Copyright Text') => array('key' => 'libratus_copy', 'type' => OPTION_TYPE_TEXTBOX, 
				'order'=>15, 
				'multilingual' => 0,
				'desc' => gettext('Edit text for footer copyright. Leave blank to omit.')),
			gettext('Statistical Pages on Archive') => array('key' => 'libratus_stats', 'type' => OPTION_TYPE_CHECKBOX_ARRAY,
				'order' => 16,
				'checkboxes' => $stats_checkboxes,
				'desc' => gettext('Select which statistical pages to show in the archive side menu and homepage side menu (optional), if any.')),
			gettext('Statistical Pages Number') => array('key' => 'libratus_stats_number', 'type' => OPTION_TYPE_TEXTBOX, 
				'order'=>17, 
				'multilingual' => 0,
				'desc' => gettext('Enter the number of images or albums to show for each statistic on the archive pages (default 30).')),
			gettext('Bottom Stats Items per Row') => array('key' => 'libratus_bottom_stats_perrow', 'type' => OPTION_TYPE_RADIO, 
				'order' => 18,
				'buttons' => array(gettext('Disable')=>0, gettext('1')=>1, gettext('2')=>2, gettext('3')=>3, gettext('4')=>4),
				'desc' => gettext("Select how many items per row for the bottom stats, if any.")),
			gettext('Bottom Stats') => array('key' => 'libratus_bottom_stats', 'type' => OPTION_TYPE_CHECKBOX_ARRAY,
				'order' => 19,
				'checkboxes' => $bottom_stats_checkboxes,
				'desc' => gettext('Select what to show in the bottom row, if not disabled above. Recommended to choose multiples of the option items per row.')),
			gettext('Number of Images in Bottom Stats') => array('key' => 'libratus_bottom_stats_number', 'type' => OPTION_TYPE_TEXTBOX, 
				'order'=>20, 
				'multilingual' => 0,
				'desc' => gettext('Enter the number of images or albums to show for each selected statistic in the bottom footer.')),
			gettext('Related Max Number') => array('key' => 'libratus_related_maxnumber', 'type' => OPTION_TYPE_TEXTBOX, 
				'order'=>21, 
				'multilingual' => 0,
				'desc' => gettext('Enter the MAX number of related albums and images to show on their respective pages (if plugin is enabled).'))
		);
	}
} ?>