<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Datatable Example</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="row">
                <div class="col-md-12 text-center">
                <a href="{{ route('customer.generate') }}" class="btn btn-primary">Generate PDF</a>
                </div>
            </div>
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>company</th>
                        <th>Address</th>
                        <th>phone</th>
                        <th>Starting Unit</th>
                        <th>Service Date</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
  $(function () {
    var table = $('.data-table').DataTable({
        ajax: "{{ route('customer.service') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'company', name: 'company'},
            {data: 'Address', name: 'Address'},
            {data: 'phone', name: 'phone'},
            {data: 'Starting_Units', name: 'Starting_Units'},
            {data: 'Service_Date', name:'Service_Date'},
        ]
    });
  });
</script>
</html>