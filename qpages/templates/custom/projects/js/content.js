var content = {

    projects: 1,

    headline: function(){

        var html = '<h1 class="prj-bigh text-center-xs text-center-sm">Your Headline</h1>\n<h2 class="prj-bigsh text-center-xs text-center-sm">Add a sub heading</h2>\n\n<span class="prj-hr">&nbsp;</span>\n\n';
        return html;

    },

    intro: function(){

        var html = '<div class="prj-intro text-center">Insert your own introduction here.</div>\n\n';
        return html;

    },

    project: function(){

        if ( content.projects %2 === 0 )
            var html = '\n\n<span class="prj-hr">&nbsp;</span>\n\n<div class="row prj-item text-right-md text-right-lg">\n<div class="col-md-6">\n<h3>Project Title <span>(Change this)</span></h3>\n<p>Project description</p>\n' +
                '<a href="#" class="btn btn-primary">VIEW PROJECT</a></div>\n' +
                '<div class="col-md-6 text-center">\n<img src="'+prj_url+'/images/prj'+content.projects+'.jpg" alt="My Project" class="prj-thumbnail">\n</div>\n' +
                '</div>\n\n';
        else
            var html = '\n\n<span class="prj-hr">&nbsp;</span>\n\n<div class="row prj-item">\n<div class="col-md-6 text-center">\n<img src="'+prj_url+'/images/prj'+content.projects+'.jpg" alt="My Project" class="prj-thumbnail">\n</div>\n' +
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

        } else {

            var ed = tinymce.get( 'content' );
            if ( pos == 'top' )
                content.cursorBegin();
            else
                content.cursorEnd();
            ed.execCommand( 'mceInsertContent', false, text.replace('<span class="prj-hr">&nbsp;</span>', '<div class="prj-hr">&nbsp;</div>') );

        }
    },

    cursorEnd: function(){
        var ed=tinyMCE.get('content');
        var root=ed.dom.getRoot();  // This gets the root node of the editor window
        var lastnode=root.childNodes[root.childNodes.length-1]; // And this gets the last node inside of it, so the last <p>...</p> tag
        if (tinymce.isGecko) {
            // But firefox places the selection outside of that tag, so we need to go one level deeper:
            lastnode=lastnode.childNodes[lastnode.childNodes.length-1];
        }
        // Now, we select the node
        ed.selection.select(lastnode);
        // And collapse the selection to the end to put the caret there:
        ed.selection.collapse(false);
    },

    cursorBegin: function(){
        var ed=tinyMCE.get('content');
        var root=ed.dom.getRoot();  // This gets the root node of the editor window
        var firstnode=root.childNodes[0]; // And this gets the last node inside of it, so the last <p>...</p> tag
        if (tinymce.isGecko) {
            // But firefox places the selection outside of that tag, so we need to go one level deeper:
            firstnode=firstnode.childNodes[0];
        }
        // Now, we select the node
        ed.selection.select(firstnode);
        // And collapse the selection to the end to put the caret there:
        ed.selection.collapse(true);
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