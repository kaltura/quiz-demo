# quiz-demo
A small demo for utilising Kaltura's Quiz capabilities

## Requires:
* PHP 5.3 and above
* Kaltura PHP5 clinetlibs which can be downloaded from https://github.com/kaltura/KalturaGeneratedAPIClientsPHP
* A partner ID, secret and admin_secret on Kaltura's SaaS

## Setup
* Place partner_info.inc outside of your docroot and make it readable to the apache user or place under docroot but set proper .htaccess to avoid download
* Edit partner_info.inc and set needed values
* Place all other files under your docroot

## Contents:
* partner_info.inc - global vars needed to establish a KS [Kaltura Session]
* index.php - accepts an entry ID as a GET param, generates a KS and loads Kaltura Editor Application [KEA] as an iframe 
* play.php - generates a KS with a random userId and loads a Quiz enabled Kaltura player [defined in partner_info.inc]
* report.php - shows basic quiz submission stats
* util_functions.php - a collection of small utility functions used in report.php to display quiz submission stats.

