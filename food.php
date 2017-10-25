<?php

function food() {

$feed = 'http://skolmaten.se/it-gymnasiet/rss/weeks/';
$content = file_get_contents($feed);
$x = new SimpleXmlElement($content);

$food = [];

foreach ($x->channel->item as $entry) {

	$day = (string) $entry->title;
	$lunch = (string) str_replace("<br/>", "<br>Alt: ", $entry->description);

	$food[] = $lunch;
}

$food = array_combine(range(1, count($food)), array_values($food));
return $food;

}

?>