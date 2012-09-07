// code in btn_a
// push a function in 'after click btn-a' queue
$.queue( 'add', 'afterClickBtnA', function( $playground ){

  // only create btn-b in DOM if it does not exist
  if( $( '#btn-b' ).length === 0 ){

    // bind 'after click btn-b' queue functions to btn-b click event
    $( '<div id="btn-b" class="btn">BUTTON B</div>' ).bind( 'click', function(){

      $.queue( 'call', 'afterClickBtnB', $playground );
    }).appendTo( $playground );
  }
});

// code in btn_b
// push a function in 'after click btn-b' queue
$.queue( 'add', 'afterClickBtnB', function( $playground ){

  // only create btn-c in DOM if it does not exist
  if( $( '#btn-c' ).length === 0 ){

    // bind 'after click btn-c' queue functions to btn-c click event
    $( '<div id="btn-c" class="btn">BUTTON C</div>' ).bind( 'click', function(){

      $.queue( 'call', 'afterClickBtnC', $playground );
    }).appendTo( $playground );
  }
});

// code in btn_c
// push a function in 'after click btn-c' queue
$.queue( 'add', 'afterClickBtnC', function( $playground ){

  // only create btn-clear in DOM if it does not exist
  if( $( '#btn-clear' ).length === 0 ){

    // remove btn-b, c and clear if the clear btn is clicked
    $( '<div id="btn-clear" class="btn">CLEAR</div>' ).bind( 'click', function(){

      $( '#btn-b' ).remove();
      $( '#btn-c' ).remove();
      $( '#btn-clear' ).remove();
    }).appendTo( $playground );
  }
});

// code in init
$( function(){

  // bind btn-a click event when DOM is ready
  $( '#btn-a' ).bind( 'click', function(){

    $.queue( 'call', 'afterClickBtnA', $( '#play-ground' ));
  });
});

$( window ).load( function(){
  prettyPrint();
});