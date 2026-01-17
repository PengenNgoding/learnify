<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $__env->yieldContent('site-title'); ?> &mdash; Learnify</title>

    <!-- Custom fonts -->
    <link href="<?php echo e(asset('vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/69008e9de8.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/sb-admin-2.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('custom-style-library'); ?>
    <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">
</head>

<body id="page-top">

<?php
    $loc = app()->getLocale(); // buat label EN/ID di topbar
?>

<!-- Page Wrapper -->
<div id="wrapper">

   <!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo e(route('home')); ?>">
        <div class="sidebar-brand-icon">
            <img src="<?php echo e(asset('img/pp-logo-learnify.jpg')); ?>" alt="Learnify" class="sidebar-logo">
        </div>
        <div class="sidebar-brand-text mx-2">
            Learnify
        </div>
    </a>

    <div class="sidebar-heading">
        <?php echo e(__('ui.menu')); ?>

    </div>

    
    <?php if(auth()->guard()->guest()): ?>
        <li class="nav-item <?php echo $__env->yieldContent('isHome'); ?>">
            <a class="nav-link" href="<?php echo e(route('home')); ?>">
                <i class="fas fa-fw fa-home"></i>
                <span><?php echo e(__('ui.home')); ?></span>
            </a>
        </li>

        <li class="nav-item <?php echo $__env->yieldContent('isMateriPdfPeserta'); ?>">
            <a class="nav-link" href="<?php echo e(route('materi-pdf.peserta.index')); ?>">
                <i class="fas fa-fw fa-file-pdf"></i>
                <span><?php echo e(__('ui.materi_pdf')); ?></span>
            </a>
        </li>

        <li class="nav-item <?php echo $__env->yieldContent('isHistory'); ?>">
            <a class="nav-link" href="<?php echo e(route('history')); ?>">
                <i class="fas fa-history"></i>
                <span><?php echo e(__('ui.history')); ?></span>
            </a>
        </li>
    <?php else: ?>
        <?php if(Auth::user()->user_type !== 'admin'): ?>
            <li class="nav-item <?php echo $__env->yieldContent('isHome'); ?>">
                <a class="nav-link" href="<?php echo e(route('home')); ?>">
                    <i class="fas fa-fw fa-home"></i>
                    <span><?php echo e(__('ui.home')); ?></span>
                </a>
            </li>

            <li class="nav-item <?php echo $__env->yieldContent('isMateriPdfPeserta'); ?>">
                <a class="nav-link" href="<?php echo e(route('materi-pdf.peserta.index')); ?>">
                    <i class="fas fa-fw fa-file-pdf"></i>
                    <span><?php echo e(__('ui.materi_pdf')); ?></span>
                </a>
            </li>

            <li class="nav-item <?php echo $__env->yieldContent('isHistory'); ?>">
                <a class="nav-link" href="<?php echo e(route('history')); ?>">
                    <i class="fas fa-history"></i>
                    <span><?php echo e(__('ui.history')); ?></span>
                </a>
            </li>
        <?php endif; ?>
    <?php endif; ?>

    
    <?php if(auth()->guard()->check()): ?>
        <?php if(Auth::user()->user_type == 'admin'): ?>
            <hr class="sidebar-divider my-2">

            <li class="nav-item <?php echo $__env->yieldContent('isMateri'); ?>">
                <a class="nav-link" href="<?php echo e(route('materi.index')); ?>">
                    <i class="fas fa-solid fa-video"></i>
                    <span><?php echo e(__('ui.materi_video')); ?></span>
                </a>
            </li>

            <li class="nav-item <?php echo $__env->yieldContent('isMateriPdfAdmin'); ?>">
                <a class="nav-link" href="<?php echo e(route('materi-pdf.index')); ?>">
                    <i class="fas fa fa-file-pdf-o"></i>
                    <span><?php echo e(__('ui.materi_pdf')); ?></span>
                </a>
            </li>

            <li class="nav-item <?php echo $__env->yieldContent('isUser'); ?>">
                <a class="nav-link" href="<?php echo e(route('user.index')); ?>">
                    <i class="fas fa-solid fa-users-line"></i>
                    <span><?php echo e(__('ui.user')); ?></span>
                </a>
            </li>

            <li class="nav-item <?php echo $__env->yieldContent('isFasilitas'); ?>">
                <a class="nav-link" href="<?php echo e(route('fasilitas.index')); ?>">
                    <i class="fas fa-fw fa-list"></i>
                    <span><?php echo e(__('ui.tracking_pembelian')); ?></span>
                </a>
            </li>

            <li class="nav-item <?php echo $__env->yieldContent('isAnnouncements'); ?>">
                <a class="nav-link" href="<?php echo e(route('announcements.index')); ?>">
                    <i class="fa fa-bullhorn"></i>
                    <span><?php echo e(__('ui.pengumuman')); ?></span>
                </a>
            </li>
        <?php endif; ?>
    <?php endif; ?>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Language">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo e(strtoupper($loc)); ?></span>
                            <i class="fas fa-globe fa-fw"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="langDropdown">
                            <a class="dropdown-item" href="<?php echo e(route('lang.switch', 'id')); ?>">ID</a>
                            <a class="dropdown-item" href="<?php echo e(route('lang.switch', 'en')); ?>">EN</a>
                        </div>
                    </li>

                    
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->user_type !== 'admin'): ?>
                            <?php
                                $unreadCount = 0;
                                $topAnnouncements = collect();
                                $readIds = [];

                                $userId = Auth::user()->user_id; // sesuai struktur lu
                                $now = now();

                                $activeQuery = \App\Announcement::query()
                                    ->where('is_active', 1)
                                    ->where(function ($q) use ($now) {
                                        $q->whereNull('tanggal_mulai')
                                          ->orWhere('tanggal_mulai', '<=', $now);
                                    })
                                    ->where(function ($q) use ($now) {
                                        $q->whereNull('tanggal_selesai')
                                          ->orWhere('tanggal_selesai', '>=', $now);
                                    });

                                $readIds = \DB::table('announcement_reads')
                                    ->where('user_id', $userId)
                                    ->pluck('announcement_id')
                                    ->toArray();

                                $unreadCount = (clone $activeQuery)
                                    ->whereNotIn('id', $readIds)
                                    ->count();

                                $topAnnouncements = (clone $activeQuery)
                                    ->orderByDesc('created_at')
                                    ->take(5)
                                    ->get();
                            ?>

                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="announcementsDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="<?php echo e(__('ui.announcements')); ?>">
                                    <i class="fas fa-bell fa-fw"></i>

                                    <?php if($unreadCount > 0): ?>
                                        <span class="badge badge-danger badge-counter">
                                            <?php echo e($unreadCount > 9 ? '9+' : $unreadCount); ?>

                                        </span>
                                    <?php endif; ?>
                                </a>

                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                     aria-labelledby="announcementsDropdown">
                                    <h6 class="dropdown-header">
                                        <?php echo e(__('ui.announcements')); ?>

                                    </h6>

                                    <?php $__empty_1 = true; $__currentLoopData = $topAnnouncements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <?php $isRead = in_array($a->id, $readIds); ?>

                                        <a class="dropdown-item d-flex align-items-center"
                                           href="<?php echo e(route('announcements.peserta.show', $a->id)); ?>">
                                            <div class="mr-3">
                                                <div class="icon-circle <?php echo e($isRead ? 'bg-secondary' : 'bg-primary'); ?>">
                                                    <i class="fas fa-bullhorn text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500">
                                                    <?php echo e(optional($a->created_at)->format('d M Y H:i')); ?>

                                                </div>
                                                <span class="<?php echo e($isRead ? '' : 'font-weight-bold'); ?>">
                                                    <?php echo e($a->judul); ?>

                                                </span>
                                            </div>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <div class="dropdown-item text-center small text-gray-500">
                                            <?php echo e(__('ui.no_announcements')); ?>

                                        </div>
                                    <?php endif; ?>

                                    <a class="dropdown-item text-center small text-gray-500"
                                       href="<?php echo e(route('announcements.peserta.index')); ?>">
                                        <?php echo e(__('ui.see_all')); ?>

                                    </a>
                                </div>
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>
                        <?php endif; ?>
                    <?php endif; ?>
                    

                    
                    <?php if(auth()->guard()->guest()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>">
                                <i class="fas fa-sign-in-alt fa-sm fa-fw mr-1 text-gray-400"></i>
                                Login
                            </a>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(auth()->guard()->check()): ?>
                        <!-- User Information (Mobile) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdownXS" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-inline text-gray-600 small"><?php echo e(Auth::user()->nama); ?></span>
                                <i class="fas fa-angle-down fa-lg"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                 aria-labelledby="userDropdownXS">
                                <a class="dropdown-item"
                                   href="<?php echo e(route('logout')); ?>"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </div>
                        </li>

                        <!-- User Information (Desktop) -->
                        <li class="nav-item dropdown no-arrow d-none d-sm-block">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo e(Auth::user()->nama); ?></span>
                                <i class="fas fa-angle-down fa-lg"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                 aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="javascript:void(0)" onclick="document.getElementById('logout-form').submit()">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                                <form class="d-none" id="logout-form" method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </div>
                        </li>
                    <?php endif; ?>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800"><?php echo $__env->yieldContent('page-title'); ?></h1>

                
                <?php echo $__env->yieldContent('main-content'); ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php echo $__env->yieldContent('modal-content'); ?>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo e(asset('vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo e(asset('vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo e(asset('js/sb-admin-2.min.js')); ?>"></script>
<?php echo $__env->yieldContent('necessary-library'); ?>
<script src="<?php echo e(asset('js/custom.js')); ?>"></script>

</body>
</html>
<?php /**PATH C:\Users\luizz\Kursus-Onlineku\resources\views/layout/app.blade.php ENDPATH**/ ?>