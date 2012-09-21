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

* When a token expires, no new token is created (3600 seconds token expire).
* Chain looping in some browsers for token request


Parameters
------------------------

Available parameters for writing queries to the Google API

* $start 	=> Start day from where it should pull it's from (STRING w/ date())
* $end	 	=> Day where it should stop pulling data. (STRING w/ date())
* $metrics	=> Parameters of selecting the data. e.g. ga:visits or ga:pageviews (STRING)