$( function(){
  if( $.browser.msie && $.browser.version < 7 ){
    $( '#with-jquery-width' ).find( 'a' ).each( function(){
      var $this = $( this );
      $this.width( $this.width());
    });

    $( '#with-jquery-actual' ).find( 'a' ).each( function(){
      var $this = $( this );
      $this.width( $this.actual( 'width', { clone : true }));
    });
  }
});

$( window ).load( function(){
  prettyPrint();
});