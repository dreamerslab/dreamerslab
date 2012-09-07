$( function(){
  // fancy box settings
  $( '#content' ).find( '.gallery' ).find( 'a' ).
    fancybox({
      overlayColor : 'black',
      overlayOpacity : 0.6,
      padding : 0,
      speedIn : 600,
      speedOut : 200,
      titlePosition : 'over'
    });
});

// img.plugin-logo v-align center
// we have to weight till all the imgs are load to get its real height
$( window ).load( function(){
  $( '#open-source' ).find( 'li.list-item' ).filter( ':not(.spliter)' ).each( function(){
    var $this     = $( this ),
        $img      = $this.find( 'img.plugin-logo' ),
        marginTop = ( $this.actual( 'height' ) - $img.actual( 'height' )) / 2;
    
    $img.css( 'margin-top', marginTop );
  });
});
