<?php ob_start(); ?>
<?php include "_connection.php"; ?>
<!-- include header.php -->
<!-- include footer.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - All Projects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
        <link rel="stylesheet" href="assets/style.css">
    <style>
    .bg-color {
        background: #f3f4f6 !important;
    }
    </style>
</head>

<body>
    <?php include "_header.php"; ?>
    <main>
        <div id="alert"></div>
        <div class="container mt-5 w-50" style="min-width : 350px">
            <div class="shadow p-3 mb-5 bg-body rounded bg-color">
                <div class="box text-center">
                    <p>
                        When you login the page Then you can Add, Delete, Update the project
                    </p>
                </div>
                <h3 class="text-center mt-5">Login</h3>
                <form method="POST">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Enter Your User Name<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="userName" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Enter Your Password<span
                                class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </main>
    <?php include "_footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
    const alertPlaceholder = document.getElementById('alert');
    const appendAlert = (message, type) => {
        const wrapper = document.createElement('div');
        wrapper.innerHTML = `<div class="alert alert-${type} alert-dismissible" role="alert">
        <div class="text-center">${message}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        `;

        alertPlaceholder.append(wrapper);

        if (type == "success") {
            setTimeout(() => {
                alertPlaceholder.innerHTML = "";

                setTimeout(() => {
                    location.replace("index.php");
                }, 3000);
            }, 5000);
        }

    }
    </script>
</body>

</html>

<?php
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['userName']) && isset($_POST['password']))
{
    $userName = $_POST['userName'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM `userdata` WHERE userName = '$userName'";
    $result = $conn->query($query);

    
    if($row = $result->fetch_assoc())
    {
        if($userName == $row['userName'] && password_verify($pass, $row['pass']))
        {
            $_SESSION['userName'] = $userName;
            $_SESSION['pass'] = $pass;

            header("Location: projectList.php");
        }
        else
        {
            ?>            
            <script>
            appendAlert('Password is wrong', 'danger');
            </script>
<?php
        }
    }
    else
    {
        ?>
<script>
appendAlert('User name is wrong', 'danger');
</script>

<?php
    }
}

if(isset($_SESSION['userName']) && isset($_SESSION['pass']))
{
    header("Location: projectList.php");
}
?>