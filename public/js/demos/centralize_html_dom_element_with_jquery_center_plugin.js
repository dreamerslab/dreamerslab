// wrap everything in document ready event
$( function(){

  // cache jquery obj
  var $el    = $( '#some-element' ),
      $pg2el = $( '#play-ground2' ).find( '.some-element' );
  
  // centerize '#some-element' against the window on clicking #btn1
  $( '#btn1' ).bind( 'click', function(){
    $el.center();
  });

  // restore '#some-element' position on clicking '.restore'
  $( '#sample1' ).find( '.restore' ).bind( 'click', function(){
    $el.attr( 'style', '' );
  });

  // centerize each '.some-element' against its parent on clicking #btn2
  $( '#btn2' ).bind( 'click', function(){
    $pg2el.center({ against: 'parent' });
  });

  // restore '.some-element' position on clicking '.restore'
  $( '#sample2' ).find( '.restore' ).bind( 'click', function(){
    $pg2el.attr( 'style', '' );
  });
});

$( window ).load( function(){
  prettyPrint();
});

