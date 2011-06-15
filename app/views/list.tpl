<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<script type="text/javascript" src="/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jquery.raty/js/jquery.raty.min.js"></script>

  
<script type="text/javascript">
  $(function() {
  <?php  foreach ($entries as $entry): ?>
	  $('#rating<?php echo $entry['id'] ?>').raty({
		  path: '/wp-content/plugins/wpGuidebookPlugin/vendor/jquery.raty/img/',	  
		  half: true,
		  start: <?php echo $entry['rating']?>,
		  click: function(score, evt) {
		      var obj = this;
			  $.post("/wp-content/plugins/<?php echo $plugin_dir ?>/vote.php", {id: <?php echo $entry['id'] ?>, score: score}, function(response){ $(obj).next().next().html(response); });
		  }
	  });
  <?php endforeach ?>
	
  });
</script>

<link rel="stylesheet" type="text/css" href="/wp-content/plugins/<?php echo $plugin_dir ?>/app/web/css/styles.css" />

<div>
<div class="add-new">
    <?php if ($admin): ?>
   <a href="/?guidebook/new/">добавить трассу</a>
 <?php endif ?>	
</div>
  <?php  foreach ($entries as $entry): ?>
    <div class="entry">
      <div class="entry-image">
	    <img src="<?php echo $entry['image'] ?>" width="200" height="150" />
	  </div>
	  <div class="entry-info">
	    <div class="entry-info-header">
		  <div class="entry-title">
		    <h3><?php echo $entry['title'] ?></h3>
		  <div id="rating<?php echo $entry['id'] ?>" class="scores"></div>
			<strong>Рейтинг:</strong> <span class="rating-numbers"> <?php echo $entry['rating'] ?></span>
          </div>
		  <div class="emtry-level">
		    <strong>Сложность:</strong> <?php echo $entry['level'] ?>
		  </div>
		  <div class="passed-at">
		    <strong>Дата накрутки:</strong> <?php setlocale(LC_TIME, 'ru_RU'); echo strftime('%e %b %g', strtotime($entry['passed_at'] )) ?>
		  </div>
		  <div class="author">
		    <strong>Автор:</strong> <?php echo $entry['author'] ?>
		  </div>
		</div>
		<div class="entry-info-description">
		  <?php echo substr($entry['description'], 0, 306) ?>
		  <a href="/?guidebook/<?php echo $entry['climbing_wall_id'] ?>/<?php echo $entry['id'] ?>/">...</a>
		</div>
	  </div>
    </div>
      <?php if ($admin): ?>
	    <a href="/?guidebook/<?php echo $entry['climbing_wall_id'] ?>/<?php echo $entry['id'] ?>/edit/">редактировать</a>
	  <?php endif ?>	
  <?php endforeach ?>

    
</div>