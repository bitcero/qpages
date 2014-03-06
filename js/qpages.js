$(document).ready(function(){
    
    $("#bulk-top").change(function(){
        $("#bulk-bottom").val($(this).val());
    });
    
    $("#bulk-bottom").change(function(){
        $("#bulk-top").val($(this).val());
    });
    
});

function before_submit(id){

	var types = $("#"+id+" input[name='ids[]']");
	var go = false;

	for(i=0;i<types.length;i++){
		if ($(types[i]).is(":checked"))
			go = true;
	}
	
	if (!go){
		alert(qp_select_message);
		return false;
	}
	
	if ($("#bulk-top").val()=='delete'){
		if (confirm(qp_message))
			$("#"+id).submit();
	} else {
		$("#"+id).submit();
	}
	
}

function select_option(id,action,form){
    
	if(action=='delete'){
		$("#bulk-top").val('delete');
		$("#bulk-bottom").val('delete');
		$("#"+form+" input[type=checkbox]").removeAttr("checked");
		$("#item-"+id).attr("checked","checked");
		if (confirm(qp_message))
			$("#"+form).submit();
	}
	
}

function qpagesInsertImageTiny(img, titulo, width, height, desc, href){
    var str = '';

    if (href!='')
        str += '<a href="' + href + '" target="_blank">';    
        
    str += '<img src="' + img + '" alt="' + titulo + '" title="' + titulo + '" width="'+width+'" height="'+height+'"';
    if (desc!='')
        str += ' longdesc="' + desc + '"';
        
    str += ' />';
    
    if (href!='')
        str += '</a>';
    
    tinyMCE.execCommand("mceInsertContent", false, str);
}

function qpagesInsertImage(img, titulo, width, height, desc, href){
    var campo = xoopsGetElementById('texto');
    var  str = '';
    if (href!='')
        str += '<a href="' + href + '">';    
        
    str += '<img src="' + img + '" alt="' + titulo + '" title="' + titulo + '" width="'+width+'" height="'+height+'"';
    if (desc!='')
        str += ' longdesc="' + desc + '"';
        
    str += ' />';
    
    if (href!='')
        str += '</a>';
    xoopsInsertText(campo, str);    
}