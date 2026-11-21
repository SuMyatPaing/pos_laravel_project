<?php $__env->startSection('content'); ?>

 <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5 mt-5">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    
                    <div class="col-lg-12 text-end">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill <?php if(!request('categoryId')): ?> active <?php endif; ?> " href="<?php echo e(url('user/home')); ?>">
                                    <span class="text-dark" style="width: 130px;">All Products</span>
                                </a>
                            </li>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill <?php if($item->id == request('categoryId')): ?> active <?php endif; ?> " href="<?php echo e(url('user/home?categoryId='.$item->id)); ?>">
                                    <span class="text-dark" style="width: 130px;"><?php echo e($item->name); ?> </span>
                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-3">
                                <div class="form">
                                    <form action="<?php echo e(route('user#homePage')); ?>" method="get">
                                        <?php echo csrf_field(); ?>
                                        <div class="input-group">
                                            <input type="text" name="searchKey" value="<?php echo e(request('searchKey')); ?>" class=" form-control"
                                                placeholder="Enter Search Key...">
                                            <button type="submit" class=" btn"> <i
                                                    class="fa-solid fa-magnifying-glass"></i> </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <form action="<?php echo e(route('user#homePage')); ?>" method="get">
                                            <?php echo csrf_field(); ?>
                                            <input type="text" name="minPrice" value="<?php echo e(request('minPrice')); ?>" placeholder="Minimum Price..."
                                                class=" form-control my-2">
                                            <input type="text" name="maxPrice" value="<?php echo e(request('maxPrice')); ?>" placeholder="Maximun Price..."
                                                class=" form-control my-2">
                                            <input type="submit" value="Search" class=" btn btn-success my-2 w-100">
                                        </form>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <form action="" method="get">

                                            <select name="sortingType" class="form-control w-100 bg-white mt-3">
                                                <option value="name,asc" <?php if(request('sortingType')== "name,asc"): ?> selected <?php endif; ?>>Alpha:A-Z</option>
                                                <option value="name,desc" <?php if(request('sortingType')== "name,desc"): ?> selected <?php endif; ?>>Alpha:Z-A</option>
                                                <option value="price,asc" <?php if(request('sortingType')== "price,asc"): ?> selected <?php endif; ?>>Price:Low-High</option>
                                                <option value="price,desc" <?php if(request('sortingType')== "price,desc"): ?> selected <?php endif; ?>>Price:High-Low</option>
                                                <option value="created_at,asc" <?php if(request('sortingType')== "created_at,asc"): ?> selected <?php endif; ?>>Date:Asc</option>
                                                <option value="created_at,desc" <?php if(request('sortingType')== "created_at,desc"): ?> selected <?php endif; ?>>Date:Desc</option>//name,price,created_at(names from database)
                                            </select>

                                            <input type="submit" value="Sort" class=" btn btn-success my-3 w-100">
                                        </form>
                                    </div>
                                </div>
                                   <a href="<?php echo e(route('user#homePage')); ?>"> <input type="button" value="Clear" class=" btn btn-danger my-2 w-100"></a>

                            </div>
                            <div class="col-9">
                                <div class="row g-4">
                                
                                    <?php if(count($products) != 0): ?>
                                       <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       
                                    <div class="col-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <a href="<?php echo e(route('user#productDetails',$item->id)); ?>"><img src="<?php echo e(asset('productImage/'.$item->image)); ?>" style="height: 250px"
                                                        class="img-fluid w-100 rounded-top" alt=""></a>
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;"><?php echo e($item->category_name); ?></div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4><?php echo e($item->name); ?></h4>
                                                
                                                <p><?php echo e(Str::words($item->description,5,'...')); ?></p>
                                               <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

    <p class="text-dark fs-5 fw-bold mb-0">
        <?php echo e($item->price); ?> MMK
    </p>

    <a href="<?php echo e(route('user#productDetails', $item->id)); ?>"
       class="btn border border-secondary rounded-pill px-3 text-primary">
        <i class="fa fa-eye me-2 text-primary"></i>
        View Details
    </a>

</div>
                                            </div>
                                        </div>
                                    </div>


                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                    <div class="text-center">
                                        <span class="text-muted m-5 h3">There is no data</span>
                                    </div>
                                    <?php endif; ?>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->



<?php $__env->stopSection(); ?>



<?php echo $__env->make('user.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP\Desktop\pos_project\resources\views/user/home/list.blade.php ENDPATH**/ ?>