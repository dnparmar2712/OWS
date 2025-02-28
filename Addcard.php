<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "ows";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $b_date = mysqli_real_escape_string($conn, $_POST['b_date']);
    $worker = mysqli_real_escape_string($conn, $_POST['worker']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);

    // Validate phone number (must be 10 digits)
    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        die("Invalid phone number. Please enter a 10-digit number.");
    }

    // Handle file upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = $_FILES['photo']['name'];
        $photo_tmp = $_FILES['photo']['tmp_name'];
        
        $upload_dir = "uploads/";

        // Create directory if not exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $photo_path = $upload_dir . basename($photo);
        move_uploaded_file($photo_tmp, $photo_path);
    } else {
        $photo = ""; // No file uploaded
    }

    // Insert into database
    $sql = "INSERT INTO `worker` (`id`, `name`, `state`, `city`, `photo`, `p_no`, `gender`, `b_date`, `worker`, `experience`) 
    VALUES (NULL, '$name', '$state', '$city', '$photo', '$phone', '$gender', '$b_date', '$worker', '$experience')";

    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD Card</title>
    <style>
        /* Previous styles remain the same */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            min-height: 100vh;
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: linear-gradient(145deg, #ffffff, #f3f4f6);
            
            width: 700px;
            padding: 1rem 2rem 1rem 2rem;
            border-radius: 15px;
            box-shadow: 0.5px 0.5px 10px #ff7800;
        }

        .title {
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: rem;
            background: linear-gradient(90deg, #333333, #666666);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-group {
            margin-bottom: 0.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.2rem;
            font-weight: 600;
            color: #374151;
        }

        input[type="text"],
        input[type="tel"],
        input[type="date"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            transition: all 0.3s ease;
            outline: none;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #ff7800;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .radio-group {
            display: flex;
            gap: 1.5rem;
        }

        .radio-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .radio-label:hover {
            color: #ff7800;
        }

        input[type="radio"] {
            margin-right: 0.5rem;
            cursor: pointer;
        }

        select {
            appearance: none;
            background-image:
                linear-gradient(45deg, transparent 50%, #666 50%),
                linear-gradient(135deg, #666 50%, transparent 50%);
            background-position:
                calc(100% - 20px) calc(1em + 2px),
                calc(100% - 15px) calc(1em + 2px);
            background-size:
                5px 5px,
                5px 5px;
            background-repeat: no-repeat;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            font-size: 1.125rem;
            font-weight: 600;
            color: white;
            background-color: #ff7800;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .otp {
            display: none;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 108, 44, 0.3);
        }

        @media (max-width: 640px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 1rem;
            }

            .radio-group {
                flex-direction: column;
                gap: 0.75rem;
            }
        }
    </style>
</head>

<body>
    <form action="Addcard.php" method="post" enctype="multipart/form-data">
        <div class="container">
            <h1 class="title">ADD Card</h1>


            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group grid">

                <label for="address">Address</label><br>
                <div>
                    <label for="state">State</label>
                    <select id="state" name="state" required>
                        <option value="">Select State</option>
                        <option value="state1">State 1</option>
                        <option value="state2">State 2</option>
                    </select>
                </div>
                <div>
                    <label for="city">City</label>
                    <select id="city" name="city" required>
                        <option value="">Select City</option>
                        <option value="city1">City 1</option>
                        <option value="city2">City 2</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" id="photo" accept="image/*" name="photo" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" required maxlength="10" name="phone">
                <!--<button type="button" class="submit-btn" onclick="otpVarification">Send OTP</button>-->
            </div>


            <div class="form-group">
                <label>Gender</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="gender" value="male" required>
                        Male
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="gender" value="female">
                        Female
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="gender" value="other">
                        Other
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="birthdate">Birth Date</label>
                <input type="date" id="birthdate" name="b_date" required>
            </div>

            <!-- New Work Experience Dropdown -->
            <div class="form-group">
                <label for="previous-work">Your Work</label>
                <select id="previous-work" name="worker" required>
                    <option value="">Select Your Work</option>
                    <option value="Labours">Labours</option>
                    <option value="Farm_Labours">Farm_Labours</option>
                    <option value="Electrician">Electrician</option>
                    <option value="Painter">Painter</option>
                    <option value="Carpenter">Carpenter</option>
                    <option value="Plumber">Plumber</option>
                    <option value="Driver">Driver</option>
                    <option value="Cameramen">Cameramen</option>
                    <option value="Mechanic">Mechanic</option>
                    <option value="Cleaner">Cleaner</option>
                    <option value="Technicians & Repair Workers">Technicians & Repair Workers</option>
                    <option value="Domestic Workers|Helpers">Domestic Workers|Helpers</option>
                    <option value="Welders|Fabricator">Welders|Fabricator</option>
                </select>
            </div>

            <div class="form-group">
                <label for="experience">Experience (Years)</label>
                <select id="experience" name="experience" required>
                    <option value="">Select Experience</option>
                    <script>
                        for (let i = 1; i <= 40; i++) {
                            document.write(`<option value="${i}">${i} Year${i === 1 ? '' : 's'}</option>`);
                        }
                    </script>
                </select>
            </div>

            <button type="submit" class="submit-btn" >Submit</button>

        </div>
    </form>
</body>
<script>
    
</script>


</html>