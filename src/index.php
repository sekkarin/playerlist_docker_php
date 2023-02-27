<?php
  include_once('./conf/conf.php');
  include_once('./models/PlayerModel.php');
  include_once('./controllers/playerController.php');

  $conf = new Config();
  $modelPeyer = new PlayerModel($conf);
  $coltroller = new PlayerController();
  $coltroller->indexView();
  // echo "Hello";
?>