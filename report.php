
<?php
if (!isset($_GET['entry_id'])){
	die('Please pass ?entry_id= as a GET param');
}
$entry_id=$_GET['entry_id'];
// IMPORTANT NOTE: this file should either be outside the docroot or .htaccess rules must be defined to prevent downloading it as it contains sensitive info
require_once('/path/to/partner_info.inc');
// can be downloaded from https://github.com/kaltura/KalturaGeneratedAPIClientsPHP
require_once('/path/to/KalturaClient.php');
require_once('util_functions.php');
$config = new KalturaConfiguration($partner_id);
$config->serviceUrl = $service_url;
$client = new KalturaClient($config);
$ks = $client->session->start($secret,null, KalturaSessionType::ADMIN, $partner_id, null, null);
$client->setKs($ks);
?>
<HTML>
<HEAD>
<TITLE>Quiz report for entry ID: <?php echo $entry_id?></TITLE>
</HEAD>
<BODY>
<?php
echo "Average Quiz Score: ". (getQuizAverageScores($client,$entry_id)).'<br>';
echo "<pre>";
var_dump(getQuestionUserAnswers($client,$entry_id,100,1));
?>
</BODY>
</HTML>
