=== qTranslate META ===
Contributors: jstar198
Tags: qtranslate, multilingual, i18n, l10n, meta, seo
Requires at least: 2.5
Tested up to: 3.4
Stable tag: trunk

For users of qTranslate, allows you to set multi-lingual META tags and a &lt;title&gt; override for your posts and pages.

== Description ==

Adds an extra panel to the post/page edit page which allows you to enter the META keywords & description for that page in each enabled language. Also adds an optional browser title override (does not affect post title).

Note 1: This plugin requires that [qTranslate](http://www.qianqin.de/qtranslate/) is installed and activated.

Note 2: This plugin does not work well with [All In One SEO](http://wordpress.org/extend/plugins/all-in-one-seo-pack/) and potentially any other plugin or theme which tries to set your META tags.

= Thanks =
I'd like to thank the following people for their contributions (in chronological order):

* Victor Berchet &mdash; Help with initial localisation; French translation
* Benoit Gauthier &mdash; autosave bug fix
* Filippo Pisano &mdash; Italian translation
* [Marcis G.](http://pc.de/) &mdash; Belorussian translation
* Almaz &mdash; Russian translation
* [Renate Kramer](http://www.heftrucknederland.nl/) &mdash; German translation
* [Rene](http://wpwebshop.com/blog/) &mdash; Dutch translation
* banane &mdash; Bugs with WordPress 3 compatability.
* Alexander of [Web Hosting Geeks](http://webhostinggeeks.com/) &mdash; Romanian translation

== Installation ==

1. Upload/Copy folder to your blog's plugin directory.
2. Ideally disable any other SEO plugins/features, such as AIOSEO and Theme Hybrid's SEO functionality.
3. Activate the plugin.
4. When adding/editing any post/page, use the simple interface to set your META tags.
5. You can also view a summary of your page's META tags via Pages -> META Summary.

== Frequently Asked Questions ==

= How do translate my site title/tagline? =
In **Settings &rarr; General**, use the qTranslate shortcodes, e.g.: <code>[:en]English title[:it]Titolo italiano</code>.
(This is a feature of qTranslate itself, not of qTranslate META).

= My title is not as I expect =
This often has to do with your theme and any other plugins that may hook onto the <code>wp_title</code> filter.
There is no straight answer for this, you simply have to figure out what's going on and look closely at your theme,
often in the <code>header.php</code> file. See the comments on [this blog post](http://blog.johnjcamilleri.com/2010/01/qtranslate-and-multilingual-meta-tags/) for ideas.

= Why does it not work with AIOSEO / other SEO plugins? =
Yes, I know this may be a drawback for some users. It may be possible that they can happily coexist, but I only developed this plugin for my own needs and don't really have the time to make it play nice with other SEO plugins, sorry! :/

= Why do I get a warning when downloading the META summary to Excel? =
When doing this you will get a warning saying:

`The file you are trying to open, '...', is in a different format than specified by the file extension. Verify that the file is not corrupted and is from a trusted sources before opening the file. Do you want to open the file now?`

This is normal, because the file generated is not actually Excel but HTML. However Excel will successfully convert it, so just click yes to the warning and then save a copy of the downloaded file.


== Screenshots ==
1. The Multilingual META panel while editing a page. It is tabbed in the same way qTranslate tabs the content edit window.
2. The Multilingual META summary page, showing missing translations in certain languages.

== Changelog ==

= 1.0.2 =
* Only load meta tags when displaying a single post or page. If you don't like this behaviour, comment out line 163 of `qtranslate-meta.php`.

= 1.0.1 =
* Fixed a bug when saving empty options.

= 1.0.0 =
* Finally added option for title hook. Included Romanian translation by Alexander of [Web Hosting Geeks](http://webhostinggeeks.com/)

= 0.9.1 =
* Updates for improved Wordpress 3 compatibility.

= 0.8.5 =
* Tested in WP 3.0
* Dutch translation, thanks to [Rene](http://wpwebshop.com/blog/)

= 0.8.4 =
* German translation, thanks to [Renate Kramer](http://www.heftrucknederland.nl/)

= 0.8.2 =
* Belorussian translation, thanks to [Marcis G.](http://pc.de/)

= 0.8.1 =
* Italian translation, thanks to Filippo Pisano

= 0.8 =
* Fixed bug with post revisions & autosave, thanks to Benoit Gauthier

= 0.7.1 =
* META Summary page now has view options, and a dropdown to choose language.
* Table on META Summary page can now be downloaded as an Excel file (BETA).

= 0.7 =
* META Summary page is now organised by page heirarchy.

= 0.6 =
* Admin pages are now localised, with help from Victor Berchet.

= 0.4 =
* Update to support field labels, as suggested by Victor Berchet.

= 0.3.2 =
* Minor fix and improvement in META Summary Page, thanks to Victor Berchet for pointing it out.

= 0.3.1 =
* Small changes to META Summary Page

= 0.3 =
* Added META Summary Page
* Compatibility with WP 2.9.1, Hybrid 0.7

= 0.2.2 =
* First public version of plugin.
