<?php $pages = App\Models\Page::first(); ?>
@can('bill_today', $pages)
@extends('voyager::master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3><strong>Bills Today</strong></h3>
                </div>
            </div>
            <a href="{{ route('customer.generatePDF_order_today') }}" class="btn btn-primary">Download List PDF</a>
            <a href="{{ route('customer.generatePDF_order_today_all') }}" class="btn btn-primary">Download ALL Order</a>
            <br>
            <div class="row">
                <div class="col-md-6 text-center">           
                    <div class="form-group">
                        <label for="totaltody">Total Today</label>
                        <?php $total = 0;$count =0 ?>
                            @foreach ($customers as $customer)
                            <?php $total =  $customer->Monthly_Rent +$total  ;  ?>
                            <?php $count =  $count + 1;  ?>
                            @endforeach
                        <input  value = "<?php echo $total ?? 0 ?>" type="text"  class="form-control mx-sm-3" disabled>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="form-group">
                    <label for="totaltody">Bills Count</label>
                    <input value="<?php echo $count ?? 0 ?>"  type="text"  class="form-control mx-sm-3" disabled>
                    </div>
                </div>
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
        ajax: "{{ route('customer.bill_today') }}",
        columns: [
            {data: 'company', name: 'company'},
            {data: 'Address', name: 'Address'},
            {data: 'phone', name: 'phone'},
            {data: 'city', name: 'city'},
            {data: 'Starting_Unit', name: 'Starting_Unit'},
            {data: 'order_date', name:'order_date'},
            {data: 'Monthly_Rent', name:'Monthly_Rent'},
        ]
    });

    $('body').on('click', '.isdone', function () {
      $(this).attr('disabled', true);      
      var Item_id = $(this).data('id');
      debugger;
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



