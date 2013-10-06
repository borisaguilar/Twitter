Twitter Ionize CMS Module
=======================

Version : 0.2

october 2013

### About Twitter Module

Twitter Ionize CMS Module is a module that allows for a designer to include tweets
and style them as desired, using tags within Ionize and by simply activating 
a module and the twitter user data needed. Tags for displaying tweets are available.
Currently tweets are cached by a time-frame interval defined in module configuration.

### Author

* [Boris Aramis Aguilar R.](http://borisaguilar.com)

### Installation

* Copy "Twitter" directory inside Ionize's CMS modules directory.
* Go to admin panel inside Ionize and enable the module (modules->administration->Twitter module->Install)
* Click on "Twitter module"
* Add a twitter user (you need to have: account's access token, access token secret, consumer key and consumer secret) you can obtain all the needed data from dev.twitter.com/apps and creating a new app and consulting your Access token and Access token secret
  

### Tags available for usage in views && example usage

<ion:twitter:tweets max="4">
<a href="http://twitter.com/<ion:tweet field="screen_name" />">@<ion:tweet field="screen_name" /></a>
<ion:tweet field="text" />
</ion:twitter:tweets>

* ion:twitter:tweets accepts the optional parameter max, it tells how much tweets to load, any number above 20 will just load the last 20 tweets cached.
* ion:twitter:tweets:tweet has the "field" parameter; possible values are:
** screen_name: displays the twitter account name.
** text: displays the tweet's content.
** userurl: if the user has a url in his profile this parameter shows it up.
** id_tweet: displays twitter's internal id.

### Credits
* Twitter module for Ionize CMS written by [Boris Aramis Aguilar R.](http://borisaguilar.com).
* The twitter interal OAuth library being used is: PHP TwitterOAuth by [Abraham Williams](https://twitter.com/abraham).