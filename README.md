# quiz-demo
A small demo for utilising Kaltura's Quiz capabilities

## Requires:
* PHP 5.3 and above
* Kaltura PHP5 clinetlibs which can be downloaded from https://github.com/kaltura/KalturaGeneratedAPIClientsPHP
* A partner ID, secret and admin_secret on Kaltura's SaaS
* The partner must have the "Quiz - Cue Points" permission set. If on SaaS, contact support to enable it, on a self hosted ENV, go to admin console->publishers->your partner->actions->configure->check "Quiz - Cue Points"

## Setup
* Place partner_info.inc outside of your docroot and make it readable to the apache user or place under docroot but set proper .htaccess to avoid download
* Edit partner_info.inc and set needed values
* Place all other files under your docroot
* Edit index.php, report.php and play.php so that the path to KalturaClient.php and partner_info.inc reflects your ENV
* If your partner does not have quiz enabled players, run:
```
php create_quiz_bse_player.php <service_url> <partner_id> <secret> <player_ver> quiz_bse_player.json 
php create_quiz_player.php <service_url> <partner_id> <secret> <player_ver> quiz_player.json
```

## Contents:
* partner_info.inc - global vars needed to establish a KS [Kaltura Session]
* index.php - accepts an entry ID as a GET param, generates an ADMIN KS and loads Kaltura Editor Application [KEA] as an iframe 
* play.php - generates a USER KS with a random userId and loads a Quiz enabled Kaltura player [defined in partner_info.inc]
* report.php - shows basic quiz submission stats
* util_functions.php - a collection of small utility functions used in report.php to display quiz submission stats.
* create_quiz_player.php - help script to create a quiz player, needed to show quiz questions
* create_quiz_bse_player.php - help script to create a quiz BSE player, needed to add/edit a quiz
* quiz_player.xml - config file for quiz player, used by create_quiz_player.php
* quiz_bse_player.xml - config file for quiz BSE player, used by create_quiz_bse_player.php
