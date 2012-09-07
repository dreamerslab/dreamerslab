// wrap everything in document ready event
$( function(){
  // hover effect - change background image
  $( '.photo' ).hover( function(){
    $( this ).addClass( 'hover' );
  }, function(){
    $( this ).removeClass( 'hover' );
  });

  // THE ACTUAL DEMO CODE
  $.preload( 'http://farm3.static.flickr.com/2754/4176113616_ee5799ed03.jpg',
    'http://farm5.static.flickr.com/4053/4210707381_1b41574e05.jpg',
    'http://farm5.static.flickr.com/4044/4290957336_135e7c585a.jpg'
  );
});