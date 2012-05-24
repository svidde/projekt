<table style='background-color:#f6f6f6;padding:1em;'>
<?php 
$count = 1;

foreach($images as $val):?>

<tr style='text-align:center;'>
  <td> <img src="<?=img_url( $val['filename'] )?>" alt="<?=$val['title']?>" width="300" />  <br />
  Fotograf: <?=$val['photographer']?>
  </td>
</tr>

<?php endforeach;?>

 </table>
