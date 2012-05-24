<?php
$activeOrNot = false;
?>
<h1>Nyheter</h1>
<?php 
$idOfMain = "";
?>
<?php foreach($forum as $val):
$idOfMain = $val['id'];
?>

 <h2><?=esc($val['title'])?></h2>
    <p class='smaller-text'><em>Posted on <?=$val['created']?> by <?=$val['owner']?></em></p>
    <p><?=filter_data($val['data'], $val['filter'])?></p>
   
<?php endforeach;?>

<?php if ( isAuthenticated() )
{
	?>

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
  <input type='submit' class="btn" name='doAddNews' value='Lägg till Kommentar' />
  </p>
</form>


</div>

<?php
}
?>

<?php 
if ( $entries != null )
{
?>

<h2>Kommentarer</h2>
<?php foreach($entries as $val):?>

<table>
  <tr>
  <td style='text-align:right;'>At: <?=$val['created']?></td>
    
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

