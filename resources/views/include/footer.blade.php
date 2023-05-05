<footer class="page-footer" role="contentinfo">
    <div class="d-flex align-items-center flex-1 text-muted">
        <span class="hidden-md-down fw-700">2019 © SmartAdmin by&nbsp;<a href='https://www.gotbootstrap.com' class='text-primary fw-500' title='gotbootstrap.com' target='_blank'>gotbootstrap.com</a></span>
    </div>
    <div>
        <ul class="list-table m-0">
            <li><a href="intel_introduction.html" class="text-secondary fw-700">About</a></li>
            <li class="pl-3"><a href="info_app_licensing.html" class="text-secondary fw-700">License</a></li>
            <li class="pl-3"><a href="info_app_docs.html" class="text-secondary fw-700">Documentation</a></li>
            <li class="pl-3 fs-xl"><a href="https://wrapbootstrap.com/user/MyOrange" class="text-secondary" target="_blank"><i class="fal fa-question-circle" aria-hidden="true"></i></a></li>
        </ul>
    </div>
</footer>

<script>
    function printSection(el){
        var getFullContent = document.body.innerHTML;
        var printsection = document.getElementById(el).innerHTML;
        document.body.innerHTML = printsection;
        window.print();
        document.body.innerHTML = getFullContent;
        setTimeout(function() {
                // location.reload();
        }, 1000);
    }
</script>
@include('include.page_script')
<script src="{{ asset('webtemp/js/vendors.bundle.js') }}"></script>
<script src="{{ asset('webtemp/js/app.bundle.js') }}"></script>
<script src="{{ asset('admin/dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('webtemp/js/notifications/toastr/toastr.js') }}"></script>
<script src="{{ asset('webtemp/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script>
    $(document).ready(function()
    {
        // initialize datatable
        $('#dt-basic-example').dataTable(
        {
            responsive: true,

            render: function(data, type, full, meta)
            {
                var badge = {
                    1:
                    {
                        'title': 'Pending',
                        'class': 'badge-warning'
                    },
                    2:
                    {
                        'title': 'Delivered',
                        'class': 'badge-success'
                    },
                    3:
                    {
                        'title': 'Canceled',
                        'class': 'badge-secondary'
                    },
                    4:
                    {
                        'title': 'Attempt #1',
                        'class': 'bg-danger-100 text-white'
                    },
                    5:
                    {
                        'title': 'Attempt #2',
                        'class': 'bg-danger-300 text-white'
                    },
                    6:
                    {
                        'title': 'Failed',
                        'class': 'badge-danger'
                    },
                    7:
                    {
                        'title': 'Attention!',
                        'class': 'badge-primary'
                    },
                    8:
                    {
                        'title': 'In Progress',
                        'class': 'badge-success'
                    },
                };
                if (typeof badge[data] === 'undefined')
                {
                    return data;
                }
                return '<span class="badge ' + badge[data].class + ' badge-pill">' + badge[data].title + '</span>';
            },
        });

        $('#cust-basic-example').dataTable(
        {
            responsive: true,
            orderCellsTop: true,
            dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            orderCellsTop: true,
            lengthMenu: [[3, 10, 50, -1], [3, 10, 50, "All"]],
            order: [[ 0, "desc" ]],

            render: function(data, type, full, meta)
            {
                var badge = {
                    1:
                    {
                        'title': 'Pending',
                        'class': 'badge-warning'
                    },
                    2:
                    {
                        'title': 'Delivered',
                        'class': 'badge-success'
                    },
                    3:
                    {
                        'title': 'Canceled',
                        'class': 'badge-secondary'
                    },
                    4:
                    {
                        'title': 'Attempt #1',
                        'class': 'bg-danger-100 text-white'
                    },
                    5:
                    {
                        'title': 'Attempt #2',
                        'class': 'bg-danger-300 text-white'
                    },
                    6:
                    {
                        'title': 'Failed',
                        'class': 'badge-danger'
                    },
                    7:
                    {
                        'title': 'Attention!',
                        'class': 'badge-primary'
                    },
                    8:
                    {
                        'title': 'In Progress',
                        'class': 'badge-success'
                    },
                };
                if (typeof badge[data] === 'undefined')
                {
                    return data;
                }
                return '<span class="badge ' + badge[data].class + ' badge-pill">' + badge[data].title + '</span>';
            },
        });
    });

</script>