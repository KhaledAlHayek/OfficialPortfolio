<?php 
  // should have [$previous_page] before including this template..
  // should have [$content_title] before including this template..
?>
<div class="setting-header">
  <a href="<?php echo $previous_page ?>" class="back">
    <i class="fas fa-arrow-left"></i>
  </a>
  <div class="title">
    <h2><?php $content_title = isset($content_title) ? $content_title : "Title"; echo $content_title ?></h2>
  </div>
</div>