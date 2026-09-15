<?php
include("config/db.php");
$images = mysqli_query($conn, "SELECT * FROM gallery ORDER BY uploaded_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Gallery | Elegant Touch Salon</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">

<style>
.gallery-img {
    border-radius: 15px;
    transition: transform 0.3s ease;
}
.gallery-img:hover {
    transform: scale(1.05);
}
</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.html">New Look</a>
  </div>
</nav>

<section class="page-header text-center text-white">
    <div class="container">
        <h1>Our Gallery</h1>
        <p>Beauty captured in moments</p>
    </div>
</section>

<section class="py-5">
<div class="container">
<div class="row g-4">

<?php while($row = mysqli_fetch_assoc($images)) { ?>
    <div class="col-md-4 col-sm-6">
        <img src="images/gallery/<?php echo $row['image']; ?>" class="img-fluid gallery-img shadow">
    </div>
<?php } ?>

</div>
</div>
</section>

<footer class="bg-dark text-white text-center py-4">
<p class="mb-0">&copy; 2025 New Look Salon</p>
</footer>

</body>
</html>
