<?php
foreach($images as $val):?>

<div style='text-align:center;'>
<?php
if ( $size == 'big'  )
{?>
  <img src="<?=img_url( $val['filename'] )?>" alt="<?=$val['title']?>" width="300" />  <br />
  <?php
}
else
{?>
  <img src="<?=img_url( $val['filename'] )?>" alt="<?=$val['title']?>" width="150" />  <br />
  <?php
} ?>
	
  <p>Fotograf: <?=$val['photographer']?> </p>
</div>

<?php endforeach;?>


