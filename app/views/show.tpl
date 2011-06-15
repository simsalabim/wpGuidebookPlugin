<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<script type="text/javascript" src="/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jquery.simplemodal.min.js"></script>
<script type="text/javascript" src="/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jwysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jwysiwyg/controls/wysiwyg.image.js"></script>
<script type="text/javascript" src="/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jwysiwyg/controls/wysiwyg.link.js"></script>
<script type="text/javascript" src="/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jwysiwyg/controls/wysiwyg.table.js"></script>
<script type="text/javascript" src="/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jwysiwyg/controls/wysiwyg.colorpicker.js"></script>
<link rel="stylesheet" type="text/css" href="/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jwysiwyg/jquery.wysiwyg.css" />
<link rel="stylesheet" type="text/css" href="/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jwysiwyg/jquery.wysiwyg.modal.css" />

<script type="text/javascript" src="http://wp.dev/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jquery.lightbox/jquery.lightbox.pack.js"></script>
<link rel="stylesheet" type="text/css" href="/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jquery.lightbox/jquery.lightbox.css" />

<script type="text/javascript" src="/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jquery.raty/js/jquery.raty.min.js"></script>

  
<script type="text/javascript">
  $(function() {
     $("#description").wysiwyg({
      resizeOptions: true,
      initialContent: "",
	  rmUnusedControls: true,
		controls: {
				bold: { visible : true },
				html: { visible : true },
				insertOrderedList: { visible : true },
				italic: { visible : true },
				strikeThrough: { visible : true },
				createLink: { visible : true },
				insertImage: { visible : true },
				insertUnorderedList: { visible : true },
				insertOrderedList: { visible : true },
				undo: { visible : true },
				redo: { visible : true },
				subscript: { visible : true },
				superscript: { visible : true },
				underline: { visible : true },
				outdent: { visible : true },
				indent: { visible : true },
				justifyCenter: { visible : true },
				justifyLeft: { visible : true },
				justifyRight: { visible : true },
				justifyFull: { visible : true },
				insertOrderedList: { visible : true },
				insertUnorderedList: { visible : true },
				insertHorizontalRule: { visible : true },
				h1: { visible : true },
				h2: { visible : true },
				h3: { visible : true }
		}
    });
    
	if (typeof $().lightBox=="function") {
	  $(".thumb").lightBox({
	    overlayBgColor: "#000",
		overlayOpacity:0.8,
		imageLoading:"/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jquery.lightbox/lightbox-ico-loading.gif",
		imageBtnClose:"/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jquery.lightbox/lightbox-btn-close.gif",
		imageBtnPrev:"/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jquery.lightbox/lightbox-btn-prev.gif",
		imageBtnNext:"/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jquery.lightbox/lightbox-btn-next.gif",
		containerResizeSpeed:350,
		txtImage:"Изображение",
		txtOf:"из"
		});
	}
	
	if (typeof $().datepicker == 'function') {
	  $('#passed_at').datepicker({ dateFormat: 'yy-mm-dd' })
	}
	
	<?php if ($action == 'show' || $action == 'update'): ?>
		$("#raty").raty({
		  path: '/wp-content/plugins/wpGuidebookPlugin/vendor/jquery.raty/img/',	  
		  half: true,
		  start: <?php echo $rating ?>,
		  click: function(score, evt) {
			var obj = this;
			  $.post("/wp-content/plugins/<?php echo $plugin_dir ?>/vote.php", {id: <?php echo $entry['id'] ?>, score: score}, function(response){ $(obj).next().next().html(response); });
		  }
		});
	<?php endif ?>
	
  });
</script>

<link rel="stylesheet" type="text/css" href="/wp-content/plugins/<?php echo $plugin_dir ?>/app/web/css/styles.css" />


<?php if ($action == 'show' || $action == 'update'): ?>
	<?php if (! $entry): ?>
		<div>
			<div class="entry-info">
				Не найдено трасс по заданным параметрам.
			</div>
		</div>
	<?php else: ?>
		<div>
			  <div class="entry-info">
				<div class="entry-info-header">
				  <div class="entry-title">
					<h3><?php echo $entry['title'] ?></h3>
					<div id="raty"></div>
					<strong>Рейтинг:</strong> <span class="rating-numbers"><?php echo $rating ?></span>
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
				  <?php echo htmlspecialchars_decode($entry['description']) ?>
				</div>
			  </div>
			  <?php if ($admin): ?>
				<a href="/?guidebook/<?php echo $entry['climbing_wall_id'] ?>/<?php echo $entry['id'] ?>/edit/">редактировать</a>
			  <?php endif ?>
		</div>
	<?php endif ?>
<?php elseif ($action == 'edit' || $action == 'new'): ?>
  <div class="edit">
    <form method="post" name="add_entry" enctype="multipart/form-data">
	  <div class="field">
	    <label for="title">Название:</label>
	    <input id="title" type="text" name="entry[title]" value="<?php echo $entry['title'] ?>" />
	  </div>
	  <div class="field">
	    <label for="image">Изображение:</label>
	    <?php if ($entry['image']): ?>
			<img src="<?php echo $entry['image'] ?>" />
		<?php endif ?>
	    <input id="image" type="file" name="upload" />
	  </div>
	  <div class="field">
	    <label for="climbing_wall_id">Скалодром:</label>
	    <select id="climbing_wall_id" name="entry[climbing_wall_id]">
		  <?php foreach ($walls as $wall): ?>
		    <option value="<?php echo $wall['id'] ?>" <?php if ($wall['id'] == $wallId): ?>selected="selected"<?php endif ?>><?php echo $wall['title'] ?></option>
		  <?php endforeach ?>
		</select>
	  </div>
	  <div class="field">
	    <label for="level">Сложность:</label>
	    <input id="level" type="text" name="entry[level]" value="<?php echo $entry['level'] ?>" />
	  </div>
	  <div class="field">
	    <label for="passed_at">Дата накрутки:</label>
	    <input id="passed_at" type="text" name="entry[passed_at]" value="<?php setlocale(LC_TIME, 'ru_RU'); echo strftime('%G-%m-%d', strtotime($entry['passed_at'] )) ?>" />
	  </div>
	  <div class="field">
	    <label for="author">Автор:</label>
	    <input id="author" type="text" name="entry[author]" value="<?php echo $entry['author'] ?>" />
	  </div>
	  <div>
	    <span class="note">Чтобы вставить видео используйте &laquo;[youtube]http://www.youtube.com/watch?v=e2_SiKDt_nE[/youtube]&raquo;</span>
	    <textarea id="description" class="description" name="entry[description]"><?php echo $entry['description'] ?></textarea>
	  </div>
	  <input type="hidden" name="id" value="<?php echo $entry['id'] ?>" />
	  <input type="hidden" name="action" value="<?php echo $method ?>" />
	  <input type="submit" value="OK" />
	</form>
  </div>
<?php endif ?>