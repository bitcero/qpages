$(document).ready(function(){
	
	$("a#add-field-name").click(function(){
		if ($(this).text()=='Add New'){
			$("#dmeta-sel").hide();
			$("#dmeta").show();
			$(this).text("Cancel");
		} else {
			$("#dmeta-sel").show();
			$("#dmeta").hide();
			$(this).text("Add New");
		}
	});
	
	$("#add-field").click(function(){
		if ($("#dvalue").val()=='') return;
		
		if ($("#dmeta-sel").is(":visible")){
			name = $("#dmeta-sel").val();
		} else if($("#dmeta-sel").length>0) {
			name = $("#dmeta").val();
			$("#dmeta-sel").show();
			$("#dmeta").hide();
			$("#dmeta").val('');
			$(this).text("Add New");
		} else {
            name = $("#dmeta").val();
            $("#dmeta").val('');
            $(this).text("Add New");
        }

		var field = '<div class="row">' +
            '<div class="col-sm-4">' +
            '<div class="form-group">' +
            '<input type="text" class="form-control" name="meta_name[]" value="'+name+'" /><br>' +
            '<button type="button" class="btn btn-warning btn-sm delete-meta">Delete</button>' +
            '</div>' +
            '</div>';
		field += '<div class="col-sm-8">' +
            '<div class="form-group">' +
            '<textarea class="form-control" name="meta_value[]">'+$("#dvalue").val()+'</textarea>' +
            '</div>' +
            '</div>' +
            '</div>';
		$("#dvalue").val('');
		$("#existing-meta > .row:first-child").after(field);
		
	});

    $("#existing-meta").on("click", ".delete-meta", function(){
        $(this).parent().parent().remove();

    });

    // Basic options
    $("#page-type").change(function(){

        var value = $(this).val();

        switch(value){

            // Normal Page
            case '':
                $("#ed-cont-content").fadeIn('fast');
                $(".no-normal").fadeOut('fast');
                $(".yes-normal").fadeIn('fast');
                break;

            // Redirection Page
            case 'redir':
                $("#ed-cont-content").fadeOut('fast');
                $(".no-redir").fadeOut('fast');
                $(".yes-redir").fadeIn('fast');
                break;

        }

    });


	$("button.qp-cancel").click(function(){
		history.go(-1);
	});

	$("button.qp-submit").click(function(){

		var blocker = '<div id="qp-blocker"></div><div id="qp-blocker-info"><span>'+qpLang.check+'</span><button type="button" class="btn btn-info">'+qpLang.cancel+'</button>';
		blocker += '<button class="btn btn-danger">'+qpLang.ok+'</button></div>';
		$("body").append(blocker);

		$("#qp-blocker").fadeIn('fast', function(){
			$("#qp-blocker-info").fadeIn('fast');

			qp_verify_fields();

		});

		$("#qp-blocker-info button").click(function(){
			$("#qp-blocker-info").fadeOut('fast', function(){
				$("#qp-blocker").fadeOut('fast', function(){
					$("#qp-blocker-info").remove();
					$("#qp-blocker").remove();
				});

			});

		});


	});

    $("#custom-tpl").change( function(){

        /**
         * If no file selected then hide the options panel
         */
        if ( $( this).val() == '' ){
            $("#qp-page-options").slideUp(250);
            return;
        }

        qp_load_template_options( $( this).val() );

    } );
	
});

/**
 * Load the options panel for a specific template
 * @param int tpl Template id
 */
function qp_load_template_options( tpl ){

    var page = $("#page-id");
    var id = page.length == 1 ? $(page).val() : 0;

    var params = {
        id: id,
        file: tpl,
        CUTOKEN_REQUEST: $("#cu-token").val(),
        action: 'load-panel'
    };

    $.post( 'pages.php', params, function( response ){

        // Error handler
        if ( response.error == 1 ){

            if ( response.token == undefined ){
                window.location.reload();
                return;
            }

            show_alert_options( response.message, 'danger' );
            $("#cu-token").val( response.token );
            return;

        }

        if ( response.token != undefined )
            $("#cu-token").val( response.token );

        $("#qp-page-options").html( response.form).slideDown(250);


    }, 'json' );

}

/**
 * Show an alert box in the options panel
 * @param string text Text to show in alert box
 * @param string type Type of alert to show (default: info)
 */
function show_alert_options( text, type ){

    if ( text == undefined || text == '' )
        return;

    type = type == undefined || type == '' ? 'info' : type;

    var alert = '<div class="alert alert-'+type+'">' + text + '</div>';

    $("#qp-page-options").html(alert);
    window.location.href = '#qp-page-options';

}

function qp_verify_fields(){

	if($("#qp-title").val()==''){
		$("#qp-blocker-info span").html(qpLang.notitle).addClass('qp-error');
		$("#qp-blocker-info button:last-child").fadeIn('fast');
		$("#qp-blocker-info button.btn-info").fadeOut('fast');
		return;
	}

	if($("#page-type").val()=='redir' && $("input[name='url']").val()==''){
		$("#qp-blocker-info span").html(qpLang.nourl).addClass('qp-error');
		$("#qp-blocker-info button:last-child").fadeIn('fast');
		$("#qp-blocker-info button.btn-info").fadeOut('fast');
		return;
	}

	var params = $("#frm-page").serialize();
	params += '&' + $("#frm-basic-options").serialize();
	params += '&' + $("#frm-view").serialize();
	params += '&' + $("#frm-defimage").serialize();
	params += '&' + $("#frm-page-template").serialize();

	$("#qp-blocker-info span").html(qpLang.saving).removeClass('qp-error');

	$.post("pages.php", params, function(response){

		if(response.error>0){
			qp_show_message(response.message, 1);
			if(response.token!='')
				$("#XOOPS_TOKEN_REQUEST").val(response.token);
			else
				window.location.href = window.location.href;

			return false;
		}

		qp_show_message(response.message, 0);
		$("#qp-blocker-info").addClass('blocker-success');
		$("#qp-blocker-info button:last-child").html(qpLang.done);
		if(response.token!='')
			$("#XOOPS_TOKEN_REQUEST").val(response.token);

		$("#qp-permalink span").html(response.data.permalink);

		if($("#qp-custom-url").length>0){
			$("#qp-custom-url input").val(response.data.custom_url);
		}

		if(response.data.redirect!=undefined)
			window.location.href = response.data.redirect;

	}, 'json');

}

function qp_show_message(msg, error){

	if(error>0){
		$("#qp-blocker-info span").html(msg).addClass('qp-error');
		$("#qp-blocker-info button:last-child").fadeIn('fast');
		$("#qp-blocker-info button.btn-info").fadeOut('fast');
	} else {
		$("#qp-blocker-info span").html(msg).removeClass('qp-error');
		$("#qp-blocker-info button:last-child").fadeIn('fast').removeClass("btn-danger").addClass("btn-success");
		$("#qp-blocker-info button.btn-info").fadeOut('fast');
	}

	setTimeout('qp_close_msg()', 15000);

}

function qp_close_msg(){
	$("#qp-blocker-info").fadeOut('fast', function(){
		$("#qp-blocker").fadeOut('fast', function(){
			$("#qp-blocker-info").remove();
			$("#qp-blocker").remove();
		});

	});
}