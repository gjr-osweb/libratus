		
		<div class="stats-menu">
		<?php 
		$imgheader = true; $albheader = true; $active = '';
		$imgheadertext = '<div class="bold-header">'.gettext('Image Sets').'</div>';
		$albheadertext = '<hr /><div class="bold-header">'.gettext('Album Sets').'</div>';
		
		if (getOption('libratus_stats_images_popular')) {
			if ($imgheader) { echo $imgheadertext; $imgheader = false; }
			if (isset($_GET['set'])) {
				if ($_GET['set'] == 'popularimages') { $active = ' class="active"'; } else { $active = ''; }
			}
			echo '<div'.$active.'><a href="'.getCustomPageURL('archive','set=popularimages').'"><i class="fa fa-eye fa-fw"></i> '.gettext('Popular Images').'</a></div>';
			$active = '';
		}
		
		if (getOption('libratus_stats_images_latestbyid')) {
			if ($imgheader) { echo $imgheadertext; $imgheader = false; }
			if (isset($_GET['set'])) {
				if ($_GET['set'] == 'latestimagesbyid') { $active = ' class="active"'; } else { $active = ''; }
			}
			echo '<div'.$active.'><a href="'.getCustomPageURL('archive','set=latestimagesbyid').'"><i class="fa fa-upload fa-fw"></i> '.gettext('Latest Images by ID').'</a></div>';
			$active = '';
		}
		
		if (getOption('libratus_stats_images_latestbydate')) {
			if ($imgheader) { echo $imgheadertext; $imgheader = false; }
			if (isset($_GET['set'])) {
				if ($_GET['set'] == 'latestimagesbydate') { $active = ' class="active"'; } else { $active = ''; }
			}
			echo '<div'.$active.'><a href="'.getCustomPageURL('archive','set=latestimagesbydate').'"><i class="fa fa-calendar fa-fw"></i> '.gettext('Latest Images by Date').'</a></div>';
			$active = '';
		}
		
		if (getOption('libratus_stats_images_latestbymtime')) {
			if ($imgheader) { echo $imgheadertext; $imgheader = false; }
			if (isset($_GET['set'])) {
				if ($_GET['set'] == 'latestimagesbymtime') { $active = ' class="active"'; } else { $active = ''; }
			}
			echo '<div'.$active.'><a href="'.getCustomPageURL('archive','set=latestimagesbymtime').'"><i class="fa fa-clock-o fa-fw"></i> '.gettext('Latest Images by Mtime').'</a></div>';
			$active = '';
		}
		
		if (getOption('libratus_stats_images_latestbypdate')) {
			if ($imgheader) { echo $imgheadertext; $imgheader = false; }
			if (isset($_GET['set'])) {
				if ($_GET['set'] == 'latestimagesbypdate') { $active = ' class="active"'; } else { $active = ''; }
			}
			echo '<div'.$active.'><a href="'.getCustomPageURL('archive','set=latestimagesbypdate').'"><i class="fa fa-calendar fa-fw"></i> '.gettext('Latest Images by Published Date').'</a></div>';
			$active = '';
		}
		
		if (getOption('libratus_stats_images_mostrated')) {
			if ($imgheader) { echo $imgheadertext; $imgheader = false; }
			if (isset($_GET['set'])) {
				if ($_GET['set'] == 'mostratedimages') { $active = ' class="active"'; } else { $active = ''; }
			}
			echo '<div'.$active.'><a href="'.getCustomPageURL('archive','set=mostratedimages').'"><i class="fa fa-thumbs-up fa-fw"></i> '.gettext('Most Rated Images').'</a></div>';
			$active = '';
		}
		
		if (getOption('libratus_stats_images_toprated')) {
			if ($imgheader) { echo $imgheadertext; $imgheader = false; }
			if (isset($_GET['set'])) {
				if ($_GET['set'] == 'topratedimages') { $active = ' class="active"'; } else { $active = ''; }
			}
			echo '<div'.$active.'><a href="'.getCustomPageURL('archive','set=topratedimages').'"><i class="fa fa-star fa-fw"></i> '.gettext('Top Rated Images').'</a></div>';
			$active = '';
		}
		
		if (getOption('libratus_stats_albums_popular')) {
			if ($albheader) { echo $albheadertext; $albheader = false; }
			if (isset($_GET['set'])) {
				if ($_GET['set'] == 'popularalbums') { $active = ' class="active"'; } else { $active = ''; }
			}
			echo '<div'.$active.'><a href="'.getCustomPageURL('archive','set=popularalbums').'"><i class="fa fa-eye fa-fw"></i> '.gettext('Popular Albums').'</a></div>';
			$active = '';
		}
		
		if (getOption('libratus_stats_albums_latestbyid')) {
			if ($albheader) { echo $albheadertext; $albheader = false; }
			if (isset($_GET['set'])) {
				if ($_GET['set'] == 'latestalbumsbyid') { $active = ' class="active"'; } else { $active = ''; }
			}
			echo '<div'.$active.'><a href="'.getCustomPageURL('archive','set=latestalbumsbyid').'"><i class="fa fa-upload fa-fw"></i> '.gettext('Latest Albums by ID').'</a></div>';
			$active = '';
		}
		
		if (getOption('libratus_stats_albums_latestbydate')) {
			if ($albheader) { echo $albheadertext; $albheader = false; }
			if (isset($_GET['set'])) {
				if ($_GET['set'] == 'latestalbumsbydate') { $active = ' class="active"'; } else { $active = ''; }
			}
			echo '<div'.$active.'><a href="'.getCustomPageURL('archive','set=latestalbumsbydate').'"><i class="fa fa-calendar fa-fw"></i> '.gettext('Latest Albums by Date').'</a></div>';
			$active = '';
		}
		
		if (getOption('libratus_stats_albums_latestbymtime')) {
			if ($albheader) { echo $albheadertext; $albheader = false; }
			if (isset($_GET['set'])) {
				if ($_GET['set'] == 'latestalbumsbymtime') { $active = ' class="active"'; } else { $active = ''; }
			}
			echo '<div'.$active.'><a href="'.getCustomPageURL('archive','set=latestalbumsbymtime').'"><i class="fa fa-clock-o fa-fw"></i> '.gettext('Latest Albums by Mtime').'</a></div>';
			$active = '';
		}
		
		if (getOption('libratus_stats_albums_latestbypdate')) {
			if ($albheader) { echo $albheadertext; $albheader = false; }
			if (isset($_GET['set'])) {
				if ($_GET['set'] == 'latestalbumsbypdate') { $active = ' class="active"'; } else { $active = ''; }
			}
			echo '<div'.$active.'><a href="'.getCustomPageURL('archive','set=latestalbumsbypdate').'"><i class="fa fa-calendar fa-fw"></i> '.gettext('Latest Albums by Published Date').'</a></div>';
			$active = '';
		}
		
		if (getOption('libratus_stats_albums_mostrated')) {
			if ($albheader) { echo $albheadertext; $albheader = false; }
			if (isset($_GET['set'])) {
				if ($_GET['set'] == 'mostratedalbums') { $active = ' class="active"'; } else { $active = ''; }
			}
			echo '<div'.$active.'><a href="'.getCustomPageURL('archive','set=mostratedalbums').'"><i class="fa fa-thumbs-up fa-fw"></i> '.gettext('Most Rated Albums').'</a></div>';
			$active = '';
		}
		
		if (getOption('libratus_stats_albums_toprated')) {
			if ($albheader) { echo $albheadertext; $albheader = false; }
			if (isset($_GET['set'])) {
				if ($_GET['set'] == 'topratedalbums') { $active = ' class="active"'; } else { $active = ''; }
			}
			echo '<div'.$active.'><a href="'.getCustomPageURL('archive','set=topratedalbums').'"><i class="fa fa-star fa-fw"></i> '.gettext('Top Rated Albums').'</a></div>';
			$active = '';
		}
		
		if (getOption('libratus_stats_albums_latestupdated')) {
			if ($albheader) { echo $albheadertext; $albheader = false; }
			if (isset($_GET['set'])) {
				if ($_GET['set'] == 'latestupdatedalbums') { $active = ' class="active"'; } else { $active = ''; }
			}
			echo '<div'.$active.'><a href="'.getCustomPageURL('archive','set=latestupdatedalbums').'"><i class="fa fa-indent fa-fw"></i> '.gettext('Latest Updated Albums').'</a></div>';
			$active = '';
		}
		
		?>
		</div>
		<?php if (getOption('libratus_social')) include ('inc-socialshare.php'); ?>
