<?php

require_once __DIR__ . "/includes/auth.php";

if (!currentUser()) {
    header("Location: auth/login.php");
    exit;
}

$user = currentUser();

$success = isset($_GET["success"]);

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Profile | SiteLab</title>

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/profile.css">
<link rel="icon" type="image/png" href="assets/images/logo.png">
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

<header class="topbar">

    <a href="index.php" style="text-decoration:none;">
        <div class="logo">Site<span>Lab</span></div>
    </a>

    <nav class="nav-links">
        <a href="index.php">Home</a>
        <a href="#">Services</a>
        <a href="#">Pricing</a>
        <a href="#">Contact</a>
    </nav>

    <div class="right">

        <div class="balance">

            $<?= number_format($user["balance"],2) ?>

        </div>

        <a href="index.php">

            <button class="secondary">

                Back

            </button>

        </a>

    </div>

</header>

<main class="profile-page">

<div class="profile-container">

<?php if($success): ?>

<div class="success-box">

<i class="fa-solid fa-circle-check"></i>

Your profile has been updated successfully.

</div>

<?php endif; ?>

<h1>My Profile</h1>

<p class="subtitle">

Manage your account information.

</p>

<form

action="update_profile.php"

method="POST"

enctype="multipart/form-data"

id="profileForm">

<div class="picture-section">

<input

type="file"

name="pfp"

id="pfp"

accept="image/*"

hidden>

<label for="pfp">

<img

src="<?= htmlspecialchars($user["pfp"]) ?>"

id="previewImage"

class="profile-picture">

<div class="change-overlay">

<i class="fa-solid fa-camera"></i>

<span>Change Photo</span>

</div>

</label>

</div>

<div class="fields-section">

    <div class="field">

        <label>Username</label>

        <input 
            type="text" 
            name="username" 
            value="<?= htmlspecialchars($user["username"]) ?>" 
            required>

    </div>

    <div class="field">

        <label>Email</label>

        <input 
            type="email" 
            name="email" 
            value="<?= htmlspecialchars($user["email"]) ?>" 
            required>

    </div>

</div>

<div class="actions">

    <button type="submit" class="primary-btn">

        Save Changes

    </button>

</div>

</form>

</div>

</main>

<script>
// Preview profile picture before upload
const fileInput = document.getElementById("pfp");
const previewImage = document.getElementById("previewImage");

fileInput.addEventListener("change", function () {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            previewImage.src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
});
</script>

</body>
</html>