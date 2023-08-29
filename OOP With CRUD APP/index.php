<?php
include 'classes/inputClasses.php';
include 'classes/validateClasses.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <title>OOP ile CRUD APP (Form)</title>
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-md-center">
            <div class="col-md-8">
                <?php

                if (INPUT::exist()) {
                    $validate = new Validate();
                    $validate->check($_POST, array(
                        'name' => array(
                            'name' => "User Name",
                            'required' => true,
                            'min' => 2,
                            'max' => 50
                        ),
                        'mail' => array(
                            'name' => "Email",
                            'required' => true,
                            'email' => true
                        ),
                        'password' => array(
                            'name' => "Password",
                            'required' => true,
                            'min' => 8,
                            'max' => 15
                        ),
                        'passwordAgain' => array(
                            'matches' => 'password'
                        )
                    ));
                    if($validate->passed()) {
                        echo "All values match";
                    } else {
                        $validate->showError();
                    }
                } else {
                    echo "Dont Post";
                }
                ?>
                <h1>Form Control</h1>
                <form action="" method="POST">
                    <div class="form-group col-md-4">
                        <label for="">Name:</label>
                        <input type="text" name="name" class="form-control">
                        <label for="">Mail:</label>
                        <input type="email" name="mail" class="form-control">
                        <label for="">Password:</label>
                        <input type="password" name="password" class="form-control">
                        <label for="">Şifre Again:</label>
                        <input type="password" name="passwordAgain" class="form-control">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit">
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</html>