<?php
include_once('./conf/conf.php');
include_once('./models/playerModel.php');
include_once('./controllers/playerController.php');

$conf = new Config();
$modelPeyer = new PlayerModel($conf);
$modelPeyer->checkAndInserter();
$coltroller = new PlayerController();
$coltroller->mvcHandler();

?>