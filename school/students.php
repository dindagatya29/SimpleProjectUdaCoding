<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $nisn = $_POST['nisn'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $parent_name = $_POST['parent_name'];
    $phone = $_POST['phone'];
    $admin_id = $_SESSION['admin_id'];

    if (isset($_POST['create'])) {
        $sql = "INSERT INTO students (name, nisn, email, date_of_birth, gender, address, parent_name, phone, created_by) 
                VALUES ('$name', '$nisn', '$email', '$date_of_birth', '$gender', '$address', '$parent_name', '$phone', '$admin_id')";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success' role='alert'>Siswa berhasil ditambahkan!</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $sql = "UPDATE students SET name='$name', nisn='$nisn', email='$email', date_of_birth='$date_of_birth', gender='$gender', address='$address', parent_name='$parent_name', phone='$phone' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success' role='alert'>Siswa berhasil diupdate!</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM students WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Siswa berhasil dihapus!</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

$edit_student = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM students WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $edit_student = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Siswa - Sekolah</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 56px;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand {
            color: white;
            font-weight: bold;
        }
        .navbar-nav .nav-link {
            color: white;
        }
        .navbar-nav .nav-link:hover {
            color: #cce5ff;
        }
        .container {
            margin-top: 20px;
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        .table thead th {
            background-color: #007bff;
            color: white;
        }
        .table tbody tr:nth-child(even) {
            background-color: #e9ecef;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            border-radius: 5px;
        }
        .form-control {
            border-radius: 5px;
        }
        .alert {
            margin-top: 20px;
        }
        .form-container {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <a class="navbar-brand" href="#">Data Siswa</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="students.php">Manajemen Siswa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1 class="text-center mt-4">Manajemen Siswa</h1>
    <a href="index.php" class="btn btn-secondary mb-3">Kembali</a>

    <div class="form-container">
        <form action="students.php" method="POST">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" name="name" value="<?= isset($edit_student) ? htmlspecialchars($edit_student['name']) : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="nisn">NISN:</label>
                <input type="text" class="form-control" name="nisn" value="<?= isset($edit_student) ? htmlspecialchars($edit_student['nisn']) : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="<?= isset($edit_student) ? htmlspecialchars($edit_student['email']) : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="date_of_birth">Tanggal Lahir:</label>
                <input type="date" class="form-control" name="date_of_birth" value="<?= isset($edit_student) ? htmlspecialchars($edit_student['date_of_birth']) : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Jenis Kelamin:</label>
                <select class="form-control" name="gender" required>
                    <option value="L" <?= isset($edit_student) && $edit_student['gender'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="P" <?= isset($edit_student) && $edit_student['gender'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="address">Alamat:</label>
                <textarea class="form-control" name="address" rows="3" required><?= isset($edit_student) ? htmlspecialchars($edit_student['address']) : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="parent_name">Nama Orang Tua:</label>
                <input type="text" class="form-control" name="parent_name" value="<?= isset($edit_student) ? htmlspecialchars($edit_student['parent_name']) : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">No HP:</label>
                <input type="text" class="form-control" name="phone" value="<?= isset($edit_student) ? htmlspecialchars($edit_student['phone']) : '' ?>" required>
            </div>
            <?php if (isset($edit_student)): ?>
                <input type="hidden" name="id" value="<?= htmlspecialchars($edit_student['id']) ?>">
                <button type="submit" name="update" class="btn btn-warning">Update Siswa</button>
            <?php else: ?>
                <button type="submit" name="create" class="btn btn-primary">Tambah Siswa</button>
            <?php endif; ?>
        </form>
    </div>

    <h2>Daftar Siswa</h2>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NISN</th>
                <th>Email</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Nama Orang Tua</th>
                <th>No HP</th>
                <th>Dibuat Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT students.id, students.name, students.nisn, students.email, students.date_of_birth, students.gender, students.address, students.parent_name, students.phone, admins.username AS created_by 
                    FROM students 
                    JOIN admins ON students.created_by = admins.id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['nisn']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['date_of_birth']}</td>
                            <td>{$row['gender']}</td>
                            <td>{$row['address']}</td>
                            <td>{$row['parent_name']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['created_by']}</td>
                            <td>
                                <a href='students.php?edit={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='students.php?delete={$row['id']}' class='btn btn-danger btn-sm'>Hapus</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='10' class='text-center'>Tidak ada data siswa</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
