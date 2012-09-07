<h1>
jQuery MSG Plugin Demo
</h1>

<div class="spliter"></div>

<div class="play-ground">
  <h3>Default usage</h3>
  <div class="spacer">
    <div id="default" class="btn">Click me</div>
  </div>
<pre class="prettyprint lang-js">
  $.msg();
</pre>
</div>

<div class="spliter"></div>

<div class="play-ground">
  <h3>Custom content</h3>
  <div class="spacer">
    <div id="custom-content" class="btn">Click me</div>
  </div>
<pre class="prettyprint lang-js">
  $.msg({ content : 'blah blah' });
</pre>
</div>

<div class="spliter"></div>

<div class="play-ground">
  <h3>Disable auto unblock</h3>
  <div class="spacer">
    <div id="disable-auto-unblock" class="btn">Click me</div>
  </div>
<pre class="prettyprint lang-js">
  $.msg({ autoUnblock : false });
</pre>
</div>

<div class="spliter"></div>

<div class="play-ground">
  <h3>Custom speed</h3>
  <div class="spacer">
    <div id="custom-speed" class="btn">Click me</div>
  </div>
<pre class="prettyprint lang-js">
  $.msg({
    fadeIn : 500,
    fadeOut : 200,
    timeOut : 5000
  });
</pre>
</div>

<div class="spliter"></div>

<div class="play-ground">
  <h3>Switch theme</h3>
  <div class="spacer">
    <div id="switch-theme" class="btn">Click me</div>
  </div>
<pre class="prettyprint lang-js">
  $.msg({ klass : 'white-on-black' });
</pre>
</div>

<div class="spliter"></div>

<div class="play-ground">
  <h3>Custom theme</h3>
  <div class="spacer">
    <div id="custom-theme" class="btn">Click me</div>
  </div>
<pre class="prettyprint lang-js">
  $.msg({ klass : 'custom-theme' });
</pre>
</div>

<div class="spliter"></div>

<div class="play-ground">
  <h3>Replace content, events and manually unblock</h3>
  <div class="spacer">
    <div id="replace-content" class="btn">Click to delete the user</div>
    <div id="restore-user" class="btn">Restore user</div>
  </div>
  <p id="the-user">I am the user :3</p>
<pre class="prettyprint lang-js">
  // block the screen to show msg when click on #replace-content btn
  $( '#replace-content' ).bind( 'click', function(){
    $.msg({
      autoUnblock : false,
      clickUnblock : false,
      content: '&lt;p&gt;Delete this user?&lt;/p&gt;' +
               '&lt;p class="btn-wrap"&gt;' +
                 '&lt;span id="yes"&gt;Yes&lt;/span&gt;' +
                 '&lt;span id="no"&gt;no&lt;/span&gt;' +
               '&lt;/p&gt;',
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
</pre>
</div>

<div class="spliter"></div>