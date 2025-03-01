<?php
$errors = [];
$email = $password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);

    if (empty($email)) {
        $errors['email'] = "Vui lòng nhập email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email không hợp lệ.";
    }

    if (empty($password)) {
        $errors['password'] = "Vui lòng nhập mật khẩu.";
    }

    if (empty($errors)) {
        if ($email === "test@example.com" && $password === "123456") {
            echo "<p style='color: green;'>Đăng nhập thành công! Chào mừng $email.</p>";
        } else {
            $errors['login'] = "Email hoặc mật khẩu không đúng.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./reset.css" />
    <link rel="stylesheet" href="./style.css" />
    <title>Login Page</title>
  </head>
  <body>
    <div class="wrapper fade-in-down">
      <div id="form-content">
        <!-- Tabs Titles -->
        <a href="./login.php">
          <h2 class="active">Đăng nhập</h2>
        </a>
        <a href="./register.php">
          <h2 class="inactive underline-hover">Đăng ký</h2>
        </a>
        

        <!-- Icon -->
        <div class="fade-in first">
          <img src="./imgs/avatar.png" id="avatar" alt="User Icon" />
        </div>

        <!-- Login Form -->
        <form>
          <input
            type="email"
            id="Email"
            class="fade-in second"
            name="email"
            placeholder="Email"
          />
          <input
            type="password"
            id="password"
            class="fade-in third"
            name="password"
            placeholder="Mật khẩu"
          />
          <input type="submit" class="fade-in five" value="Đăng nhập" />
        </form>

        <!-- Remind Passowrd -->
        <div id="form-footer">
          <a class="underline-hover" href="#">Quên mật khẩu?</a>
        </div>
      </div>
    </div>
  </body>
</html>