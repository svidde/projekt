<?php 
if ( isAuthenticated() ) 
{
?>
  
<h1>Forum</h1>
<p>Här kan du skriva ett nytt inlägg.</p>

<form action="<?=$formAction?>" method='post'>
  <p>
    <label><br/>Message: <br/>
    <textarea name='message' style='width:500px;height:100px;'></textarea></label>
    <input type="hidden" name="author" value="<?=getNameOfUser()?>" /> 
  </p>
  <p>
  <input type='submit' name='doAddForum' value='Lägg till foruminlägg' />
  </p>
</form>




<?php 
if ( $entries != null )
{

?>
<h2>Current messages</h2>
<?php
foreach($entries as $val):
$id  = $val['id'];
?>
<table>
  <tr>
    <td style='text-align:left;'> Author: <?=$val['author']?> </td>
    <td style='text-align:right;'> At: <?=$val['created']?> </td>
  </tr>
  <tr>
    <td colspan="2"> <?=nl2br(CHTMLPurifier::purify($val['message']) )?> </td>
  </tr>
  <tr>
  <?php 
  if ( hasAdmRole() )
  {  
  ?>
  
  <td style='text-align:right;'>
    <form action="<?=$formAction?>"  method='post'>
    <input type="hidden" name="id" value="<?=$id?>" /> 
    <input type='submit' name='doDelForumComment' value='Radera' class="submitbtn" /></td>
    <td style='text-align:right;'>  <input type='submit' name='doAddForumComment' value='Kommentera' class="submitbtn" />  </td>
    </form>
    </td>
    
  <?php } 
  else
  {
  ?>
  	
    <td colspan="2" style='text-align:right;'>
    <form action="<?=$formAction?>"  method='post'>
    <input type="hidden" name="id" value="<?=$id?>" /> 
    <input type='submit' name='doAddForumComment' value='Kommentera' class="submitbtn" /> 
    </form>
    </td>
    
    <?php
  }
  ?>
  </tr>
</table>
 
<?php endforeach;?>
<?php } ?>
<?php
}
else
{
	?>
	<h1>Ej tillträde</h1>
	<p>Du måste vara inloggad för att få vara här.<p>
	<?php
}
?>
