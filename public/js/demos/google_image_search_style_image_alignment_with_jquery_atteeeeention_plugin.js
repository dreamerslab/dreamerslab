// load google search lib
google.load( 'search', '1' );
// wrap args and func in a closure
( function( g, $ ){
  var pageCounter,
  // tmp container for imgs to be append to DOM
  imgs,
  // reset all args
  reset = function(){
    pageCounter = 0;
    imgs = '';
    $( '#play-ground' ).empty();
  },
  // set search options
  search = function( keyowrd, controller, afterSearch, callback ){
    // google only gives 8 results max per request
    controller.setResultSetSize( 8 );
    controller.setSearchCompleteCallback( this, afterSearch, [ controller, callback ] );
    controller.execute( keyowrd );
  },
  // build DOM
  // this func will be call from within itself by google api .gotoPage()
  build = function( controller, callback ){
    // loop through each search result
    // calculate and record results
    $.each( controller.results, function( key, val ){
      imgs = imgs +
      '<a title="' + val.titleNoFormatting + '" href="' + val.unescapedUrl + '">' +
        '<img src="' + val.tbUrl +'"/>' +
      '</a>';
    });

    pageCounter++;
    // ask for the next page data
    controller.gotoPage( pageCounter );
    // only append to DOM with the last query
    if( pageCounter === 8 ){
      $( '#play-ground' ).append( imgs );
      if( callback ) callback.call( this );
    }
  },

  execute = function( keyword, callback ){
    var searcher = new g.search.ImageSearch();
    reset();
    search( keyword, searcher, build, callback );
  };

  $( function(){

    var googleSearch = function(){
      execute( $( '#keyword' ).val(), function(){
        // THE ACTUAL CODE
        $( '#play-ground' ).atteeeeention({
          hideLastRow : true
        });
      });
    };
    
    $( '#search' ).bind( 'click', googleSearch );
    $( '#keyword' ).bind( 'keypress', function( e ){
      if( e.keyCode === 13 ){
        googleSearch();
      }
    });

  });

})( google, jQuery );

$( window ).load( function(){
  prettyPrint();
});