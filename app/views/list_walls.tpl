<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<script type="text/javascript" src="/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jquery.raty/js/jquery.raty.min.js"></script>

  
<script type="text/javascript">
  $(function() {
  
  });
</script>

<link rel="stylesheet" type="text/css" href="/wp-content/plugins/<?php echo $plugin_dir ?>/app/web/css/styles.css" />

<div>
  <?php  foreach ($walls as $wall): ?>
    <div class="entry">
      <div class="entry-image">
	    <?php if ($wall['image'] ): ?>
		  <a href="/?guidebook/<?php echo $wall['id'] ?>/">
		    <img src="<?php echo $wall['image'] ?>" width="200" height="150" />
		  </a>
		<?php endif ?>  
	  </div>
	  <div class="entry-info">
	    <div class="entry-info-header">
		  <div class="entry-title">
		    <h3><?php echo $wall['title'] ?></h3>
          </div>
		</div>
		<div class="entry-info-description">
		  <?php echo $wall['description'] ?>
		  <a href="/?guidebook/<?php echo $wall['id'] ?>/">перейти к трассам</a>
		</div>
	  </div>
    </div>
      <?php if ($admin): ?>

	  <?php endif ?>	
  <?php endforeach ?>

    
</div>