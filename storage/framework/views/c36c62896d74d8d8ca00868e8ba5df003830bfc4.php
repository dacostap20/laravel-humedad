<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Histórico </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(url('ver-humedad')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Histórico</li>
            </ol>
        </nav>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ciudad</th>
                            <th>Fecha Filtrada</th>
                            <th>Humedad fecha filtrada</th>
                            <th>Fecha consulta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $Historicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Historico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($Historico->historicoCiudad->nombre); ?></td>
                                <td><?php echo e($Historico->fechaConsultada); ?></td>
                                <td><?php echo e($Historico->humedadConsultada); ?></td>
                                <td><?php echo e($Historico->created_at); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Diego\codigos\prueba-laravel-php-senior\resources\views/principal/verHistorico.blade.php ENDPATH**/ ?>