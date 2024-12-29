<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Project - Contact Us</title>
    <link rel="icon" href="logo.png" type="image/gif" sizes="16x16">    
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
                    <p>Do you have any questions? Please do not hesitate to
                        contact us directly. Our team will come back to you within
                        a matter of hours to help you.
                    </p>
                </div>
                <h3 class="text-center mt-5">Contact Us</h3>
                <form method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Enter Your Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div id="name" class="form-text">We'll never share your Name with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Enter Email Address<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email"
                            required>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Pls Enter Your Message<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="message" rows="3" maxlength="500" name="message"
                            required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
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

        if(type == "success")
        {
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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'assets/PHPMailer/src/Exception.php';
require_once 'assets/PHPMailer/src/PHPMailer.php';
require_once 'assets/PHPMailer/src/SMTP.php';

function send_mail_to_me($name, $email, $message){
    include "_config.php" ;
    $mail = new PHPMailer(true);
    
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $email;
    $mail->Password   = $email_api_key;
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    
    $mail->setFrom($email);
    
    $message1 = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . $name . ' Send you some message</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    </head>
    <body>
        <div class="container mt-5">
            <div class="shadow p-3 mb-5 bg-body rounded bg-color">
                <h3 class="text-center my-5 shadow">Message from ' . $name . '</h3>
                <div class="shadow p-5 mb-5 rounded bg-dark text-light">
                    <h4>Email : '. $email . '</h4>
                    <p><b>Message : </b> ' . $message . '</p>
                </div>
            </div>
        </div>
    </body>
    </html>';

    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = $name . " Send you Some message";
    $mail->Body    = $message1;

    if ($mail->send()) {
        ?>

        <script>appendAlert('Your message has been sent. I will try to read your message as soon as possible.', 'success');</script>
        <?php
    } 
    else {
        ?>

        <script>appendAlert('Your message has not been sent. Please try again.', 'danger');</script>
        <?php
    }
  }
  if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message']))
  {
    $name =  $_POST['name'];
    $email =  $_POST['email'];
    $message =  $_POST['message'];

    send_mail_to_me($name, $email, $message);
  }
?>