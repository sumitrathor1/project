<!-- include "_connection.php"; -->
<?php
function insertProject($imgLink, $projectLink, $tittle, $shortDescription, $longDescription)
{
    include "_connection.php";
    $insert = "INSERT INTO `projectdata`(`imageLink`, `projectLink`, `projectTittle`, `shortDescription` , `longDescription`) VALUES ('$imgLink','$projectLink','$tittle', '$shortDescription' ,'$longDescription')";
    $result = $conn->query($insert);
    if ($result) {
        echo '<script>appendAlert("Your project Havebeen add", "success")</script>';
    } else {
        echo '<script>appendAlert("Something went wrong your data is not insert", "danger")</script>';
    }
}

function updateProject($sno, $imgLink, $projectLink, $tittle, $shortDescription, $longDescription)
{
    include '_connection.php';

    $update = "UPDATE `projectdata` SET `imageLink`='$imgLink',`projectLink`='$projectLink',`projectTittle`='$tittle',`shortDescription`='$shortDescription',`longDescription`='$longDescription' WHERE sno='$sno'";  
    $result = $conn->query($update);
    if ($result) {
        echo '<script>appendAlert("Your project Havebeen Update", "success")</script>';
    } else {
        echo '<script>appendAlert("Something went wrong your data is not Update", "danger")</script>';
    } 
}
?>
<?php
include "_connection.php";
if (isset($_SESSION['userName']) && isset($_SESSION['pass'])) {
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["submit"]) && (isset($_POST['imgLink']) || $_FILES['imgFile']["name"]) && isset($_POST['projectLink']) && isset($_POST['tittle']) && isset($_POST['shortDescription']) && isset($_POST['longDescription'])) {

        $tittle = $_POST['tittle'];
        $shortDescription = $_POST['shortDescription'];
        $longDescription = $_POST['longDescription'];
        $projectLink = $_POST['projectLink'];

        if (isset($_FILES['imgFile']["name"])) {
            $target_dir = "assets/projectImg/";
            $tempImg = $target_dir . basename($_FILES["imgFile"]["name"]);
            $imageFileType = strtolower(pathinfo($tempImg, PATHINFO_EXTENSION));

            $target_file = $target_dir . $_FILES['imgFile']['name'];

            $check = getimagesize($_FILES["imgFile"]["tmp_name"]);

            // Check if image file is a actual image or fake image
            if ($check !== false) {

                // Check if file already exists
                if (!file_exists($target_file)) {

                    // Check file size
                    if (!($_FILES["imgFile"]["size"] > 10485760)) {

                        // Allow certain file formats
                        if (!($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif")) {
                            if (move_uploaded_file($_FILES["imgFile"]["tmp_name"], $target_file)) {
                                $imgLink = $target_file;
                                insertProject($imgLink, $projectLink, $tittle, $shortDescription, $longDescription);
                            } else {
                                echo '<script>appendAlert("Sorry, there was an error uploading your file.", "danger")</script>';
                            }
                        } else {
                            echo '<script>appendAlert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.", "danger")</script>';
                        }
                    } else {
                        echo '<script>appendAlert("Sorry, your file is too large.", "danger")</script>';
                    }

                } else {
                    echo '<script>appendAlert("Sorry, file already exists.", "danger")</script>';
                }

            } else {
                echo '<script>appendAlert("File is not an image.", "danger")</script>';
            }

        } else {
            $imgLink = $_POST['imgLink'];
            insertProject($imgLink, $projectLink, $tittle, $shortDescription, $longDescription);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["editSubmit"]) && (isset($_POST['editLinkImg']) || $_FILES['editFileImg']["name"]) && isset($_POST['editProjectLink']) && isset($_POST['editTittle']) && isset($_POST['editShortDescription']) && isset($_POST['editLongDescription'])) {
        $sno = $_POST['sno'];
        $tittle = $_POST['editTittle'];
        $shortDescription = $_POST['editShortDescription'];
        $longDescription = $_POST['editLongDescription'];
        $projectLink = $_POST['editProjectLink'];

        if (isset($_FILES['editFileImg']["name"])) {

            $target_dir = "assets/projectImg/";
            $tempImg = $target_dir . basename($_FILES["editFileImg"]["name"]);
            $imageFileType = strtolower(pathinfo($tempImg, PATHINFO_EXTENSION));

            $target_file = $target_dir . $_FILES['editFileImg']['name'];

            $check = getimagesize($_FILES["editFileImg"]["tmp_name"]);

            // Check if image file is a actual image or fake image
            if ($check !== false) {

                // Check if file exists
                if (file_exists($target_file)) {
                    unlink($target_file);
                }
                
                $query = "SELECT * FROM `projectdata` WHERE sno='$sno'";
                $result = $conn->query($query);
                if ($row = $result->fetch_assoc()) {
                    $dataBaseImg = $row['imageLink'];
                }
                if(file_exists($dataBaseImg))
                {
                    unlink($dataBaseImg);
                }

                // Check file size
                if (!($_FILES["editFileImg"]["size"] > 10485760)) {

                    // Allow certain file formats
                    if (!($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif")) {
                        if (move_uploaded_file($_FILES["editFileImg"]["tmp_name"], $target_file)) {
                            $imgLink = "https://sumitrathor.rf.gd/myProjects/".$target_file;
                            updateProject($sno, $imgLink, $projectLink, $tittle, $shortDescription, $longDescription);
                        } else {
                            echo '<script>appendAlert("Sorry, there was an error uploading your file.", "danger")</script>';
                        }
                    } else {
                        echo '<script>appendAlert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.", "danger")</script>';
                    }
                } else {
                    echo '<script>appendAlert("Sorry, your file is too large.", "danger")</script>';
                }

            } else {
                echo '<script>appendAlert("File is not an image.", "danger")</script>';
            }

        } else {
            $imgLink = $_POST['editLinkImg'];
            updateProject($sno, $imgLink, $projectLink, $tittle, $shortDescription, $longDescription);
        }
    }
}
?>