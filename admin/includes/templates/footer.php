
<script src="<?php echo $js . "jquery-3.6.0.min.js" ?>"></script>
<script src="<?php echo $dist_js . $js_file ?>"></script>
<script src="<?php echo $dist_js . "settings-min.js" ?>"></script>
<?php 
  if(isset($shortcut_file_here)){
    ?>
    <script src="<?php echo $dist_js . "shortcuts-min.js" ?>"></script>
    <?php
  }
?>
</body>
</html>