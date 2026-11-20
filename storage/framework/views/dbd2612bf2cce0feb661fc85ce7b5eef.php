<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>POS Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/js/fontawesome.min.js" integrity="sha512-CkkpcvO1IMp81fvY/fEA6iWNDXZ6+PYlb3+HlYz1Fzy+0Sh9ZknJw378WFY37Hd5Vu33+bR5hOpnAjzfgRjbOg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo e(asset('admin/css/sb-admin-2.min.css')); ?>" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
           
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
   href="<?php echo e(route('admin#dashboard')); ?>">

    <img src="<?php echo e(asset('user/img/posLogoDesign.png')); ?>"
         alt="POS Logo"
         class="img-fluid"
         style="max-width: 150px; max-height: 60px;">

</a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin#dashboard')); ?>"><i class="fas fa-fw fa-table"></i><span>Dashboard </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('category#list')); ?>"><i class="fa-solid fa-circle-plus"></i></i><span>Category </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('product#createPage')); ?>"><i class="fa-solid fa-plus"></i></i><span>Add Products </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('product#list')); ?>"><i class="fa-solid fa-layer-group"></i><span>Product List </span></a>
            </li>


          <?php if(Auth()->user()-> role == 'superadmin'): ?>
                      <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('payment#list')); ?>"><i class="fa-solid fa-credit-card"></i></i><span>Payment Method </span></a>
            </li>
          <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin#saleInformation')); ?>"><i class="fa-solid fa-list"></i><span>Sale Information </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin#orderList')); ?>"><i class="fa-solid fa-cart-shopping"></i><span>Order Board </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('profile#changePasswordPage')); ?>"><i class="fa-solid fa-lock"></i></i></i><span>Change Password </span></a>
            </li>

            <li class="nav-item">
                <form action="<?php echo e(route('logout')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <span class="nav-link">
                        <button type="submit" class="btn bg-dark text-white"><i
                                class="fa-solid fa-right-from-bracket"></i> Logout</button>
                    </span>
                </form>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                                
                                 <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo e(Auth::user()->name != null ? Auth::user()->name  : Auth::user()->nickname); ?>


                                </span>
                                <img class="img-profile rounded-circle" src="<?php echo e(Auth::user()->profile == null ? asset('default/profile.jfif') : asset('profile/'.Auth::user()->profile)); ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?php echo e(route('profile#editProfile')); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>

                               <?php if(Auth()->user()-> role == 'superadmin'): ?>
                                <a class="dropdown-item" href="<?php echo e(route('account#newAccountPage')); ?>">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Add New Admin Account
                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('account#adminList')); ?>">
                                    <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Admin List
                                </a>

                                <a class="dropdown-item" href="<?php echo e(route('account#userList')); ?>">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    User List
                                </a>
                               <?php endif; ?>


                                <a class="dropdown-item" href="<?php echo e(route('profile#changePasswordPage')); ?>">
                                    <i class="fa-solid fa-lock fa-sm fa-fw mr-2 text-gray-400"></i></i></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <span class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                    <form action="<?php echo e(route('logout')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <input type="submit" class="btn btn-dark text-white w-100" value="Logout">
                                    </form>
                                </span>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                
                <?php echo $__env->yieldContent('content'); ?>
                <?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>;

                <!-- Bootstrap core JavaScript-->
                <script src="<?php echo e(asset('admin/vendor/jquery/jquery.min.js')); ?>"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
                    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script src="<?php echo e(asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
                
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

                <!-- Core plugin JavaScript-->
                <script src="<?php echo e(asset('admin/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>

                <!-- Custom scripts for all pages-->
                <script src="<?php echo e(asset('admin/js/sb-admin-2.min.js')); ?>"></script>



                <!-- Page level custom scripts -->
                
     
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php echo $__env->yieldContent('js-script'); ?>
<script>
    function loadFile(event) {
        var reader =new FileReader();
        reader.onload = function(){
       var output = document.getElementById('output');
       output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>

</html>

<?php /**PATH C:\Users\HP\Desktop\pos_project\resources\views/admin/layouts/master.blade.php ENDPATH**/ ?>