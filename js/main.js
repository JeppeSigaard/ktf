(function($) {
    $.fn.goTo = function() {
        $('html, body').animate({
            scrollTop: $(this).offset().top -50 + 'px'
        }, 600);
        return this; // for chaining...
    }
})(jQuery);

(function($) {
    $.fn.goToFast = function() {
        $('html, body').animate({
            scrollTop: $(this).offset().top -70 + 'px'
        }, 100);
        return this; // for chaining...
    }
})(jQuery);

function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
		var popupLeft = (window.innerWidth / 2) - 350 ;
		
        var mywindow = window.open('', 'my div', 'height=400,width=700,left='+popupLeft+',top=150');
        mywindow.document.write('<html><head><title>Kalender - KLAR TIL FILM</title>');
        mywindow.document.write('<link rel="stylesheet" href="http://klartilfilm.dk/wp-content/themes/klartilfilm/style.css" type="text/css" />');
		mywindow.document.write('<style>#cal-expand,div.img-box{display:none;!importantfont-size:0px!important;width:0px!important;}</style>');
		mywindow.document.write('</head><body>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
		mywindow.print();
        mywindow.close();
        return true;
    }

function placeHeader(){
	
	var wH = $(window).height();
	var wS = $(window).scrollTop();
	
	if(wH <= (wS + 60)){
		if(!$('#header').hasClass('shown')){
			$('#header').addClass('shown');
			}
		}
	else{
		if($('#header').hasClass('shown')){
			$('#header').removeClass('shown');
			$('#top-menu').removeClass('shown');
			}
		}
	}

function isMobile(){
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		return true; 
		}
	else{
		return false;
		}
	}

function marginizeVid(){
	var vidW = $('#video-container').width();
	var winW = $(window).width();
	if(vidW > winW){
		margin = 0 - ((vidW - winW)/2);
		$('#video-container').css({left:margin});
		}
	}
	
function setRollNav(){
	var nH = $('#roll-nav').height();
	var nW = $('#roll-nav').width();
	var wH = $(window).height();
	var wW = $(window).width();
	
	var Mtop = (wH - nH)/2;
	var Mleft = (wW - nW)/2;
	if(Mtop < 10){Mtop = 10}
	$('#roll-nav').css({
	top: Mtop,
	left: Mleft,
	});
	$('#front-page').css({height:wH});
	}
	

/*function loadScript(url) {
	var js = document.createElement('script');
	js.setAttribute('src', url);
	document.getElementsByTagName('head').item(0).appendChild(js);
	}

function embedVideo(video) {
	$('#embed').animate({height:529},200);
	var videoEmbedCode = video.html;
	document.getElementById('embed').innerHTML = unescape(videoEmbedCode);
	$('#filmgalleri > div > article > h1').goToFast();
		}
*/


$(document).ready(function(e) {
    //marginizeVid();
	setRollNav();
	placeHeader();
	
	$('#roll-nav').fadeOut(2);
	
	if(isMobile()){
		$('#video-container').empty().append('<img id="background-video" src="http://klartilfilm.dk/demofilm/jonathan-teaser-480.gif"/>');
		}
	
	$(window).resize(function(){
		//marginizeVid();
		setRollNav();
		placeHeader();
		});
	
	
	/// Ryd iop i kalenderen
	var CCi = 0;	
	$('#cal-full .cal-entry').each(function(){
		CCi ++;
		if(CCi <= 3){
			$(this).remove();
			}
		});
		if($('#cal-full .cal-entry').length = 0){
			$('#cal-expand').remove();
			}
	
	$('#menu-forsidens-menu a').click(function(e){
		e.preventDefault();
		var dest = $(this).attr('href');
		$(dest).goTo();
		});
	
	
		
	$('#cal-expand').click(function(){
		if($(this).hasClass('expanded')){
			$('#cal-full').slideUp(200);
			$(this).html('Vis hele kalenderen');
			$(this).removeClass('expanded');
			}
		else{
			$(this).html('');
			$(this).css('background-image','url(http://www.klartilfilm.dk/wp-content/uploads/2014/03/ajax-loader.gif)');
			setTimeout(function(){
				$('#cal-full').slideDown(200);
				$('#cal-expand').html('Vis 3 kommende begivenheder');
				$('#cal-expand').addClass('expanded');
				$('#cal-expand').css('background-image','none');
			},500);
			}
		});
		
	
	$('.title-box').click(function(){
		if($(this).hasClass('expanded')){
			$(this).parents('.cal-entry').children('.descr-box').slideUp(200);
			$(this).removeClass('expanded');
			}
		else{
			$(this).parents('.cal-entry').children('.descr-box').slideDown(200);
			$(this).addClass('expanded');
			}
		});
	
			
	$('a.u-cont').click(function(e){
		e.preventDefault();
		});
	
	$('#top-menu-expand').click(function(){
		if($('#top-menu').hasClass('shown')){
			$('#top-menu').removeClass('shown');
			}
		else{
			$('#top-menu').addClass('shown');
			}
		});
	
	
	$('#top-menu a[href*="#"]').click(function(e) {
		e.preventDefault();
		if($("#front-page").length > 0){
			$($(this).attr('href')).goTo();
		}
		else{
			var dest = $(this).attr('href');
			window.location = 'klartilfilm.dk'+dest;
			}
		});
		
	$('#top-menu a').click(function(e) {
		$('#top-menu').removeClass('shown');
		});
			
	$('#roll-nav').fadeIn(500);
	setTimeout(function(){$('#menu-forsidens-menu a').each(function(){
		$(this).addClass('translate');
		});},200);
	
	
	
	$('.cal-print').click(function(){
		PrintElem('#kalender article');
		});
	
	$('div.pic-more').click(function(){
		$(this).empty().css({
			'transition':'0s',
			'-webkit-transition':'0s',
			'background-color':'#000',
			'background-image':'url(http://www.klartilfilm.dk/wp-content/uploads/2014/03/ajax-loader.gif)',
			'background-position': 'center',
			'background-repeat': 'no-repeat',
		});
		setTimeout(function(){
			$('div.pic-more').slideUp(100);
			function slideDownSeries(e, duration) {
			$(e).slideDown(duration, 'linear', function () {
				if ($(e).next().length !== 0) {
					if(!$(e).next().hasClass('pic-more')){
					slideDownSeries($(e).next(), duration);
					}
			}});} 
			slideDownSeries($('#billeder .wrap-940 a.hidden:nth-child(9)'), 100);
			
			//$('#billeder a.hidden').slideDown(200).removeClass('hidden');
			
			},400);
		});
		
		
	$('.cal-entry .desc-meta a').each(function(e) {
		$(this).parent('.desc-meta').append('| '+$(this).html()+' ');
		$(this).remove();
    });
		
		
	
	
	
	
	
	
	/* HENT VIDEOER FRA YOUTUBE */
	
	$('#filmgalleri article').css({
		height: 500,
		
		});
	
	var xmlhttpYT;
		if (window.XMLHttpRequest){xmlhttpYT=new XMLHttpRequest();}
		else{xmlhttpYT=new ActiveXObject("Microsoft.XMLHTTP");}
		xmlhttpYT.onreadystatechange=function(){
		if (xmlhttpYT.readyState==4 && xmlhttpYT.status==200)
		{
		
		//retur
		$('#filmgalleri article').append(xmlhttpYT.response).css({
			height: 'auto',
			});
		
		
		
		/* ALT DER HAR MED YOUTUBE AT GØRE */
		
		
		
		// Features
		$('#thumbs a').click(function(e){
			var videoId = $(this).attr('href').replace('https://youtu.be/','');
			if(isMobile()){}
			else{
			e.preventDefault();
			$('#thumbs li').removeClass('hidden');
			$('#embed').hide().removeClass('noshow');
			$('#embed').html('<iframe width="900" height="540" src="http://www.youtube.com/embed/'+videoId+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
			$(this).parents('li').addClass('hidden');
			$('#filmgalleri > div > article > h1').html($(this).children('.video-title').html());
			$('#filmgalleri h1').goTo();
			var desc = $(this).children('span.hidden-desc').html();
			$('#meta-description').html('<h2>'+$(this).children('.video-title').html()+'</h2><p>'+desc+'</p>')
			$('#meta').css({height:0}).removeClass('noshow');
			setTimeout(function(){
				$('#meta').css({height:'auto'});
				if($('#meta-kolofon').height() < $('#meta-description').height()){
					$('#meta-kolofon').css({height:$('#meta-description').height()});	
				}
				else{
					$('#meta-description').css({height:$('#meta-kolofon').height()});	
					}
				$('#embed').slideDown(200);
				},400);
			}
			});
		
		// Playlistefilm
		$('.plist-videos a').click(function(e){
			var videoId = $(this).attr('href').replace('https://youtu.be/','');
			if(isMobile()){}
			else{
			e.preventDefault();
			$('#thumbs li').removeClass('hidden');
			$('#embed').hide().removeClass('noshow');
			$('#embed').html('<iframe width="900" height="540" src="http://www.youtube.com/embed/'+videoId+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
			$(this).parents('li').addClass('hidden');
			$('#filmgalleri > div > article > h1').html($(this).children('.video-title').html());
			$('#filmgalleri h1').goTo();
			var desc = $(this).children('span.hidden-desc').html();
			$('#meta-description').html('<h2>'+$(this).children('.video-title').html()+'</h2><p>'+desc+'</p>')
			$('#meta').css({height:0}).removeClass('noshow');
			setTimeout(function(){
				$('#meta').css({height:'auto'});
				if($('#meta-kolofon').height() < $('#meta-description').height()){
					$('#meta-kolofon').css({height:$('#meta-description').height()});	
				}
				else{
					$('#meta-description').css({height:$('#meta-kolofon').height()});	
					}
				$('#embed').slideDown(200);
				},400);
			}
			});
		
		
		$('#mov-expand').click(function(){
		$(this).hide();
		$('.yt-plists').slideDown(200);
		
		});
		
		
		
		
		
		
		}
		}
		
		xmlhttpYT.open("POST","http://klartilfilm.dk/wp-content/themes/klartilfilm/ajax-youtube.php",true);
		xmlhttpYT.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttpYT.send();
	



/// Ajax hent artikler	
	var xmlhttpART;
		if (window.XMLHttpRequest){xmlhttpART=new XMLHttpRequest();}
		else{xmlhttpART=new ActiveXObject("Microsoft.XMLHTTP");}
		xmlhttpART.onreadystatechange=function(){
			if (xmlhttpART.readyState==4 && xmlhttpART.status==200)
			{
			//retur
			$('#all-news').empty().append(xmlhttpART.response);
			
			$('#more-news').click(function(){
				$(this).html('');
				$(this).css('background-image','url(http://www.klartilfilm.dk/wp-content/uploads/2014/03/ajax-loader.gif)');
				setTimeout(function(){
					$('#hidden-news').slideDown(400);
					$('#more-news').hide();
				},500);
			});
			
			}
		}

	xmlhttpART.open("POST","http://klartilfilm.dk/wp-content/themes/klartilfilm/ajax-feed.php",true);
	xmlhttpART.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttpART.send();

////// Ajax hent billeder
var xmlhttpBILLEDER;
	if (window.XMLHttpRequest){xmlhttpBILLEDER=new XMLHttpRequest();}
	else{xmlhttpBILLEDER=new ActiveXObject("Microsoft.XMLHTTP");}
	xmlhttpBILLEDER.onreadystatechange=function(){
	if (xmlhttpBILLEDER.readyState==4 && xmlhttpBILLEDER.status==200)
	{
	//retur
	$('#billeder-result').html(xmlhttpBILLEDER.response);
	}
	}
	
	xmlhttpBILLEDER.open("POST","http://klartilfilm.dk/wp-content/themes/klartilfilm/ajax-billeder.php",true);
	xmlhttpBILLEDER.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttpBILLEDER.send();



///// AJax hent breaking
	if($('body.home').length > 0){
	var xmlhttp;
	if (window.XMLHttpRequest){xmlhttp=new XMLHttpRequest();}
	else{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		//retur
		$('body').prepend(xmlhttp.response)
		setTimeout(function(){
		$('.breaking-news').css({'display':'block',bottom:-50}).animate({bottom:0},300);
		$('.breaking-news span.exclm').addClass('blinking');
		setTimeout(function(){
			$('.breaking-news span.exclm').removeClass('blinking').addClass('shown');
			setTimeout(function(){
				var length = $('.breaking-news .news-title h3').width() + 40;
				$('.breaking-news .news-title').animate({width:length},400);
				},100);
			},700);
		},100);
		
		$('.breaking-ctrl.breaking-close').click(function(){
				$('.breaking-news').animate({bottom:-50},100);
				setTimeout(function(){
					$('.breaking-news').remove();
					},200);
				});
		
		}
		}
		
	xmlhttp.open("POST","http://klartilfilm.dk/wp-content/themes/klartilfilm/ajax-newsbreaker.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send();
	}

////// AJAX hent undervisere

	var xmlhttpUNDER;
	if (window.XMLHttpRequest){xmlhttpUNDER=new XMLHttpRequest();}
	else{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
	xmlhttpUNDER.onreadystatechange=function(){
	if (xmlhttpUNDER.readyState==4 && xmlhttpUNDER.status==200)
	{
	//retur
	$('#undervisere article').append(xmlhttpUNDER.response);
	
	setTimeout(function(){
	$('#undervisere img').each(function(){
		$(this).removeAttr('width').removeAttr('height');
		var w = $(this).width();
		var h = $(this).height();
		if(w > h){
			$(this).css({'height': '100%', width: 'auto'});
			}
		else{
			$(this).css({'width':'100%', height: 'auto'});
			}
		});
	},100);
	
	}
	}
	
	xmlhttpUNDER.open("POST","http://klartilfilm.dk/wp-content/themes/klartilfilm/ajax-undervisere.php",true);
	xmlhttpUNDER.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttpUNDER.send();





setInterval(function(){
	marginizeVid();
	},10)


}); // END DOCUMENT READY
	
$(window).load(function(){
	
	$('#background-cover').fadeOut(800);
	
	
}); // END WINDOW LOAD
	
$(window).scroll(function(){
	placeHeader();
	});