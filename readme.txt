=== Birdfy - Twitter markups for Wordpress ===
Contributors: hildersantos
Tags: twitter, posts, users
Requires at least: 2.1
Tested up to: 3.1
Stable tag: 1.0.2.5
Donate link: http://hildersantos.com/donate/

Birdfy is a plugin that allows you to use @users and #hashtags markups on your posts and pages, and to link them to Twitter.

== Description ==

Tired of link every Twitter profile cited in your posts and pages? Birdfy allows you to automagically transforms your @users and #hashtags markups in your posts/pages into links to Twitter profiles/hashtags search.

All you have to do is install this plugin, and you're good to go.

**Features**

* Automatically discovers @ and # content into your posts and pages (excluding e-mails, dots after usernames and so on);
* You can disable users and/or hashtags discovery both globally or in individual posts/pages;
* Optionally, you can choose to open the links in a new window/tab.
	
**Usage**

Simply install the plugin and start to cite Twitter profiles by using @ before the twitter username you want to link, and the plugin will transform it into a link to the profile. Same with hashtags, by simply use # before any word - like in Twitter.

If you want to fine tune the plugin, you still can go to the Options page, named "Birdy Settings" (inside the Settings menu) and enable/disable the options you want. Remember that this options will act globally.

You may want to disable @users/#hashtags links in individual posts/pages also. In this case, just disable what you want in the box created inside your post/page administration page.	

== Installation ==

Drop Birdfy folder into /wp-content/plugins/ and activate the plug in the Wordpress admin area.

== Frequently Asked Questions ==

= Will this plugin make the @ and # links for my past posts and pages? =

Yup! Don't worry about that; the plugin will search and destr... oops, and generate the correct links for you. :)

= The links is not being generated in my excerpts. Why? =

Well... Actually because it don't. Maybe in the future, but by now, the plugins are only generated in the full post/page content.

= I activated the plugin, but I guess the links is not being generated. =

Make sure you don't have any cache plugin (like WP Supercache) running on your installation. If this is your case, just delete your cache and everything should be fine. If not, drop me a message at hilder[at]hildersantos.com and I'll look further on you problem - if I have time. ;)

== Changelog ==

= 1.0.2.5 =
* Fixed some regex bugs

= 1.0.2.4 =
* Fixed the problem with single @'s and #'s signals - it is no more creating empty links.

= 1.0.2.3 =
* Fixed some regex bugs

= 1.0.2.2 =
* Fixed some regex bugs

= 1.0.2.1 =
* Added pt_BR translation

= 1.0.2 =
* Added support to localization
* Corrected some bugs

= 1.0.0 =
* First release of Birdfy

== Upgrade Notice ==

= 1.0.2.5 =
* Fixed the problem with @users and #hashtags styling (like <em>, <strong>, etc). Thanks David Diaz for the report! :)

= 1.0.2.4 =
* Fixed problem with single @ ans #'s (was creating links before).

= 1.0.2.3 =
* Regex fixed... again.

= 1.0.2.2 =
* This version has the problem with regex fixed.

= 1.0.2.1 =
This version localizes the Birdfy on Portuguese (Brazilian) language.

= 1.0.2 =
This version adds support to i18n and have some bugs fixed (like the one that does not come with the hashtags link generation activated by default).

= 1.0.0 =
This is the first stable release of Birdfy.

== Contact ==

Want to contact me? Just drop me your suggestion, bug, congratulations and so on at hilder[at]hildersantos.com, or contact me on my [contact page](http://hildersantos.com/contato "Link to my contact page").