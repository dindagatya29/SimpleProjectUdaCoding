<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$sql = "SELECT * FROM news ORDER BY created_at DESC LIMIT 3";
$result = $conn->query($sql);
$news = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $news[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Sekolah</title>
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
        .navbar-brand, .nav-link {
            color: #ffffff !important;
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #e2e6ea !important;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .btn-container {
            display: flex;
            justify-content: flex-end;
        }
        .btn-container .btn {
            margin-left: 10px;
        }
        .news-card {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .news-card img {
            height: 200px;
            object-fit: cover;
            transition: opacity 0.2s;
        }
        .news-card:hover img {
            opacity: 0.85;
        }
        .news-card .card-body {
            padding: 20px;
        }
        .news-card .card-title {
            font-size: 1.5rem;
            color: #007bff;
            margin-bottom: 10px;
        }
        .news-card .card-text {
            color: #333;
            margin-bottom: 10px;
        }
        .news-card .text-muted {
            font-size: 0.9rem;
        }
        .header-banner {
            background: linear-gradient(to right, #007bff, #00c6ff);
            color: white;
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 30px;
        }
        .header-banner h1 {
            margin: 0;
            font-size: 2.5rem;
        }
        .about-school {
            margin-top: 50px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .about-school h2 {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 20px;
        }
        .about-school p {
            font-size: 1rem;
            color: #333;
            line-height: 1.5;
        }
        .about-school img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <a class="navbar-brand" href="#">Sekolah</a>
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
    <div class="header-banner">
        <h1>Selamat Datang di Website Sekolah</h1>
        <p>Temukan berita terkini dan informasi penting di sini</p>
    </div>

    <h2 class="mb-4">Berita Terkini</h2>
    <?php if (empty($news)): ?>
        <p>Tidak ada berita terkini.</p>
    <?php else: ?>
        <div class="row">
            <?php foreach ($news as $news_item): ?>
                <div class="col-md-4">
                    <div class="card mb-4 news-card">
                        <img src="<?php echo htmlspecialchars($news_item['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($news_item['title']); ?>">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo htmlspecialchars($news_item['title']); ?></h3>
                            <p class="card-text"><?php echo htmlspecialchars($news_item['content']); ?></p>
                            <small class="text-muted">Diterbitkan pada: <?php echo date('d M Y, H:i', strtotime($news_item['created_at'])); ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="about-school">
        <h2>Tentang Sekolah Kami</h2>
        <img src="images/gambarsekolah.jpg" alt="Tentang Sekolah">
        <p>Sekolah kami didirikan dengan tujuan untuk memberikan pendidikan berkualitas tinggi kepada siswa-siswi. Dengan fasilitas modern dan kurikulum yang terus diperbaharui, kami berkomitmen untuk mencetak generasi yang cerdas, kreatif, dan berakhlak mulia.</p>
        <p>Di sekolah kami, siswa tidak hanya belajar mata pelajaran akademik tetapi juga diajarkan untuk mengembangkan keterampilan sosial, kepribadian, dan nilai-nilai moral yang tinggi. Kami percaya bahwa pendidikan adalah kunci untuk masa depan yang lebih baik.</p>
        <p>Kami mengundang Anda untuk datang dan mengunjungi sekolah kami, melihat langsung fasilitas yang kami tawarkan, dan bertemu dengan staf pengajar yang berdedikasi. Kami yakin Anda akan terkesan dengan apa yang Anda temukan di sini.</p>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
