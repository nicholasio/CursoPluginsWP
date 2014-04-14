=== BlackBox Debug Bar ===
Contributors: gwin
Tags: debugging, debug bar
Requires at least: 3.0.0
Tested up to: 3.5.1
Stable tag: trunk

BlackBox is a plugin for plugin and theme developers. It collects and displays useful debug information (errors, executed queries, globals, profiler).

The icons are property of http://www.gentleface.com/free_icon_set.html, used on Creative Commons Attribution-NonCommercial license.

== Description ==

BlackBox is symfony like unobstrusive debug bar attached to the top of the browser window.

How can it help you with development:
1. instantly inspect global variables (GET, POST, COOKIE, SERVER)
2. debug both frontend and admin area
3. executed MySQL queries and time it took to execute each query (useful for finding slow queries)
4. profiler for measuring performance of your plugins and themes
5. errors occurred when loading WordPress page

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload plugin to `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Done!

== Screenshots ==

1. Glabal variables foramted using var_export() function, syntax coloring using awesome highlight.js library (75% zoom) 
2. Profiler tab. Displays checkpoint name, time passed since profiler start and current memory usage (75% zoom) 
3. SQL tab. Displays each query execution time and the executed queries. Syntax highlighting using highlight.js library (75% zoom) 
4. Errors tab. Displays error type and the error message. If the error occured more then once  its type is displayed as "Notice (X)" where X is the number of error occurances.

