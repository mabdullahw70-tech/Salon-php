<?php
// STEP 5.4: Database connection
include("config/db.php");

// Check if form is submitted
if (isset($_POST['submit'])) {

    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $service = mysqli_real_escape_string($conn, $_POST['service']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert into database
    $query = "INSERT INTO appointments 
              (name, phone, service, appointment_date, appointment_time, email, message)
              VALUES ('$name', '$phone', '$service', '$date', '$time', '$email', '$message')";

    if (mysqli_query($conn, $query)) {
        $success = "Appointment booked successfully!";
    } else {
        $error = "Error booking appointment: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment | New Look Salon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.html">New Look</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
        <li class="nav-item"><a class="nav-link" href="services.html">Services</a></li>
        <li class="nav-item"><a class="nav-link active" href="booking.php">Book</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- PAGE HEADER -->
<section class="page-header text-center text-white">
  <div class="container">
    <h1>Book an Appointment</h1>
    <p>We’ll take care of the rest 💄</p>
  </div>
</section>

<!-- BOOKING FORM -->
<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="service-box">

          <?php
          if(isset($success)){
              echo '<div class="alert alert-success text-center">' . $success . '</div>';
          }
          if(isset($error)){
              echo '<div class="alert alert-danger text-center">' . $error . '</div>';
          }
          ?>

          <form method="post" action="">
            <div class="row g-3">

              <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <input type="tel" name="phone" class="form-control" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Service</label>
                <select name="service" class="form-select" required>
                  <option value="">Select Service</option>
                  <option>Hair Styling</option>
                  <option>Makeup</option>
                  <option>Facial</option>
                  <option>Bridal Makeup</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">Preferred Date</label>
                <input type="date" name="date" class="form-control" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Preferred Time</label>
                <input type="time" name="time" class="form-control" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Email (Optional)</label>
                <input type="email" name="email" class="form-control">
              </div>

              <div class="col-12">
                <label class="form-label">Message</label>
                <textarea name="message" class="form-control" rows="4"></textarea>
              </div>

              <div class="col-12 text-center">
                <button type="submit" name="submit" class="btn btn-primary btn-lg mt-3">
                  Book Appointment
                </button>
              </div>

            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4">
  <p class="mb-0">&copy; 2025 Elegant Touch Salon. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
