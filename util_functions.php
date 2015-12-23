<?php
// a collection of small utility functions used in report.php to display quiz submission stats.

define('AVERAGE_QUIZ_SCORE_HEADER', 'average');

function getQuizAverageScores($client,$entryId)
{
	//default filter is enough
	$filter = new KalturaReportInputFilter();
	$resultObject = $client->report->getTotal(KalturaReportType::QUIZ, $filter, $entryId);
	return extractQuizAverageScore($resultObject);
}

function truncatePercentageString($percentage){
	$dotPos = strpos($percentage, '.');
	if($dotPos){
	    $percentage = substr($percentage, 0, $dotPos);
	}
	return $percentage;
}

function extractQuizAverageScore($resultObject)
{
	if (!empty($resultObject) && !empty($resultObject->header)){
	    if ($resultObject->header === AVERAGE_QUIZ_SCORE_HEADER) {
		if($resultObject->data != null && $resultObject->data != ""){
		    $averageScore = truncatePercentageString(floatval($resultObject->data) * 100) . '%';
		}
	    }
	}
	return $averageScore;
}
function getQuestionUserAnswers($client,$entryId,$pageSize, $page)
{
	$filter = new KalturaAnswerCuePointFilter();
	$filter->entryIdEqual = $entryId;
	$cuepointPlugin = KalturaCuepointClientPlugin::get($client);
	$resultObject = $cuepointPlugin->cuePoint->listAction($filter, null);
	$users = array();
	// only leave non-anonymous users answers
	foreach ($resultObject->objects as $answer) {
	    if (!empty($answer->userId)) {
		if ($answer->isCorrect){
			@$users[$answer->userId]['correct_answers'] +=1 ;
		}else{
			@$users[$answer->userId]['incorrect_answers'] +=1 ;
		}
	    }
	}
	return $users;
}

