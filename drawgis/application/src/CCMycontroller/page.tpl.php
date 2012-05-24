<?php if($content['id']):?>
  <h1><?=esc($content['title'])?></h1>
  <p><?=$content->getFilteredData()?></p>
  
  	<?php if($news != null):?>
  	 <?php foreach($news as $val):?>
  	 <h2><?=esc($val['title'])?></h2>
  	 <p class='smaller-text'><em>Posted on <?=$val['created']?> by <?=$val['owner']?></em></p>
  	 <p><?=filter_data($val['data'], $val['filter'])?></p>
  	 <?php endforeach; ?>
  	<?php else:?>
  	<?php endif;?>

<?php else:?>
  <p>404: No such page exists.</p>
<?php endif;?>

