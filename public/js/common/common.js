// preload img
$.preload( '/img/blank.gif' );

$( function(){
  var $w       = $( window ),
      $lang    = $( '#lang' ),
      $lang_a  = $lang.find( 'a' ),
      base_uri = $lang_a.attr( 'href' ),
      $tabs    = $( '.tabs' ),
      tab_a    = 'ul.ui-tabs-nav a',
      msg, lang;

  // Enable tabs on all tab widgets. The `event` property must be overridden so
  // that the tabs aren't changed on click, and any custom event name can be
  // specified. Note that if you define a callback for the 'select' event, it
  // will be executed for the selected tab whenever the hash changes.
  $tabs.tabs({ event: 'change' });

  // Define our own click handler for the tabs, overriding the default.
  $tabs.find( tab_a ).bind( 'click', function(){
    var $this = $( this ),
        state = {},
        id    = $this.closest( '.tabs' ).attr( 'id' ), // Get the id of this tab widget.
        idx   = $this.parents( 'li' ).prevAll().length; // Get the index of this tab.

    // Set the state!
    state[ id ] = idx;
    $.bbq.pushState( state );
  });

  // Bind an event to window.onhashchange that, when the history state changes,
  // iterates over all tab widgets, changing the current tab as necessary.
  $w.bind( 'hashchange', function(e) {

    // Change link href
    $lang_a.attr( 'href', base_uri + window.location.hash );

    // Iterate over all tab widgets.
    $tabs.each( function(){

      // Get the index for this tab widget from the hash, based on the
      // appropriate id property. In jQuery 1.4, you should use e.getState()
      // instead of $.bbq.getState(). The second, 'true' argument coerces the
      // string value to a number.
      var idx = $.bbq.getState( this.id, true ) || 0;

      // Select the appropriate tab for this tab widget by triggering the custom
      // event specified in the .tabs() init above (you could keep track of what
      // tab each widget is on using .data, and only select a tab if it has
      // changed).
      $( this ).find( tab_a ).eq( idx ).triggerHandler( 'change' );
    });
  });

  // Since the event is only triggered when the hash changes, we need to trigger
  // the event now, to handle the hash the page may have loaded with.
  $w.trigger( 'hashchange' );

  // if the init load has hash in the uri, we must asign it to the lang switch link
  $lang_a.attr( 'href', base_uri + window.location.hash );

  // get current lang
  lang = $lang.attr( 'lang' );
  $.secret( 'in' ,'lang', lang );

  // disable not ready page
  msg = lang === 'en' ?
    'The page is not ready yet, please try again later.' :
    '抱歉, 這個頁面目前還沒有完成.';

  $( '#wrap' ).find( '.not-ready' ).bind( 'click', function( e ){
    e.preventDefault();
    $.msg({
      bgPath: '/img/',
      content : msg
    });
  });

});
