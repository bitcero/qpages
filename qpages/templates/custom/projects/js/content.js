var content = {

    projects: 1,

    headline: function(){

        var html = '<h1 class="prj-bigh text-center-xs text-center-sm">Your Headline</h1>\n<h2 class="prj-bigsh text-center-xs text-center-sm">Add a sub heading</h2>\n\n<span class="prj-hr"></span>\n\n';
        return html;

    },

    intro: function(){

        var html = '<div class="prj-intro text-center">Insert your own introduction here.</div>\n\n';
        return html;

    },

    project: function(){

        if ( content.projects %2 === 0 )
            var html = '\n\n<span class="prj-hr"></span>\n\n<div class="row prj-item text-right-md text-right-lg">\n<div class="col-md-6">\n<h3>Project Title <span>(Change this)</span></h3>\n<p>Project description</p>\n' +
                '<a href="#" class="btn btn-primary">VIEW PROJECT</a></div>\n' +
                '<div class="col-md-6 text-center">\n<img src="'+prj_url+'/images/prj'+content.projects+'.jpg" alt="My Project" class="prj-thumbnail">\n</div>\n' +
                '</div>\n\n';
        else
            var html = '\n\n<span class="prj-hr"></span>\n\n<div class="row prj-item">\n<div class="col-md-6 text-center">\n<img src="'+prj_url+'/images/prj'+content.projects+'.jpg" alt="My Project" class="prj-thumbnail">\n</div>\n' +
                '<div class="col-md-6">\n<h3>Project Title <span>(Change this)</span></h3>\n<p>Project description</p>\n' +
                '<a href="#" class="btn btn-primary">VIEW PROJECT</a></div></div>\n\n';
        content.projects++;

        if ( content.projects > 2 )
            content.projects = 1;

        return html;

    },

    insert: function( text, pos ){
        if ( 'undefined' === typeof tinymce ){

            if ( pos == 'top' )
                $("#content").val( text + $("#content").val() );
            else
                $("#content").val( $("#content").val() + text );

        }
    }

};

$(document).ready( function(){

    $("#add-headline").click( function() {
        content.insert( content.headline(), 'top' );
    } );

    $("#add-intro").click( function() {
        content.insert( content.intro(), 'bottom' );
    } );

    $("#add-project").click( function(){
        content.insert( content.project(), 'bottom' );
    } )

} );