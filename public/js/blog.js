// document ready
$( function(){

// --- variable and function declaration ---------------------------------------

  // lang pack
  var lang = $( '#lang' ).attr( 'lang' ) === 'en' ?
    { 
      collapse : 'Collapse',
      expand : 'Expand',
      collapse_all : 'Collapse all',
      expand_all : 'Expand all'
    } :
    {
      collapse : '隱藏',
      expand : '展開',
      collapse_all : '全部隱藏',
      expand_all : '全部展開'
    },

  // cache jquery obj
  $content      = $( '#content' ),
  $collapse     = $content.find( '.collapse' ),
  $collapse_all = $content.find( '.collapse-all' ),
  $expand_all   = $content.find( '.expand-all' ),
  $collapsible  = $content.find( '.collapsible' ),

  collapse_all = function(){
    $collapse.text( lang.expand );
    $collapsible.hide().addClass( 'collapsed' );
  };

// --- execution ---------------------------------------------------------------

  $expand_all.text( lang.expand_all );
  $collapse_all.text( lang.collapse_all );
  // collapse all collapsible obj at page load
  collapse_all();

  // `collapse all` controll
  $collapse_all.bind( 'click', collapse_all );

  $expand_all.bind( 'click', function(){
    $collapse.text( lang.collapse );
    $collapsible.show().removeClass( 'collapsed' );
  });

  // `collapsible` controll
  $collapse.each( function(){
    var $this = $( this );

    $this.bind( 'click', function(){

      var $collapsible = $( this ).parent().find( '.collapsible' ).first();

      if( $collapsible.hasClass( 'collapsed' )){
        $this.text( lang.collapse );
        $collapsible.show().removeClass( 'collapsed' );
      }else{
        $this.text( lang.expand );
        $collapsible.hide().addClass( 'collapsed' );
      }
    });
  });

  $( '#content' ).find( '.thumbnails' ).find( 'a' ).
    fancybox({
      overlayColor : 'black',
      overlayOpacity : 0.6,
      padding : 0,
      speedIn :	600,
      speedOut :	200,
      titlePosition : 'over'
    });
});
