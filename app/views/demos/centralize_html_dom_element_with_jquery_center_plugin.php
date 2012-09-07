<h1>
  jQuery Center Plugin Demo
</h1>
<p>
  Try clicking the buttons to see how they works :)
</p>

<div class="spliter"></div>

<div class="block">
  <h2>
    Centralize #some-element against the window
  </h2>
  <div id="sample1" class="spacer">
    <div id="btn1" class="btn">Centralize</div>
    <div class="btn restore">Restore</div>
  </div>
  <div id="play-ground1">
    <div id="some-element" class="some-element">
      #some-element
    </div>
  </div>

  <h3>The code</h3>
<pre class="prettyprint lang-js">
  // cache jquery obj
  var $el = $( '#some-element' );

  // centerize '#some-element' against the window on clicking #btn1
  $( '#btn1' ).bind( 'click', function(){
    $el.center();
  });

  // restore '#some-element' position on clicking '.restore'
  $( '#sample1' ).find( '.restore' ).bind( 'click', function(){
    $el.attr( 'style', '' );
  });
</pre>
</div>

<div class="spliter"></div>

<div class="block">
  <h2>
    Centralize .some-element against its parent
  </h2>
  <div id="sample2" class="spacer">
    <div id="btn2" class="btn">Centralize</div>
    <div class="btn restore">Restore</div>
  </div>
  <div id="play-ground2">
    <div class="parent">
      .parent
      <div class="some-element">
        .some-element
      </div>
    </div>
    <div class="parent">
      .parent
      <div class="some-element">
        .some-element
      </div>
    </div>
    <div class="parent">
      .parent
      <div class="some-element">
        .some-element
      </div>
    </div>
    <div class="parent">
      .parent
      <div class="some-element">
        .some-element
      </div>
    </div>
  </div>

  <h3>The code</h3>
<pre class="prettyprint lang-js">
  // cache jquery obj
  var $pg2el = $( '#play-ground2' ).find( '.some-element' );

  // centerize each '.some-element' against its parent on clicking #btn2
  $( '#btn2' ).bind( 'click', function(){
    $pg2el.center({ against: 'parent' });
  });

  // restore '.some-element' position on clicking '.restore'
  $( '#sample2' ).find( '.restore' ).bind( 'click', function(){
    $pg2el.attr( 'style', '' );
  });
</pre>
</div>

<div class="spliter"></div>


