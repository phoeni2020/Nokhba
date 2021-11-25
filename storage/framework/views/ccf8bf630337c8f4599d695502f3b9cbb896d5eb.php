<html >
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            body {
                font-family: DejaVu Sans, sans-serif;
                text-align:right;
            }
            table, th, td {
                border: 1px solid black;
            }
            th, td {
                padding: 15px;
            }
        </style>
    </head>
    <body dir="rtl">

            <table style="width:100%">
                <thead>
                <tr>
                    <td>اسم الدرس</td>
                    <td>الكود</td>
                    <td>QR</td>
                </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $qrArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><center><?php echo e($qr['lessonTitle']); ?></center></td>
                            <td><center><?php echo e($qr['text']); ?></center></td>
                            <td padding="10px"><center> <img class="" src="<?php echo e($qr['img']); ?>"></center></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

    </body>
</html>
<?php /**PATH /opt/lampp/htdocs/freelance/Nokhba(Dev)/resources/views/dashbord/qrcode/pdf.blade.php ENDPATH**/ ?>