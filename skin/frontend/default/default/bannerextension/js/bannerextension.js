(function(jQuery){
jQuery.fn.bannerextension = function( params ) {
    // set config
    var defaults = {
        width: 500,
        height: 500,
        next: false,
        prev: false,
        auto: 0,
        current: 0,
        items: 0,
        slidespeed: 1000,
        visible: 1,
        pagination: 0,
		effect:'horizontal'
    };
    var config = jQuery.extend(defaults, params);
    
    // configure banner ul and li
    var ul = jQuery(this);
    var li = ul.children('li');
    
    config.items = li.length;
    
    var height = config.height;
    var width = config.width;
    if(config.visible>1) {
        if(config.vertical)
            height = height*config.visible;
        else
            width = width*config.visible;
    }
    
    ul.wrap('<div class="banner_wrapper" style="width:'+width+'px;height:'+height+'px;overflow:hidden">');
    var container = ul.parent('.banner_wrapper');
    if(config.effect=='horizontal') {
        ul.width(config.items*config.width);
        ul.height(config.height);
    } else {
        ul.width(config.width);
        ul.height(config.items*config.height);
    }
    ul.css('overflow','hidden');
    
    li.each(function(i,item) {
        jQuery(item).width(config.width);
        jQuery(item).height(config.height);
        if(!config.vertical)
            jQuery(item).css('float','left');
    });
    
    // function for sliding the slider
    var slidebanner = function(dir, click) {
        if(typeof click == "undefined" & config.auto==0)
            return;
    
        if(dir=="next") {
            config.current += config.visible;
            if(config.current>=config.items)
                config.current = 0;
        } else if(dir=="prev") {
            config.current -= config.visible;
            if(config.current<0)
                config.current = (config.visible==1) ? config.items-1 : config.items-config.visible+(config.visible-(config.items%config.visible));
        } else {
            config.current = dir;
        }
        
        // set active class for pagination li
        if(config.pagination != 0) {
            container.next('.banner_pagination').find('li').removeClass('active')
            container.next('.banner_pagination').find('li:nth-child('+(config.current+1)+')').addClass('active');
        }
        
        // show fade effect
        if(config.effect=='fade') {
            ul.fadeOut(true, function() {
                ul.css({marginLeft: -1.0*config.current*config.width});
                ul.fadeIn(true);
            });
            
        // show next slide
        } else {
            if(config.effect=='horizontal')
                ul.animate( {marginLeft: -1.0*config.current*config.width}, config.slidespeed );
            else
                ul.animate( {marginTop: -1.0*config.current*config.height}, config.slidespeed );
        }
        
        if(typeof click != "undefined")
            config.auto = 0;
        
        if(config.auto!=0)
            setTimeout(function() {
                slidebanner('next');
            }, config.auto);
    }
    
	// Slide uisng pagination
	if(config.pagination != 0) {
		var pagination = container.next('.banner_pagination');
		pagination.find('li').each(function(index, item) {
			jQuery(this).click(function() {
				slidebanner(index,true);
			});
		});
	}

        
    // Slide using next button
    if(config.next!=false)
        config.next.click(function() {
            slidebanner('next',true);
        });
        
   // Slide using prev button     
    if(config.prev!=false)
        config.prev.click(function() {
            slidebanner('prev',true);
        });
    
    // start auto sliding
    if(config.auto!=false)
        setTimeout(function() {
            slidebanner('next');
        }, config.auto);
}
})(jQuery);