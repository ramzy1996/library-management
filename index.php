<?php
session_start();
include('./connection.php');
// include('./restrictuser.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Home page</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="userassets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="userassets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="userassets/css/style.css" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="index.php">Library Management</a></h1>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#home">Home</a></li>
                    <li><a class="nav-link scrollto" href="#book">Book List</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact Us</a></li>
                    <?php if (isset($_SESSION['other'])) { ?>
                        <li><a class="nav-link scrollto" href="settingsstd.php#profile">Profile</a></li>
                        <li><a class="nav-link scrollto" href="logout.php">Logout</a></li>
                    <?php } else if (isset($_SESSION['Librarian'])) { ?>
                        <li><a class="nav-link scrollto" href="logout.php">Logout</a></li>
                    <?php } else { ?>
                        <li><a class="nav-link scrollto" href="login.php#login">Login</a></li>
                    <?php } ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar -->

        </div>
    </header>
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="home">
        <div class="hero-container">
            <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

                <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

                <div class="carousel-inner" role="listbox">

                    <!-- Slide 1 -->
                    <div class="carousel-item active" style="background: url(userassets/img/slide/slide-1.jpg);">
                        <div class="carousel-container">
                            <div class="carousel-content">
                                <h2 class="animate__animated animate__fadeInDown">Nothing is pleasanter than exploring a library!</h2>
                                <p class="animate__animated animate__fadeInUp">Libraries store the energy that fuels the imagination. They open up windows to the world and inspire us to explore and achieve, and contribute to improving our quality of life.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item" style="background: url(userassets/img/slide/slide-2.jpg);">
                        <div class="carousel-container">
                            <div class="carousel-content">
                                <h2 class="animate__animated animate__fadeInDown">Community</h2>
                                <p class="animate__animated animate__fadeInUp">Bad libraries build collections, good libraries build services, great libraries build communities..</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="carousel-item" style="background: url(userassets/img/slide/slide-3.jpg);">
                        <div class="carousel-background"><img src="userassets/img/slide/slide-3.jpg" alt=""></div>
                        <div class="carousel-container">
                            <div class="carousel-content">
                                <h2 class="animate__animated animate__fadeInDown">Books are the best weapon!</h2>
                                <p class="animate__animated animate__fadeInUp">Libraries were full of ideas – perhaps the most dangerous and powerful of all weapons.</p>
                            </div>
                        </div>
                    </div>

                </div>

                <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                </a>

                <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                </a>

            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= book Section ======= -->
        <section id="book" class="services">
            <div class="container">
                <div class="section-title">
                    <h2>Our Book List</h2>
                    <p>Librarians are almost always very helpful and often almost absurdly knowledgeable. Their skills are probably very underestimated and largely underemployed..</p>
                </div>
                <!-- card -->

                <div class="card-deck row">
                    <?php
                    $sql = "select * from books";
                    $res = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($res) > 0) {

                        while ($row = mysqli_fetch_array($res)) {

                            $id = $row['id'];
                            $bookname = $row['bookname'];
                            $category = $row['category'];
                            $publisher = $row['publisher'];
                            $year = $row['year'];
                            $isbn = $row['isbn'];
                            $date = $row['date'];
                            $status = $row['status'];
                            $image = $row['image'];

                    ?>
                            <div class="card col-md-4">
                                <h4 class="card-title mt-3 text-center"><?php echo $bookname; ?>(<?php echo $year; ?>)<span style="font-size: 10px;" class="badge top-0 <?php if ($status == 'Available') echo "bg-success";
                                                                                                                                                                        else echo "bg-warning"; ?>"><?php echo $status; ?></span></h4>
                                <div class="card-title text-center">Publisher Name: <?php echo $publisher; ?></div>

                                <?php if (!empty($image)) : ?>
                                    <img src="images/<?php echo $image ?>" style="border-radius: 10px;" class="card-img-top" height="350px">
                                <?php else : ?>
                                    <img src="images/books.png" class="card-img-top" height="350px">
                                <?php endif ?>
                                <div class="card-footer">
                                    <a href="book_details.php?pckid=<?php echo $id; ?>" class="btn btn-primary <?php if ($status != 'Available') echo "disabled" ?>" style="width: 100%;">View</a>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <div>No record found</div>
                    <?php } ?>
                </div>
            </div>
        </section><!-- End Services Section -->

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">

                <div class="row no-gutters">
                    <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start"></div>
                    <div class="col-xl-7 ps-0 ps-lg-5 pe-lg-1 d-flex align-items-stretch">
                        <div class="content d-flex flex-column justify-content-center">
                            <h3>Lova State University Library</h3>
                            <p>
                                Who Needs a Librarian and Cataloger When You Have Google and Internet? Well, Who Needs a Teacher When You Have Wikipedia? And, Who Needs a Doctor When You Have WebMD? Just as the Wikipedia Doesn't Replace the Teacher, and WebMD Doesn’t Replace the Doctor, In the Same Way, Google Search and Internet Doesn’t Replace the Librarian and Cataloger.
                            </p>
                            <div class="row">
                                <div class="col-md-6 icon-box">
                                    <i class="bx bx-receipt"></i>
                                    <h4>When in doubt go to the library.!</h4>
                                    <p>One of the most famous quotes by J.K. Rowling in one of the most stunning visualizations – obviously by Risa Rodil. You can get this particular design from Redbubble, placed on many items, including wall art, apparel, iPad cases, mugs, tote bags, and even duvet covers!</p>
                                </div>
                                <div class="col-md-6 icon-box">
                                    <i class="bx bx-cube-alt"></i>
                                    <h4>When I got my library card, that’s when my life began.</h4>
                                    <p>Libraries will get you through times of no money better than money will get you through times of no libraries.When you absolutely positively have to know, ask a librarian.</p>
                                </div>
                                <div class="col-md-6 icon-box">
                                    <i class="bx bx-images"></i>
                                    <h4>Libraries were full of ideas – perhaps the most dangerous and powerful of all weapons.</h4>
                                    <p>A library is the delivery room for the birth of ideas, a place where history comes to life.I ransack public libraries, and find them full of sunk treasure.</p>
                                </div>
                                <div class="col-md-6 icon-box">
                                    <i class="bx bx-shield"></i>
                                    <h4>Libraries always remind me that there are good things in this world.</h4>
                                    <p>Cutting libraries during a recession is like cutting hospitals during a plague.If you want to get laid, go to college. If you want an education, go to the library.Shout for libraries. Shout for the young readers who use them.</p>
                                </div>
                            </div>
                        </div><!-- End .content-->
                    </div>
                </div>

            </div>
        </section>
        <!-- End About Section -->



        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                    <h2>Contact Us</h2>
                </div>

                <div class="row contact-info">

                    <div class="col-md-4">
                        <div class="contact-address">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Address</h3>
                            <address>Somewhere on earth</address>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-phone">
                            <i class="bi bi-phone"></i>
                            <h3>Phone Number</h3>
                            <p><a href="tel:+940777123456">+940777123456</a></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-email">
                            <i class="bi bi-envelope"></i>
                            <h3>Email</h3>
                            <p><a href="mailto:info@example.com">info@example.com</a></p>
                        </div>
                    </div>

                </div>

                <div class="form">
                    <form method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>2021</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by Ruzny
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="userassets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Template Main JS File -->
    <script src="userassets/js/main.js"></script>
</body>

</html>