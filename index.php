<!-- include header.php -->
<!-- include footer.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>All Project</title>
    <link rel="icon" href="logo.png" type="image/gif" sizes="16x16">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
        <link rel="stylesheet" href="assets/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500&display=swap" rel="stylesheet">
        
</head>

<body>
    <?php include "_header.php"; ?>
    <main>
        <div class="container ">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="card">
            </div>
        </div>
    </main>
    <?php include "_footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
    let fetch_card = (() => {
        let card = document.getElementById("card");
        let fetchSourceData = new XMLHttpRequest();
        fetchSourceData.open('GET', '_fetch.php?card=true', true);
        fetchSourceData.send();

        fetchSourceData.onreadystatechange = (() => {
            if (fetchSourceData.readyState == 4 && fetchSourceData.status == 200) {
                card.innerHTML = fetchSourceData.responseText;
            }
        })
    })
    fetch_card();
    </script>
</body>

</html>