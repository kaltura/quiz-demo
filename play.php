<?php
if (!isset($_GET['entry_id'])){
	die('Please pass ?entry_id= as a GET param');
}
$entry_id=$_GET['entry_id'];
// IMPORTANT NOTE: this file should either be outside the docroot or .htaccess rules must be defined to prevent downloading it as it contains sensitive info
require_once('/path/to/partner_info.inc');
// can be downloaded from https://github.com/kaltura/KalturaGeneratedAPIClientsPHP
require_once('/path/to/KalturaClient.php');
$config = new KalturaConfiguration($partner_id);
$config->serviceUrl = $service_url;
$client = new KalturaClient($config);
// generate a KS with a random user ID so that each request will be counted as a new submission of the quiz
$ks = $client->session->start($user_secret,'user_'.date('U'), KalturaSessionType::USER, $partner_id, null, null);
$client->setKs($ks);

?>
<div style="width: 60%;display: inline-block;position: relative;"> 
	<!--  inner pusher div defines aspect ratio: in this case 16:9 ~ 56.25% -->
	<div id="dummy" style="margin-top: 56.25%;"></div>
	<!--  the player embed target, set to take up available absolute space   -->
	<div id="kaltura_player" style="position:absolute;top:0;left:0;left: 0;right: 0;bottom:0;border:solid thin black;">
	</div>
</div>
<script src="https://<?php echo $cdn_host?>/p/<?php echo $partner_id?>/sp/<?php echo $partner_id?>00/embedIframeJs/uiconf_id/<?php echo $playback_ui_conf_id?>/partner_id/<?php echo $partner_id?>"></script>
<script>
    kWidget.embed({
	    "targetId": "kaltura_player",
	    "wid": "_<?php echo $partner_id?>",
	    "uiconf_id": <?php echo $playback_ui_conf_id?>,
	    "flashvars": {
		"streamerType": "auto",
		"ks":"<?php echo $ks?>"
	    },
	    "cache_st": 1450868353,
	    "entry_id": "<?php echo $entry_id?>"
    });
</script>
