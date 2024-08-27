<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Aruna Bootstrap Template - Photo</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <style>
        #upload-section { display: none; }
        .photo-container { position: relative; }
        .delete-button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            position: absolute;
            top: 10px;
            right: 10px;
            display: none;
        }
        .delete-button:hover { background-color: #c82333; }
    </style>
</head>

<body>
    <header id="header" class="fixed-top">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h1 class="logo me-auto me-lg-0"><a href="index.html">Aruna</a></h1>
            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="project.html">Projects</a></li>
                    <li><a href="education.html">Education</a></li>
                    <li><a href="skill.html">Skills</a></li>
                    <li><a href="membership.html">Memberships</a></li>
                    <li><a class="active" href="photo.php">Photos</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <div class="header-social-links">
        <a href="mailto:ehos.sampath@gmail.com" class="email"><i class="bi bi-envelope-at"></i></a>
        <a href="assets/cv/CV.pdf" download="Your Name - CV.pdf" class="cv"><i class="bi bi-file-earmark-person"></i></a>
        <a href="https://www.linkedin.com/in/aruna-sampath" class="linkedin"><i class="bi bi-linkedin"></i></a>
        <a href="https://www.facebook.com/ehosaruna?mibextid=ZbWKwL" class="facebook"><i class="bi bi-facebook"></i></a>
      </div>
    </div>
    </header>

    <main id="main">
        <section id="photos" class="photos">
            <div id="login-section" class="d-none">
                <div class="section-title">
                    <h2 class="text-white">Login to Add Photos</h2>
                </div>
                <form id="login-form" class="p-4">
                    <div class="form-group">
                        <label for="username" class="text-white">Username</label>
                        <input type="text" class="form-control" id="username" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="password" class="text-white">Password</label>
                        <input type="password" class="form-control" id="password" required>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary col-4">Login</button>
                    </div>
                </form>
            </div>

            <div id="photo-section" class="">
                <div class="section-title">
                    <h2 class="text-white">Photos</h2>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="text-white text-center mx-3"></div>
                    <button id="login-button" class="btn btn-primary mx-3" onclick="login()">
                        <i class="bi bi-pen mx-1"></i>
                        Edit
                    </button>
                    <button id="logout-button" class="btn btn-danger mx-3 d-none">
                        <i class="bi bi-box-arrow-in-left mx-2"></i>
                        Logout
                    </button>
                </div>
                <div id="photo-gallery" class="row mx-2">
                    <?php
                    // This assumes you have set up the photos array correctly
                    // For example, this could be populated by querying a database
                    $photos = []; // Replace this with your actual array of photo URLs
                    
                    $isAuthenticated = isset($_COOKIE['authenticated']) && $_COOKIE['authenticated'] === 'true';

                    if (empty($photos)) {
                        echo "<p>No photos available.</p>";
                    } else {
                        foreach ($photos as $photoUrl) {
                            echo "<div class='col-4 mb-3 photo-container'>";
                            echo "<img src='" . htmlspecialchars($photoUrl, ENT_QUOTES, 'UTF-8') . "' alt='Photo' class='img-thumbnail w-100'>";
                            if ($isAuthenticated) {
                                echo "<button class='delete-button'>Delete</button>";
                            }
                            echo "</div>";
                        }
                    }
                    ?>
                </div>
                
                <div class="photo-upload mt-4" id="upload-section">
                    <input type="file" id="photo-input" accept="image/*" class="form-control mb-2">
                    <button id="upload-button" class="btn btn-primary">Upload Photo</button>
                </div>
            </div>
        </section>
    </main>

    <script>
        const fixedUsername = 'admin';
        const fixedPassword = 'password';
        const isAuthenticated = getCookie('authenticated');
        const isOwner = getCookie('isOwner') === 'true';

        function getCookie(name) {
            let cookieArr = document.cookie.split(";");
            for (let i = 0; i < cookieArr.length; i++) {
                let cookiePair = cookieArr[i].split("=");
                if (name === cookiePair[0].trim()) {
                    return decodeURIComponent(cookiePair[1]);
                }
            }
            return null;
        }

        function setCookie(name, value, days) {
            let date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            let expires = "expires=" + date.toUTCString();
            document.cookie = name + "=" + value + ";" + expires + ";path=/;";
        }

        function deleteCookie(name) {
            document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        }

        document.getElementById('login-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            if (username === fixedUsername && password === fixedPassword) {
                setCookie('authenticated', 'true', 1);
                setCookie('isOwner', 'true', 1);
                showPhotoSection(true);
            } else {
                alert('Invalid credentials');
            }
        });

        function showPhotoSection(isOwner = false) {
            document.getElementById('photo-section').style.display = 'block';
            if (isOwner) {
                document.getElementById('login-button').classList.add('d-none');
                document.getElementById('logout-button').classList.remove('d-none');
                document.getElementById('upload-section').style.display = 'block';
                document.getElementById('photo-section').classList.remove('d-none');
                document.getElementById('login-section').classList.add('d-none');
            }
            loadPhotos(isOwner);
        }

        document.getElementById('logout-button').addEventListener('click', function () {
            deleteCookie('authenticated');
            deleteCookie('isOwner');
            location.reload();
        });

        showPhotoSection(isOwner);

        document.getElementById('upload-button').addEventListener('click', function () {
            const input = document.getElementById('photo-input');
            const file = input.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('photo', file);

                fetch('photo.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let isOwner = getCookie('isOwner') === 'true';
                        loadPhotos(isOwner);
                    } else {
                        alert('Photo upload failed.');
                    }
                })
                .catch(error => {
                    console.error('Error uploading photo:', error);
                });
            } else {
                alert('Please select a photo to upload.');
            }
        });

        function loadPhotos(isOwner = false) {
            let photoGallery = document.getElementById('photo-gallery');
            let isAuthenticated = getCookie('authenticated') === 'true';

            fetch('photo.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'action=loadPhotos'
            })
            .then(response => response.json())
            .then(photos => {
                photoGallery.innerHTML = '';
                if (photos.length > 0) {
                    photos.forEach(photoUrl => {
                        let photoContainer = document.createElement('div');
                        photoContainer.className = 'col-4 mb-3 photo-container';
                        photoContainer.innerHTML = `
                            <img src="${photoUrl}" alt="Photo" class="img-thumbnail w-100">
                        `;
                        if (isAuthenticated) {
                            let deleteButton = document.createElement('button');
                            deleteButton.className = 'delete-button';
                            deleteButton.innerText = 'Delete';
                            deleteButton.onclick = () => deletePhoto(photoUrl);
                            photoContainer.appendChild(deleteButton);
                        }
                        photoGallery.appendChild(photoContainer);
                    });
                } else {
                    photoGallery.innerHTML = '<p>No photos available.</p>';
                }
            });
        }

        function deletePhoto(photoUrl) {
            if (confirm('Are you sure you want to delete this photo?')) {
                fetch('photo.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `action=deletePhoto&photoUrl=${encodeURIComponent(photoUrl)}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadPhotos(getCookie('isOwner') === 'true');
                    } else {
                        alert('Failed to delete photo.');
                    }
                });
            }
        }
    </script>

<footer id="footer">
  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong><span>Aruna</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
