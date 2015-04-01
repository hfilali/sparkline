(function($)
{
    "use strict";

    $(document).ready(function()
    {
		
        activate_shortcode_scripts();

    });



// -------------------------------------------------------------------------------------------
// ACTIVATE ALL SHORTCODES
// -------------------------------------------------------------------------------------------

	function activate_waypoints(container)
	{
		//activates simple css animations of the content once the user scrolls to an elements
		if($.fn.themeapt_waypoints)
		{
			if(typeof container == 'undefined'){ container = 'body';};

			$('.themeapt_animate_when_visible', container).themeapt_waypoints();
			$('.themeapt_animate_when_almost_visible', container).themeapt_waypoints({ offset: '80%'});
		}
	}


    function activate_shortcode_scripts(container)
	{
		if(typeof container == 'undefined'){ container = 'body';};
		
		activate_waypoints(container);
		
		//activates animation for testimonial
		if($.fn.themeapt_sc_testimonial)
		{
			$('.themeapt-testimonial-wrapper', container).themeapt_sc_testimonial();
		}
		
		//activates behavior and animation for gallery
		if($.fn.themeapt_sc_gallery)
		{
			$('.themeapt-gallery', container).themeapt_sc_gallery();
		}
		
		//activates animation for iconlist
		if($.fn.themeapt_sc_iconlist)
		{
			$('.themeapt-icon-list', container).themeapt_sc_iconlist();
		}


		//activates animation for progress bar
		if($.fn.themeapt_sc_progressbar)
		{
		
			$('.themeapt-progress-bar-container', container).themeapt_sc_progressbar();
		}
		
		//activates animation for progress bar
		if($.fn.themeapt_sc_initPieChart)
		{
		
			$('.themeapt-pie-chart-container', container).themeapt_sc_initPieChart();
		}

		
		
    }


	

// -------------------------------------------------------------------------------------------
// testimonial shortcode javascript
// -------------------------------------------------------------------------------------------

$.fn.themeapt_sc_testimonial = function(options)
{
	return this.each(function()
	{
		var container = $(this), elements = container.find('.themeapt-testimonial');


		//trigger displaying of thumbnails
		container.on('themeapt_start_animation', function()
		{
			elements.each(function(i)
			{
				var element = $(this);
				setTimeout(function(){ element.addClass('themeapt_start_animation') }, (i * 150));
			});
		});
	});
}




// -------------------------------------------------------------------------------------------
// Gallery shortcode javascript
// -------------------------------------------------------------------------------------------

$.fn.themeapt_sc_gallery = function(options)
{
	return this.each(function()
	{
		var gallery = $(this), images = gallery.find('img');


		//trigger displaying of thumbnails
		gallery.on('themeapt_start_animation', function()
		{
			images.each(function(i)
			{
				var image = $(this);
				setTimeout(function(){ image.addClass('themeapt_start_animation') }, (i * 110));
			});
		});

	});
}


// -------------------------------------------------------------------------------------------
// Progress bar shortcode javascript
// -------------------------------------------------------------------------------------------

$.fn.themeapt_sc_progressbar = function(options)
{
	return this.each(function()
	{
	
	
		var container = $(this), elements = container.find('.progress-bar');
	

		container.on('themeapt_start_animation', function()
		{			
			elements.each(function(i)
			{
				var element = $(this);
				
				setTimeout(function(){ element.addClass('themeapt_start_animation') }, (i * 250));
			});
		});
	});
}

// -------------------------------------------------------------------------------------------
// Iconlist shortcode javascript
// -------------------------------------------------------------------------------------------

$.fn.themeapt_sc_iconlist = function(options)
{
	return this.each(function()
	{
		var iconlist = $(this), elements = iconlist.find('>li');


		//trigger displaying of thumbnails
		iconlist.on('themeapt_start_animation', function()
		{
			elements.each(function(i)
			{
				var element = $(this);
				setTimeout(function(){ element.addClass('themeapt_start_animation') }, (i * 350));
			});
		});
	});
}



// -------------------------------------------------------------------------------------------
// Iconlist shortcode javascript
// -------------------------------------------------------------------------------------------

$.fn.themeapt_sc_initPieChart = function(options)
{

	var container = $(this), elements = container.find('themeapt-pie-chart-container');

	container.on('themeapt_start_animation', function()
		{
		
			 jQuery('.percentage').easyPieChart({
                    animate: 1000,
                    onStep: function(value) {
                        this.$el.find('span').text(~~value);
                    }
                });
               jQuery('.percentage-light').easyPieChart({
                    barColor: '#6FB554',
                    trackColor: '#5a5a5a',
                    scaleColor: false,
                    lineCap: 'butt',
                    lineWidth: 20,
                    animate: 2000,
					size: 190,					
                    onStep: function(value) {
                        this.$el.find('span').text(~~value);
                    }
                });

				
			
			
		});
               
				
				
               
            };



//waipoint script when something comes into viewport
 $.fn.themeapt_waypoints = function(options_passed)
	{
		

		var defaults = { offset: 'bottom-in-view' , triggerOnce: true},
			options  = $.extend({}, defaults, options_passed);

		return this.each(function()
		{
			var element = $(this);

			setTimeout(function()
			{
				element.waypoint(function(direction)
				{
				 	$(this).addClass('themeapt_start_animation').trigger('themeapt_start_animation');

				}, options );

			},100)
		});
	};


})( jQuery );














