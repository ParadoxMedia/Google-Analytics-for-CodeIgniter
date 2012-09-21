Google-Analytics-for-CodeIgniter
================================

Google Analytics Dashboard Module for CodeIgniter (BETA)

Features
------------------------

Features added into the initial release of this plugin:

* OAuth 2.0 Authentication
* Google Analytics API setup & connection
* Retrieve data about the current month (example)

-- More documentation to be added soon


Known Issues
------------------------

Errors/issues where im working on / struggeling with, and where you can assist me with:

* When a token expires, no new token is created (3600 seconds token expire) :: (IN PROGRESS).
* Chain looping in some browsers for token request (FIXED)


Installation & How To
------------------------

Signup for the API here: https://code.google.com/apis/console
Generate the following keys:

* ga_appname	    :: is the name of your app, used for authenticaion
* ga_clientid 	    :: is the id of the client
* ga_clientsecret	:: is the secret key of your app auth
* ga_redirect_uri  	:: is the redirect_uri of the app auth || blank for default
* ga_devkey			:: is the developer key used for the API
* ga_projectid		:: is the project ID of the current GA Acc

Note: project id can be difficult to find, if that is your case checkout this img:
http://enarion.net/wp-content/uploads/2012/03/01_analytics_url.png
Big thanks to the guys at Enarion for that.


Parameters (NOT IMPLENTED YET)
------------------------

Available parameters for writing queries to the Google API. Soon available.

* $start 	=> Start day from where it should pull it's from (STRING w/ date())
* $end	 	=> Day where it should stop pulling data. (STRING w/ date())
* $metrics	=> Parameters of selecting the data. e.g. ga:visits or ga:pageviews (STRING)