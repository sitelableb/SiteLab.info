
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>SiteLab</title>
<link rel="stylesheet" href="css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="icon" type="image/png" href="assets/images/logo.png">
</head>

<body>

<?php require_once __DIR__ . "/includes/auth.php"; $user = currentUser(); ?>


<div id="loader">
    <div class="loader-box">
        <div class="spinner"></div>
        <div class="loader-text">Loading SiteLab...</div>
    </div>
</div>
<header class="topbar">

    <div class="logo">Site<span>Lab</span></div>

    <!-- DESKTOP NAV -->
    <nav class="nav-links">
        <a href="#home">Home</a>
        <a href="#services">Services</a>
        <a href="#pricing">Pricing</a>
        <a href="#contact">Contact</a>
    </nav>

    <!-- RIGHT DESKTOP AREA -->
    <div class="right">

        <?php if (!$user): ?>

            <a href="auth/login.php">
                <button class="login">Login</button>
            </a>

        <?php else: ?>

            <div class="profile-wrapper">
                <div class="profile-mini" onclick="toggleMenu()">
                    <img src="<?= $user["pfp"] ?>">
                    <span><?= $user["username"] ?></span>
                    <div class="arrow">▼</div>
                </div>

                <div class="dropdown" id="dropdownMenu">
                    <a href="profile.php">Profile</a>
                    <a href="#">Settings</a>
                    <?php if (!empty($user) && ($user["role"] ?? '') === "admin"): ?>
    <a href="admin/dashboard.php">Dashboard</a>
<?php endif; ?>
                    <a class="logout" href="auth/logout.php">Logout</a>
                </div>
            </div>

            <div class="balance">
                $<?= number_format($user["balance"], 2) ?>
            </div>

           <div class="notifications-wrapper">

    <div class="bell" onclick="toggleNotifications(event)">
        <i class="fa-solid fa-bell"></i>

        <?php
        $notificationCount = 3; // replace later with real unread count
        if ($notificationCount > 0):
        ?>
            <span class="notification-badge"><?= $notificationCount ?></span>
        <?php endif; ?>
    </div>

    <div class="notifications-panel" id="notificationsPanel">

        <div class="notifications-header">
            Notifications
        </div>

        <div class="notifications-list">

            <div class="notification unread">
                <div class="notification-icon success">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <div class="notification-content">
                    <h4>Purchase Successful</h4>
                    <p>Your Business plan has been activated.</p>
                    <span>2 minutes ago</span>
                </div>
            </div>

            <div class="notification">
                <div class="notification-icon info">
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="notification-content">
                    <h4>Profile Updated</h4>
                    <p>Your profile information was changed.</p>
                    <span>Yesterday</span>
                </div>
            </div>

            <div class="notification">
                <div class="notification-icon warning">
                    <i class="fa-solid fa-credit-card"></i>
                </div>

                <div class="notification-content">
                    <h4>Payment Received</h4>
                    <p>$30.00 has been added to your balance.</p>
                    <span>3 days ago</span>
                </div>
            </div>

        </div>

    </div>

</div>

        <?php endif; ?>

    </div>

    <!-- HAMBURGER (MOBILE ONLY) -->
    <div class="hamburger" onclick="toggleNav()">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="white">
            <path d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z"/>
        </svg>
    </div>

</header>

<!-- OFF CANVAS MENU -->
<div class="side-drawer" id="sideDrawer">

 <div class="drawer-content">

    <!-- USER HEADER -->
    <?php if ($user): ?>
    <div class="drawer-profile">
        <img src="<?= $user["pfp"] ?>">
        <div>
            <div class="name"><?= $user["username"] ?></div>
            <div class="balance">$<?= number_format($user["balance"], 2) ?></div>
        </div>
    </div>
    <?php endif; ?>

    <!-- NAVIGATION -->
    <div class="drawer-section">
        <div class="section-title">Navigation</div>

        <a href="#"><i class="fa-solid fa-house"></i> Home</a>
        <a href="#"><i class="fa-solid fa-screwdriver-wrench"></i> Services</a>
        <a href="#"><i class="fa-solid fa-tag"></i> Pricing</a>
        <a href="#"><i class="fa-solid fa-envelope"></i> Contact</a>
    </div>

    <!-- ACCOUNT -->
    <?php if ($user): ?>
    <div class="drawer-section">
        <div class="section-title">Account</div>

        <a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a>
        <a href="#"><i class="fa-solid fa-gear"></i> Settings</a>
        <a href="#"><i class="fa-solid fa-bell"></i> Notifications</a>
    </div>
    <?php endif; ?>

    <!-- SYSTEM -->
    <div class="drawer-section">
        <div class="section-title">System</div>

        <?php if (($user["role"] ?? '') === "admin"): ?>
            <a href="admin/dashboard.php"><i class="fa-solid fa-shield"></i> Dashboard</a>
        <?php endif; ?>

        <?php if ($user): ?>
            <a class="logout" href="auth/logout.php">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        <?php else: ?>
            <a href="auth/login.php">
                <i class="fa-solid fa-right-to-bracket"></i> Login
            </a>
        <?php endif; ?>
    </div>

</div>
</div>






<!-- overlay -->
<div class="overlay" id="overlay" onclick="toggleNav()"></div>

<section class="hero" id="home">

    <div class="hero-left">
        <span class="tag">Websites that drive results</span>

        <h1>
            Modern Websites<br>
            Built for <span>Growth</span>
        </h1>

        <p>
            We create fast, responsive and high-converting websites that help your business stand out and grow online.
        </p>

        <div class="buttons">
            <button class="primary">Get Started</button>
            <button class="secondary">View Work</button>
        </div>
    </div>

    <!-- MAC WINDOW PREVIEW -->
    <div class="mockup">

        <div class="mac-bar">
            <span class="red"></span>
            <span class="yellow"></span>
            <span class="green"></span>

            <div class="url">sitelab.dev</div>
        </div>

        <div class="screen">

            <div class="mock-header">
                <div class="mock-logo">SiteLab</div>
                <div class="mock-nav">
                    <span></span><span></span><span></span><span></span>
                </div>
            </div>

            <div class="mock-title">Digital Solutions That Drive <b>Success</b></div>

            <div class="mock-wave"></div>

            <div class="mock-cards">
                <div></div>
                <div></div>
                <div></div>
            </div>

        </div>
    </div>

</section>



<!-------------------WHy us?--------------------->
<section class="why">

    <div class="container">

        <div class="why-header" id="services">
            <h2>Our Services</h2>
            <p>We build websites designed to convert visitors into customers.</p>
        </div>

        <div class="why-grid">

            <div class="why-card">
                <div class="icon"><i class="fa-solid fa-bolt"></i></div>
                <h3>Web Development</h3>
                <p>Modern, responsive websites built with clean code.</p>
            </div>

            <div class="why-card">
                <div class="icon"><i class="fa-solid fa-cart-shopping"></i></div>
                <h3>E-Commerce</h3> 
                <p>Online stores that are fast, secure, and scalable.</p>
            </div>

            <div class="why-card">
                <div class="icon"><i class="fa-solid fa-palette"></i></div>
                <h3>UI/UX Design</h3> 
                <p>Beautiful interfaces designed to convert users.</p>
            </div>

            <div class="why-card">
                <div class="icon"><i class="fa-solid fa-mobile-screen"></i></div>
                <h3>Mobile Friendly</h3>
                <p>Every website works perfectly on all devices.</p>
            </div>

            <div class="why-card">
                <div class="icon"><i class="fa-solid fa-gauge-high"></i></div>
                <h3>Fast Performance</h3>
                <p>Optimized for speed and SEO ranking.</p>
            </div>

            <div class="why-card">
                <div class="icon"><i class="fa-solid fa-headset"></i></div>
                <h3>Support</h3>
                <p>We help you even after your website is launched.</p>
            </div>

        </div>

    </div>

</section>

<!------------------- PRICING --------------------->

<section class="pricing" id="pricing">

    <div class="container">

        <div class="pricing-header">
            <h2>Pricing Plans</h2>
            <p>Choose the perfect website package for your business.</p>
        </div>

        <div class="pricing-grid">

            <!-- STARTER -->
            <div class="price-card">

                <div class="plan-name">Starter</div>

                <div class="price">
                    $10
                    <span>/month</span>
                </div>

                <ul>
                    <li><i class="fa-solid fa-check"></i> Up to 3 Pages</li>
                    <li><i class="fa-solid fa-check"></i> Responsive Design</li>
                    <li><i class="fa-solid fa-check"></i> Contact Form</li>
                    <li><i class="fa-solid fa-check"></i> Basic SEO</li>

                    <li class="disabled"><i class="fa-solid fa-xmark"></i> E-Commerce</li>
                    <li class="disabled"><i class="fa-solid fa-xmark"></i> CMS Dashboard</li>
                    <li class="disabled"><i class="fa-solid fa-xmark"></i> Priority Support</li>
                </ul>

               <a href="https://whish.money/invoice/pay/?q=4SA2dL6oJ" target="_blank">
    <button class="buy-btn">Buy Now</button>
</a>

            </div>

            <!-- BUSINESS -->
            <div class="price-card featured">

                <div class="badge">BEST SELLER</div>

                <div class="plan-name">Business</div>

                <div class="price">
                    $30
                    <span>/month</span>
                </div>

                <ul>
                    <li><i class="fa-solid fa-check"></i> Up to 10 Pages</li>
                    <li><i class="fa-solid fa-check"></i> Custom Design</li>
                    <li><i class="fa-solid fa-check"></i> SEO Optimization</li>
                    <li><i class="fa-solid fa-check"></i> CMS Dashboard</li>
                    <li><i class="fa-solid fa-check"></i> Speed Optimization</li>
                    <li><i class="fa-solid fa-check"></i> Email Setup</li>

                    <li class="disabled"><i class="fa-solid fa-xmark"></i> Advanced Integrations</li>
                </ul>

                <button class="buy-btn">Buy Now</button>

            </div>

            <!-- PREMIUM -->
            <div class="price-card">

                <div class="plan-name">Premium</div>

                <div class="price">
                    $99
                    <span>/month</span>
                </div>

                <ul>
                    <li><i class="fa-solid fa-check"></i> Unlimited Pages</li>
                    <li><i class="fa-solid fa-check"></i> Full Custom Design</li>
                    <li><i class="fa-solid fa-check"></i> E-Commerce Store</li>
                    <li><i class="fa-solid fa-check"></i> CMS Dashboard</li>
                    <li><i class="fa-solid fa-check"></i> Advanced SEO</li>
                    <li><i class="fa-solid fa-check"></i> Premium Support</li>
                    <li><i class="fa-solid fa-check"></i> Lifetime Updates</li>
                </ul>

                <button class="buy-btn">Buy Now</button>

            </div>

        </div>

    </div>

</section>


<!------------------- FOOTER --------------------->

<footer class="footer" id="contact">

    <div class="container">

        <div class="footer-grid">

            <!-- BRAND -->
            <div class="footer-column">

                <h2 class="footer-logo">Site<span>Lab</span></h2>

                <p>
                    We build modern, high-performing websites that help
                    businesses grow online.
                </p>

            </div>

            <!-- CONTACT -->
            <div class="footer-column">

                <h3>Contact</h3>

                <a href="mailto:contact@sitelab.dev">
                    <i class="fa-solid fa-envelope"></i>
                    sitelab.leb@gmail.com
                </a>

                <a href="tel:+96170123456">
                    <i class="fa-solid fa-phone"></i>
                    +961 81 634 151<br>
                    +961 76 680 568
                </a>

            </div>

            <!-- QUICK LINKS -->
            <div class="footer-column">

                <h3>Quick Links</h3>

                <a href="#home">Home</a>
                <a href="#services">Services</a>
                <a href="#pricing">Pricing</a>
                <a href="#contact">Contact</a>

            </div>

            <!-- FAQ -->
            <div class="footer-column">

                <h3>FAQ</h3>

                <a href="#">How long does a website take?</a>
                <a href="#">Do you redesign websites?</a>
                <a href="#">Do you offer hosting?</a>
                <a href="#">Can I update my website?</a>

            </div>

        </div>

        <div class="footer-bottom">

            <div class="socials">

                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/sitelab.leb?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-github"></i></a>

            </div>

            <p>
                © <?php echo date("Y"); ?> SiteLab. All Rights Reserved.
            </p>

        </div>

    </div>

</footer>









<script src="./js/main.js"></script>

<script>
(function () {
    const loader = document.getElementById("loader");

    function removeLoader() {
        if (!loader) return;
        loader.classList.add("hide");
    }

    // Always run no matter what state the page is in
    setTimeout(removeLoader, 800);
})();
</script>
</body>
</html>