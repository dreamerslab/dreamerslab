// store some common data and methods
// which are going to be use through out the whole application
$.secret( 'in', 'name', 'Ben' ).
  secret( 'in', 'age', 30 ).
  secret( 'in', 'sports', [ 'basketball', 'baseball' ]).

  secret( 'in', 'showName', function( callback ){
    // append the stored 'name' to page
    this.$playground.
      append( '<div class="name"> Name: ' + this.name + '</div>' );
    // do a callback function if any
    if( callback ) callback.call( this );

  }).secret( 'in', 'showAge', function( callback ){
    // append the stored 'age' to page
    this.$playground.
      append( '<div class="age"> Age: ' + this.age + '</div>' );
    // do a callback function if any
    if( callback ) callback.call( this );

  }).secret( 'in', 'showSports', function( callback ){
    // cache obj props ouside the loop
    var sports = this.sports,
    fragment = '<div>Sports:<ul>';

    $.each( sports, function( key, value ){
      fragment = fragment + '<li>' + value + '</li>';
    });

    fragment = fragment + '</ul></div>';
    
    this.$playground.append( fragment );
    if( callback ) callback.call( this );
  });


// wrap code in a document ready function
$( function(){
  $( '#click-me' ).bind( 'click', function(){
    // pass the $( '#play-ground' ) to $.secret private obj
    $.secret( 'in', '$playground', $( '#play-ground' )).

      // execute predefined methods
      secret( 'call', 'showName', function(){
        alert( 'callback function from showName' );
      }).secret( 'call', 'showAge', function(){
        alert( 'callback function from showAge' );
      }).secret( 'call', 'showSports', function(){
        alert( 'callback function from showSports' );
      });
  });
});

$( window ).load( function(){
  prettyPrint();
});