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
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Player List</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Modal -->
    <div class="modal fade" id="addModel" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../index.php?playerRout=add" method="post" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="" class="form-label">ชื่อ</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="ชื่อ"
                                aria-describedby="helpId">

                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">นามสกุล</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="นามสกุล"
                                aria-describedby="helpId">

                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">ทีม</label>
                            <input type="text" name="team" id="team" class="form-control" placeholder="ทีม"
                                aria-describedby="helpId">

                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">ตำแหน่ง</label>
                            <input type="text" name="position" id="position" class="form-control" placeholder="ตำแหน่ง"
                                aria-describedby="helpId">
                        </div>
                        <div class="mb-3">
                            <label for="image_url" class="form-label">รูป</label>
                            <input type="file" name="image_url" id="image_url" class="form-control" placeholder="รูป"
                                aria-describedby="helpId">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="addbtn" class="btn btn-success">บันทึก</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-start align-items-start g-2">
            <div class="col">
                <h5 class="display-5">รายการนักฟุตบอล</h5>
            </div>

        </div>
    </div>
    <!-- content show player  -->
    <div class="container">
        <div class="row flex-wrap g-4 mt-1">
            <?php
            for ($i=0; $i < count($result) ; $i++) { 
           ?>
                <div class="col-3 col-md-6 col-xl-3 ">
                    <div class="card" style="width: 18rem;">
                        <img src="../public/images/<?php echo ($result[$i]->image_url) ?>" class="card-img-top" width="250" height="270" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo ($result[$i]->firstname . " " . $result[$i]->lastname) ?>
                            </h5>

                            <h6 class="card-title">Team</h6>
                            <p class="card-text"><?php echo ($result[$i]->team) ?></p>
                            <h6 class="card-title">Position</h6>
                            <p class="card-text"><?php echo ($result[$i]->position) ?></p>
                            <a href="./views/updatePlayer.php?identifier=<?= $result[$i]->identifier ?>"
                                class="btn btn-primary btn-sm">แก้ใข</a>
                            <a href="../index.php?playerRout=delete&&identifier=<?php echo ($result[$i]->identifier) ?>"
                                class="btn btn-danger btn-sm">ลบ</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- end content show player  -->

    <script src="../libs/js/bootstrap.min.js"></script>
    <script src="../libs/js/bootstrap.bundle.min.js"></script>
    <script src="../libs/js/main.js"></script>
</body>

</html>