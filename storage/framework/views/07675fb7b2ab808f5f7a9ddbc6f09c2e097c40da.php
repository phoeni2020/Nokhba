<!--begin: Datatable-->
<table class="table table-bordered table-hover table-checkable" id="example" style="margin-top: 13px !important">
    <thead>
    <tr>
        <?php $__currentLoopData = $tableConfig['tableHeaed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tableHeadData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th> <?php echo e($tableHeadData); ?> </th>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tr>
    </thead>
</table>
<!--end: Datatable-->
<?php $__env->startPush('Scripts'); ?>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')); ?>"></script>
    <style>
        .dataTables_length {
            float: none !important;
            text-align: center;
            display:inline-block;
            margin-right: 25px;
        }
    </style>
    <script>
        // begin first table
        var table = $('#example').DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            searching: false,
            pageLength: 25,
            lengthMenu: [10, 25, 50, 100,200],
            dom: 'Blfrtip',
            "order": [[ <?php echo e(isset($tableConfig['tableCheckboxs']) ? 1 : 0); ?>, "desc" ]],
            ajax: {
                url: '<?php echo e($tableConfig['actionUrl']); ?>',
                type: 'POST',
                data: {
                    _token:'<?php echo e(csrf_token()); ?>',
                    columnsDef: <?php echo $tableConfig['tableColumnsNames']; ?>,
                },
            },
            columns: <?php echo $tableConfig['tableColumnsData']; ?>,
            columnDefs: [
                    <?php if(isset($tableConfig['hasActions'])): ?>
                {
                    targets: -1,
                    orderable: false,
                    render: function (data, type, full, meta) {

                        let updateElement = '',
                            deleteElement = '',
                            viewElement = ''
                        customActionsElement = '',
                            emailElement = '',
                            smsElement = '';

                        if(typeof full.updateLink !== "undefined" && full.updateLink !== "")
                        {
                            updateElement = `<a href="${full.updateLink}" class="btn btn-sm btn-clean btn-icon" title="Edit">
                                              <i class="la la-edit"></i>
                                            </a>`;
                        }

                        if(typeof full.deleteLink !== "undefined" && full.deleteLink !== ""){
                            deleteElement = `
                                            <a onclick="(confirm('Are You Sure To Delete This ?')) ? document.getElementById('remove-${full.id}').submit() : false;" class="btn btn-sm btn-clean btn-icon" title="Delete">
                                                        <i class="la la-trash"></i>
                                            </a>
                                            <form id="remove-${full.id}" action="${full.deleteLink}" method="POST" style="display: none;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('delete'); ?>
                                            </form>

`;
                        }

                        if(typeof full.viewLink !== "undefined" && full.viewLink !== ""){
                            viewElement = `<a href="${full.viewLink}" target="_blank" class="btn btn-sm btn-clean btn-icon" title="View">
                                              <i class="la la-external-link"></i>
                                            </a>`;
                        }

                        if(typeof full.emailLink !== "undefined" && full.emailLink !== ""){
                            emailElement = `<a href="${full.emailLink}" class="btn btn-sm btn-clean btn-icon" title="email">
                                              <i class="la la-envelope"></i>
                                            </a>`;
                        }
                        if(typeof full.smsLink !== "undefined" && full.smsLink !== ""){
                            smsElement = `<a href="${full.smsLink}" class="btn btn-sm btn-clean btn-icon" title="sms">
                                              <i class="la la-sms"></i>
                                            </a>`;
                        }

                        <?php if(isset($tableConfig['customActions'])): ?>

                            customActionsData = <?php echo $tableConfig['customActions']; ?>;
                        customActionsElement = customActionsData.map((data) => {
                            if(typeof full[data.linkColumn] !== "undefined" && full[data.linkColumn] !== ''){
                                return `<a href="${full[data.linkColumn]}" ${data.attributes}><i class="${data.icon}"></i></a>`;
                            }
                        });
                        <?php endif; ?>

                            return `
                                ${customActionsElement}
                                ${viewElement}
                                ${emailElement}
                                ${smsElement}
                                ${updateElement}
                                ${deleteElement}
                               `;
                    },
                },
                    <?php endif; ?>

                    <?php if(isset($tableConfig['tableCheckboxs'])): ?>
                {
                    targets: 0,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return `<input class="<?php echo $tableConfig['tableCheckboxs']['checkboxClassName']; ?>" type="checkbox" value="${full.id}">`;
                    },
                },
                    <?php endif; ?>

                    <?php if(isset($tableConfig['tableColumnDefs']['link'])): ?>
                    <?php $__currentLoopData = $tableConfig['tableColumnDefs']['link']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tableConfigData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                {
                    targets: <?php echo $tableConfigData['targets']; ?>,
                    orderable: <?php echo $tableConfigData['orderable']; ?>,
                    render: function (data, type, full, meta) {

                        let column = "<?php echo e($tableConfigData['column']); ?>",
                            columnLink = "<?php echo e($tableConfigData['link']); ?>",

                            columnData = (typeof full[column] == "undefined") ? column : full[column],
                            columnLinkData = (columnLink == '#') ? '#' : full[columnLink];

                        return `<a href="${columnLinkData}" target="<?php echo isset($tableConfigData['target']) ? $tableConfigData['target'] : '_self'; ?>">${columnData}</a>`;
                    },
                },
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <?php if(isset($tableConfig['tableColumnDefs']['image'])): ?>
                    <?php $__currentLoopData = $tableConfig['tableColumnDefs']['image']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tableConfigData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                {
                    targets: <?php echo $tableConfigData['targets']; ?>,
                    orderable: <?php echo $tableConfigData['orderable']; ?>,
                    render: function (data, type, full, meta) {
                        let column = "<?php echo e($tableConfigData['column']); ?>",
                            columnData = (typeof full[column] == "undefined") ? column : full[column];

                        return (columnData !== '') ?  `<div class="d-flex align-items-center"><div class="symbol symbol-120 mr-3"><img src="${columnData}" /></div></div>` : `-`;
                    },
                },
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <?php if(isset($tableConfig['tableColumnDefs']['button'])): ?>
                    <?php $__currentLoopData = $tableConfig['tableColumnDefs']['button']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tableConfigData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                {
                    targets: <?php echo $tableConfigData['targets']; ?>,
                    orderable: <?php echo $tableConfigData['orderable']; ?>,
                    render: function (data, type, full, meta) {
                        let column = "<?php echo e($tableConfigData['column']); ?>",
                            columnLink = "<?php echo e($tableConfigData['link']); ?>",

                            columnData = (typeof full[column] == "undefined") ? column : full[column],
                            columnLinkData = (columnLink == '#') ? '#' : full[columnLink];

                        return `<a class="btn btn-primary" href="${columnLinkData}" >${columnData}</a>`;
                    },
                },
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <?php if(isset($tableConfig['tableColumnDefs']['label'])): ?>
                    <?php $__currentLoopData = $tableConfig['tableColumnDefs']['label']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tableConfigData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                {
                    targets: <?php echo $tableConfigData['targets']; ?>,
                    orderable: <?php echo $tableConfigData['orderable']; ?>,
                    render: function (data, type, full, meta) {

                        let statusLabel = {
                            1: ' label-light-success',
                            2: ' label-light-danger',
                            3: ' label-light-primary',
                        };

                        let column = "<?php echo e($tableConfigData['column']); ?>",
                            columnLabel = "<?php echo e($tableConfigData['columnLabel']); ?>",

                            columnLabelColor = (typeof statusLabel[full[columnLabel]] == "undefined") ? '' : statusLabel[full[columnLabel]];

                        return `<span class="label label-lg font-weight-bold  ${columnLabelColor} label-inline">${full[column]}</span>`;
                    },
                },
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            ],
            lengthChange: true,
            buttons: [
                'copy','excel', 'pdf', 'print'
            ],
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ ',
            }
        });

        table.buttons().container()
            .appendTo( '#example_wrapper .col-md-6:eq(0)' );

        <?php if(isset($tableConfig['filter'])): ?>
        $('#kt_search').on('click', function(e) {
            e.preventDefault();

            var $formData = $('#filter').serialize();

            table.on('preXhr.dt', function (e, settings, data) {
                return $.extend(data, {filter: $formData});
            });

            table.ajax.reload();
        });
        /*=========================================================================*/
        $('#kt_reset').on('click', function(e) {
            e.preventDefault();
            $('#filter').trigger('reset');
            $('.dropDown').trigger('change');
            table.on('preXhr.dt', function (e, settings, data) {
                return $.extend(data, {filter: ''});
            });
            table.ajax.reload();
        });
        /*=========================================================================*/
        <?php endif; ?>
    </script>

    <?php if(isset($tableConfig['tableCheckboxs']['delete'])): ?>
        <script>
            window.onload = function(){

                let dataToSelect = [],
                    deleteSelected = $('<?php echo $tableConfig['tableCheckboxs']['deleteButtonSelector']; ?>');
                /*============================================*/
                function deleteSelectedData() {
                    let _this = $(this);
                    const index = dataToSelect.indexOf(_this.val());
                    if (index > -1) {
                        dataToSelect.splice(index, 1);
                    }else{
                        dataToSelect.push(_this.val());
                    }
                }

                $(document).on('change','.<?php echo $tableConfig['tableCheckboxs']['checkboxClassName']; ?>',deleteSelectedData);
                /*============================================*/
                function addToDeleteArray(){

                    let request = $.ajax({
                        url:"<?php echo $tableConfig['tableCheckboxs']['delete']['deleteUrl']; ?>",
                        dataType:'JSON',
                        type:'POST',
                        data:{
                            '_token': '<?php echo e(csrf_token()); ?>',
                            '_method': 'delete',
                            'delid':dataToSelect.join(',')
                        }
                    });

                    request.done(function(){
                        window.location.href = "<?php echo e($tableConfig['tableCheckboxs']['delete']['redirectTo']); ?>";
                    });
                }

                deleteSelected.on('click',addToDeleteArray);
                /*============================================*/
            };

        </script>
    <?php endif; ?>

<?php $__env->stopPush(); ?>
<?php /**PATH /opt/lampp/htdocs/freelance/Nokhba(Dev)/resources/views/components/data-table.blade.php ENDPATH**/ ?>