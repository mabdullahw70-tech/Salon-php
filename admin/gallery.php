<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Upload image
if (isset($_POST['upload'])) {

    $imageName = time() . "_" . $_FILES['image']['name'];
    $target = "../images/gallery/" . $imageName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        mysqli_query($conn, "INSERT INTO gallery (image) VALUES ('$imageName')");
        $success = "Image uploaded successfully!";
    } else {
        $error = "Failed to upload image.";
    }
}

// Fetch images
$images = mysqli_query($conn, "SELECT * FROM gallery ORDER BY uploaded_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h3>Gallery Management</h3>
    <a href="dashboard.php">← Back to Dashboard</a>

    <?php if(isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="post" enctype="multipart/form-data" class="my-4">
        <input type="file" name="image" required class="form-control mb-2">
        <button type="submit" name="upload" class="btn btn-primary">Upload Image</button>
    </form>

    <div class="row">
        <?php while($row = mysqli_fetch_assoc($images)) { ?>
            <div class="col-md-3 mb-3">
                <img src="../images/gallery/<?php echo $row['image']; ?>" class="img-fluid rounded shadow">
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
