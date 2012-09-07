// wrap everything in a anonymous function to prevent global
( function( $ ){

  // the testing result with default jquery width() and this plugin actual('width')
  var result = function(){

    // THE ACTUAL DEMO CODE
    // empty display area before append new result
    $( '#display' ).
      empty().
      append( '<pre class="prettyprint linenums lang-js">' + 
        '  $( "#inner" ).width(); => ' + $( '#inner' ).width() + 'px\n' +
        '  $( "#inner" ).actual( "width" ); => ' + $( '#inner' ).actual( 'width' ) + 'px' +
        '</pre>'
      );
    prettyPrint();
  },

  switchCss = function( callback ){

    // cache dom element
    $checkbox = $( ':checkbox' );

    // change result on clicke event
    $checkbox.bind( 'click', function(){

      // vars to store selected css for #outer and #inner
      var outerCss = {},
          innerCss = {};

      // get each selected css props for #outer element
      $checkbox.filter( '.outer:checked' ).each( function(){
        var $this = $( this );
        outerCss[ $this.attr( 'name' )] = $this.val();
      });

      // get each selected css props for #inner element
      $checkbox.filter( '.inner:checked' ).each( function(){
        var $this = $( this );
        innerCss[ $this.attr( 'name' )] = $this.val();
      });

      // clear all style before apply new styles
      $( '#outer' ).removeAttr( 'style' ).css( outerCss );
      $( '#inner' ).removeAttr( 'style' ).css( innerCss );

      // fire callback function if any
      if( callback ) callback.call( this );
    });
  };

  // when document is ready show the initial result
  // when user switchs the css props shows the new result
  $( function(){
    result();
    switchCss( result );
  });

})( jQuery );

$( window ).load( function(){
  prettyPrint();
});