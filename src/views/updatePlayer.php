<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="../libs/css/bootstrap-utilities.min.css">
</head>

<body>
    <?php
    include_once('../models/PlayerModel.php');
    include_once('../conf/conf.php');
    $identifier = $_GET["identifier"];

    $conf = new Config();
    $modelPeyer = new PlayerModel($conf);
    $player = json_decode($modelPeyer->getPlayer($identifier));
    ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Player List</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="modal fade" id="addModel" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../index.php?playerRout=update" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">ชื่อ</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" value="ชื่อ"
                                aria-describedby="helpId">

                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">นามสกุล</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" value="นามสกุล"
                                aria-describedby="helpId">

                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">ทีม</label>
                            <input type="text" name="team" id="team" class="form-control" value="ทีม"
                                aria-describedby="helpId">

                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">ตำแหน่ง</label>
                            <input type="text" name="position" id="position" class="form-control" value="ตำแหน่ง"
                                aria-describedby="helpId">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">รูป</label>
                            <input type="image" name="image_url" id="image_url" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="updatebtn" class="btn btn-success">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="../index.php?playerRout=add">เพิ่มข้อมูล</a> -->
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addModel">
                            เพิ่มผู้เล่น
                        </button>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" value="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-5">
                <form action="../index.php?playerRout=update" method="post" enctype="multipart/form-data">
                    
                    <div class="modal-body">
                        <input type="hidden" name="identifier" value="<?php echo ($player->identifier); ?>">
                        <input type="hidden" name="old_image" value="<?php echo ($player->image_url); ?>">
                        <div class="mb-3">
                            <label for="" class="form-label">ชื่อ</label>
                            <input type="text" name="firstname" id="firstname" class="form-control"
                                value="<?php echo $player->firstname; ?>"
                                 aria-describedby="helpId">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">นามสกุล</label>
                            <input type="text" name="lastname" id="lastname" class="form-control"
                                value="<?php echo ($player->lastname) ?>" aria-describedby="helpId">

                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">ทีม</label>
                            <input type="text" name="team" id="team" class="form-control"
                                value="<?php echo ($player->team) ?>" aria-describedby="helpId">

                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">ตำแหน่ง</label>
                            <input type="text" name="position" id="position" class="form-control"
                                value="<?php echo ($player->position) ?>" aria-describedby="helpId">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">รูป</label>
                            <input type="file" name="image_url" id="image_url" class="form-control"
                                aria-describedby="helpId">
                        </div>
                    </div>
                    <div class="">
                        <a href="../index.php" class="btn btn-secondary">Close</a>
                        <button type="submit" name="updatebtn" class="btn btn-success">บันทึก</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script src="../libs/js/bootstrap.min.js"></script>
    <script src="../libs/js/bootstrap.bundle.min.js"></script>
    <script src="../libs/js/main.js"></script>
</body>

</html>