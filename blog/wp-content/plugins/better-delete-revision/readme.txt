=== Plugin Name ===
Contributors: Galerio, Urda
Donate link: http://www.1e2.it/donazione
Tags: better delete revision, revision, delete, remove, removal, revision removal, delete revision, disable revision, no revision, revision manager, manage revision, remove revision, post revision, page revision, optimize database, database optimization, optimize, fast, light, faster, lighter, speed up
Requires at least: 2.7
Tested up to: 3.1
Stable tag: 1.2

Remove and delete old revision of posts, pages and related meta content completely then optimize Database: reduce size and optimization to speed up!

== Description ==

Better Delete Revision not only deletes redundant revisions of posts from your Wordpress Database, it also deletes other database content related to each revision such meta information, tags, relationships, and more.
Better Delete Revision is based on the old "Delete Revision" plugin but it is compatible with the latest version of Wordpress (3.x) with improved features.
= Your current published, scheduled, and draft posts are never touched by this plugin! =
This plugin can also perform optimizations on your Wordpress database. With optimization and old revision removal this plugin will keep your database lighter and smaller throughout use. Removing old revisions and database optimizations is one of the best things you can do to your Wordpress blog to keep it running as fast as it can.

Wordpress MU or customs installation (like some pre-made installation of some Hosting Providers) are not yet supported. Wordpress MU support is in our TODO list.

Post Revisions are a feature introduced in Wordpress 2.6. Whenever you or Wordpress saves a post or a page, a revision is automatically created and stored in your Wordpress database. Each additional revision will slowly increase the size of your database. If you save a post or page multiple times, your number of revisions will greatly increase overtime. For example, if you have 100 posts and each post has 10 revisions you could be storing up to 1,000 copies of older data! The Better Delete Revision plugin is your #1 choice to quickly and easily removing revision from your Wordpress database. Try it out today to see what a lighter and smaller Wordpress database can do for you!

Home Page: http://www.1e2.it/tag/better-delete-revision on www.1e2.it

= Remember to VOTE IT !!! Thanks =

Thanks goes to Urda for version 1.1

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `better-delete-revision.zip` to the '/wp-content/plugins/' directory
2. Unzip the better-delete-revision.zip to the '/wp-content/plugins/better-delete-revision/' directory
3. Activate the plugin through the 'Plugins' menu in WordPress

= Upgrade Notice =

Just copy the new files over the old ones or use the automatic upgrade function of your Wordpress.

== Frequently Asked Questions ==

= What does it have more than Delete Revision or Revision Removal or other similar plugin? =

It has the ability to remove completely the revision posts and pages and related meta tag, description and other things that are useless. The other plugins doesn't really remove all the waste things.

= To clean datebase is safe? =

Yes, it's very safe

= Will not affect the normal published post? =

No. The revision posts is redundancy, is not same to the normal posts. For this reason they can be safely removed to save space, increase database speed.

== Screenshots ==

1. Revision Removal Control Panel.
2. Database Optimization.


== Changelog ==
= 1.2 =
* Used the Role and Capabilities system instead of User Level

= 1.1 = 
* 2010-10-21  v1.1
* English corrections
* Function cleanup
* Source code cleanup
* Moved various strings into functions
*           = by Urda =
            
= 1.0 =
* Just completed test on wordpress 3.0.1

== Todo ==

- General
    * Clean up code to fit within an 80-character margin limit. Not only doe this assit with various code editors, it forces the programmer to keep the code clean and effecient!
    * Move strings into a constant file, for easier updating and tracking.
    * Create a CSS file in charge of handling styles for look and feel.
    
- Internationalization
    * Needs to be done correctly, some code is using 'echo', other code is using the _e() calls from Wordpress. Either Internationalization needs to be implemented, or yank it all together for the time being.

- SQL Related
    * Add sometime of documentation explaining each and every SQL query
    * Possibly Move SQL queries into abstracted file?
    * Clean up SQL (ID vs `ID`)
    * Remove revisions also for Worpdress MU