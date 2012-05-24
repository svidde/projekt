<?php
$activeOrNot = false;
?>
<h1>Forum</h1>
<p>En forumtråd.</p>
<?php 
$idOfMain = "";
?>
<?php foreach($forum as $val):
$idOfMain = $val['id'];
?>
<!--  här ska jag ha en tabell för att skriva ut meddelandet som man klickat på -->
<table>
  <tr>
  <td style='text-align:right;'>At: <?=$val['created']?> ID: <?=$val['id']?> </td> 
  </tr>
  <tr>
    <td><?=nl2br(CHTMLPurifier::purify($val['message']) )?> </td>
  </tr>
  <tr> 
    <td>Author: <?=$val['author']?></td>
  </tr>
</table>
<?php endforeach;?>


<div id="comment" >
<h2>Skriv ny kommentar</h2>

<form action="<?=$formAction?>" method='post'>
  <p>
    <label>Message: <br/>
    <textarea name='message' style='height:50px;'></textarea></label>
    <input type="hidden" name="author" value="<?=getNameOfUser()?>" /> 
    <input type="hidden" name="id" value="<?=$idOfMain?>" /> 
  </p>
  <p>
  <input type='submit' name='doAddComment' value='Lägg till Kommentar' />
  </p>
</form>


</div>



<?php 
if ( $entries != null )
{
?>

<h2>Current messages</h2>
<?php foreach($entries as $val):?>

<table style='background-color:#f6f6f6;padding:1em;'>
  <tr>
  <td style='text-align:right;'>At: <?=$val['created']?> ID: <?=$val['id']?></td>
    
  </tr>
  <tr>
    <td><?=nl2br(CHTMLPurifier::purify($val['message']) )?> </td>
  </tr>
  <tr>
   <td>Author: <?=$val['author']?></td>
  </tr>
</table>
 
<?php endforeach;?>
<?php } ?>

