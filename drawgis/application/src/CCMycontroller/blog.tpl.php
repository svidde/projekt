<h1>Blog</h1>
<p>All nice news and blogposts about me.</p>

<?php if($contents != null):?>
  <?php foreach($contents as $val):
  $id  = $val['id'];
?>
    <h2><?=esc($val['title'])?></h2>
    <p class='smaller-text'><em>Posted on <?=$val['created']?> by <?=$val['owner']?></em></p>
    <p><?=filter_data($val['data'], $val['filter'])?></p>
    <p> 
    <form action="<?=$formAction?>" method='post'>
    <input type="hidden" name="id" value="<?=$id?>" /> 
    <input type='submit' name='doAddNewsComment' value='Visa' />
    </form>
    <!-- <td> <a href="comment?id=$id">Kommentera</a> <td> -->
  </p>
  <?php endforeach; ?>
<?php else:?>
  <p>No posts exists.</p>
<?php endif;?>


  
