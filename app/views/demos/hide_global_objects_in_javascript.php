<h1>
  jQuery Secret Plugin Demo
</h1>
<p>
  This demo shows how to pass data to different js files without using global.
</p>

<div class="spliter"></div>

<div class="block">
<h2>Code in common.js</h2>
<pre class="prettyprint lang-js">
  // store some common data and methods
  // which are going to be use through out the whole application
  $.secret( 'in', 'name', 'Ben' ).
    secret( 'in', 'age', 30 ).
    secret( 'in', 'sports', [ 'basketball', 'baseball' ]).

    secret( 'in', 'showName', function( callback ){
      // append the stored 'name' to page
      this.$playground.
        append( '&lt;p class="name"&gt; Name: ' + this.name + '&lt;/p&gt;' );
      // do a callback function if any
      if( callback ) callback.call( this );

    }).secret( 'in', 'showAge', function( callback ){
      // append the stored 'age' to page
      this.$playground.
        append( '&lt;p class="age"&gt; Age: ' + this.age + '&lt;/p&gt;' );
      // do a callback function if any
      if( callback ) callback.call( this );

    }).secret( 'in', 'showSports', function( callback ){
      // cache obj props ouside the loop
      var sports = this.sports,
      fragment = '&lt;p&gt;Sports:&lt;ul&gt;';

      $.each( sports, function( key, value ){
        fragment = fragment + '&lt;li&gt;' + value + '&lt;/li&gt;';
      });

      fragment = fragment + '&lt;/ul&gt;&lt;/p&gt;';

      this.$playground.append( fragment );
      if( callback ) callback.call( this );
    });
</pre>
</div>

<div class="spliter"></div>

<div class="block">
  <h2>Code in another.js</h2>
<pre class="prettyprint lang-js">
  // wrap code in a document ready function
  $( function(){

    $( '#click-me' ).bind( 'click', function(){
      // pass the $( '#play-ground' ) to $.secret private obj
      $.secret( 'in', '$playground', $( '#play-ground' )).

        // execute predefined methods
        secret( 'out', 'showName', function(){
          alert( 'callback function from showName' );
        }).secret( 'out', 'showAge', function(){
          alert( 'callback function from showAge' );
        }).secret( 'out', 'showSports', function(){
          alert( 'callback function from showSports' );
        });
    });
  });
</pre>
</div>

<div class="spliter"></div>

<div class="block">
  <p>Click the button to see how these code works, you can check Firebug in the DOM panel to see if there is any global object.</p>
  <div id="fire">
    <div id="click-me">THE BUTTON</div>
  </div>
</div>

<div class="spliter"></div>

<div class="block">
  <div id="play-ground"></div>
</div>

<div class="spliter"></div>