<?php require_once('./includes/header.php') ?>

    <div class="container">

        <?php
            if($_SERVER['REQUEST_METHOD'] == 'GET') 
            {
                header('Location: ./index.php');
            }else{
                $id = $_POST['val'];
                $sql = "SELECT * FROM users WHERE user_id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ":id" => $id
                ]);

                if($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $user_id = $user['user_id'];
                    $user_name = $user['user_name'];
                    $user_email = $user['user_email'];
                    $user_password = $user['user_password'];
                }
            }

        ?>
        <h2 class="pt-4">User Update</h2>

        <?php

            if(isset($_POST['update_user'])) {
                $user_id = $_POST['update_id'];
                $user_name = trim($_POST['username']);
                $user_email = trim($_POST['email']);
                $user_password = trim($_POST['password']);

                if((empty($user_name) || empty($user_email)) || empty($user_password)){
                    echo "
                        <div class='alert alert-danger'> Field can't be blank!!!</div>
                    ";
                } else {
                    //update user

                    $sql = 'UPDATE users SET user_name = :name, user_email = :email, user_password = :password WHERE user_id = :id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ":name" => $user_name,
                        ":email" => $user_email,
                        ":password" => $user_password,
                        ":id" => $user_id                       
                    ]);

                    header('Location: ./index.php');
                }
            }
        ?>

        <form class="py-2" autocomplete="off" method="POST" action="edit-user.php">
            <input type="hidden" name="update_id" value="<?php echo $user_id ?>">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $user_name ?>" id="username" placeholder="Desired username">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control" value="<?php echo $user_email ?>" id="email" placeholder="Desired email address">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password"  name="password" class="form-control" value="<?php echo $user_password ?>" id="password" placeholder="Enter new password">
            </div>
            <button type="submit" name="update_user" class="btn btn-primary">Submit</button>
        </form>
    </div>
<?php require_once('./includes/footer.php') ?>
