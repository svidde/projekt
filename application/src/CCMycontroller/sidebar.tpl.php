<div id='rss'>

<?php

if ( $xml != null )
{

$count = 0;
'<div>';
foreach ($xml->channel->item as $item) :
if($count < 5){?>
 
<a href='<?=$xml->channel->item[$count]->link?>' target= _blank>'<?=$xml->channel->item[$count]->title?>'</a>
<div id=date><?=$xml->channel->item[$count]->pubDate?></div>
<br>
 
<?php $count++;
}
endforeach;

}
?>

</div>
