=== Google XML Sitemaps with qTranslate Support ===
Contributors: NeoEGM, arnee
Tags: qtranslate, update, patch, google, sitemaps, google sitemaps, yahoo, msn, ask, live, xml sitemap, xml
Requires at least: 2.1
Tested up to: 2.9
Stable tag: 3.1.6.3

This plugin will create a Google sitemaps compliant XML-Sitemap of your WordPress blog. qTranslate Compliant version by NeoEGM.

== Description ==

This plugin will create a Google sitemaps compliant XML-Sitemap of your WordPress blog. It supports all of the WordPress generated pages as well as custom ones. Everytime you edit or create a post, your sitemap is updated and all major search engines that support the sitemap protocol, like ASK.com, Google, MSN Search and YAHOO, are notified about the update.

This is a <strong>qTranslate Compatible Version</strong> by <a href="http://www.neoegm.com/software/google-xml-sitemaps-with-qtranslate-support/">NeoEGM</a>

This plugin was originally written by <a href="http://www.arnebrachhold.de/projects/wordpress-plugins/google-xml-sitemaps-generator/">Arne Brachhold</a>.

I've decided to mantain the qTranslate support for this plugin. This release is to make possible the automatic updating. I'll be updating it every time the original author updates his own version and if I make changes for the qTranslate support.

For any question or comment you may have about the qTranslate support for the plugin, please refer to <a href="http://www.neoegm.com/software/google-xml-sitemaps-with-qtranslate-support/">my website</a>.

== Installation ==

1. Upload the full directory into your wp-content/plugins directory
2. Use your favorite FTP program to create two files in your WordPress directory (that's where the wp-config.php is) named sitemap.xml and sitemap.xml.gz and make them writable via CHMOD 666. More information about CHMOD and how to make files writable is available at the [WordPress Codex](http://codex.wordpress.org/Changing_File_Permissions) and on [stadtaus.com](http://www.stadtaus.com/en/tutorials/chmod-ftp-file-permissions.php). Making your whole blog directory writable is NOT recommended anymore due to security reasons.
4. Activate the plugin at the plugin administration page
5. Open the plugin configuration page, which is located under Options -> XML-Sitemap and build the sitemap the first time. If you get a permission error, check the file permissions of the newly created files.
6. The plugin will automatically update your sitemap of you publish a post, so theres nothing more to do :)

== Frequently Asked Questions == 

= There are no comments yet (or I've disabled them) and all my postings have a priority of zero! =

Please disable automatic priority calculation and define a static priority for posts.

= Do I always have to click on "Rebuild Sitemap" if I modified a post? =

No, if you edit/publish/delete a post, your sitemap is automatcally regenerated

= So much configuration options... Do I need to change them? =

No, only if you want to. Default values should be ok!

= Does this plugin work with all WordPress versions? =

This version works with WordPress 2.1 and better. If you're using an older version, plese check the [Google Sitemaps Plugin Homepage](http://www.arnebrachhold.de/projects/wordpress-plugins/google-xml-sitemaps-generator/ "Google (XML) Sitemap Generator Plugin Homepage") for the legacy releases. There is a working release for every WordPress version since 1.5

= I get an fopen and / or permission denied error or my sitemap files could not be written =

If you get permission errors, make sure that the script has the right to overwrite the sitemap.xml and sitemap.xml.gz files. Try to create the sitemap.xml resp. sitemap.xml.gz at manually and upload them with a ftp program and set the rights with CHMOD to 666 (or 777 if 666 still doesn't work). Then restart sitemap generation on the administration page. A good tutorial for changing file permissions can be found on the [WordPress Codex](http://codex.wordpress.org/Changing_File_Permissions) and at [stadtaus.com](http://www.stadtaus.com/en/tutorials/chmod-ftp-file-permissions.php).

== Screenshots ==

1. Administration interface in WordPress 2.7
2. Administration interface in WordPress 2.5
3. Administration interface in WordPress 2.0

== Licence ==

Good news, this plugin is free for everyone! Since it's released under the GPL, you can use it free of charge on your personal or commercial blog. But if you enjoy this plugin, you can thank me and leave a [small donation](http://www.arnebrachhold.de/redir/sitemap-paypal "Donate with PayPal") for the time I've spent writing and supporting this plugin. And I really don't want to know how many hours of my life this plugin has already eaten ;)

== Translations ==

The plugin comes with various translations, please refer to the [WordPress Codex](http://codex.wordpress.org/Installing_WordPress_in_Your_Language "Installing WordPress in Your Language") for more information about activating the translation. If you want to help to translate the plugin to your language, please have a look at the sitemap.pot file which contains all defintions and may be used with a [gettext](http://www.gnu.org/software/gettext/) editor like [Poedit](http://www.poedit.net/) (Windows).
