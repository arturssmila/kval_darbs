var open_tree = 0;
var end_tree = 0;
var can_edit = true;
$(document).ready(function()
{
	if($('#tree')[0])
		trees();
	$("#tree_lock").click(function(){
		check_tree_lock();
	});
});
jQuery(window).bind("load", function()
{
	
});
function trees()
{
	tree(0);
	tree(-1);
	tree(-3);
	tree(-4);
	tree(-100);//Atribūti
}
function check_tree_lock()
{
	if($("#tree_lock").is(':checked'))
	{
		set_tree_lock(1);
		$("#tree").css('height',($(window).height() - $("#header").outerHeight() - 40)+'px');
		$("#tree").css('overflow-y','scroll');
	}
	else
	{
		set_tree_lock(0);
		$("#tree").css('height','auto');
		$("#tree").css('overflow-y','auto');
	}
}

function tree(id)
{	//alert(domain);
	open_tree++;
	$.ajax({
		type: "POST",
		url: "/admin/treee.php",
		data: {
			id:id,
			mode:mode,
			edit_id:edit_ind
		},
		async: false,
		success: function(rr)
			{
				//alert(rr);
				$('#img_'+id).attr('src','/cms/css/images/minus.png');
				$('#img_'+id).attr('onclick',"javascript:collapse("+id+");")
				$("#child_"+id).html(rr);
				end_tree++;
				if(id>0)
				{
					$("#child_"+id).slideDown(500);
				}
				else
				{
					$("#child_"+id).show();
				}
				imagePreview();
				check_tree_lock();
				if((open_tree == end_tree) && (edit_ind > 0))
				{
					if(can_edit)
					{
						can_edit = false;
						if(typeof window['edit_'+mode] == 'function')
						{ 
							var edit_plus = window['edit_'+mode];
							edit_plus('',edit_ind);
						}
						else
						{
							edit('',edit_ind);
						}
					}
					$('#tree').animate({
							scrollTop: (($("#link_"+edit_ind)[0] ? ($("#link_"+edit_ind).offset().top - $('#header').outerHeight()) : 0) - 40)
					}, 1000);
				}
			}
	});
}
function collapse(id)
{
	$.ajax({
		type: "POST",
		url: "/admin/collapse.php",
		data: "id="+id,
		async: true,
		success: function(rr)
			{
				//alert(rr);
				$("#child_"+id).slideUp(500,function(){
					$('#child_'+id).html('');
					$('#img_'+id).attr('src','/cms/css/images/plus.png');
					$('#img_'+id).attr('onclick',"javascript:tree("+id+");");
				});
				
			}
		});
}
function edit(cat,id)
{
	//console.log(cat + ' / ' + id);
	$.ajax({
		type: "POST",
		url: "/admin/edit.php",
		data: {
			id:id,
			cat:cat
			},
		async: false,
		success: function(rr)
			{
				//alert(rr);
				$('.tree_link:not(#link_'+id+')').removeClass('red');
				$("#content").html(rr);
			},
		error: function(xhr, status, error)
			{
				$("#content").html(error);
			}
		});
		
}
var add_remove_field_int = {};
function add_remove_field(template_id,field_id,checked)
{
	if(field_id > 0)
	{
		$('#fields_'+template_id+' .success').hide();
		$('#fields_'+template_id+' .error').hide();
		$.ajax({
			type: "POST",
			url: "/admin/add_remove_field.php",
			data: {
				template_id:template_id,
				field_id:field_id,
				checked:(checked?1:0)
			},
			async: true,
			success: function(rr)
				{
					var data = rr.split('#');
					if(data[0]=="success")
					{
						$('#fields_'+template_id+' .success').html(data[1]);
						$('#fields_'+template_id+' .success').slideDown(500);
						window.clearTimeout(add_remove_field_int);
						add_remove_field_int = setTimeout(function() {
							$('#fields_'+template_id+' .success').slideUp(500);
						}, 2000);
					}
					else
					{
						$('#fields_'+template_id+' .error').html(rr);
						$('#fields_'+template_id+' .error').slideDown(500);
						window.clearTimeout(add_remove_field_int);
						add_remove_field_int = setTimeout(function() {
							$('#fields_'+template_id+' .error').slideUp(500);
						}, 2000);
					}
				},
			error: function(xhr, status, error)
				{
					$('#fields_'+template_id+' .error').html(error);
					$('#fields_'+template_id+' .error').slideDown(500);
					window.clearTimeout(add_remove_field_int);
					add_remove_field_int = setTimeout(function() {
						$('#fields_'+template_id+' .error').slideUp(500);
					}, 2000);
				}
			});
	}
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
function got_error(el,error_message)
{
	
	el.removeClass('waiting');
	el.removeClass('success');
	el.addClass('error');
	el.html(error_message);
	el.show();
}

function install(step)
{
	switch(step)
	{
		case 1:
			db_host = $('#db_host').val();
			db_user = $('#db_user').val();
			db_password = $('#db_password').val();
			db_database = $('#db_database').val();
			db_prefix = $('#db_prefix').val();
			
			cms_mail = $('#cms_mail').val();
			cms_password = $('#cms_password').val();
			
			img_width = $('#img_width').val();
			img_height = $('#img_height').val();
			img_small_width = $('#img_small_width').val();
			img_small_height = $('#img_small_height').val();
			img_thumb_width = $('#img_thumb_width').val();
			img_thumb_height = $('#img_thumb_height').val();
			
			if((db_host=="") || (db_user=="") || (db_password=="") || (db_database=="") || (cms_mail=="") || (cms_password==""))
			{
				got_error($('#start_install .info'),"Please, fill required fields!");
				return false;
			}
			$('#start_install .info').html('Downloading install package..');
			break;
		case 2:
			$('#start_install .info').html('Creating settings file..');
			break;
		case 3:
			$('#start_install .info').html('Extracting files..');
			break;
		case 4:
			$('#start_install .info').html('Writing database..');
			break;
		case 5:
			$('#start_install .info').html('Deleting files used for installing..');
			break;
	}
	
	$('#start_install .info').addClass('waiting');
	$('#start_install .info').show();
	$('#start_install .work').hide();
	
	$.ajax({
		type: "POST",
		url: "/install.php",
		data: {
				step:step,
				db_host:db_host,
				db_user:db_user,
				db_password:db_password,
				db_database:db_database,
				db_prefix:db_prefix,
				cms_mail:cms_mail,
				cms_password:cms_password,
				img_width:img_width,
				img_height:img_height,		
				img_small_width:img_small_width,	
				img_small_height:img_small_height,
				img_thumb_width:img_thumb_width,	
				img_thumb_height:img_thumb_height
			},
		async: true,
		success: function(result)
			{
				if(result=="OK")
				{
					instal_success($('#start_install .info'),step);					
				}
				else
				{
					$('#start_install .work').show();
					got_error($('#start_install .info'),result);										
				}				
			},
		error: function(xhr, status, error)
			{
				got_error($('#start_install .info'),error);
			}
		});
}
function instal_success(el,step)
{
	el.removeClass('error');
	el.removeClass('waiting');
	el.addClass('success');
	switch(step)
	{
	case 1:
		el.html('Install package downloaded!');
		setTimeout(function(){ install(2); }, 2000);
		break;
	case 2:
		el.html('Settings file created!');
		setTimeout(function(){ install(3); }, 2000);
		break;
	case 3:
		el.html('All files extracted!');
		setTimeout(function(){ install(4); }, 2000);
		break;
	case 4:
		el.html('Database created!');
		setTimeout(function(){ install(5); }, 2000);
		break;
	case 5:
		//redirekts
		el.html('Files deleted!');
		setTimeout(function(){ window.location = '/admin/updates/'; }, 2000);
		break;
	}
		
}
function usersip_like(like,page,order)
{
	//alert();
	$.ajax({
		type: "POST",
		url: "/admin/usersip_like.php",
		data: "like="+like+"&page="+page+"&order="+order,
		async: true,
		success: function(rr)
			{
				$("tr .users_like").remove();
				$("tr .users_like_pages").remove();
				$('#users_like > tbody').append(rr);
			}
		});
}
function usersres_like(like,page,order)
{
	//alert();
	$.ajax({
		type: "POST",
		url: "/admin/usersres_like.php",
		data: "like="+like+"&page="+page+"&order="+order,
		async: true,
		success: function(rr)
			{
				$("tr .users_like").remove();
				$("tr .users_like_pages").remove();
				$('#users_like > tbody').append(rr);
			}
		});
}

function actions_like(like,page)
{
	$.ajax({
		type: "POST",
		url: "/admin/actions_like.php",
		data: "like="+like+"&page="+page,
		async: true,
		success: function(rr)
			{
				$("tr .actions_like").remove();
				$("tr .actions_like_pages").remove();
				$('#actions_like > tbody').append(rr);
			}
		});
}
function delete_fade_image(image,tr)
{
	$.ajax({
			type: "POST",
			url: "/admin/delete_fade_image.php",
			data: "image="+image,
			async: true,
			success: function(data)
				{
					if(data=="OK")
					{
						$("#tr_"+tr).remove();
					}
					else 
					{
						$("#tr_"+tr+" td").append(data);
					}
				}
			});
}
function change_rules()
{
	ind = 0;
	html = '';
	aliases = new Array();
	$('.rules_checkboxes').each(function()
		{
			if(this.checked)
			{
				aliases = aliases + ((ind) ? ',' : '')+$(this).val();
				span_id = $(this).val();
				html = html + 
					'<input type="checkbox" checked style="width:20px;" onclick="$('+"'#rules_checkbox_"+span_id+"'"+').click();" />'+
					'<span title="'+$('#checkbox_span_'+span_id).attr('title')+'">'+$('#checkbox_span_'+span_id).text()+'</span>';
				
				ind++;
			}
		});
	//alert(aliases);
	$('#rules').val(aliases);
	$('#checkboxes_for_rules').html(html);
}
function set_tree_lock(val)
{
	//add to session user type
	$.ajax({
		type: "POST",
		url: "/cms/libs/ses.php",
		data: "variable=tree_lock&tree_lock="+val,
		async: true,
		success: function(data)
			{
				if (data == "ok")
				{
					//window.location.reload();
				}
			}
		});
}
function set_activity_data_date(from,to,meta_id,rev = 0)
{
	rev = rev || 0;
	//add to session user type
	$.ajax({
		type: "POST",
		url: "/cms/libs/ses.php",
		data: {
			variable:"activity_data_date",
			from:from,
			to:to,
			meta_id:meta_id
			},
		async: true,
		success: function(data)
			{
				if(data == "ok")
				{
					if(rev)
					{
						var link = '/admin/activity_data#rev_'+rev;
						window.open(link,'_blank');
					}
					else
					{
						window.location.hash = '';
						window.location.reload();
					}
				}
			}
		});
}
function set_header_fade_lang(lang)
{
	//add to session user type
	$.ajax({
		type: "POST",
		url: "/cms/libs/ses.php",
		data: "variable=header_fade_lang&lang="+lang,
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
function set_sign_data_last(val)
{
	//add to session user type
	$.ajax({
		type: "POST",
		url: "/cms/libs/ses.php",
		data: "variable=sign_data_last&val="+val,
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
function set_sign_data_first(val)
{
	//add to session user type
	$.ajax({
		type: "POST",
		url: "/cms/libs/ses.php",
		data: "variable=sign_data_first&val="+val,
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
function set_sign_data_both(val)
{
	//add to session user type
	$.ajax({
		type: "POST",
		url: "/cms/libs/ses.php",
		data: "variable=sign_data_both&val="+val,
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

function tt_order(order)
{
	//add to session tt_order
	$.ajax({
		type: "POST",
		url: "/cms/libs/ses.php",
		data: "variable=tt_order&order="+order,
		async: true,
		success: function(data)
			{
				if (data == "ok")
				{
					window.location.reload();
					//tree(-3);
				}
			}
		});
}

function set_task_list_lang(lang)
{
	$.ajax({
		type: "POST",
		url: "/cms/libs/ses.php",
		data: "variable=set_task_list_lang&lang="+lang,
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
function set_task_list_cat(cat)
{
	$.ajax({
		type: "POST",
		url: "/cms/libs/ses.php",
		data: "variable=set_task_list_cat&cat="+cat,
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
function img_edit(id,file,mode)
{
	$('#img_name'+id).html('<input type="text" value="'+file+'" onkeydown="if(event.keyCode == 13) { eenter=true; img_save('+id+','+"'"+file+"'"+','+"'"+mode+"'"+'); return false; }" />');
	$('#img_edit'+id).attr('src','/cms/css/images/is.png');
	$('#img_edit'+id).attr('title','Saglabāt');
	$('#img_edit'+id).attr('onclick','img_save('+id+','+"'"+file+"'"+','+"'"+mode+"'"+')');
}
function img_save(id,file,mode)
{
	new_file = $('#img_name'+id+' input').val();
	$.ajax({
		type: "POST",
		url: "/cms/libs/ses.php",
		data: "variable=image_rename&file="+file+"&new_file="+new_file+"&mode="+mode,
		async: true,
		success: function(data)
			{
				if (data == "OK")
				{
					$('#img_name'+id).html(new_file);
					$('#img_edit'+id).attr('src','/cms/css/images/edit_hover.png');
					$('#img_edit'+id).attr('title','Labot faila nosaukumu');
					$('#img_edit'+id).attr('onclick','img_edit('+id+','+"'"+new_file+"'"+','+"'"+mode+"'"+')'); 
				}
				else 
				{
					alert(data);
					return false;
				}
			}
		});
	eenter=false;
}
function sign_data_delete(id)
{
	$.ajax({
		type: "POST",
		url: "/admin/sign_data_delete.php",
		data: "id="+id,
		async: true,
		success: function(data)
			{
				//alert(data);
				if (data == "ok")
				{
					$('.sign_data_row'+id).remove();
					//window.location.reload();
				}
			}
		});
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