<?php
session_start();
require_once 'config.php'; // Include the database connection

if (!isset($_SESSION['restrictLogin'])) {
    // Redirect to login if not logged in
    header("Location: login.php");
    exit();
}

// Fetch user data from the database
$stmt = $pdo->prepare("SELECT firstname, lastname, phone, email FROM tbl_user WHERE id = ?");
$stmt->execute([$_SESSION['id']]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Libis GYM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
<style>
.btnbook {
    background-color: red;
    border-color: yellow;
    color: yellow;
    width: 200px;
    height: 40px;
    border-radius: 15px;
    margin-top: 20px;
    margin-left: 490px;
}
.btnbook:hover {
    color: red;
    background-color: yellow;
    border-color: red;
}
h3 {
    color: red;
    font-size: 40px;
    font-weight: bold;
    margin-bottom: 20px;
}
h4 {
    color: black;
    font-size: 20px;
}
.custom-select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    border-radius: 5px;
    color: #495057;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    appearance: none; /* Removes default arrow for custom styling */
    background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23495057" viewBox="0 0 4 5"><path d="M2 0L0 2h4L2 0z"/></svg>');
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 10px;
}

.custom-select:hover {
    border-color: #80bdff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
}

.custom-select:focus {
    outline: none;
    border-color: #80bdff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

</style>
</head>
<body>
    <!--header section-->
    <div class="header">
        <div class="logo-container">
          <img src="pic/logo.png" alt="Logo" width="60px" height="50px" margin-left="50px">
          <span class="text">LIBIS GYM</span>
        </div>
        <div class="nav" id="Nav">
          <a href="guest.php">Home</a>
          <div class="dropdown">
            <button class="btndrop">Book <i class="fa fa-caret-down"></i></button>
            <div class="dropdown-content">
                <a href="book.php" class="active">Book Now</a>
                <a href="history.php">Book History</a>
            </div>
        </div>
          <div class="dropdown">
            <button class="btndrop">Gym <i class="fa fa-caret-down"></i></button>
            <div class="dropdown-content">
              <a href="equipment.php">Equipment</a>
              <a href="contact.php">Contact</a>
            </div>
          </div>
          <a href="about.php">About</a>
          <a href="profile.php">Profile</a>
          <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
          </a>
        </div>
    </div>
    <!--book now section-->
    <div class="container book"  style="padding-top: 20px; padding-left: 40px; background-color: lightgray; width: 800px; height: 600px; margin-top: 100px;">
        <div class="row justify-content-start">
        <h3>Gym Appointment Form</h3>
        <h4><?php echo htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?></h4>
        <h4><?php echo htmlspecialchars($user['phone']); ?></h4>
        <h4><?php echo htmlspecialchars($user['email']); ?></h4>
            <div class="col-lg-6 col-md-8 col-sm-12">
                <form id="bookingform"  method="POST" action="process.php">
                    <div class="bform mb-3 row">
                        <label for="date" class="col-sm-4 col-form-label" style="margin-top: 20px; padding-left: 20px; padding-bottom: 0px; font-weight: 500; font-weight: bold;">Date </label>
                    </div>
                        <div class="col-sm-8">
                            <div class="mb-2">
                                <input type="date" class="form-control" id="date" name="date" style="width: 670px; margin-left: 20px;" required>
                            </div>
                        </div>
                    <div class="bform mb-3 row">
                        <label for="time" class="col-sm-4 col-form-label" style="padding-left: 20px; padding-bottom: 0px; font-weight: 500; font-weight: bold;">Time </label>
                    </div>
                        <div class="col-sm-8">
                            <select class="form-select custom-select" id="time" name="time" style="width: 670px; margin-left: 20px;" required>
                            <option selected disabled>Select a time slot</option>
                            <option value="08:00">8:00 AM</option>
                            <option value="08:30">8:30 AM</option>
                            <option value="09:00">9:00 AM</option>
                            <option value="09:30">9:30 AM</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="10:30">10:30 AM</option>
                            <option value="11:00">11:00 AM</option>
                            <option value="11:30">11:30 AM</option>
                            <option value="12:00">12:00 PM</option>
                            <option value="12:30">12:30 PM</option>
                            <option value="01:00">1:00 PM</option>
                            <option value="01:30">1:30 PM</option>
                            <option value="02:00">2:00 PM</option>
                            <option value="02:30">2:30 PM</option>
                            <option value="03:00">3:00 PM</option>
                            <option value="03:30">3:30 PM</option>
                            <option value="04:00">4:00 PM</option>
                            <option value="04:30">4:30 PM</option>
                            <option value="05:00">5:00 PM</option>
                            <option value="05:30">5:30 PM</option>
                            <option value="06:00">6:00 PM</option>
                            <option value="06:30">6:30 PM</option>
                            <option value="07:00">7:00 PM</option>
                            <option value="07:30">7:30 PM</option>
                            <option value="08:00">8:00 PM</option>
                            </select>
                        </div>
                    <div class="bform mb-3 row">
                        <label for="remarks" class="col-sm-4 col-form-label" style="padding-left: 20px; padding-bottom: 0px; font-weight: 500; font-weight: bold;">Remarks </label>
                    </div>
                        <div class="col-sm-8">
                        <textarea id="message" name="message" rows="3" style="border-radius: 7px; border: none; margin-left: 20px; width: 670px; display: flex;" placeholder="Enter Your Remarks..." required></textarea>
                            <!-- <input type="text" class="form-control" id="remarks" name="remarks" style="width: 670px; height: 50px; margin-left: 20px;"> -->
                        </div>
                    <button type="submit" class="btnbook">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!--footer section-->
    <footer>
        <p>Privacy Policy | Terms and Conditions</p>
    </footer>
    <script>
        function myFunction() {
            var x = document.getElementById("Nav");
            if (x.className === "nav") {
            x.className += " responsive";
            } else {
            x.className = "nav";
            }
        }
    </script>
    <!-- <script>
    const dateInput = document.getElementById('date');

    dateInput.addEventListener('input', function() {
        const selectedDate = new Date(this.value);
        const day = selectedDate.getUTCDay(); // Get the day of the week (0 = Sunday, 1 = Monday, ...)

        if (day === 0) { // Check if the selected day is Sunday
            alert('Sundays are not allowed. Please select a different date.');
            this.value = ''; // Clear the input
        }
    });
    </script> -->
</body>
</html>