$( function(){
  // fancy box settings
  $( '#content' ).find( 'a.show-demo' ).
    fancybox({
      hideOnContentClick : false,
      width : '100',
      height: '100',
      margin: 20,
      overlayColor : 'black',
      overlayOpacity : 0.6,
      padding : 0,
      speedIn :	600,
      speedOut :	200,
      titlePosition : 'over',
      type :'iframe'
    });
});