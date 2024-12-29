<style>
#alert-message{
    margin-top: 80px !important;
}
</style>

<!-- include _addProject.php -->
<?php include "_session.php"; ?>
<header>
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #000000" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./"><img class="rounded-circle" src="assets/logo.gif" width="45px"
                    alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="./">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="about.php">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Project
                        </a>
                        <ul class="dropdown-menu navbar-nav-scroll" id="allProject">
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="contactUs.php">Contact Us</a>
                    </li>
                </ul>
                <?php 
                if(!isset($_SESSION['userName']) && !isset($_SESSION['pass'])) 
                {
                    ?>
                <a href="login.php"><button class="btn btn-outline-primary" type="button">Login</button></a>
                <?php
                }
                if(isset($_SESSION['userName']) && isset($_SESSION['pass'])) 
                {
                    ?>
                <a href="_session.php?session=false"><button class="btn btn-outline-danger mx-2 my-2"
                        type="button">Logout</button></a>
                <a href="projectList.php"><button class="btn btn-outline-success mx-2" type="button">View
                        Project</button></a>
                <button class="btn btn-outline-info" type="button" data-bs-toggle="modal" data-bs-target="#modal">Add
                    Project</button>
                <?php
                }
                ?>
            </div>
        </div>
    </nav>
</header>
<div id="alert"></div>

<!-- Add Project Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Project</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <select class="form-select mb-3" aria-label="Default select example" onInput="imgSource(this.value)"
                        required>
                        <option value="">Image Source</option>
                        <option value="link">Link</option>
                        <option value="file">File</option>
                    </select>

                    <!-- This is for Image -->
                    <div class="mb-3" id="img">
                    </div>

                    <label for="linkproject" class="form-label">Enter the Project Link</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Enter The Link..."
                        id="linkproject" name="projectLink" required>

                    <div class="mb-3">
                        <label for="tittle" class="form-label mt-3">Tittle:</label>
                        <input type="text" class="form-control" placeholder="Enter Tittle" maxlength="60" name="tittle"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="shortDescription" class="col-form-label" maxlength="200">Short Description:</label>
                        <textarea class="form-control" rows="4" cols="200" maxlength="200" id="shortDescription"
                            name="shortDescription" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="longDescription" class="col-form-label" maxlength="600">Long Description:</label>
                        <textarea class="form-control" rows="4" cols="200" maxlength="600" id="longDescription"
                            name="longDescription" required></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" value="Add Project" name="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Fetch All the Project -->
<script>
let fetch_allProject = (() => {
    let allProject = document.getElementById("allProject");
    let fetchallProject = new XMLHttpRequest();
    fetchallProject.open('GET', '_fetch.php?allProject=true', true);
    fetchallProject.send();

    fetchallProject.onreadystatechange = (() => {
        if (fetchallProject.readyState == 4 && fetchallProject.status == 200) {
            allProject.innerHTML = fetchallProject.responseText;
        }
    })
})
fetch_allProject();
</script>

<!-- Check File or image -->
<script>
let imgSource = ((val) => {
    let img = document.getElementById('img');

    if (val == "link") {
        img.innerHTML =
            ` <label for="linkImg" class="form-label">Enter the Link</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Enter The Link..." id="linkImg" name="imgLink" required>`;
    } else if (val == "file") {
        img.innerHTML = `<label for="fileImg" class="form-label">Input File</label>
                        <input class="form-control form-control-sm" name="imgFile" id="fileImg" type="file"required>`;
    }
});
</script>

<!-- This is alert script -->
<script>
const alertPlaceholder = document.getElementById('alert');
const appendAlert = (message, type) => {
    const wrapper = document.createElement('div');
    wrapper.innerHTML = `<div class="alert alert-${type} alert-dismissible border border-danger border-2 rounded-pill"  id="alert-message"  role="alert">
        <div class="text-center">${message}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        `;

    alertPlaceholder.append(wrapper);

    if (type == "success") {
        setTimeout(() => {
            alertPlaceholder.innerHTML = "";
        }, 5000);
    }

}
</script>
<?php include "_addProject.php";?>