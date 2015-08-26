<?php
header('Content-type:application/json;charset=utf-8');
$xml=simplexml_load_file("videos.xml") or die("Error: Cannot create object");
//$xml=simplexml_load_file("https://www.youtube.com/feeds/videos.xml?playlist_id=PL4HaMRVB8id5GkiOyie4q4N2SQMCyRx_v") or die("Error: Cannot create object");

$count = 0;
$list = '';
$item = array();
foreach ($xml->entry as $value){
	$pxml = $value->children();
	$title = (string)$pxml->title;
	$author = (string)$pxml->author->name;
	 $id = str_replace('yt:video:', '', $pxml->id);
	 if ($count == 0 ){
	 $default_video = $id;
	 }
	 $count++;
	 $thumbnail = "http://img.youtube.com/vi/".$id."/default.jpg";
	 
	 $item[] = array('title'=> $title,
	 'author' => $author,
	 'id' => $id,
	 'thumbnail' => $thumbnail);
	 /*
	 
	 $image = '<img src="'.$thumbnail.'" alt="'.$title.'" />';
	 
	 $list .= '<li>';
	 $list .= '<a href="'.$id.'">';
	 $list .= $image. ' <h2>' . $title . '</h2>';
	 $list .= '<p>' . $author . '</p>';
	 $list .= '</a>';
	 $list .= '</li>'. "\\n";
	 
	 */
	//print_r($value);
	//print_r($pxml->id);
}

//print_r($item);
$send = array();
$send['default_video'] = $default_video;
$send['list'] = $item;
$json = json_encode($send);

echo $json;

//print_r($xml);
?>
