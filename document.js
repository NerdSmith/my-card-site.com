window.onload = function() {

    function reAnswer(state, title){
        $.ajax ({
            url: "content.php",
            type: "POST",
            data: {page: state, name:title},
            success: function (result) { $(".cnt").html(result);
             }
        });
    }

    function handlerAnchors() {
        $("ul.nav li a").removeClass('selected');
        $(this).addClass('selected');

        var state = {
            title: this.getAttribute( "title" ),
            url: this.getAttribute( "href", 2 )
        }

        //history.pushState( state, state.title, state.url );
        document.title = state.title;
        reAnswer(state.url, state.title);

        return false;
    }

    var anchors = document.getElementsByTagName( 'a' );
    for( var i = 0; i < anchors.length; i++ ) {
        if ($(anchors[ i ]).attr('id') != "add_btn") 
            anchors[ i ].onclick = handlerAnchors;
    }

     //window.onpopstate = function( e ) {
         //$("ul.nav li a").removeClass('selected');
         //$('ul.nav li a[href$="' + history.state.url + '"]').addClass('selected');
         //document.title = history.state.title;
         //reAnswer(history.state.url, history.state.title);
    //}
}