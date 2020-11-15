<?php $pages = App\Models\Page::first(); ?>
@can('serviceToday', $pages)
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
@endsection
@if (Auth::user()->hasRole('admin'))
@extends('voyager::master')
@endif
@section('content')
<style>
@media print {
 
 table {
     padding-top:150px;
     border: none !important;
 }
 
}

</style>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3><strong>Service Today</strong></h3>
                </div>
                
            </div>
            <a href="{{ route('customer.generatePDF_service_today') }}" class="btn btn-primary">PDF Download</a>
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>company</th>
                        <th>Address</th>
                        <th>phone</th>
                        <th>city</th>
                        <th>Starting </th>
                        <th>Service Date</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('javascript')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
    
    
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script type="text/javascript">
  $(function () {
    var table = $('.data-table').DataTable({
        ajax: "{{ route('customer.service_today') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'company', name: 'company'},
            {data: 'Address', name: 'Address'},
            {data: 'phone', name: 'phone'},
            {data: 'city', name: 'city'},
            {data: 'Starting_Unit', name: 'Starting_Unit'},
            {data: 'service_date', name:'service_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
    });

        $('body').on('click', '.is_service', function () {
      $(this).attr('disabled', true);      
      var Item_id = $(this).data('id');
      $.get("{{ route('customer.is_service') }}/"+Item_id ).done(function() {
        $('#'+Item_id).attr('disabled', false); 
        $('#'+Item_id).css("background-color", "#2ecc71").text("Done");
});
});
  });
</script>
@endsection

@else
@section('content')
Not have permissions To Veiw
@endsection
@endcan


