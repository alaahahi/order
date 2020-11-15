<?php $pages = App\Models\Page::first(); ?>
@can('bill_today', $pages)
@extends('voyager::master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3><strong>Bills Not Pay To <?php echo $new ?? 0 ?> </strong></h3>
                </div>
            </div>
            <div class="form-group  col-md-3">
            <label for="totaltody">From </label>
            <input class="form-control from" type="date" max="<?php echo $new ?? 0 ?>" >
            </div>
            <div class="form-group  col-md-3">
            <label for="totaltody">To </label>
            <input class="form-control to" type="date" max="<?php echo $new ?? 0 ?>" >
            </div>
            <div class="form-group  col-md-3">
            <button style=" margin-top: 27px;" class="btn btn-ok btn-info form-control">Search </button>
            </div>   
            <div class="row">     
            <div class="col-md-3">
                <label for="totaltody">Bills Total </label>
                <input id="total"  value = "<?php echo $total ?? 0 ?>" type="text"  class="form-control  mx-sm-3" disabled>
            </div>
            </div>
            <div class="col-md-3">
            <a href="#" class="btn btn-success btn-download" disabled>Download </a>
            </div>
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>company</th>
                        <th>Address</th>
                        <th>phone</th>
                        <th>city</th>
                        <th>Starting </th>
                        <th>Order Date</th>
                        <th>Price</th>
                        <th width="100px">Action</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">

$('body').on('click', '.isdone', function () {
      $(this).attr('disabled', true);      
      var Item_id = $(this).data('id');
      $.get("{{ route('customer.isdone') }}/"+Item_id ).done(function() {
        $('#'+Item_id).attr('disabled', false); 
        $('#'+Item_id).css("background-color", "#2ecc71").text("Done");
});   });
$('body').on('click', '.print', function () {
    var Item_id = $(this).data('id');
    window.location = "{{ route('customer.print_order') }}/"+Item_id ;
            });
$('body').on('click', '.btn-ok', function () {
    var from = $(".from").val();
    var to = $(".to").val();
    $(".btn-download").attr("href","{{ route('customer.generatePDF_not_bills') }}/"+from +"/"+to );
    $(".btn-download").attr('disabled',false);
    var table = $('.data-table').DataTable({
        ajax: "{{ route('customer.not_bills') }}/"+from +"/"+to ,
        columns: [
            {data: 'company', name: 'company'},
            {data: 'Address', name: 'Address'},
            {data: 'phone', name: 'phone'},
            {data: 'city', name: 'city'},
            {data: 'Starting_Unit', name: 'Starting_Unit'},
            {data: 'order_date', name:'order_date'},
            {data: 'Monthly_Rent', name:'Monthly_Rent'},
            {data: 'action', name:'action', orderable: false, searchable: false},
        ],
        paging: false,
        destroy: true,
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
  
            total = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            pageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                $('#total').val(total);
               
        }
     
    });
   });
</script>
@endsection
@else
Not have permissions To Veiw
@endcan



