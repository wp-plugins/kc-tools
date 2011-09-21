=== KC Tools ===
Contributors: krumch
Donate link: http://krumch.com/kctools.html
Tags: system info, environment info, DB access, DB, SSH, developers tools, tool
Requires at least: 3.0
Tested up to: 3.1.2
Stable tag: 20110601

Brain surgery for WEB-sites (System info, DB access and SSH over HTTP).

== Description ==

<p>KC Tools are a Wordpress plugin with several tools for "in deep" development and troubleshooting. It allows reading of environment info, direct database access and terminal-like interface with server. It is locked by password to your browser only, so you can use it on life sites securely. It do nothing else - no output on pages, no shortcodes, no widgets, nothing, only a new row in "Settings" in Admin area.
<br>
Sometimes, when develop something new or try to find problem somewhere, needs to read "raw" info. Thus, this plugin is the right tool. But it is too powerfull tool, so it is not for everyone.<br>
<br>
<b>Blogers, self-webmasters, average users</b>: This is not right tools for you. <a href="contacts.html">Contact me</a>, I can create anything what you will need, but leave this plugin away. It can (and will) destroy your site within seconds. No joke...<br>
<br>
<b>Developers</b>: Generally not for you too, but if you are brave enough, and want to learn - you are welcome. Sorry to repeat, but it is dangerous, because it is so powerfull. Imagine your plugin is a car - <a href="http://en.wikipedia.org/wiki/Nissan_Leaf" target="_blank">shiny and power</a> (80&nbsp;kW, 110&nbsp;hp). So Wordpress itself is a <a href="http://en.wikipedia.org/wiki/Truck" target="_blank">truck</a> (450 kW, 600 hp). This plugin is not a truck. It is not <a href="http://en.wikipedia.org/wiki/Locomotive" target="_blank">locomotive</a> (1,500&nbsp;kW, 2000 hp) too. Nor <a href="http://en.wikipedia.org/wiki/Haul_truck" target="_blank">haul truck</a> (2,610&nbsp;kW, 3,500&nbsp;hp). It is a <a href="http://en.wikipedia.org/wiki/Emma_M%C3%A6rsk" target="_blank">ship</a> (81&nbsp;MW, 109,000 hp), but it is not <a href="http://en.wikipedia.org/wiki/Falcon_Heavy" target="_blank">rocket</a>. Be warned...<br>
<br>
<b>Gurus</b>: It countain 3 tools. First allows to see environment variables and PHP init settings (yes, most images in admin panel gone at this page, np). Second allows direct communicatin with database, think about "mysql" command line tool. It is very light phpMyAdmin. Third is terminal-like tool, allowing command row, almost like SSH, but restricted to HTTPD user rights and no way to run continuous tasks like "top".</p>

== Installation ==

1. Create MD5 of your password
1. Put it in $thepassword variable at first code row in kstools.php
2. Don't forget to compress back to ZIP archive
1. Upload `kstools` directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Click "KC Tools" row in "Settings" within "Admin dashboard". First time you will be asked about password.

== Frequently Asked Questions ==

No questions, so far. Ask me, I will answer.

== Screenshots ==

1. ENV tab
2. DB tab
3. SHH tab

== Changelog ==

= 20110601 =
* The very first versions.

== Upgrade Notice ==

= 20110601 =
Well, how to update to initial version?


