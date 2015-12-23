<?php
$partner_id=0;
// this should ideally be https://www.kaltura.com, at the moment, using HTTP cause of a bug in the SaaS config, prevent the latest version of clientlibs from using https://www.kaltura.com as service_url.
$service_url="";
// ADMIN secret:
$secret='';
// USER secret
$user_secret='';
$cdn_host='';
// the ID for the uiconf used for playing back the quiz entry. Used in play.php
// index.php uses KEA which automatically selects a player to edit with based on:
//'filter:objectType': 'KalturaUiConfFilter',
//'filter:tagsMultiLikeOr' : 'kea_'+KEA_VERSION,
//'service': 'uiConf',
//'action': 'listTemplates'
$playback_ui_conf_id=0;
?>

