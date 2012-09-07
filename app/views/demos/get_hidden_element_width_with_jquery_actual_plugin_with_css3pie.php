<h1>
  jQuery Actual Plugin Demo 
  <br />
  - with css3pie
</h1>
<p>
  <a title="Go to css3pie home page" href="http://css3pie.com/">css3pie</a> makes Internet Explorer 6-8 capable of rendering several of the most useful CSS3 decoration features. If you haven't heard of it, you should give it a try now.
</p>
<p>How ever css3pie breaks your layout in some cases. For example if you have a navigation bar with float elements apply css3 border-radius property. Your layout will break in ie6. Because what css3pie does is it renders a image with rounded corners and append it 'inside' the element and has width set to 100%.</p>
<p>In ie6 if you have a image width set to 100% inside float elements with no specific width. Those float elements will have 100% of their parent width instead of the content width</p>
<p>In this case we have to give every css3pie applied elements a fix width. Please see the source code to tell the difference.</p>

<div class="spliter"></div>

<div id="origin" class="block">
  <h2>Origin</h2>
  <p>This is going to break with ie6.</p>
  <ul class="nav">
    <li><a href="#about">About</a></li>
    <li><a href="#works">Works</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#blog">Blog</a></li>
  </ul>
</div>

<div class="spliter"></div>

<div id="with-jquery-width" class="block">
  <h2>With jQuery width</h2>
  <p>This is going to break with ie6 as well.</p>
<pre class="prettyprint lang-js">
  $( '#with-jquery-width' ).find( 'a' ).each( function(){
    var $this = $( this );
    $this.width( $this.width());
  });
</pre>
  <ul class="nav">
    <li><a href="#about">About</a></li>
    <li><a href="#works">Works</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#blog">Blog</a></li>
  </ul>
</div>

<div class="spliter"></div>

<div id="with-jquery-actual" class="block">
  <h2>With jQuery Actual Plugin</h2>
  <p>This works in all browsers.</p>
<pre class="prettyprint lang-js">
  $( '#with-jquery-actual' ).find( 'a' ).each( function(){
    var $this = $( this );
    $this.width( $this.actual( 'width', { clone : true }));
  });
</pre>
  <ul class="nav">
    <li><a href="#about">About</a></li>
    <li><a href="#works">Works</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#blog">Blog</a></li>
  </ul>
</div>

<div class="spliter"></div>