jQuery(function(){

    elemento = jQuery( '.btn-whatsapp' );

    elemento.on( 'click', function( e ){

        url = window.location.href;

        link = elemento.attr( 'href' );

        elemento.attr( 'href', link +" "+ url );
    });
});
