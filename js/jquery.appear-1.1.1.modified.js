/*
 * jQuery.appear
 * http://code.google.com/p/jquery-appear/
 *
 * Copyright (c) 2009 Michael Hixson
 * Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php)
 *
 * http://www.3magine.com
 * Modified by Karl Schellenberg
*/
(function($) {
  
  $.fn.appear = function(options) {
	var c = {'zero':0,'ten':10,'twenty':20,'thirty':30,'fourty':40,'fifty':50,'sixty':60,'seventy':70,'eighty':80,'ninety':90,'hundred':100};
	
    var settings = $.extend({
	  data:undefined,
      once: false,
	  percentage: 50,
	  forEachVisible:function(i,e){},
	  appear:function(){},
	  disappear:function(){},
	  initialized:false
    }, options);
    
    return this.each(function(i,e) {
      var t = $(this),
	  	  perc = settings.percentage;
      
	  for(n in c){
		if(t.hasClass(n)){
			perc = c[n];
			break;
		}
	  }
	  
	  $(window).load(function(){	
		  t.appeared = false;
		  var w = $(window);
		  
		  var check = function(){
			if (!t.is(':visible')){
			  t.appeared = false;
			  return;
			}
			//is the element inside the visible window?
			var wx = w.scrollLeft();
			var wy = w.scrollTop();
			var wxr = wx + w.width();  //wx right
			var wyb = wy + w.height(); //wy bottom
			
			var o = t.offset();
			var x = o.left;
			var xr = x  + t.width(); //x right
			var y = o.top;
			var yb = y + t.height(); //y bottom
			
			var wts = wy>y && wy<yb ? wy - y : 0; //subtract from top
			var wbs = wyb<yb && wyb>y ? yb - wyb : 0; //subtract from bottom
			var ts = wts + wbs; //total subtract
				
			var percVis = Math.round(((t.height()-ts) / t.height()) * 100);	//percentage visible
						
			if (percVis >= perc &&
				yb >= wy && 
				y <= wyb &&
				xr >= wx && 
				x <= wxr){
			  if (!t.appeared){
				  if(!settings.initialized)	settings.forEachVisible(i,t);
				  t.trigger('appear', settings.data);
			  }
			} else {
			  if(t.appeared)  t.trigger('disappear',settings.data);
			  t.appeared = false;
			}
		  };
		   
		  //create a modified fn with some additional logic
		  var modifiedAppear = function() {
			t.appeared = true;
	
			if (settings.once) {
			  w.unbind('scroll', check);
			  w.unbind('resize', check);
			  
			  var i = $.inArray(check, $.fn.appear.checks);
			  if (i >= 0) $.fn.appear.checks.splice(i, 1);
			}
			settings.appear.apply(this, arguments);
		  };
		  
		  //create a modified fn2 with some additional logic
		  var modifiedDisappear = function() {
			t.appeared = false;
			settings.disappear.apply(this, arguments);
		  };
		  
		  //bind the modified fn to the element
		  if (settings.once)	 t.one('appear', settings.data, modifiedAppear);
		  else{
			  t.bind('appear', settings.data, modifiedAppear);
			  t.bind('disappear', settings.data, modifiedDisappear);
		  }
		  
		  w.scroll(check);
		  w.resize(check);
		  $.fn.appear.checks.push(check);
		  (check)();
		  
		  //check again (chrome fix):
		  var at = setTimeout(function(){	window.scrollBy(0,-1);	window.scrollBy(0,1);	settings.initialized = true; },500);
		});
    });
  };
  
  //keep a queue of appearance checks
  $.extend($.fn.appear, {
    
    checks: [],
    timeout: null,

    //process the queue
    checkAll: function() {
      var length = $.fn.appear.checks.length;
      if (length > 0) while (length--) ($.fn.appear.checks[length])();
    },

    //check the queue asynchronously
    run: function() {
      if ($.fn.appear.timeout) clearTimeout($.fn.appear.timeout);
      $.fn.appear.timeout = setTimeout($.fn.appear.checkAll, 20);
    }
  });
  
  //run checks when these methods are called
  $.each(['append', 'prepend', 'after', 'before', 'attr', 
          'removeAttr', 'addClass', 'removeClass', 'toggleClass', 
          'remove', 'css', 'show', 'hide'], function(i, n){
    var old = $.fn[n];
    if (old) {
      $.fn[n] = function() {
        var r = old.apply(this, arguments);
        $.fn.appear.run();
        return r;
      }
    }
  });
  
})(jQuery);