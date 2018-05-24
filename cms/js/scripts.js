var documentClicked = false;
$(document).on('touchstart', function(){
	documentClicked = true;
});

$(document).on('touchmove', function(){
	documentClicked = false;
});
$(document).ready(function()
{
	/*************************************************************************************/
	$('.gallery_open_link').click(function(){
		var url = ((typeof $(this).attr('rel') !== typeof undefined) && ($(this).attr('rel') !== false)) ? $(this).attr('rel') : '';
		var thumb = ((typeof $(this).attr('thumb') !== typeof undefined) && ($(this).attr('thumb') !== false)) ? $(this).attr('thumb') : '';
		var alt = ((typeof $(this).attr('alt') !== typeof undefined) && ($(this).attr('alt') !== false)) ? $(this).attr('alt') : '';
		if(url != '')
		{
			gallery[0] = {
					url:url,
					thumb:thumb,
					alt:alt
					};
		}
		if(Object.keys(gallery).length > 0)
		{
			$('body').append('<div id="gallery">'+
						'<div id="gallery_frame">'+
							'<a id="gallery_left"></a>'+
							'<a id="gallery_right"></a>'+
							'<a id="gallery_close" onclick="$('+"'#gallery'"+').remove();"></a>'+
						'</div>'+
					'</div>');
			start_gallery(0);
		}			
	});
	$(window).keydown(function( event )
	{
		if((event.which == 37) && ($('#gallery').is(':visible')) && ($('#gallery #gallery_left').is(':visible')))//LEFT
		{
			$('#gallery_left').click();
			event.preventDefault();			
		}	
		if((event.which == 39) && ($('#gallery').is(':visible')) && ($('#gallery #gallery_right').is(':visible')))//RIGHT
		{
			$('#gallery_right').click();
			event.preventDefault();			
		}	
		if((event.which == 27) && ($('#gallery').is(':visible')) && ($('#gallery #gallery_close').is(':visible')))//CLOSE
		{
			$('#gallery_close').click();
			event.preventDefault();			
		}	
	});
	/*************************************************************************************/
	$('.video_open_link').click(function(){
		var video_id = $(this).attr('rel');
		var video_title = $(this).attr('alt');
		
		if(video_id != "")
		{
			if(video_title != "")
			{
				video_title = '<div id="gallery_title">'+video_title+'</div>';
			}
			$('body').append('<div id="gallery">'+
						'<div id="gallery_frame">'+
							'<a id="gallery_close" onclick="$('+"'#gallery'"+').remove();"></a>'+
							'<iframe id="video_iframe" src="//www.youtube.com/embed/'+video_id+'?rel=0" frameborder="0" allowfullscreen></iframe>'+
							video_title+
						'</div>'+
					'</div>');
			$('#gallery').show();
			optimize_stock_elements();
		}
	});
	/*************************************************************************************/
	$('.statlikecoms').each(function(){
		if($(this)[0].hasAttribute('rel'))
		{
			get_statlikecoms($(this).attr('rel'),lang);
		}
	});
	$('.statlikecoms .like').click(function(){
		var meta_id = $(this).parent('.statlikecoms').attr('rel');
		get_statlikecoms(meta_id,lang,1);
	});
	/*************************************************************************************/
	optimize_stock_elements();
});
var thumbs_on = false;
var thumbs_proc = 100;
function start_gallery(id)
{
	id = Number(id);
	var thumb_count = Object.keys(gallery).length;
	$('#gallery_image').removeClass('visible');
	$('#gallery_thumbs').removeClass('visible');
	
	$("#gallery").unbind();		
	$('#gallery_image').remove();
	$('#gallery_desc').remove();//old
	$('#gallery_desc_top').remove();
	$('#gallery_desc_bottom').remove();
	$('#gallery_index').remove();
	$('#gallery_thumbs').remove();
	$('#gallery_frame').css('margin-top','');
	$('#gallery_frame').css('margin-left','');
	
	$('<img/>').attr('src', gallery[id]["url"]).load(function()
	{		
		$(this).remove();
		
		var gfc = '';//gallery_frame_content
		
		//gallery_desc_top
		if(gallery[id].top_name || gallery[id].top_teaser)
		{
			gfc = gfc + '<div id="gallery_desc_top">';
			gfc = gfc + ((gallery[id].top_name)	? ('<h1>'+gallery[id].top_name+'</h1>') : '');
			gfc = gfc + ((gallery[id].top_teaser)	? ('<div class="content">'+gallery[id].top_teaser+'</div>') : '');
			gfc = gfc + '</div>';
		}
		
		//image
		gfc = gfc + '<img id="gallery_image" src="' + gallery[id]["url"] + '" alt="' + gallery[id]["alt"] + '" />';
		
		//old
		if(gallery[id].name || gallery[id].teaser)
		{
			gfc = gfc + '<div id="gallery_desc">'+
					((gallery[id].name)	? ('<h1>' + gallery[id].name + '</h1>') : '') +
					((gallery[id].teaser)	? ('<div class="content">' + gallery[id].teaser + '</div>') : '') +
				'</div>';
		}
			
		//gallery_desc_bottom
		if(gallery[id].bottom_name || gallery[id].bottom_teaser)
		{
			gfc = gfc + '<div id="gallery_desc_bottom">';
			gfc = gfc + ((gallery[id].bottom_name)		? ('<h1>'+gallery[id].bottom_name+'</h1>') : '');
			gfc = gfc + ((gallery[id].bottom_teaser)	? ('<div class="content">'+gallery[id].bottom_teaser+'</div>') : '');
			gfc = gfc + '</div>';
		}	
		
		//gallery_index
		if(gallery[id].index)
		{
			gfc = gfc + '<div id="gallery_index">' +
					//gallery[id].index + '/' + thumb_count +
					gallery[id].index.replace("index", (id+1)).replace("all", thumb_count) +
				'</div>';
		}
		$('#gallery_frame').append(gfc);
		
		var thumbs_html = '';
		if(thumbs_on)
		{
			thumbs_html = '<div id="gallery_thumbs" style="padding-top:'+(thumbs_proc/((thumb_count>7)?thumb_count:8))+'%;"><div id="gallery_thumbs_div">';
			for(x in gallery)
			{
				thumbs_html = 
					thumbs_html + 
					'<div class="gallery_thumb_div" style="width:'+(100/thumb_count)+'%">'+
						'<div class="gallery_thumb '+((x==id)?'active':'')+'" style="background-image:url('+"'"+gallery[x]["thumb"]+"'"+');" onclick="start_gallery('+x+');"></div>'+
					'</div>';
			}
			thumbs_html = thumbs_html + '</div></div>';
			$('#gallery_frame').append(thumbs_html);
		}
		if(id > 0)
		{
			$('#gallery_left').unbind();
			$('#gallery_left').click(function(){
				start_gallery(id-1);
			});
			$('#gallery_left').show();
		} else $('#gallery_left').hide();
		if((id+1) < Object.keys(gallery).length)
		{
			$('#gallery_right').unbind();
			$('#gallery_right').click(function(){
				start_gallery(id+1);
			});
			$('#gallery_right').show();
		} else $('#gallery_right').hide();
		$('#gallery').show();
		$('#gallery_image').addClass('visible');
		$('#gallery_thumbs').addClass('visible');
		$("#gallery").on("click",function(e)
		{
			var el = $(e.target);
			if(el.attr('id')=="gallery")
			{
				$('#gallery').remove();
			}		
		});
		$("#gallery_frame").on("click",function(e)
		{
			var el = $(e.target);
			if(el.attr('id')=="gallery_frame")
			{
				$('#gallery').remove();
			}		
		});
		optimize_elements();
	});
}
function optimize_stock_elements()
{
	$('#gallery_desc').css('max-width','none');
	$('#gallery_desc_top').css('max-width','none');
	$('#gallery_desc_bottom').css('max-width','none');
	$('#gallery_image').css('max-width','none');
	$('#video_iframe').css('max-width','none');
	$('#gallery_image').css('max-height','none');
	$('#video_iframe').css('max-height','none');
	
	var win_scroll_top = $(window).scrollTop();
	var win_scroll_left = $(window).scrollLeft();
	var win_width = $(document).width();
	var win_height = $(window).height();
	
	//Gallery	
	var gallery_image_mw = $('#gallery').outerWidth(true) - ($('#gallery_frame').outerWidth() - $('#gallery_frame').width());
	gallery_image_mw = (gallery_image_mw < parseInt($('#gallery_image').css('min-width'),10)) ?  parseInt($('#gallery_image').css('min-width'),10) : gallery_image_mw;
	$('#gallery_image').css('max-width',gallery_image_mw+'px');
	$('#video_iframe').css('max-width',gallery_image_mw+'px');
	
	$('#gallery_desc').css('max-width',$('#gallery_image').outerWidth()+'px');
	$('#gallery_desc_top').css('max-width',$('#gallery_image').outerWidth()+'px');
	$('#gallery_desc_bottom').css('max-width',$('#gallery_image').outerWidth()+'px');
	
	var gallery_image_mh =
				$('#gallery').outerHeight(true)
				-
				(
					$('#gallery_frame').outerHeight() - $('#gallery_frame').height()
				)
				- 
				$('#gallery_desc').outerHeight(true)
				- 
				$('#gallery_desc_top').outerHeight(true)
				- 
				$('#gallery_desc_bottom').outerHeight(true)
				- 
				$('#gallery_index').outerHeight(true)
				-
				$('#gallery_thumbs').outerHeight(true);			
				
	gallery_image_mh = (gallery_image_mh < parseInt($('#gallery_image').css('min-height'),10)) ?  parseInt($('#gallery_image').css('min-height'),10) : gallery_image_mh;
	$('#gallery_image').css('max-height',gallery_image_mh+'px');
	$('#video_iframe').css('max-height',gallery_image_mh+'px');
	
	$('#gallery_frame').css('margin-top',($('#gallery_frame').outerHeight()/-2)+'px');
	$('#gallery_frame').css('margin-left',($('#gallery_frame').outerWidth()/-2)+'px');
}

function unlink_profile(user_id,linked_user,callback)
{
	$.ajax({
		type: "POST",
		url: "/cms/libs/00.php",
		data:
		{
			action:		"unlink_profile",
			user_id:	user_id,
			linked_user:	linked_user
		},
		async: true,
		success: function(data)
			{
				if (callback && typeof(callback) === "function")
				{
					callback(data);
				}
				else
				{
					window.location.reload();
				}
			}
		});
}
function reset_password(action,data,callback)
{
	$.ajax({
		type: "POST",
		url: "/cms/libs/00.php",
		data:
		{
			action:		action,
			data:		data
		},
		dataType: 'json',
		cache: false,
		async: true,
		success: function(data)
			{
				if (callback && typeof(callback) === "function")
				{
					callback(data);
				}
			}
		});
}

function to_number(number, decimal_places, th_sep)
{
	decimal_places = ((typeof decimal_places !== typeof undefined) && (decimal_places !== false)) ? Number(decimal_places) : 2;
	th_sep = ((typeof th_sep !== typeof undefined) && (th_sep !== false)) ? th_sep : "";
	var n1 = String(String(Number(number)).split('.')[0]);
	var n2 = String(String(Number(number)).split('.')[1]);
	
	var number_length = n1.length;
	var new_number = '';
	var ind = 0;
	for(var i=number_length;i>0;i--)
	{
		new_number = String(n1.substring((i-1), i)) + ( ( ind && !(ind%3))?th_sep:'') + String(new_number);
		ind++;
	}
	return new_number + ((decimal_places>0)?'.':'') + String(n2 + Array(decimal_places+1).join("0")).slice(0,decimal_places);
}
function set_like(meta_id)
{
	if(meta_id>0)
	{
		$.ajax({
			type: "POST",
			url: "/libs/set_like.php",
			data:
			{
				id:	meta_id
			},
			async: true,
			success: function(data)
				{
					if (data == "ok")
					{
						get_stats(meta_id,lang);
					}
				}
			});
	}
}
function reload_feedbacks(url,id)
{
	$.ajax({
		type: "POST",
		url: "/libs/ses.php",
		data: "variable=feedback_category&feedback_category="+id,
		async: true,
		success: function(data)
			{
				if (data == "ok")
				{
					window.location = url;
				}
			}
		});
	
}

function send_question(id, lang)
{
	var mail = check_field(document.getElementById(id+'_email'),2);
	var question = $('#'+id+'_text').val();
	
	$('#'+id+'_email_error').html("");
	$('#'+id+'_text_error').html("");
	$('#'+id+'_error').html("");
	$.ajax({
		type: "POST",
		url: "/cms/libs/send_question.php",
		data: {
			mail:mail,
			question:question,
			lang:lang
			},
		async: true,
		success: function(data)
			{
				switch (data)
				{
					case "ok":
						switch (id)
						{
							case "question":
								$("#"+id+" .send_question").html("<h4>"+lg.paldies_par_jautajumu+"</h4>");
								break;
							case "error_report":
								$("#error_report .content").html("<h4>"+lg.paldies_par_kludas_zinojumu+"</h4>");
								break;
						}
						break;
					case "mail":
						$('#'+id+'_email_error').html(lg.nav_epasta);
						break;
					case "question":
						$('#'+id+'_text_error').html(lg.nav_jautajuma);
						break;
					default:
						$('#'+id+'_error').html(lg.nezinama_kluda+'<br />'+data);
						break;
				}
			}
		});
}
function add_feedback(user_id,text,post_id,callback)
{
	var teaser = '';
	if($('#feedback_teaser')[0])
	{
		teaser = $('#feedback_teaser').val();
	}
	
	if(text)
	{
		$('#feedback').css('background-color','');
		$.ajax({
			type: "POST",
			url: "/cms/libs/add_feedback.php",
			data:
			{
				user_id:	user_id,
				text:		text,
				post_id:	post_id,
				lang:		lang
			},
			async: true,
			success: function(data)
				{
					if(data=="OK")
					{
						if (callback && typeof(callback) === "function")
						{
							callback();
						}
						else
						{
							window.location.reload();
						}
					}
				}
			});
	}
	else
	{
		$('#feedback').css('background-color','pink');
	}
}
function set_session(variable,value)
{
	$.ajax({
		type: "POST",
		url: "/cms/libs/ses.php",
		data: {
			variable:variable,
			value:value
		},
		async: true,
		success: function(data)
			{
				if (data == "ok")
				{
					window.location.reload();
				}
			}
		});
	
}
var liked = Array();
function get_stats(id,lang)//OLD
{
	$.ajax({
		type: "POST",
		url: "/libs"+test_site+"/get_stats.php",
		data: "id="+id+"&lang="+lang,
		async: true,
		success: function(data)
			{
				var stat_arr = data.split('##@@##');
				var x;
				liked[id] = false;
				for(x in stat_arr)
				{
					var y = stat_arr[x].split('--##--');
					if(y[0]=="liked")
					{
						liked[id] = true;
					}
					else
						$("."+y[0]).html(y[1]);
				}
				if(liked[id])
					$('.like_'+id).addClass('liked');
				else
					$('.like_'+id).removeClass('liked');
			}
		});
}
function get_statlikecoms(id,lang,like)//NEW
{
	if (typeof like === 'undefined') like = 0;
	$.ajax({
		type: "POST",
		url: "/cms/libs/get_statlikecoms.php",
		data: {
			id:	id,
			lang:	lang,
			like:	like
		},
		async: true,
		success: function(data)
			{
				var statlikecoms_arr = data.split('##@@##');
				var x;
				liked[id] = false;
				for(x in statlikecoms_arr)
				{
					var y = statlikecoms_arr[x].split('--##--');
					switch(y[0])
					{
						case "stat":
						case "like":
						case "coms":
							$('.statlikecoms[rel="'+id+'"] .'+y[0]+' span').html(y[1]);
							break;
						case "liked":
							if(y[1]=='')
								$('.statlikecoms[rel="'+id+'"] .like').removeClass('liked');
							else
								$('.statlikecoms[rel="'+id+'"] .like').addClass('liked');
							break;
						default:
							if(y[0]!='')
							$('.'+y[0]).html(y[1]);
					}
				}
			}
		});
}
function add_comment(user_id,text,post_id,lang,callback)
{
	if(text)
	{
		$('#comment').css('background-color','');
		$.ajax({
			type: "POST",
			url: "/cms/libs/add_comment.php",
			data:
			{
				user_id:	user_id,
				text:		text,
				post_id:	post_id
			},
			async: true,
			success: function(data)
				{
					if(data=="OK")
					{
						if (callback && typeof(callback) === "function")
						{
							callback();
						}
						get_statlikecoms(post_id,lang);
						$('#comment').val('');
					}
				}
			});
	}
	else
	{
		$('#comment').css('background-color','pink');
	}
}
function send_form_data(sender_name,sender_email,data,callback)
{
	var domain = (typeof origin_domain === 'undefined') ? '' : origin_domain;
	
	var subject = '';
	if("subject" in data)
	{
		subject = data["subject"];
		delete data["subject"];
	}
	var type = '';
	if("type" in data)
	{
		type = data["type"];
		delete data["type"];
	}
	$.ajax({
		type: "POST",
		url: domain + "/cms/libs/send_form_data.php",
		crossDomain: true,
		data:
		{
			sender_name:	sender_name,
			sender_email:	sender_email,
			subject:	subject,
			type:		type,
			data:		data
		},
		async: true,
		success: function(data)
			{
				if (callback && typeof(callback) === "function")
				{
					callback(data);
				}
			}
		});
}
function subscribe(sender_name,sender_email,data,callback)
{
	$.ajax({
		type: "POST",
		url: "/cms/libs/subscribe.php",
		data:
		{
			sender_name:	sender_name,
			sender_email:	sender_email,
			data:		data
		},
		async: true,
		success: function(data)
			{
				if (callback && typeof(callback) === "function")
				{
					callback(data);
				}
			}
		});
}
function send_template_data(reciever_name,reciever_email,data,template,callback)
{
	$.ajax({
		type: "POST",
		url: "/cms/libs/send_template_data.php",
		data:
		{
			reciever_name:	reciever_name,
			reciever_email:	reciever_email,
			template:	template,
			lang:		lang,
			data:		data
		},
		async: true,
		success: function(response)
			{
				if (callback && typeof(callback) === "function")
				{
					callback(response);
				}
			}
		});
}
function two_digits(digit,side)
{
	side = ((typeof side !== typeof undefined) && (side !== false)) ? side : "l";
	var str = digit;
	switch(side)
	{
		case "r":
			str = String(digit + '00').substring(0, 2);
			break;
		default:
			str = String('00' + digit).slice(-2);
	}
	return str;
}

jQuery.fn.mClick = function(e) {
	
	if(e && typeof(e) === "function")
	{
		var tas = this;
		
		if(
			!window.MSStream
			&&
			("userAgent" in navigator)
			&&
			/iPad|iPhone|iPod/.test(navigator.userAgent)
			&&
			("platform" in navigator)
			&&
			/iPad|iPhone|iPod/.test(navigator.platform)
		)
		{
			tas.on('touchend', function(event){
					//nočeko, vai nebīda pirkstu pa ekrānu..
					if(documentClicked)
					{
						e.apply(this, arguments);
					}					
				});
		}
		else
		{
			tas.click(e);
		}
		return this;
	}
};

function check_field(e,type)
{
	$(e).removeClass('redborder');
	$(e).parent('.input_box').removeClass('redborder');
	var allowed_ch = new Array();
	var field_error = new Array();
	
	allowed_ch[1] =	"+0123456789"; //phone
	allowed_ch[2] =	"ABCDEFGHIJKLMNOPQRSTUVWXYZ"+
			"abcdefghijklmnopqrstuvwxyz"+
			"0123456789"+
			"!#$%&'*+-/=?^_`{|}~"+
			"."+
			'"(),:;<>@[\]'; //mail
	allowed_ch[3] =	"ALL"; //text
	field_error[1] = ((typeof lg !== 'undefined') && ("ievadiet_telefona_numuru" in lg)) ? lg["ievadiet_telefona_numuru"] : 'lg[ievadiet_telefona_numuru]'; //phone
	field_error[2] = ((typeof lg !== 'undefined') && ("ludzu_parbaudiet_epasta_adresi" in lg)) ? lg["ludzu_parbaudiet_epasta_adresi"] : 'lg[ludzu_parbaudiet_epasta_adresi]'; //mail
	field_error[3] = ((typeof lg !== 'undefined') && ("ludzu_aizpildiet_obligato_laucinu" in lg)) ? lg["ludzu_aizpildiet_obligato_laucinu"] : 'lg[ludzu_aizpildiet_obligato_laucinu]'; //text
	
	var result = '';
	
	if(e.value != "")
	{
		if(type <3)
		{
			for(i=0;i<e.value.length;i++)
			{
				if(allowed_ch[type].indexOf(e.value.substr(i,1)) != -1)
				{
				  result = result + "" + e.value.substr(i,1);
				}
			}
		}
	}
	switch(type)
	{
		case 1:
			if(result.length < 8 )
			{
				result = '';
			}
			break;
		case 2:
			if( /(.+)@(.+){2,}\.(.+){2,}/.test(result) )
			{
			   //alert("valid email");
			} 
			else 
			{
				result = '';
			}
			break;
		case 3:
			result = e.value;
			if($(e).is('select'))
			{
				result = $('option:selected',$(e)).text();
			}
			break;
	}
	if((result == '')||(result == 0))
	{
		$(e).parent('.input_box').addClass('redborder');
		$(e).addClass('redborder');
		$(".error",$(e).parent()).html(field_error[type]);
	}
	//e.value = result;
	return result;
}
