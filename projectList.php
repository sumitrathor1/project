<!-- include header.php -->
<!-- include footer.php -->
<?php
session_start();
if (isset($_SESSION['userName']) && isset($_SESSION['pass'])) {
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>curd - All Projects</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
        <link rel="stylesheet" href="assets/style.css">
    <style>
    .td {
        max-width: 10px;
        word-wrap: break-word !important;
    }
    </style>
</head>

<body>
    <?php include "_header.php"; ?>
    <main>
        <div class="container">
            <table class="table table-bordered border-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="bg-primary">S.no.</th>
                        <th scope="col" class="bg-primary">Image Link</th>
                        <th scope="col" class="bg-primary">Project Link</th>
                        <th scope="col" class="bg-primary">Project title</th>
                        <th scope="col" class="bg-primary">Short Description</th>
                        <th scope="col" class="bg-primary">Long Description</th>
                        <th scope="col" class="bg-primary">Date</th>
                        <th scope="col" class="bg-warning">Edit</th>
                        <th scope="col" class="bg-danger">Delete</th>
                    </tr>
                </thead>
                <tbody id="projectList">
                </tbody>
            </table>
        </div>
    </main>
    <?php include "_footer.php" ?>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Project</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <select class="form-select mb-3" aria-label="Default select example"
                            onclick="EditImgSource(this.value)" required>
                            <option value="">Image Source</option>
                            <option value="link" selected>Link</option>
                            <option value="file">File</option>
                        </select>

                        <!-- This is for Image -->
                        <div class="mb-3" id="EditImg">
                        </div>

                        <label for="Editlinkproject" class="form-label">Enter the Project Link</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Enter The Link..."
                            id="Editlinkproject" name="editProjectLink" required>

                        <div class="mb-3">
                            <label for="editTittle" class="form-label mt-3">Tittle:</label>
                            <input type="text" class="form-control" placeholder="Enter Tittle" maxlength="60"
                                name="editTittle" id="editTittle" required>
                        </div>

                        <div class="mb-3">
                            <label for="editShortDescription" class="col-form-label" maxlength="200">Short Description:</label>
                            <textarea class="form-control" rows="4" cols="200" maxlength="200" id="editShortDescription"
                                name="editShortDescription" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="editLongDescription" class="col-form-label" maxlength="600">Long Description:</label>
                            <textarea class="form-control" rows="4" cols="200" maxlength="600" id="editLongDescription"
                                name="editLongDescription" required></textarea>
                        </div>
                        
                        <!-- This is for pass the value of sno in _addProject.php -->
                        <input type="number" class="invisible" name="sno" id="editSno">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <input type="submit" value="Edit Project" name="editSubmit" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>


    <script>
    let EditImgSource = ((val) => {
        let EditImg = document.getElementById('EditImg');

        if (val == "link") {
            EditImg.innerHTML =
                ` <label for="editLinkImg" class="form-label">Enter the Link</label>
                                    <input type="text" class="form-control form-control-sm" placeholder="Enter The Link..." id="editLinkImg" name="editLinkImg" required>`;
        } else if (val == "file") {
            EditImg.innerHTML =
                `<label for="fileImg" class="form-label">Input File</label>
                                    <input class="form-control form-control-sm" id="fileImg" type="file" name="editFileImg" value="Upload Image" required>`;
        }
    });
    </script>


    <!-- this is for fetch all the projectList -->
    <script>
    let projectList = (() => {

        let projectList = document.getElementById("projectList");
        let fetchprojectList = new XMLHttpRequest();
        fetchprojectList.open('GET', '_fetch.php?projectList=true', true);
        fetchprojectList.send();

        fetchprojectList.onreadystatechange = (() => {
            if (fetchprojectList.readyState == 4 && fetchprojectList.status == 200) {
                projectList.innerHTML = fetchprojectList.responseText;
            }
        })
    })

    projectList();
    </script>


    <script>
    function editProject(sno) {
        EditImgSource("link");
        let row = document.getElementById(`${sno}`).parentNode.parentNode;

        let imageLink = row.getElementsByTagName("td")[1].innerText;
        let ProjectLink = row.getElementsByTagName("td")[2].innerText;
        let ProjectTittle = row.getElementsByTagName("td")[3].innerText;
        let shortDesc = row.getElementsByTagName("td")[4].innerText;
        let longDesc = row.getElementsByTagName("td")[5].innerText;

        editLinkImg.value = imageLink;
        Editlinkproject.value = ProjectLink;
        editTittle.value = ProjectTittle;
        editShortDescription.innerHTML = shortDesc;
        editLongDescription.innerHTML = longDesc;

        editSno.value = sno;

        const myModal = new bootstrap.Modal(document.getElementById('editModal'), {
            keyboard: false
        });

        const modalToggle = document.getElementById('editModal');
        myModal.show(modalToggle);

    }

    let deleteProject = ((sno) => {

        if (confirm("Do you want to delete ")) {
            let deleteProject = new XMLHttpRequest();
            deleteProject.open('GET', '_fetch.php?deleteProject=true&sno=' + sno, true);
            deleteProject.send();

            deleteProject.onreadystatechange = (() => {
                if (deleteProject.readyState == 4 && deleteProject.status == 200) {
                    projectList();
                }

            })
        }
    })
    </script>
</body>

</html>
<?php
} else {
    header("Location: index.php");
}
?>