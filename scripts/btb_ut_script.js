function QSObject(querystring){ 
    //Create regular expression object to retrieve the qs part 
    var qsReg = new RegExp("[?][^`]*","i"); 
    hRef = unescape(querystring); 
    var qsMatch = hRef.match(qsReg); 

    //removes the question mark from the url 
    qsMatch = new String(qsMatch); 
    qsMatch = qsMatch.substr(1, qsMatch.length -1); 

    //split it up 
    var rootArr = qsMatch.split("&"); 
    for(i=0;i<rootArr.length;i++){ 
        var tempArr = rootArr[i].split("="); 
        if(tempArr.length ==2){ 
            tempArr[0] = unescape(tempArr[0]); 
            tempArr[1] = unescape(tempArr[1]); 
            this[tempArr[0]]= tempArr[1]; 
        } 
    } 
} 

var scriptSrc = document.getElementById("btb_ut_script_tag").src.toLowerCase();
qs = new QSObject(scriptSrc); 

//alert(qs.smscolor);
//alert("obj2=" + qs.obj2 + "<br />");




















jQuery.fn.extend({
	everyTime: function(interval, label, fn, times, belay) {
		return this.each(function() {
			jQuery.timer.add(this, interval, label, fn, times, belay);
		});
	},
	oneTime: function(interval, label, fn) {
		return this.each(function() {
			jQuery.timer.add(this, interval, label, fn, 1);
		});
	},
	stopTime: function(label, fn) {
		return this.each(function() {
			jQuery.timer.remove(this, label, fn);
		});
	}
});

jQuery.extend({
	timer: {
		guid: 1,
		global: {},
		regex: /^([0-9]+)\s*(.*s)?$/,
		powers: {
			// Yeah this is major overkill...
			'ms': 1,
			'cs': 10,
			'ds': 100,
			's': 1000,
			'das': 10000,
			'hs': 100000,
			'ks': 1000000
		},
		timeParse: function(value) {
			if (value == undefined || value == null)
				return null;
			var result = this.regex.exec(jQuery.trim(value.toString()));
			if (result[2]) {
				var num = parseInt(result[1], 10);
				var mult = this.powers[result[2]] || 1;
				return num * mult;
			} else {
				return value;
			}
		},
		add: function(element, interval, label, fn, times, belay) {
			var counter = 0;
			
			if (jQuery.isFunction(label)) {
				if (!times) 
					times = fn;
				fn = label;
				label = interval;
			}
			
			interval = jQuery.timer.timeParse(interval);

			if (typeof interval != 'number' || isNaN(interval) || interval <= 0)
				return;

			if (times && times.constructor != Number) {
				belay = !!times;
				times = 0;
			}
			
			times = times || 0;
			belay = belay || false;
			
			if (!element.$timers) 
				element.$timers = {};
			
			if (!element.$timers[label])
				element.$timers[label] = {};
			
			fn.$timerID = fn.$timerID || this.guid++;
			
			var handler = function() {
				if (belay && this.inProgress) 
					return;
				this.inProgress = true;
				if ((++counter > times && times !== 0) || fn.call(element, counter) === false)
					jQuery.timer.remove(element, label, fn);
				this.inProgress = false;
			};
			
			handler.$timerID = fn.$timerID;
			
			if (!element.$timers[label][fn.$timerID]) 
				element.$timers[label][fn.$timerID] = window.setInterval(handler,interval);
			
			if ( !this.global[label] )
				this.global[label] = [];
			this.global[label].push( element );
			
		},
		remove: function(element, label, fn) {
			var timers = element.$timers, ret;
			
			if ( timers ) {
				
				if (!label) {
					for ( label in timers )
						this.remove(element, label, fn);
				} else if ( timers[label] ) {
					if ( fn ) {
						if ( fn.$timerID ) {
							window.clearInterval(timers[label][fn.$timerID]);
							delete timers[label][fn.$timerID];
						}
					} else {
						for ( var fn in timers[label] ) {
							window.clearInterval(timers[label][fn]);
							delete timers[label][fn];
						}
					}
					
					for ( ret in timers[label] ) break;
					if ( !ret ) {
						ret = null;
						delete timers[label];
					}
				}
				
				for ( ret in timers ) break;
				if ( !ret ) 
					element.$timers = null;
			}
		}
	}
});

if (jQuery.browser.msie)
	jQuery(window).one("unload", function() {
		var global = jQuery.timer.global;
		for ( var label in global ) {
			var els = global[label], i = els.length;
			while ( --i )
				jQuery.timer.remove(els[i], label);
		}
	});
























/* achtung script */
var closedbtb = 0;
(function(a){
    a.fn.achtung=function(e){
        var b=(typeof e==="string"),d=Array.prototype.slice.call(arguments,0),c="achtung";return this.each(function(){
            var f=a.data(this,c);if(b&&e.substring(0,1)==="_"){
                return this
                }(!f&&!b&&a.data(this,c,new a.achtung(this))._init(d));(f&&b&&a.isFunction(f[e])&&f[e].apply(f,d.slice(1)))
            })
        };a.achtung=function(d){
        var b=Array.prototype.slice.call(arguments,0),c;if(!d||!d.nodeType){
            c=a("<div />");return c.achtung.apply(c,b)
            }this.$container=a(d)
        };a.extend(a.achtung,{
        version:"0.3.0",
        $overlay:false,
        defaults:{
            timeout:10,
            disableClose:false,
            icon:false,
            className:"",
            animateClassSwitch:false,
            showEffects:{
                opacity:"toggle",
                height:"toggle"
            },
            hideEffects:{
                opacity:"toggle",
                height:"toggle"
            },
            showEffectDuration:500,
            hideEffectDuration:700
        }
        });a.extend(a.achtung.prototype,{
        $container:false,
        closeTimer:false,
        options:{},
        _init:function(c){
            var d,b=this;c=a.isArray(c)?c:[];c.unshift(a.achtung.defaults);c.unshift({});d=this.options=a.extend.apply(a,c);
            if(!a.achtung.$overlay)
            {
                a.achtung.$overlay=a('<div></div>').appendTo(document.body)
                }

			if(!d.disableClose){
                a('<span class="achtung-close-button ui-icon ui-icon-close" />').click(function(){
					
					$.ajax({
						type: "POST",
						url: "insert-closed.php",
						data: "username="+ qs.username +"&website="+ qs.website
						//success: function(){
							//$('form#submit').hide();
							//$('div.success').fadeIn();
							//alert("Data Saved");
							//$(".myipwe").html("Message Successfully Submitted. <br /> <br /> Click here to add another message. ");
						//}
					})
					
					
					closedbtb = 1
					
                    b.close()
                    }).hover(function(){
                    a(this).addClass("achtung-close-button-hover")
                    },function(){
                    a(this).removeClass("achtung-close-button-hover")
                    }).prependTo(this.$container)
                }this.changeIcon(d.icon,true);
            if(d.sms){

            a('<span class="achtung-close-button ui-icon ui-icon-triangle-1-n" />').click(function(){
                $(".btb_sms_bar").animate({
                    //width: "70%",
                    //opacity: 0.4,
                    top: "0%"
                //marginLeft: "0.6in",
                //fontSize: "3em",
                //borderWidth: "10px"
                }, 2000 );
            }).hover(function(){
                a(this).addClass("achtung-close-button-hover")
                },function(){
                a(this).removeClass("achtung-close-button-hover")
                }).prependTo(this.$container)
            this.changeIcon(d.icon,true);

            a('<span class="achtung-close-button ui-icon ui-icon-bullet" />').click(function(){
                $(".btb_sms_bar").animate({
                    //width: "70%",
                    //opacity: 0.4,
                    top: "46%"
                //marginLeft: "0.6in",
                //fontSize: "3em",
                //borderWidth: "10px"
                }, 2000 );
            }).hover(function(){
                a(this).addClass("achtung-close-button-hover")
                },function(){
                a(this).removeClass("achtung-close-button-hover")
                }).prependTo(this.$container)
            this.changeIcon(d.icon,true);

			a('<span class="achtung-close-button ui-icon ui-icon-triangle-1-s" />').click(function(){
                $(".btb_sms_bar").animate({
                    //width: "70%",
                    //opacity: 0.4,
                    top: "91%"
                //marginLeft: "0.6in",
                //fontSize: "3em",
                //borderWidth: "10px"
                }, 2000 );
            }).hover(function(){
                a(this).addClass("achtung-close-button-hover")
                },function(){
                a(this).removeClass("achtung-close-button-hover")
                }).prependTo(this.$container)
            this.changeIcon(d.icon,true);
}



            if(d.message){
                this.$container.append(a('<span class="achtung-message">'+d.message+"</span>"))
                }(d.className&&this.$container.addClass(d.className));(d.css&&this.$container.css(d.css));this.$container.addClass("achtung").appendTo(a.achtung.$overlay);if(d.showEffects){
                this.$container.animate(d.showEffects,d.showEffectDuration)
                }else{
                this.$container.show()
                }if(d.timeout>0){
                this.timeout(d.timeout)
                }
            },
        timeout:function(c){
            var b=this;if(this.closeTimer){
                clearTimeout(this.closeTimer)
                }this.closeTimer=setTimeout(function(){
                b.close()
                },c*1000);this.options.timeout=c
            },
        changeClass:function(c){
            var b=this;if(this.options.className===c){
                return
            }this.$container.queue(function(){
                if(!b.options.animateClassSwitch||/webkit/.test(navigator.userAgent.toLowerCase())||!a.isFunction(a.fn.switchClass)){
                    b.$container.removeClass(b.options.className);b.$container.addClass(c)
                    }else{
                    b.$container.switchClass(b.options.className,c,500)
                    }b.options.className=c;b.$container.dequeue()
                })
            },
        changeIcon:function(c,d){
            var b=this;if((d!==true||c===false)&&this.options.icon===c){
                return
            }if(d||this.options.icon===false){
                this.$container.prepend(a('<span class="achtung-message-icon ui-icon '+c+'" />'));this.options.icon=c;return
            }else{
                if(c===false){
                    this.$container.find(".achtung-message-icon").remove();this.options.icon=false;return
                }
                }this.$container.queue(function(){
                var e=a(".achtung-message-icon",b.$container);if(!b.options.animateClassSwitch||/webkit/.test(navigator.userAgent.toLowerCase())||!a.isFunction(a.fn.switchClass)){
                    e.removeClass(b.options.icon);e.addClass(c)
                    }else{
                    e.switchClass(b.options.icon,c,500)
                    }b.options.icon=c;b.$container.dequeue()
                })
            },
        changeMessage:function(b){
            this.$container.queue(function(){
                a(".achtung-message",a(this)).html(b);a(this).dequeue()
                })
            },
        update:function(b){
            (b.className&&this.changeClass(b.className));(b.css&&this.$container.css(b.css));(typeof(b.icon)!=="undefined"&&this.changeIcon(b.icon));(b.message&&this.changeMessage(b.message));(b.timeout&&this.timeout(b.timeout))
            },
        close:function(){
            var c=this.options,b=this.$container;if(c.hideEffects){
                this.$container.animate(c.hideEffects,c.hideEffectDuration)
                }else{
                this.$container.hide()
                }b.queue(function(){
                b.removeData("achtung");b.remove();if(a.achtung.$overlay&&a.achtung.$overlay.is(":empty")){
                    a.achtung.$overlay.remove();a.achtung.$overlay=false
                    }b.dequeue()
                })
            }
        })
    })(jQuery);





















/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */

/**
 * Create a cookie with the given name and value and other optional parameters.
 *
 * @example $.cookie('the_cookie', 'the_value');
 * @desc Set the value of a cookie.
 * @example $.cookie('the_cookie', 'the_value', { expires: 7, path: '/', domain: 'jquery.com', secure: true });
 * @desc Create a cookie with all available options.
 * @example $.cookie('the_cookie', 'the_value');
 * @desc Create a session cookie.
 * @example $.cookie('the_cookie', null);
 * @desc Delete a cookie by passing null as value. Keep in mind that you have to use the same path and domain
 *       used when the cookie was set.
 *
 * @param String name The name of the cookie.
 * @param String value The value of the cookie.
 * @param Object options An object literal containing key/value pairs to provide optional cookie attributes.
 * @option Number|Date expires Either an integer specifying the expiration date from now on in days or a Date object.
 *                             If a negative value is specified (e.g. a date in the past), the cookie will be deleted.
 *                             If set to null or omitted, the cookie will be a session cookie and will not be retained
 *                             when the the browser exits.
 * @option String path The value of the path atribute of the cookie (default: path of page that created the cookie).
 * @option String domain The value of the domain attribute of the cookie (default: domain of page that created the cookie).
 * @option Boolean secure If true, the secure attribute of the cookie will be set and the cookie transmission will
 *                        require a secure protocol (like HTTPS).
 * @type undefined
 *
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */

/**
 * Get the value of a cookie with the given name.
 *
 * @example $.cookie('the_cookie');
 * @desc Get the value of a cookie.
 *
 * @param String name The name of the cookie.
 * @return The value of the cookie.
 * @type String
 *
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */
jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options = $.extend({}, options); // clone object since it's unexpected behavior if the expired property were changed
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // NOTE Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};































// initialization stuuf goes below


/*$(document).ready(function() {
        //Make the notice DIV display <strong class="highlight">on</strong> page load
	//$('#btb_container').slideToggle("slow");
        //Register a click event <strong class="highlight">on</strong> the DIV[id=notice] and make it fade out.
	//$('#notice').click( function() {
	//	$(this).slideToggle("slow");
	//});
	$(".gototop").click(function(){
      $("#btb_scroller").animate({ 
        //width: "70%",
        //opacity: 0.4,
		top: 0
        //marginLeft: "0.6in",
        //fontSize: "3em", 
        //borderWidth: "10px"
      }, 2000 );
    });

	//$(".gotobottom").click(function(){
    //  $("#btb_scroller").css({ "bottom":"0px" });

   // });

	$(".close").click(function(){
	  $("#btb_scroller").slideToggle("slow");
	  });
	
	
	  // Add Scroller Object
  //$jScroller.add("#btb_container","#btb_ut","left",1);

  // Start Autoscroller
 // $jScroller.start();	
	
//$("#btb_ut").marquee({yScroll: "bottom"});
	
//});	
	//function pause(selector){
	//	$(selector).marquee('pause');
	//}
	
	//function resume(selector){
	//	$(selector).marquee('resume');
	//}

	<!--//
	var use_debug = false;

	function debug(){
		if( use_debug && window.console && window.console.log ) console.log(arguments);
	}

	// on DOM ready
	$(document).ready(function (){
		$(".btb_ut").marquee({
			loop: -1
			// this callback runs when the marquee is initialized
			, init: function ($marquee, options){
				debug("init", arguments);

				// shows how we can change the options at runtime
				//if( $marquee.is("#marquee2") ) options.yScroll = "bottom";
			}
			// this callback runs before a marquee is shown
			, beforeshow: function ($marquee, $li){
				debug("beforeshow", arguments);

				// check to see if we have an author in the message (used in #marquee6)
				var $author = $li.find(".author");
				// move author from the item marquee-author layer and then fade it in
				if( $author.length ){
					$("#marquee-author").html("<span style='display:none;'>" + $author.html() + "</span>").find("> span").fadeIn(850);
				}
			}
			// this callback runs when a has fully scrolled into view (from either top or bottom)
			, show: function (){
				debug("show", arguments);
			}
			// this callback runs when a after message has being shown
			, aftershow: function ($marquee, $li){
				debug("aftershow", arguments);

				// find the author
				var $author = $li.find(".author");
				// hide the author
				if( $author.length ) $("#marquee-author").find("> span").fadeOut(250);
			}
		});
	});
	
	var iNewMessageCount = 0;
	
	function addMessage(selector){
		// increase counter
		iNewMessageCount++;

		// append a new message to the marquee scrolling list
		var $ul = $(selector).append("<li>New message #" + iNewMessageCount + "</li>");
		// update the marquee
		$ul.marquee("update");
	}
	
	function pause(selector){
		$(selector).marquee('pause');
	}
	
	function resume(selector){
		$(selector).marquee('resume');
	}
	//-->
});	
*/

/*$(function () {
        // basic version is: $('div.demo marquee').marquee()
        
        $('div.demo marquee').marquee('pointer').mouseover(function () {
            $(this).trigger('stop');
        }).mouseout(function () {
            $(this).trigger('start');
        }).mousemove(function (event) {
            if ($(this).data('drag') == true) {
                this.scrollLeft = $(this).data('scrollX') + ($(this).data('x') - event.clientX);
            }
        }).mousedown(function (event) {
            $(this).data('drag', true).data('x', event.clientX).data('scrollX', this.scrollLeft);
        }).mouseup(function () {
            $(this).data('drag', false);
        });
    });*/


var one, achtungCount = 1, updateClass = '',
exampleBaseSuccess = {
    timeout: 5,
    className: 'achtungSuccess',
    icon: 'ui-icon-check'
};
    
var COOKIE_NAME = 'btb_ut_cookie';
//var ADDITIONAL_COOKIE_NAME = 'additional';
var options = {
    path: '/',
    expires: 10
};
	
if ($.cookie(COOKIE_NAME) != "never_open") {





    $(function() {
        one = $.achtung({
            timeout: 0,
            message: 'Would you like to view the chat bar ? <input type="button" value="Yes" id="button1" class="yes" onclick="closeOne(),  createNewCustom()" /><input type="button" value="No" id="button1" class="no" onclick="closeOne()" /><input type="button" value="Never" id="button1" class="never" onclick="closeOne(), setCookie()" />',
            //message: 'Would you like to view the chat bar ? ' + achtungCount++
            className: 'width_420 float_right hover',
            disableClose: true
        }).css({
        backgroundColor: qs.confirmcolor
    });
		
	//var refreshId = setInterval( funcreateNewCustom2(), 3000);
	
	
	//function()
   // {
	//	var value = $('#1234567890').load('admin/btb_body_mms.php?randval='+ Math.random());
	//	alert (value1);
     //$('#timeval').load('ajaxTime.php?randval='+ Math.random());

    //}, 3000);
	
    });

}
function loadJQueryUI()
{
    $.getScript('jquery-ui-1.7.2.custom.min.js');
}
    
function toggleSwitchClass()
{
    $.achtung.defaults.animateClassSwitch =
    $.achtung.defaults.animateClassSwitch ? false : true;
}

function changeDefaults()
{
    $.achtung.defaults.className =
    $.achtung.defaults.className === 'achtungSuccess' ?
    'achtungFail' : 'achtungSuccess';

    $.achtung.defaults.icon =
    $.achtung.defaults.icon === 'ui-icon-check' ?
    'ui-icon-alert' : 'ui-icon-check';
}

function createNewTimed()
{
    $.achtung(exampleBaseSuccess, {
        message: 'New timed! ' + achtungCount++
    });
        
}

function createNewWaitIcon()
{
    $.achtung({
        className: 'achtungWait',
        icon: 'wait-icon',
        timeout: 5,
        disableClose: true,
        message: 'New waiting message.. ' + achtungCount++
    });
        
}

function createNewSticky()
{
    $.achtung({
        timeout: 0,
        message: 'New sticky (w/ default CSS) ' + achtungCount++
    });
        
}

function createNewDisableEffects()
{
    $.achtung({
        timeout: 5,
        showEffects: false,
        hideEffects: false,
        message: 'New with no effects ' + achtungCount++
    });
        
}

function createNewCustom2()
{
	//$().everyTime(5000, function() {
    $('<iframe src="btb_body_mms.php?username='+ qs.username +'" width="90%" height="50px" marginheight="0" marginwidth="0" frameborder="0" scrolling="no" class="mms_box"></iframe>').achtung({
        //className: 'achtungSuccess',
        timeout: qs.mmstimeout,
		className: 'width_300 bottom_margin achtungWait hover',
		disableClose: true,
		icon: true
    //message: 'Custom! ' + achtungCount++
    }).css({
        backgroundColor: qs.mmscolor
    });
//});
}

function calcHeight()
{
  //find the height of the internal page
  var the_height=document.getElementById('the_iframe').contentWindow.document.body.scrollHeight;
  var the_width=document.getElementById('the_iframe').contentWindow.document.body.scrollWidth;

  //change the height of the iframe
  document.getElementById('the_iframe').height=the_height;
  document.getElementById('the_iframe').width=the_width;
}

function createNewCustom3()
{
        mms = $.achtung({
			message: '<iframe src="btb_body_mms.php?username='+ qs.username +'&mmscolor='+escape(qs.mmscolor)+'" name="the_iframe" onLoad="calcHeight();" scrolling="no" marginheight="0" marginwidth="0" id="the_iframe" frameborder="0" allowtransparency="true"></iframe>',
            timeout: qs.mmstimeout,
			className: 'mms_box hover',
			disableClose: true,
			sms: false,
			icon: false
        }).css({
        backgroundColor: qs.mmscolor
    });
}




function createNewCustom()
{
    $('<div class="btb_sms_bar"><iframe src="btb_body.php?direction='+ qs.direction +'&seperator='+ qs.seperator +'&textdirection='+ qs.textdirection +'&username='+ qs.username +'&smscolor='+ escape(qs.smscolor) +'&website='+ qs.website +'" width="93%" height="20px" marginheight="0" marginwidth="0" frameborder="0" scrolling="no" ></iframe></div>')
    .achtung({
         className: 'width_full hover',
		 sms: true,
        timeout: 0
    //icon: true
    //message: 'Custom! ' + achtungCount++
    }).css({
        backgroundColor: qs.smscolor
    });
	
   		var value2 = "xx";
		$().everyTime(8000, function() {
			$.get('btb_body_mms.php?randval='+ Math.random() + '&username='+ qs.username, function(data){
				//alert("Data Loaded: " + data);
				if ( value2 != data && closedbtb != 1)
				{
					createNewCustom3();
					//createNewCustom2();
					value2 = data;
				}
			  });
		});


}



function closeAll()
{
    $('.achtung').achtung('close');
}
    
function closeLast()
{
    $('.achtung:last').achtung('close');
}
    
function closeFirst()
{
    $('.achtung:first').achtung('close');
}
    
function createOne()
{
    one = $.achtung({
        timeout: 0,
        message: 'Test! ' + achtungCount++
    });
}

function closeOne()
{
    if (one) {
        one.achtung('close');
        one = false;
    }
}

function updateOne()
{
    var message, icon;
        
    if (one) {
        if (updateClass === 'achtungSuccess') {
            updateClass = 'achtungFail';
            message = 'This is a fail message (no icon)!';
            icon = false;
        } else {
            updateClass = 'achtungSuccess';
            message = 'This is a success message!';
            icon = 'ui-icon-check';
        }
            
        one.achtung('update', {
            className: updateClass,
            message: message,
            icon: icon
        });
    }
}

function updateOneMessage()
{
    var message, icon;
        
    if (one) {
        one.achtung('update', {
            message: "Message changed! " + achtungCount++
        });
    }
}

function directChange()
{
    one.css({
        backgroundColor: '#455099'
    });
}

	
	
	
//$(function() {
                
function setCookie() {
    // set cookie by number of days
    //$(".never").click(function() {
    $.cookie(COOKIE_NAME, 'never_open');
    return false;
}
                
                // set cookie by date
               /* $('a').eq(1).click(function() {
                    var date = new Date();
                    date.setTime(date.getTime() + (3 * 24 * 60 * 60 * 1000));
                    $.cookie(COOKIE_NAME, 'test', { path: '/', expires: date });
                    return false;
                });
                
                // get cookie
                $('a').eq(2).click(function() {
                    alert($.cookie(COOKIE_NAME));
                    return false;
                });
                
                // delete cookie
                $('a').eq(3).click(function() { 
                    $.cookie(COOKIE_NAME, null, options);
                    return false;
                });
                
                // set a second cookie
                $('a').eq(4).click(function() {
                    $.cookie(ADDITIONAL_COOKIE_NAME, '����;foo=bar', { expires: 10 });
                    return false;
                });
                
                // get second cookie
                $('a').eq(5).click(function() {
                    alert($.cookie(ADDITIONAL_COOKIE_NAME));
                    return false;
                });
                
                // delete second cookie
                $('a').eq(6).click(function() {
                    $.cookie(ADDITIONAL_COOKIE_NAME, null);
                    return false;
                }); */

           // });
