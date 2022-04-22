<?php
require_once 'models/UserModel.php';
$userModel = new UserModel();

$user = NULL; //Add new user
$id = NULL;


if (isset($_POST['id'])) {

    if ( !empty($_GET['id'])) {
        $id = $_GET['id'];
        $userModel->deleteUserById($id); //Delete existing user
    }
    header('location: list_users.php');
    ?>
    
    <?php
}
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $user = $userModel->findUserById($id); //Update existing user
}
?>
<!DOCTYPE html>
<html>

<head>
    <title> Delete User form</title>
    <style>
        .question-box{
            background: #0f6bf58a;
            width: 500px;
            text-align: center;
            margin: 0 auto;
            padding-top: 20px ;
            padding-bottom: 20px;
        }
        .btn{
            padding: 5px 10px;
            margin: 0 5px;
            text-decoration: none;
        }
        .sName{
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="question-box">
        <?php if ($user || empty($id)) { ?>
            <form  method="post">
                <div class="alert alert-danger fase in">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <p>Bạn có chắc muốn xóa người dùng <span class="sName"><?php if (!empty($user[0]['name'])) echo $user[0]['name'] ?></span> ?</p>
                    <p>
                        <input type="submit" value="yes" class="btn btn-danger">
                        <a href="list_users.php" class="btn btn-default"> No</a>
                    </p>
                </div>
            </form>
        <?php } else { ?>
            <div class="alert alert-success" role="alert">
                User not found!
            </div>
        <?php } ?>
        </div>
    </div>
</body>

</html>