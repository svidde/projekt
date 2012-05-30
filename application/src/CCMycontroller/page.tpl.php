<?php if($content['id']):?>
  <h1><?=esc($content['title'])?></h1>
  <p><?=$content->getFilteredData()?></p>
  
  
  	<?php if($news != null):?>
  	<div id="news">
  	 <?php foreach($news as $val):?>
  	 <h2><?=esc($val['title'])?></h2>
  	 <p class='smaller-text'><em>Posted on <?=$val['created']?> by <?=$val['owner']?></em></p>
  	 <p><?=filter_data($val['data'], $val['filter'])?></p>
  	 <?php endforeach; ?>
  	 </div>
  	<?php else:?>
  	<?php endif;?>
   
  	<?php if($pic != null):?>
  	 <?php foreach($pic as $val):?>
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
  	 <?php endforeach; ?>
  	<?php else:?>
  	<?php endif;?>
  	
   
<?php else:?>
  <p>404: No such page exists.</p>
<?php endif;?>

