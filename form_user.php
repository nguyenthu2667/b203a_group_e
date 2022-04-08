<?php
// Start the session
session_start();
require_once 'models/UserModel.php';
$userModel = new UserModel();

$user = NULL; //Add new user
$_id = NULL;
$gender = "";
$type = "";

if (!empty($_GET['id'])) {
    $_id = $_GET['id'];
    $user = $userModel->findUserById($_id); //Update existing user
    // var_dump($user);die();
    $gender = $user[0]['sex'];
    $type = $user[0]['type'];
}


if (!empty($_POST['submit'])) {

    if (!empty($_id)) {
        $userModel->updateUser($_POST);
    } else {
        $userModel->insertUser($_POST);
    }
    header('location: list_users.php');
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>User form</title>
    <?php include 'views/meta.php' ?>
</head>

<body>
    <?php include 'views/header.php' ?>
    <div class="container">

        <?php if ($user || !isset($_id)) { ?>
            <div class="alert alert-warning" role="alert">
                User form
            </div>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $_id ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" name="name" placeholder="Name" value='<?php if (!empty($user[0]['name'])) echo $user[0]['name'] ?>'>
                </div>
                <div class="form-group">
                    <label for="firstname">Firstname</label>
                    <input class="form-control" name="firstname" placeholder="Firstname" value='<?php if (!empty($user[0]['firstname'])) echo $user[0]['firstname'] ?>'>
                </div>
                <div class="form-group">
                    <label for="lastname">Lastname</label>
                    <input class="form-control" name="lastname" placeholder="Lastname" value='<?php if (!empty($user[0]['lastname'])) echo $user[0]['lastname'] ?>'>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" name="username" placeholder="Username" value='<?php if (!empty($user[0]['username'])) echo $user[0]['username'] ?>'>
                </div>
                <div class="form-group">
                    <label for="sex">Sex</label> <br>
                    <input type="radio" name="sex" <?php if (isset($gender) && $gender == "female") echo "checked"; ?> value="female">Female
                    <input type="radio" name="sex" <?php if (isset($gender) && $gender == "male") echo "checked"; ?> value="male">Male
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" name="email" placeholder="Email" value='<?php if (!empty($user[0]['email'])) echo $user[0]['email'] ?>'>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="type">Type user</label>
                    <select id="type" name="type">
                        <?php 
                        if (isset($type)){?>
                            <option <?php  echo "selected"; ?> value="<?= $type  ?>"><?= $type  ?></option>
                        <?php }
                        ?>
                        <option value="admin">admin</option>
                        <option value="guest">guest</option>
                    </select>
                </div>

                <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
            </form>
        <?php } else { ?>
            <div class="alert alert-success" role="alert">
                User not found!
            </div>
        <?php } ?>
    </div>
</body>

</html>