<?php
$errors = [];
$username = $email = $password = $repeat_password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);
    $repeat_password = trim($_POST['repeat-password']);

    if (!$username) $errors['username'] = "Vui lòng nhập họ tên.";
    if (!$email) $errors['email'] = "Vui lòng nhập email.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = "Email không hợp lệ.";
    if (!$password) $errors['password'] = "Vui lòng nhập mật khẩu.";
    elseif (strlen($password) < 6) $errors['password'] = "Mật khẩu ít nhất 6 ký tự.";
    if ($repeat_password !== $password) $errors['repeat-password'] = "Xác nhận mật khẩu không khớp.";

    if (!$errors) {
        echo "<p style='color: green;'>Chào mừng, $username! Bạn đã đăng ký thành công.</p>";
        $username = $email = $password = $repeat_password = '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <!-- TODO
  1) Chuyển đổi register.html thành file php và chạy trên webserver để xử lý 
  form đăng ký người dùng gồm các thông tin: 
  Họ tên: Không được để trống. 
  Email: Không được để trống và phải đúng định dạng.
  Mật khẩu: Không được để trống, ít nhất 6 ký tự (strlen()).
  Xác nhận mật khẩu: Phải giống với Mật khẩu.
  gợi ý: 
    + Kiểm tra và lọc dữ liệu đầu vào để chống XSS (htmlspecialchars()).
    + có thể sử dụng filter_var hoặc preg_match để kiểm tra biến
  2) Lỗi phát sinh sẽ được đưa vào mãng $errors = [];
  ví dụ: $errors = ["username" => "Vui lòng nhập họ tên.", "email" => "Vui lòng nhập email."];
  3) Hiển thị lỗi nếu có sai sót và giữ nguyên dữ liệu đã nhập nếu có lỗi.
  Có thể hiển thị lỗi trên đầu form hoặc lỗi ngay dưới phần nhập của lỗi.
  4) Nếu đăng ký thành công, hiển thị thông báo chào mừng. Xóa trống form đăng ký.
  -->

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./reset.css" />
  <link rel="stylesheet" href="./style.css" />
  <title>Register Page</title>
</head>
<body>
  <div class="wrapper fade-in-down">
    <div id="form-content">
      <!-- Tabs Titles -->
      <a href="./login.php">
        <h2 class="inactive underline-hover">Đăng nhập</h2>
      </a>
      <a href="./register.php">
        <h2 class="active">Đăng ký</h2>
      </a>

      <!-- Icon -->
      <div class="fade-in first">
        <img src="./imgs/avatar.png" id="avatar" alt="User Icon" />
      </div>
      <!-- Registration Form -->
      <form method="POST" action="register.php">
        <input
          type="text"
          id="username"
          class="fade-in first"
          name="username"
          placeholder="Họ tên"
          value="<?= htmlspecialchars($username) ?>"
        />
        <span class="error"><?= isset($errors['username']) ? $errors['username'] : '' ?></span>

        <input
          type="email"
          id="Email"
          class="fade-in second"
          name="email"
          placeholder="Email"
          value="<?= htmlspecialchars($email) ?>"
        />
        <span class="error"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>

        <input
          type="password"
          id="password"
          class="fade-in third"
          name="password"
          placeholder="Mật khẩu"
          value="<?= htmlspecialchars($password) ?>"
        />
        <span class="error"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>

        <input
          type="password"
          id="repeat-password"
          class="fade-in fourth"
          name="repeat-password"
          placeholder="Xác nhận mật khẩu"
          value="<?= htmlspecialchars($repeat_password) ?>"
        />
        <span class="error"><?= isset($errors['repeat-password']) ? $errors['repeat-password'] : '' ?></span>

        <input type="submit" class="fade-in five" value="Đăng ký" />
      </form>

      <!-- Remind Password -->
      <div id="form-footer">
        <a class="underline-hover" href="#">Quên mật khẩu?</a>
      </div>
    </div>
  </div>
</body>
</html>
