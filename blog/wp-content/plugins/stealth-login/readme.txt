=== Stealth Login ===
Contributors: skullbit, devbit
Donate link: http://skullbit.com/donate
Tags: login, logout, htaccess, custom, url, wp-admin, admin
Requires at least: 2.3
Tested up to: 2.7.1
Stable tag: 1.3

Create custom URL's for logging in, logging out and registering for your WordPress blog.

== Description ==

This plugin allows you to create custom URLs for logging in, logging out, administration and registering for your WordPress blog.  Instead of advertising your login url on your homepage, you can create a url of your choice that can be easier to remember than wp-login.php, for example you could set your login url to http://www.myblog.com/login for an easy way to login to your website.  

You could also enable "Stealth Mode" which will prevent users from being able to access 'wp-login.php' directly.  You can then set your login url to something more cryptic.  This won't secure your website perfectly, but if someone does manage to crack your password, it can make it difficult for them to find where to actually login.  This also prevents any bots that are used for malicious intents from accessing your wp-login.php file and attempting to break in.

== Installation ==

1. Upload the `stealth-login` directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Set the options in the Settings Panel

== Frequently Asked Questions ==

= Somethings gone horribly wrong and my site is down =

Though extremely unlikely, if the plugin does cause you problems, first delete the `stealth-login` directory from your `wp-content/plugins/` directory.  Then, if still encountering issues, delete your .htaccess file.  You will need to resave your Permalinks settings once your site is back online.

== Screenshots ==

1. Settings - Stealth Mode Disabled
2. Settings - Stealth Mode Enabled