$( window ).load( function(){
  var $sub_nav = $( '#sub-nav' ).find( 'a' ),
  
  realWidth = function( $el ){
    $el.width( $el.actual( 'width', { clone : true }));
  };

  // this must trigger after ui-tabs
  setTimeout( function(){
    $sub_nav.each( function(){
      realWidth( $( this ));
    });
  }, 500 );

});
