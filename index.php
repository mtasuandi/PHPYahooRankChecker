<?php
/**
	@package	: Yahoo! RankChecker
	@author		: M Teguh A Suandi
	@license	: Creative Common License (http://creativecommons.org/licenses/by/3.0/)
*/
include("YahooRankChecker.class.php");
$RankChecker	= new YahooRankChecker(100);
$run			= $RankChecker->yahooFind('id', 'mtasuandi');
var_dump($run);
?>