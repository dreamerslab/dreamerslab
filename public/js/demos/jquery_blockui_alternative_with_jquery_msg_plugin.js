$.msg( 'overwriteGlobal', 'bgPath', '/img/' );

$( function(){

  $( '#default' ).bind( 'click', function(){
    $.msg();
  });

  $( '#custom-content' ).bind( 'click', function(){
    $.msg({ content: 'blah blah' });
  });

  $( '#disable-auto-unblock' ).bind( 'click', function(){
    $.msg({ autoUnblock : false });
  });

  $( '#custom-speed' ).bind( 'click', function(){
    $.msg({
      fadeIn : 500,
      fadeOut : 200,
      timeOut : 5000
    });
  });

  $( '#switch-theme' ).bind( 'click', function(){
    $.msg({ klass : 'white-on-black' });
  });

  $( '#custom-theme' ).bind( 'click', function(){
    $.msg({ klass : 'custom-theme' });
  });

  // block the screen to show msg when click on #replace-content btn
  $( '#replace-content' ).bind( 'click', function(){
    $.msg({
      autoUnblock : false,
      clickUnblock : false,
      content: '<p>Delete this user?</p>' +
               '<p class="btn-wrap">' +
                 '<span id="yes">Yes</span>' +
                 '<span id="no">no</span>' +
               '</p>',
      afterBlock : function(){
        // store 'this' for other scope to use
        var self = this;

        // delete user and auto unblock the screen after 1 second
        // when click #yes btn
        $( '#yes' ).bind( 'click', function(){

          // self.method is not chainable
          self.replace( 'User deleted.' );
          self.unblock( 2000 );
          // this equals to
          // $.msg( 'replace', 'User deleted.' ).
          //   msg( 'unblock', 2000 );

          $( '#the-user' ).empty();
        });

        $( '#no' ).bind( 'click', function(){

          // this equals to $.msg( 'unblock' );
          self.unblock();
        });
      },
      beforeUnblock : function(){
        alert( 'This is a callback from beforeUnblock event handler :)' );
      }
    });
  });

  $( '#restore-user' ).bind( 'click', function(){
    $( '#the-user' ).text( 'I am the user' );
  });

});

$( window ).load( function(){
  prettyPrint();
});
