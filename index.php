<?php
session_start();
if(isset($_SESSION['user_id'])){
    header('Location: admin/dashboard.php');
    exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login - SIS-SURAT</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container">
    <div class="row justify-content-center" style="margin-top:80px">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Login Sistem Administrasi Surat</div>
                <div class="card-body">
                    <?php if(isset($_GET['err'])): ?>
                    <div class="alert alert-danger">Login gagal. Periksa username/password.</div>
                    <?php endif; ?>
                    <form method="post" action="auth/login.php">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <button class="btn btn-primary" type="submit" name="login">Login</button>
                    </form>
                </div>
            </div>
            <p class="text-muted mt-2">Default superadmin: username <code>admin</code> password <code>admin123</code> (setelah import DB).</p>
        </div>
    </div>
</div>
</body>
</html>
