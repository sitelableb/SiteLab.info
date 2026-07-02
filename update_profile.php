<?php

require_once __DIR__ . "/includes/auth.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user = currentUser();

if (!$user) {
    header("Location: auth/login.php");
    exit;
}

/* =========================
   LOAD USERS DATABASE
========================= */

$usersFile = __DIR__ . "/data/users.json";

if (!file_exists($usersFile)) {
    file_put_contents($usersFile, json_encode([]));
}

$users = json_decode(file_get_contents($usersFile), true);

/* =========================
   GET FORM DATA
========================= */

$newUsername = trim($_POST["username"] ?? $user["username"]);
$newEmail    = trim($_POST["email"] ?? $user["email"]);

/* =========================
   UPDATE PROFILE PICTURE
========================= */

$pfpPath = $user["pfp"];

if (isset($_FILES["pfp"]) && $_FILES["pfp"]["error"] === UPLOAD_ERR_OK) {

    $uploadDir = __DIR__ . "/uploads/profile_pictures/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $ext = pathinfo($_FILES["pfp"]["name"], PATHINFO_EXTENSION);
    $fileName = uniqid("pfp_", true) . "." . $ext;

    $targetPath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES["pfp"]["tmp_name"], $targetPath)) {
        $pfpPath = "uploads/profile_pictures/" . $fileName;
    }
}

/* =========================
   FIND & UPDATE USER
   (using email as identifier)
========================= */

foreach ($users as &$u) {

    if ($u["email"] === $user["email"]) {

        $u["username"] = $newUsername;
        $u["email"] = $newEmail;
        $u["pfp"] = $pfpPath;

        // update session too
        $_SESSION["user"] = $u;

        break;
    }
}

unset($u);

/* =========================
   SAVE BACK TO FILE
========================= */

file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

/* =========================
   REDIRECT
========================= */

header("Location: index.php");
exit;