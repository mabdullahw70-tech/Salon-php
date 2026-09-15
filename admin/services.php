<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("../config/db.php");

if(isset($_POST['add_service'])){
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "../images/services/".$image);

    $query = "INSERT INTO services (name, description, price, image)
              VALUES ('$name','$desc','$price','$image')";
    mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Services</title>
  <link rel="stylesheet" href="../assets/bootstrap.min.css">
</head>
<body class="container mt-5">

<h2>Add New Service</h2>

<form method="POST" enctype="multipart/form-data">
  <input type="text" name="name" class="form-control mb-2" placeholder="Service Name" required>
  <textarea name="description" class="form-control mb-2" placeholder="Description" required></textarea>
  <input type="text" name="price" class="form-control mb-2" placeholder="Price (e.g Rs. 2000)" required>
  <input type="file" name="image" class="form-control mb-2" required>
  <button name="add_service" class="btn btn-success">Add Service</button>
</form>

<hr>

<h3>Existing Services</h3>

<table class="table table-bordered">
<tr>
  <th>Image</th>
  <th>Name</th>
  <th>Price</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM services");
while($row = mysqli_fetch_assoc($result)){
?>
<tr>
  <td><img src="../images/services/<?php echo $row['image']; ?>" width="80"></td>
  <td><?php echo $row['name']; ?></td>
  <td><?php echo $row['price']; ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>
