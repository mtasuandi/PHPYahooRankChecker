<?php
/**
	@package	: Yahoo! RankChecker
	@author		: M Teguh A Suandi
	@email 		: teguh.andro@gmail.com
	@license	: Creative Common License (http://creativecommons.org/licenses/by/3.0/)
*/
if(!class_exists('YahooRankChecker'))
{
	class YahooRankChecker
	{
		public $end;
		
		public function __construct($end=100)
		{
			$this->end		= $end;
		}
		
		public function yahooFind($yahoodomain="", $keyword)
		{
			$i	= 1;
			for($end=($this->end/$this->end);$end<=$this->end-9;$end+=10)
			{
				if(empty($yahoodomain))
				{
					$domain	= "";
				}
				else
				{
					$domain = $yahoodomain.".";
				}
				
				$keyword	= str_replace(" ","+",$keyword);
				$url		= "http://".$domain."search.yahoo.com/search?p=".$keyword."&b=".$end."";
				set_time_limit(120);
				$data		= file_get_contents($url);
				$dom 		= new DomDocument();
				@$dom->loadHTML($data);
				$finder 	= new DomXPath($dom);
				$classname	= "url";
				$nodes 		= $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
				$tmp_dom 	= new DOMDocument();
				
				foreach($nodes as $node) 
				{
					$node 		= $tmp_dom->appendChild($tmp_dom->importNode($node,true));
					$site 		= $node->nodeValue;
					$rank		= $i++;
					$result[]	= array("link" => $site, "rank" => $rank);
				}
			}
			return $result;
		}
	}
}
?>
