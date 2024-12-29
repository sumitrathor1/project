<?php
include "_connection.php";
session_start();
if (isset($_GET['allProject']) == 'true') {
    $query = "SELECT * FROM `projectdata`";
    $result = $conn->query($query);

    $i = 1;
    while ($row = $result->fetch_assoc()) {
        ?>
        <li><a class="dropdown-item" href="<?php echo $row['projectLink'] ?>" target="_main">
                <?php echo $row['projectTittle']; ?>
            </a></li>
        <?php
        $i++;
    }
    return;
}
if (isset($_GET['card']) == 'true') {
    $query = "SELECT * FROM `projectdata`";
    $result = $conn->query($query);

    $i = 1;
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="col w-5">
            <div class="card cardBg">
                <img src="<?php echo $row['imageLink'] ?>" class="card-img-top" alt="<?php echo $row['projectTittle']; ?>" />
                <div class="card-body shadow">
                    <h5 class="card-title fw-bold">
                        <?php echo $row['projectTittle'] ?>
                    </h5>
                    <p class="card-text font-style">
                        <?php echo $row['shortDescription'] ?>
                    </p>
                    <a href="<?php echo $row['projectLink'] ?>" class="btn btn-dark" target="_main">View Project</a>
                    <span><?php echo $row['date'] ?></span>
                </div>
            </div>
        </div>
        <?php
        $i++;
    }
    return;
}
if (isset($_SESSION['userName']) && isset($_SESSION['pass'])) {
    if (isset($_GET['projectList']) == 'true') {
        $query = "SELECT * FROM `projectdata`";
        $result = $conn->query($query);
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td>
                    <?php echo $i; ?>
                </td>
                <td class="td">
                    <?php echo $row['imageLink'] ?>
                </td>
                <td class="td">
                    <?php echo $row['projectLink'] ?>
                </td>
                <td class="td">
                    <?php echo $row['projectTittle'] ?>
                </td>
                <td class="td">
                    <?php echo $row['shortDescription'] ?>
                </td>
                <td class="td">
                    <?php echo $row['longDescription'] ?>
                </td>
                <td>
                    <?php echo $row['date'] ?>
                </td>
                <td class="text-center"><button class="btn" onclick="editProject(<?php echo $row['sno']; ?>)"
                        id="<?php echo $row['sno']; ?>"><i class="fa-solid fa-pen-to-square" style="color: #ffa200;"></i></button>
                </td>
                <td class="text-center"><button class="btn" onclick="deleteProject(<?php echo $row['sno']; ?>)"
                        id="d<?php echo $row['sno']; ?>"><i class="fa-sharp fa-solid fa-trash "
                            style="color: #ff0000;"></i></button></td>
            </tr>
            <?php
            $i++;
        }
        return;
    }

    if (isset($_GET['deleteProject']) == 'true') {
        $sno = $_GET['sno'];
        echo ''. $sno .'';

        $query = "SELECT * FROM `projectdata` WHERE sno='$sno'";
        $result = $conn->query($query);
        
        if ($row = $result->fetch_assoc()) {
            $dataBaseImg = $row['imageLink'];
        }
        if(file_exists($dataBaseImg))
        {
            unlink($dataBaseImg);
        }
        $query = "DELETE FROM `projectdata` WHERE sno = '$sno'";
        $result = $conn->query($query);
        return;
    }
}


?>