<?php
if (count($argv)<4){
	echo 'Usage:' .__FILE__ .' <service_url> <partner_id> <secret> <player_ver> </path/to/player.json>'."\n";
        exit (1); 
}

require_once('/opt/kaltura/web/content/clientlibs/php5/KalturaClient.php');
$userId = null;
$expiry = null;
$privileges = null;
$secret = $argv[3];
$type = KalturaSessionType::ADMIN;
$partnerId=$argv[2];
$config = new KalturaConfiguration($partnerId);
$config->serviceUrl = $argv[1];
$player_ver=$argv[4];
$client = new KalturaClient($config);
$ks = $client->session->start($secret, $userId, $type, $partnerId, $expiry, $privileges);
$client->setKs($ks);
$uiConf = new KalturaUiConf();
$uiConf->name = 'Quiz BSE player';
$uiConf->description = "Quiz BSE player created via API";
$uiConf->objType = 8; 
$uiConf->width = 528; 
$uiConf->height = 327; 
$uiConf->htmlParams = '';
$uiConf->swfUrl = "/flash/kdp3/v$player_ver/kdp3.swf";
$uiConf->config = file_get_contents($argv[5]);
$uiConf->creationMode=2;
$uiConf->useCdn = '1';
$uiConf->swfUrlVersion = '3.9.9';
$uiConf->tags="autodeploy, kms_v5.0.0, kms_kdp3,player,html5v2,quiz_player,bse";
$uiConf->html5Url="/html5/html5lib/$player_version/mwEmbedLoader.php";
$uiConf->version=2;
$results = $client->uiConf->add($uiConf);
echo "Generated UI conf id : ".$results->id ."\n";
?>
