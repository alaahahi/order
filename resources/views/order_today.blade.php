<?php $pages = App\Models\Page::first(); ?>
@can('order', $pages)
@extends('voyager::master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3><strong>Order Today</strong></h3>
                </div>
            </div>
            <a href="{{ route('customer.generatePDF_order_today') }}" class="btn btn-primary">Download List PDF</a>
            <a href="{{ route('customer.generatePDF_order_today_all') }}" class="btn btn-primary">Download ALL Order</a>
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>company</th>
                        <th>Address</th>
                        <th>phone</th>
                        <th>city</th>
                        <th>Starting </th>
                        <th>Next Order </th>
                        <th>Price</th>
                        <th width="100px">Action</th>
                    </tr>
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
  $(function () {
    var table = $('.data-table').DataTable({
        ajax: "{{ route('customer.order_today') }}",
        columns: [
            {data: 'company', name: 'company'},
            {data: 'Address', name: 'Address'},
            {data: 'phone', name: 'phone'},
            {data: 'city', name: 'city'},
            {data: 'Starting_Unit', name: 'Starting_Unit'},
            {data: 'orderdate', name:'orderdate'},
            {data: 'total', name:'total'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('body').on('click', '.isdone', function () {
      $(this).attr('disabled', true);      
      var Item_id = $(this).data('id');
      $.get("{{ route('customer.isdone') }}/"+Item_id ).done(function() {
        $('#'+Item_id).attr('disabled', false); 
        $('#'+Item_id).css("background-color", "#2ecc71").text("Done");
});
   });

    $('body').on('click', '.deleteItem', function () {
     
        var Item_id = $(this).data("id");
        confirm("Are You sure want to delete !");
      
        $.ajax({
            type: "DELETE",
            url: "{{ route('customer.edit') }}"+'/'+Item_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
 
    $('body').on('click', '.editItem', function () {
      var Item_id = $(this).data('id');
      $.get("{{ route('customer.edit') }}" /+ Item_id , function (data) {
          $('#modelHeading').html("Edit Item");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#Item_id').val(data.id);
          $('#name').val(data.name);
          $('#description').val(data.description);
      })
   });
  });
</script>
@endsection
@else
Not have permissions To Veiw
@endcan



