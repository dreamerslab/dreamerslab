<h1>
  jQuery Queue Plugin Demo
</h1>
<p>
  This demo shows how to build flexible Javascript application. We are going to build a really simple application to show how we can write code a more flexible way.
</p>

<div class="spliter"></div>

<div class="block">
  <h4>
    Functions of this app:
  </h4>
  <ol id="fn-desc">
    <li>When we click on BUTTON A, create a BUTTON B after BUTTON A</li>
    <li>Now if we click on BUTTON B, create a BUTTON C after BUTTON B</li>
    <li>Again click on BUTTON C, create a BUTTON CLEAER after BUTTON C</li>
    <li>At last,click on BUTTON CLEAR to remove BUTTON B, C, and CLEAR</li>
  </ol>
  <p>The purpose of those functions is to bind events to dynamically created DOM elements. Without using this plugin your code would be nested like the following code.</p>
<pre class="prettyprint lang-js">
  $( function(){
    var $playground = $( '#play-ground' );

    // bind btn-a click event when DOM is ready
    $( '#btn-a' ).bind( 'click', function(){

      // only create btn-b in DOM if it does not exist
      if( $( '#btn-b' ).length === 0 ){

        // bind 'after click btn-b' queue functions to btn-b click event
        $( '&lt;div id="btn-b" class="btn"&gt;BUTTON B&lt;/div&gt;' ).bind( 'click', function(){

          // only create btn-c in DOM if it does not exist
          if( $( '#btn-c' ).length === 0 ){

            // bind 'after click btn-c' queue functions to btn-c click event
             $( '&lt;div id="btn-c" class="btn"&gt;BUTTON C&lt;/div&gt;' ).bind( 'click', function(){

               // only create btn-clear in DOM if it does not exist
               if( $( '#btn-clear' ).length === 0 ){

                 // remove btn-b, c and clear if the clear btn is clicked
                 $( '&lt;div id="btn-clear" class="btn"&gt;CLEAR&lt;/div&gt;' ).bind( 'click', function(){

                   $( '#btn-b' ).remove();
                   $( '#btn-c' ).remove();
                   $( '#btn-clear' ).remove();
                 }).appendTo( $playground );
               }
            }).appendTo( $playground );
          }
        }).appendTo( $playground );
      }
    });
  });
</pre>
  <p>With jQuery.queue plugin we can separate code to modules and store each in different files like the following.</p>
</div>

<div class="spliter"></div>

<div class="block">
  <h2>Code in btn_a.js</h2>
<pre class="prettyprint lang-js">
  // push a function in 'after click btn-a' queue
  $.queue( 'add', 'afterClickBtnA', function( $playground ){

    // only create btn-b in DOM if it does not exist
    if( $( '#btn-b' ).length === 0 ){

      // bind 'after click btn-b' queue functions to btn-b click event
      $( '&lt;div id="btn-b" class="btn"&gt;BUTTON B&lt;/div&gt;' ).bind( 'click', function(){

        $.queue( 'call', 'afterClickBtnB', $playground );
      }).appendTo( $playground );
    }
  });
</pre>
</div>

<div class="spliter"></div>

<div class="block">
  <h2>Code in btn_b.js</h2>
<pre class="prettyprint lang-js">
  // push a function in 'after click btn-b' queue
  $.queue( 'add', 'afterClickBtnB', function( $playground ){

    // only create btn-c in DOM if it does not exist
    if( $( '#btn-c' ).length === 0 ){

      // bind 'after click btn-c' queue functions to btn-c click event
       $( '&lt;div id="btn-c" class="btn"&gt;BUTTON C&lt;/div&gt;' ).bind( 'click', function(){

        $.queue( 'call', 'afterClickBtnC', $playground );
      }).appendTo( $playground );
    }
  });
</pre>
</div>

<div class="spliter"></div>

<div class="block">
  <h2>Code in btn_c.js</h2>
<pre class="prettyprint lang-js">
  // push a function in 'after click btn-c' queue
  $.queue( 'add', 'afterClickBtnC', function( $playground ){

    // only create btn-clear in DOM if it does not exist
    if( $( '#btn-clear' ).length === 0 ){

      // remove btn-b, c and clear if the clear btn is clicked
      $( '&lt;div id="btn-clear" class="btn"&gt;CLEAR&lt;/div&gt;' ).bind( 'click', function(){

        $( '#btn-b' ).remove();
        $( '#btn-c' ).remove();
        $( '#btn-clear' ).remove();
      }).appendTo( $playground );
    }
  });
</pre>
</div>

<div class="spliter"></div>

<div class="block">
  <h2>Code in init.js</h2>
<pre class="prettyprint lang-js">
  $( function(){

    // bind btn-a click event when DOM is ready
    $( '#btn-a' ).bind( 'click', function(){

      $.queue( 'call', 'afterClickBtnA', $( '#play-ground' ));
    });
  });
</pre>
</div>

<div class="spliter"></div>

<div class="block">
  <p>Click the button to see how these code works.</p>
  <div id="play-ground">
    <div id="btn-a" class="btn">BUTTON A</div>
  </div>
</div>

<div class="spliter"></div>
