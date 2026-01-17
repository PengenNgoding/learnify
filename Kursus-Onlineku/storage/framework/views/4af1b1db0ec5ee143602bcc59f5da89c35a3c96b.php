<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo e(__('auth.login_title')); ?> — Learnify</title>

    <link href="<?php echo e(asset('vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?php echo e(asset('css/sb-admin-2.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">

    <style>
        .lang-fab {
            position: fixed;
            right: 18px;
            bottom: 18px;
            z-index: 9999;
        }
        .lang-fab .dropdown-menu {
            min-width: 160px;
            padding: 8px;
        }
        .lang-pill {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 12px;
            text-decoration: none;
        }
        .lang-pill:hover {
            background: rgba(0,0,0,.04);
        }
        .lang-badge {
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 999px;
            background: rgba(78,115,223,.12);
            color: #4e73df;
            font-weight: 700;
        }
        .rocket-btn {
            width: 54px;
            height: 54px;
            border-radius: 999px;
            box-shadow: 0 10px 24px rgba(0,0,0,.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .rocket-btn i { font-size: 18px; }
    </style>
</head>

<body class="bg-gradient-primary">

    
   <div class="dropdown lang-fab">
    <button
        class="btn btn-light rocket-btn dropdown-toggle"
        type="button"
        id="langFab"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        title="<?php echo e(__('ui.language')); ?>"
    >
        <img
            src="<?php echo e(app()->getLocale() === 'id'
                    ? asset('img/logo-bendera.png')
                    : asset('img/logo-bendera.png')); ?>"
            alt="Lang"
            class="lang-icon"
        >
    </button>

    <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="langFab">
        <div class="px-3 pt-2 pb-1 small text-muted">
            <?php echo e(__('ui.language')); ?>

        </div>

        <a class="lang-pill dropdown-item" href="<?php echo e(route('lang.switch', ['locale' => 'id'])); ?>">
            <img src="<?php echo e(asset('img/indo.png')); ?>" class="lang-flag" alt="ID">
            <span class="ml-2">ID</span>
            <?php if(app()->getLocale() === 'id'): ?>
                <span class="lang-badge ml-auto"><?php echo e(__('ui.active')); ?></span>
            <?php endif; ?>
        </a>

        <a class="lang-pill dropdown-item" href="<?php echo e(route('lang.switch', ['locale' => 'en'])); ?>">
            <img src="<?php echo e(asset('img/inggris.png')); ?>" class="lang-flag" alt="EN">
            <span class="ml-2">EN</span>
            <?php if(app()->getLocale() === 'en'): ?>
                <span class="lang-badge ml-auto"><?php echo e(__('ui.active')); ?></span>
            <?php endif; ?>
        </a>
    </div>
</div>

    <div class="container">
        <div class="row justify-content-center" style="height: 100vh">
            <div class="col-xl-4 col-lg-6 col-md-8 align-self-center mb-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="p-5">

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><?php echo e(__('auth.welcome')); ?></h1>
                                    </div>

                                    <form class="user" action="<?php echo e(route('login')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>

                                        <div class="form-group">
                                            <input
                                                type="text"
                                                class="form-control form-control-user <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="<?php echo e(__('auth.user_id')); ?>"
                                                name="user_id"
                                                value="<?php echo e(old('user_id')); ?>"
                                                autofocus
                                            >
                                            <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="form-group">
                                            <input
                                                type="password"
                                                class="form-control form-control-user <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="<?php echo e(__('auth.password')); ?>"
                                                name="password"
                                            >
                                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            <?php echo e(__('auth.login_button')); ?>

                                        </button>
                                    </form>

                                    <div class="text-center mt-3">
                                        <a href="<?php echo e(route('register')); ?>">
                                            <?php echo e(__('auth.no_account')); ?>

                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo e(asset('vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/sb-admin-2.min.js')); ?>"></script>

</body>
</html>
<?php /**PATH C:\Users\luizz\Kursus-Onlineku\resources\views/auth/login.blade.php ENDPATH**/ ?>