$('.bar').scrollFix();

$(document).ready(function(){

	$('#zp__admin_module').detach().appendTo('#quickmenu');

	$('#map-wrap > a').before('<i class="fa fa-map-marker fa-fw"></i> ');
	$('#mailform input[type="submit"]').addClass('button-primary');
	$('#commentform input[type="submit"]').addClass('button-primary');
	$('#search_submit').removeClass('button');
	
	var iw = $( "img.check-flagthumb" );
	if ( iw.parent().is( "span" ) ) { iw.unwrap(); }

	/*
	$('.gallery-thumbs').each(function (i, el) {
		$(el).justifiedGallery({rel: 'gal' + i, rowHeight: 120, margins: 20, cssAnimation : true,}).on('jg.complete', function () {
			if (i == 1) $('.swipebox').swipebox(); //swipebox, wants to be called only once to work properly
		});
	});
	*/
	$('.swipebox').swipebox({hideBarsOnMobile : false});
	
	$('.gallery-thumbs').justifiedGallery({
		rowHeight : 120,
		lastRow : 'nojustify',
		cssAnimation : true,
		margins : 20
	});
	
	$('.gallery-thumbs-large').justifiedGallery({
		rowHeight : 180,
		maxRowHeight : 200,
		lastRow : 'nojustify',
		cssAnimation : true,
		margins : 20
	});

	$('#bottom-modules .gallery-thumbs').justifiedGallery({
		rowHeight : 120,
		maxRowHeight : 140,
		lastRow : 'justify',
		cssAnimation : true,
		margins : 10
	});
	
	$(".imageFavorites input").removeClass("button");
	$(".masonry-style-padding img").addClass("scale");
	$(".blog-style-padding img").addClass("scale");
	$(".page-news-full img").addClass("scale");
	$("#relateditems img").addClass("scale");
	$(".album-thumb img").addClass("scale");
	
	
	$('.scale').each(function(){
        $(this).removeAttr('width')
        $(this).removeAttr('height');
    });

	$('.textobject').each(function(){
        $(this).removeAttr('style');
    });
  
	// scroll to top, 200 is amount of pixels scrolled for link to appear
	$(window).scroll(function(){
		if ($(this).scrollTop() > 200) {
			$('.scrollup').fadeIn();
		} else {
			$('.scrollup').fadeOut();
		}
	});
	$('.scrollup').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 600);
		return false;
	});
  
	// enable map pointer events only on click, prevents zoom on map when scrolling with mousewheel;
    $('#map_canvas').addClass('scrolloff'); // set the pointer events to none on doc ready
	$('#osm_map').addClass('scrolloff'); // set the pointer events to none on doc ready
    $('#map-wrap').on('click', function() {
		$('#map_canvas').removeClass('scrolloff'); // set the pointer events true on click
		$('#osm_map').removeClass('scrolloff'); // set the pointer events true on click
    });

    // disable pointer events when the mouse leaves the canvas area;
    $( "#map_canvas" ).mouseleave(function() {
		$('#map_canvas').addClass('scrolloff'); // set the pointer events to none when mouse leaves the map area
    }); 
	$( "#osm_map" ).mouseleave(function() {
		$('#osm_map').addClass('scrolloff'); // set the pointer events to none when mouse leaves the map area
    }); 
  
});
