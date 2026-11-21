
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Fresh Fruits & Vegetables</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shop fresh fruits and vegetables at Fruitables. Enjoy quality products and a convenient online shopping experience.">
    <meta name="keywords" content="Fruitables, fresh fruits, vegetables, online grocery">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
        rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo e(asset('user/lib/lightbox/css/lightbox.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('user/lib/owlcarousel/assets/owl.carousel.min.css')); ?>" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="<?php echo e(asset('user/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <!-- Template CSS -->
    <link href="<?php echo e(asset('user/css/style.css')); ?>" rel="stylesheet">

    <!-- Custom CSS removed: using Bootstrap classes -->

</head>

<body>

    <!-- ================= NAVBAR START ================= -->

    <div class="container-fluid fixed-top bg-white shadow-sm">

        <div class="container px-0">

            <nav class="navbar navbar-light bg-white navbar-expand-xl">

                <!-- Website Logo -->
                <a href="<?php echo e(route('user#homePage')); ?>"
                    class="navbar-brand d-flex align-items-center py-1">

                    
                        <img src="<?php echo e(asset('user/img/posLogoDesign.png')); ?>"
    alt="POS Logo"
    style="width: 180px; height: 65px; object-fit: contain;"
    class="img-fluid">

                </a>

                <!-- Mobile Toggle Button -->
                <button class="navbar-toggler py-2 px-3" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-label="Toggle navigation">

                    <span class="fa fa-bars text-primary"></span>

                </button>

                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">

                    <!-- Navigation Links -->
                    <div class="navbar-nav mx-auto">

                        <a href="<?php echo e(route('user#homePage')); ?>"
                            class="nav-item nav-link <?php echo e(request()->routeIs('user#homePage') ? 'active' : ''); ?>">
                            Shop
                        </a>

                        <a href="<?php echo e(route('user#cart')); ?>"
                            class="nav-item nav-link <?php echo e(request()->routeIs('user#cart') ? 'active' : ''); ?>">
                            Cart
                        </a>

                        <a href="<?php echo e(route('user#contactPage')); ?>"
                            class="nav-item nav-link <?php echo e(request()->routeIs('user#contactPage') ? 'active' : ''); ?>">
                            Contact
                        </a>

                    </div>

                    <div class="d-flex flex-wrap align-items-center justify-content-center m-3 me-0">

                        <!-- Cart -->
                        <a href="<?php echo e(route('user#cart')); ?>"
                            class="position-relative me-4 my-auto"
                            aria-label="Shopping Cart">

                            <i class="fa fa-shopping-bag fa-2x"></i>

                        </a>

                        <!-- Order List -->
                        <a href="<?php echo e(route('user#orderList')); ?>"
                            class="position-relative me-4 my-auto"
                            aria-label="My Orders">

                            <i class="fa-solid fa-list-check fa-2x"></i>

                        </a>

                        <!-- User Profile Dropdown -->
                        <div class="nav-item dropdown">

                            <a href="#" class="nav-link dropdown-toggle my-auto"
                                data-bs-toggle="dropdown">

                                <img src="<?php echo e(asset(empty(Auth::user()->profile)
                                    ? 'default/profile.jpg'
                                    : 'profile/' . Auth::user()->profile)); ?>"
                                    width="50"
                                    height="50"
                                    class="img-profile rounded-circle object-fit-cover"
                                    alt="Profile">

                                <span>
                                    <?php echo e(Auth::user()->name == null
                                        ? Auth::user()->nickname
                                        : Auth::user()->name); ?>

                                </span>

                            </a>

                            <div class="dropdown-menu dropdown-menu-end m-0 bg-secondary rounded-0">

                                <a href="<?php echo e(route('user#profile')); ?>"
                                    class="dropdown-item py-2">
                                    Edit Profile
                                </a>

                                <a href="<?php echo e(route('user#changePasswordPage')); ?>"
                                    class="dropdown-item py-2">
                                    Change Password
                                </a>

                                <div class="px-3 py-2">

                                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>

                                        <button type="submit"
                                            class="btn btn-outline-success rounded w-100">
                                            Logout
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </nav>

        </div>

    </div>

    <!-- ================= NAVBAR END ================= -->


    <!-- Main Content -->
    <?php echo $__env->yieldContent('content'); ?>


    <!-- SweetAlert -->
    <?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


    <!-- ================= FOOTER START ================= -->

    <footer class="bg-dark text-white pt-5 mt-5">

        <div class="container">

            <!-- Footer Top -->
            <div class="row align-items-center">

                <!-- Brand Logo -->
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">

                    <a href="<?php echo e(route('user#homePage')); ?>">

                        
                            <img src="<?php echo e(asset('user/img/posLogoDesign.png')); ?>"
    alt="POS Logo"
    style="width: 180px; height: 65px; object-fit: contain;"
    class="img-fluid">

                    </a>

                    

                </div>

                <!-- Social Media -->
                <div class="col-md-6 text-center text-md-end">

                    <a href="#"
                        class="btn btn-outline-warning rounded-circle m-1"
                        aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>

                    <a href="#"
                        class="btn btn-outline-warning rounded-circle m-1"
                        aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <a href="#"
                        class="btn btn-outline-warning rounded-circle m-1"
                        aria-label="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>

                    <a href="#"
                        class="btn btn-outline-warning rounded-circle m-1"
                        aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>

                    <a href="#"
                        class="btn btn-outline-warning rounded-circle m-1"
                        aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>

                </div>

            </div>

            <hr class="border-warning my-4">


            <!-- Footer Main Content -->
            <div class="row g-4">

                <!-- Column 1 -->
                <div class="col-lg-3 col-md-6">

                    <h5 class="text-white fs-5 fw-semibold mb-3">
                        Why People Like Us!
                    </h5>

                    <p class="text-white-50 lh-lg small">
                        We provide fresh and quality products
                        for our customers. Our goal is to make
                        your shopping experience easy,
                        convenient and enjoyable.
                    </p>

                </div>


                <!-- Column 2 -->
                <div class="col-lg-3 col-md-6">

                    <h5 class="text-white fs-5 fw-semibold mb-3">
                        Shop Info
                    </h5>

                    <ul class="list-unstyled">

                        <li class="mb-2">
                            <a href="<?php echo e(route('user#homePage')); ?>"
                                class="text-white-50 text-decoration-none">
                                <i class="fas fa-angle-right me-2"></i>
                                Shop
                            </a>
                        </li>

                        <li class="mb-2">
                            <a href="<?php echo e(route('user#contactPage')); ?>"
                                class="text-white-50 text-decoration-none">
                                <i class="fas fa-angle-right me-2"></i>
                                Contact Us
                            </a>
                        </li>

                        <li class="mb-2">
                            <a href="<?php echo e(route('user#privacyPolicy')); ?>"
                                class="text-white-50 text-decoration-none">
                                <i class="fas fa-angle-right me-2"></i>
                                Privacy Policy
                            </a>
                        </li>

                        <li class="mb-2">
                            <a href="<?php echo e(route('user#termsConditions')); ?>"
                                class="text-white-50 text-decoration-none">
                                <i class="fas fa-angle-right me-2"></i>
                                Terms & Conditions
                            </a>
                        </li>

                    </ul>

                </div>


                <!-- Column 3 -->
                <div class="col-lg-3 col-md-6">

                    <h5 class="text-white fs-5 fw-semibold mb-3">
                        My Account
                    </h5>

                    <ul class="list-unstyled">

                        <li class="mb-2">
                            <a href="<?php echo e(route('user#profile')); ?>"
                                class="text-white-50 text-decoration-none">
                                <i class="fas fa-angle-right me-2"></i>
                                My Account
                            </a>
                        </li>

                        <li class="mb-2">
                            <a href="<?php echo e(route('user#homePage')); ?>"
                                class="text-white-50 text-decoration-none">
                                <i class="fas fa-angle-right me-2"></i>
                                Browse Products
                            </a>
                        </li>

                        <li class="mb-2">
                            <a href="<?php echo e(route('user#cart')); ?>"
                                class="text-white-50 text-decoration-none">
                                <i class="fas fa-angle-right me-2"></i>
                                Shopping Cart
                            </a>
                        </li>

                        <li class="mb-2">
                            <a href="<?php echo e(route('user#orderList')); ?>"
                                class="text-white-50 text-decoration-none">
                                <i class="fas fa-angle-right me-2"></i>
                                My Orders
                            </a>
                        </li>

                        <li class="mb-2">
                            <a href="<?php echo e(route('user#changePasswordPage')); ?>"
                                class="text-white-50 text-decoration-none">
                                <i class="fas fa-angle-right me-2"></i>
                                Change Password
                            </a>
                        </li>

                    </ul>

                </div>


                <!-- Column 4 -->
                <div class="col-lg-3 col-md-6">

                    <h5 class="text-white fs-5 fw-semibold mb-3">
                        Contact Us
                    </h5>

                    <div class="text-white-50 small">

                        <p class="mb-3">
                            <i class="fas fa-map-marker-alt text-warning me-2"></i>
                            Yangon, Myanmar
                        </p>

                        <p class="mb-3">
                            <i class="fas fa-envelope text-warning me-2"></i>
                            fruitables@gmail.com
                        </p>

                        <p class="mb-3">
                            <i class="fas fa-phone text-warning me-2"></i>
                            09-259190620
                        </p>

                        <a href="<?php echo e(route('user#contactPage')); ?>"
                            class="btn btn-outline-warning rounded-pill px-4 mt-2">
                            Contact Us
                        </a>

                    </div>

                </div>

            </div>

        </div>


        <!-- Copyright -->
        
            <div class="py-3 mt-4" style="background-color: #37484a;"></div>

            <div class="container">

                <div class="row align-items-center">

                    <div class="col-md-6 text-center text-md-start">

                        <p class="text-white-50 mb-2 mb-md-0">

                            <i class="fas fa-copyright me-2"></i>
                            <?php echo e(date('Y')); ?>


                            <a href="<?php echo e(route('user#homePage')); ?>"
                                class="text-warning text-decoration-none">
                               POS SYSTEM
                            </a>.

                            All rights reserved.

                        </p>

                    </div>

                    <div class="col-md-6 text-center text-md-end">

                        <p class="text-white-50 mb-0">
                            Designed with
                            <i class="fas fa-heart text-danger"></i>
                            for a better shopping experience.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </footer>

    <!-- ================= FOOTER END ================= -->


    <!-- Back To Top -->
    <a href="#"
        class="btn btn-primary border-3 border-primary rounded-circle position-fixed bottom-0 end-0 m-3">

        <i class="fa fa-arrow-up"></i>

    </a>


    <!-- ================= JAVASCRIPT ================= -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Bootstrap Bundle -->
    <script src="<?php echo e(asset('user/js/bootstrap.bundle.min.js')); ?>"></script>

    <script src="<?php echo e(asset('user/lib/easing/easing.min.js')); ?>"></script>

    <script src="<?php echo e(asset('user/lib/waypoints/waypoints.min.js')); ?>"></script>

    <script src="<?php echo e(asset('user/lib/lightbox/js/lightbox.min.js')); ?>"></script>

    <script src="<?php echo e(asset('user/lib/owlcarousel/owl.carousel.min.js')); ?>"></script>

    <script src="<?php echo e(asset('user/js/main.js')); ?>"></script>

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Page Specific JS -->
    <?php echo $__env->yieldContent('js-script'); ?>

</body>

</html>
<?php /**PATH C:\Users\HP\Desktop\pos_project\resources\views/user/layouts/master.blade.php ENDPATH**/ ?>