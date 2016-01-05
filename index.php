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
$ks = $client->session->start($secret, null, KalturaSessionType::ADMIN, $partner_id, null, null);
$client->setKs($ks);
// check whether this entry already has quiz object
$filter = new KalturaQuizFilter();
$filter->entryIdEqual = $entry_id;
$pager = null;
$quizPlugin = KalturaQuizClientPlugin::get($client);
$result = $quizPlugin->quiz->listAction($filter, $pager);
// if it does not, create one
if (count($result->objects) === 0 ){
	$quiz = new KalturaQuiz();
	$result = $quizPlugin->quiz->add($entry_id, $quiz);
}
?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Kaltura Quiz Editor</title>
    <script type="text/javascript" language="javascript">
        window.keaDelegate = {
            //'uiconf_id' : '{OPTIONAL_PLAYER_ID}',
            'ks' : <?php echo "'".$ks."'"?>,
            'partner_id' : <?php echo "'".$partner_id."'"?>,
            'service_url' : <?php echo "'".$service_url."'"?>,
            'cdn_host' : <?php echo "'".$cdn_host."'"?> 
        };

        function handleKeaMessages(event) {
            try {
                var data = JSON.parse(event.data);
            }
            catch (e) {
                console.log('Failed to parse message:', event.data);
                return;
            }
            switch (data.message) {
                case "keaInitParams" :
                    event.source.postMessage(JSON.stringify(window.keaDelegate), event.origin);
                    break;
                case "entryInfoChanged" :
                    console.log ("Entry info has changed, " + data.entry_id);
                    break;
            }


        }

        if (window.addEventListener) {
            // For standards-compliant web browsers
            window.addEventListener("message", handleKeaMessages, false);
        }
        else {
            window.attachEvent("onmessage", handleKeaMessages);
        }


    </script>
</head>
<body>
<iframe id="kaltura_editor" src="#"  width="100%" height="710" allowfullscreen webkitallowfullscreen mozAllowFullScreen frameborder="0"></iframe>
<script type="text/javascript" language="javascript">
    var iframeUrl = "https://www.kaltura.com/apps/kea/v0.18.0/index.html#/index/" + <?php echo "'".$entry_id."'"?>;
    document.getElementById("kaltura_editor").src = iframeUrl;
</script>
<div align=center><a href="play.php?entry_id=<?php echo $entry_id?>">TAKE THE QUIZ</a></div>
<br>
<div align=center><a href="report.php?entry_id=<?php echo $entry_id?>">VIEW REPORT</a></div>
</body>
</html>
