<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Humedad </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Lugares</a></li>
                <li class="breadcrumb-item active" aria-current="page">consultar humedad</li>
            </ol>
        </nav>
    </div>
    <div class="row hr-banner">
        <div class="col-xl-12 col-sm-12 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex">
                        <div class="pr-4 border-right-lg">
                            <i class="mdi mdi-alert-circle menu-icon" style="font-size: 50px"></i>
                        </div>
                        <div class="w-75 px-0 px-lg-4">
                            <div class="d-lg-flex align-items-center mb-2">
                                <h4 class="mr-3 mb-0 mt-2 mt-sm-0">Elija fecha a consultar</h4>

                            </div>
                            <form class="form-sample"
                                    action="<?php echo e(url('ver-humedad-fecha')); ?>"
                                    method="POST" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>

                                    <?php if($errors->any()): ?>
                                        <div class="alert alert-danger">
                                            <ul>
                                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><?php echo e($error); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <input type="date" class="form-control"
                                            name="fechaForm"
                                            id="fechaForm" min="<?php echo e($fechaAntes); ?>" >

                                    </div>
                                    <button class="btn btn-outline-success"
                                        type="submit">Ver</button>
                                </form>
                            <p class="text-muted mb-0">Datos de la fecha: <?php echo e($fecha); ?> </p>
                        </div>
                        <!--<a href="#" class="close-hr-banner"><i class="mdi mdi mdi-close-circle mdi-24px"></i></a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row">
            <?php $__currentLoopData = $lugares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lugar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-12 col-md-4">
                    <a class="nav-link" href="<?php echo e(url('ver-humedad-ciudad', ['lugar' => $lugar->id,'fecha' => $fechaUnix])); ?>">
                        <div class="card">
                            <div class="card-body">

                                <div class="d-flex justify-content-between">
                                    <b><?php echo e($lugar->nombre); ?></b>
                                    <?php if($vista == 2): ?>
                                        <p><?php echo e($lugar->humedad); ?>% - <?php echo e($lugar->humedadPasada); ?>%</p>
                                    <?php else: ?>
                                        <p><?php echo e($lugar->humedad); ?>%</p>
                                    <?php endif; ?>
                                </div>
                                <?php if($vista == 2): ?>
                                    <div class="d-flex justify-content-between">
                                        <p> </p>
                                        <p>actual - anterior</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <br>
        <div id="map"></div>



        <script>
            var map = L.map('map').setView([25.7617, -80.1918], 4);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var miami = L.marker([25.7617, -80.1918]).addTo(map);
            miami.bindPopup("Miami Humedad: <?php echo e($miamiHumedad); ?>%").openPopup();

            var orlando = L.marker([28.5383, -81.3792]).addTo(map);
            orlando.bindPopup("Orlando Humedad: <?php echo e($orlandoHumedad); ?>%").openPopup();

            var newYork = L.marker([40.730610, -73.935242]).addTo(map);
            newYork.bindPopup("New York Humedad: <?php echo e($newYorkHumedad); ?>%").openPopup();
        </script>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Diego\codigos\prueba-laravel-php-senior\resources\views/principal/verHumedad.blade.php ENDPATH**/ ?>