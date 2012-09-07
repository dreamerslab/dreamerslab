=== WP-HTML-Compression ===
Author: Steven Vachon
URL: http://www.svachon.com/
Contact: prometh@gmail.com
Contributors: prometh
Tags: absolute, bandwidth, comment, comments, compress, compressed, compression, faster, google, html, link, links, loading, optimize, optimization, minification, minified, minify, performance, plugin, reduction, relative, seo, shorten, speed, space, template, url, urls, whitespace
Requires at least: 3.2
Tested up to: 3.3.2
Stable tag: trunk

Reduce file size by shortening URLs and safely removing all standard comments and unnecessary whitespace from an HTML document.


== Description ==

Combining HTML "minification" with cache and HTTP compression (**[WP Super Cache](http://wordpress.org/extend/plugins/wp-super-cache/)**, or similar) will cut down your bandwidth and ensure near-immediate content delivery while increasing your Google rankings.

This plugin will compress your HTML by shortening **URLs** and removing **standard comments** and **whitespace**; including new lines, carriage returns, tabs and excess spaces. Most importantly, by ignoring `<pre>`, `<textarea>`, `<script>` and Explorer `conditional comment` tags, ***presentation will not be affected***.


== Installation ==

1. Download the plugin (zip file).
2. Upload and activate the plugin through the "Plugins" menu in the WordPress admin.


== Frequently Asked Questions ==

= Will this plugin slow down my page load times? =

Yes, by about 1/1000th of a second. While you should be using **[WP Super Cache](http://wordpress.org/extend/plugins/wp-super-cache/)** anyway, it will correct the issue.

= Will Internet Explorer conditional comments be removed? =

No.

= Will having invalid HTML cause an issue? =

Probably, however WordPress does a pretty good job of correcting invalid markup. But honestly, it's your job to make sure that your code doesn't suck.

= How do I mark areas that should not be compressed? =

While &lt;pre&gt;, &lt;textarea&gt; and &lt;script&gt; tags are automatically left uncompressed, you can designate any code to be exempted from compression. Simply drop your content between a pair of `<!--wp-html-compression no compression-->` comment tags. A picture is worth a thousand words; so, check the **[screenshots](http://wordpress.org/extend/plugins/wp-html-compression/screenshots/)**.

= How do I compress the contents of &lt;script&gt; tags? =

Until a settings page is created, you'll have to edit the file from the "Plugins" menu in the WordPress admin. Look for the `$compress_js` variable and set it to `true`.

= Are you or have you thought of using HTML Tidy? =

Since not every WordPress server supports the installation of PHP extensions, this plugin does not currently make use of HTML Tidy. However, future releases may do so.

= Will this plugin work for WordPress version x.x.x? =

This plugin has only been tested with versions of WordPress as early as 3.2. For anything older, you'll have to see for yourself.


== Screenshots ==

1. This is what the XHTML looks like after being compressed with WP-HTML-Compression.
2. This is what the same XHTML from the above screenshot looked like prior to compression.
3. This is an example of how to use the compression override.


== Changelog ==

= 0.5 =
* Includes **[Absolute-to-Relative URLs](http://wordpress.org/extend/plugins/absolute-to-relative-urls/)** for `action`, `href`, `src` attributes
* Bypasses compression for RSS/Atom feeds
* Bypasses compression on admin/dashboard pages to free up resources for other tools/plugins
* Compresses themes that don't make use of a header.php file (previously did not)
* Removes any empty attributes using single-quote encapsulation (previously supported only double-quotes)
* Removes excess spacing within opening and closing tags (previously supported only self-closing tags)
* Converts new lines to spaces so that *rendered* whitespace is preserved
* Simplified compression statistics comment
* PHP errors hidden if/when plugin file is accessed directly
* Speed optimizations

= 0.4 =
* Removes empty attributes except `action`, `alt`, `content`, `src`

= 0.3 =
* Comments in &lt;textarea&gt; are no longer removed. Browsers seem to display such text
* Removes excess spacing within self-closing tags
* Speed optimizations

= 0.2 =
* Fixed compression override

= 0.1 =
* Initial release