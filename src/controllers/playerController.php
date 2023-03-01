<?php

include_once('./models/playerModel.php');
include_once('./conf/conf.php');
// require '/conf/conf.php';
class PlayerController
{
  private $playerModel;
  private $conf;

  function __construct()
  {
    $this->conf = new Config();
    $this->playerModel = new PlayerModel($this->conf);
  }
  public function pageRedirect($url)
  {

    header("location:" . $url);
    exit(0);
  }
  public function indexView()
  {
    $json = $this->playerModel->getAllPlayer();
    $result = json_decode($json);
    // print_r($result);
    include('./views/listView.php');
  }
  public function insert()
  {
    try {
      if (isset($_POST['addbtn'])) {
        # code...
        $dataArrar = array();
        $dataArrar["firstname"] = $_POST['firstname'];
        $dataArrar["lastname"] = $_POST['lastname'];
        $dataArrar["team"] = $_POST['team'];
        $dataArrar["position"] = $_POST['position'];
        $dataArrar["image_url"] = $_POST['image_url'];

        // upload image 
        $target_dir = "./public/images/";
        $target_file = $target_dir . basename($_FILES["image_url"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          // unlink("$target_file);
          $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image_url"]["size"] > 1000000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        // Allow certain file formats
        if (
          $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif"
        ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $target_file)) {
            $dataArrar["image_url"] = htmlspecialchars(basename($_FILES["image_url"]["name"]));
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }


        $insert = $this->playerModel->inserPlayer($dataArrar);
        if ($insert == true) {
          $this->pageRedirect('./index.php');
        } else {
          echo "ไม่สามารถเพิ่มข้อมูลได้";
          // $this->pageRedirect('./index.php');
        }
      }

    } catch (Exception $e) {
      echo $e;
    }
  }
  public function update()
  {

    // $this->pageRedirect('./index.php');
    try {
      if (isset($_POST['updatebtn'])) {
        # code...
        $dataArrar = array();
        $dataArrar["identifier"] = $_POST['identifier'];
        $dataArrar["firstname"] = $_POST['firstname'];
        $dataArrar["lastname"] = $_POST['lastname'];
        $dataArrar["team"] = $_POST['team'];
        $dataArrar["position"] = $_POST['position'];
        $old_file = $_POST['old_image'];

        $target_dir = "./public/images/";
        $target_file = $target_dir . basename($_FILES["image_url"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
          // echo "Sorry, file already exists.";
          $dataArrar["image_url"] = $old_file;
          $insert = $this->playerModel->updatePlayer($dataArrar);
          // $uploadOk = 0;
          $this->pageRedirect('./index.php');
        }

        // Check file size
        if ($_FILES["image_url"]["size"] > 1000000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        // Allow certain file formats
        if (
          $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif"
        ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $target_file)) {
            $dataArrar["image_url"] = htmlspecialchars(basename($_FILES["image_url"]["name"]));
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }


        $insert = $this->playerModel->updatePlayer($dataArrar);
        if ($insert == true) {
          if (file_exists("./public/images/".$old_file)) {
            unlink("./public/images/".$old_file);
          }
          $this->pageRedirect('./index.php');
        } else {
          echo "ไม่สามารถเพิ่มข้อมูลได้";
          // $this->pageRedirect('./index.php');
        }
      }

    } catch (Exception $e) {
      echo $e;
    }


  }
  public function delete()
  {
    try {
      if (isset($_GET['identifier'])) {
        $insert = $this->playerModel->deletePlayer($_GET['identifier']);
        if ($insert == true) {
          $this->pageRedirect('./index.php');
        } else {
          echo "ไม่สามารถลบข้อมูลได้";
        }
      }

    } catch (Exception $e) {
      echo $e;
    }
  }
  public function mvcHandler()
  {
    $playerRounter = isset($_GET['playerRout']) ? $_GET['playerRout'] : NULL;
    switch ($playerRounter) {
      case 'add':
        $this->insert();
        break;
      case 'update':
        $this->update();
        break;
      case 'delete':
        $this->delete();
        break;
      default:
        $this->indexView();
    }
  }

}

?>