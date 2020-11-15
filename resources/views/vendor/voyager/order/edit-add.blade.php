@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">
            <button class="btn is btn-success">Add </button>  
                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                            class="form-add"
                            action="{{ route('customer.addorder') }}"
                            method="POST" >
                            {{ csrf_field() }}
                <div class="panel-body">
                <div class="form-group  col-md-12 ">       
                <label class="control-label" for="name">customers</label>
                <select class="form-control select2-ajax select2-hidden-accessible" name="Customer_id" data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_belongsto_customer_relationship" data-method="add"  tabindex="-1" aria-hidden="true">
                <option value="" data-select2-id="3" selected="selected">None</option>
                </select>
                <span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection">   
                </span><span class="dropdown-wrapper" aria-hidden="true">
                </span></span>
                </div>                                      
                <div class="form-group  col-md-12 ">    
                <label class="control-label" for="name">Order Date</label>
                <input type="date" class="form-control" name="order_date" placeholder="Order Date" value="">    
                </div>
                <div class="my_orderol">
                <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">product</label>
                <select class="form-control select2-ajax " name="order1"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add" tabindex="-1" aria-hidden="true">
                    <option value="" data-select2-id="6">None</option>           
                </select>
                </div>
                <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">Qty</label>
                <input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value="">            
                </div>
                <div class="form-group  col-md-6 "> <label class="control-label" for="name">product</label><select class="form-control select2-ajax " name="order2"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add"  tabindex="-1" aria-hidden="true"><option value="" >None</option></select></div><div class="form-group  col-md-6 ">  <label class="control-label" for="name">Qty</label><input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value=""></div>
                    <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">product</label>
                <select class="form-control select2-ajax " name="order1"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add" tabindex="-1" aria-hidden="true">
                    <option value="" data-select2-id="6">None</option>           
                </select>
                </div>
                <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">Qty</label>
                <input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value="">            
                </div>
                <div class="form-group  col-md-6 "> <label class="control-label" for="name">product</label><select class="form-control select2-ajax " name="order3"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add"  tabindex="-1" aria-hidden="true"><option value="">None</option></select></div><div class="form-group  col-md-6 ">  <label class="control-label" for="name">Qty</label><input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value=""></div>
                    <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">product</label>
                <select class="form-control select2-ajax " name="order1"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add" tabindex="-1" aria-hidden="true">
                    <option value="" data-select2-id="6">None</option>           
                </select>
                </div>
                <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">Qty</label>
                <input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value="">            
                </div>
                <div class="form-group  col-md-6 "> <label class="control-label" for="name">product</label><select class="form-control select2-ajax " name="order4"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add"  tabindex="-1" aria-hidden="true"><option value="" >None</option></select></div><div class="form-group  col-md-6 ">  <label class="control-label" for="name">Qty</label><input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value=""></div>
                    <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">product</label>
                <select class="form-control select2-ajax " name="order1"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add" tabindex="-1" aria-hidden="true">
                    <option value="" data-select2-id="6">None</option>           
                </select>
                </div>
                <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">Qty</label>
                <input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value="">            
                </div>
                <div class="form-group  col-md-6 "> <label class="control-label" for="name">product</label><select class="form-control select2-ajax " name="order5"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add"  tabindex="-1" aria-hidden="true"><option value="" >None</option></select></div><div class="form-group  col-md-6 ">  <label class="control-label" for="name">Qty</label><input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value=""></div>
                    <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">product</label>
                <select class="form-control select2-ajax " name="order1"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add" tabindex="-1" aria-hidden="true">
                    <option value="" data-select2-id="6">None</option>           
                </select>
                </div>
                <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">Qty</label>
                <input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value="">            
                </div>
                <div class="form-group  col-md-6 "> <label class="control-label" for="name">product</label><select class="form-control select2-ajax " name="order6"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add"  tabindex="-1" aria-hidden="true"><option value="">None</option></select></div><div class="form-group  col-md-6 ">  <label class="control-label" for="name">Qty</label><input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value=""></div>
                    <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">product</label>
                <select class="form-control select2-ajax " name="order1"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add" tabindex="-1" aria-hidden="true">
                    <option value="" data-select2-id="6">None</option>           
                </select>
                </div>
                <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">Qty</label>
                <input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value="">            
                </div>
                <div class="form-group  col-md-6 "> <label class="control-label" for="name">product</label><select class="form-control select2-ajax " name="order7"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add"  tabindex="-1" aria-hidden="true"><option value="" >None</option></select></div><div class="form-group  col-md-6 ">  <label class="control-label" for="name">Qty</label><input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value=""></div>
                    <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">product</label>
                <select class="form-control select2-ajax " name="order1"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add" tabindex="-1" aria-hidden="true">
                    <option value="" data-select2-id="6">None</option>           
                </select>
                </div>
                <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">Qty</label>
                <input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value="">            
                </div>
                <div class="form-group  col-md-6 "> <label class="control-label" for="name">product</label><select class="form-control select2-ajax " name="order8"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add"  tabindex="-1" aria-hidden="true"><option value="" >None</option></select></div><div class="form-group  col-md-6 ">  <label class="control-label" for="name">Qty</label><input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value=""></div>
                    <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">product</label>
                <select class="form-control select2-ajax " name="order1"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add" tabindex="-1" aria-hidden="true">
                    <option value="" data-select2-id="6">None</option>           
                </select>
                </div>
                <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">Qty</label>
                <input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value="">            
                </div>
                <div class="form-group  col-md-6 "> <label class="control-label" for="name">product</label><select class="form-control select2-ajax " name="order9"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add"  tabindex="-1" aria-hidden="true"><option >None</option></select></div><div class="form-group  col-md-6 ">  <label class="control-label" for="name">Qty</label><input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value=""></div>
                    <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">product</label>
                <select class="form-control select2-ajax " name="order1"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add" tabindex="-1" aria-hidden="true">
                    <option value="" data-select2-id="6">None</option>           
                </select>
                </div>
                <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">Qty</label>
                <input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value="">            
                </div>
                <div class="form-group  col-md-6 "> <label class="control-label" for="name">product</label><select class="form-control select2-ajax " name="order10"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add"  tabindex="-1" aria-hidden="true"><option >None</option></select></div><div class="form-group  col-md-6 ">  <label class="control-label" for="name">Qty</label><input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value=""></div>
                    <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">product</label>
                <select class="form-control select2-ajax " name="order1"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add" tabindex="-1" aria-hidden="true">
                    <option value="" data-select2-id="6">None</option>           
                </select>
                </div>
                <div class="form-group  col-md-6 ">    
                <label class="control-label" for="name">Qty</label>
                <input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value="">            
                </div>
                <div class="form-group  col-md-6 "> <label class="control-label" for="name">product</label><select class="form-control select2-ajax " name="order11"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add"  tabindex="-1" aria-hidden="true"><option value="" >None</option></select></div><div class="form-group  col-md-6 ">  <label class="control-label" for="name">Qty</label><input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value=""></div>
                 
                    <div class="form-group  col-md-6 "> <label class="control-label" for="name">product</label><select class="form-control select2-ajax " name="order2"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add" tabindex="-1" aria-hidden="true"><option >None</option></select></div><div class="form-group  col-md-6 ">  <label class="control-label" for="name">Qty</label><input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value=""></div>
                    
                </div> 
                <div class="form-group  col-md-12 ">
                <label class="control-label" for="name">Service Day</label>
                <input required="" type="text" class="form-control" name="service_day" placeholder="Service Day" value="15">
                </div> 
                <div class="form-group  col-md-12 ">    
                            </div><!-- panel-body -->
                        <div class="panel-footer">
                        <button type="submit" class="btn btn-primary save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
          return function() {
            $file = $(this).siblings(tag);

            params = {
                slug:   '{{ $dataType->slug }}',
                filename:  $file.data('file-name'),
                id:     $file.data('id'),
                field:  $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
          };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                } else if (elt.type != 'date') {
                    elt.type = 'text';
                    $(elt).datetimepicker({
                        format: 'L',
                        extraFormats: [ 'YYYY-MM-DD' ]
                    }).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });



        $(".is").on('click',function(){
    $(".my_orderol").append('<div class="form-group  col-md-6 "> <label class="control-label" for="name">product</label><select class="form-control select2-ajax " name="order2"  data-get-items-route="http://localhost:90/bibars/public/admin/order/relation" data-get-items-field="order_hasmany_product_relationship" data-method="add" tabindex="-1" aria-hidden="true"><option >None</option></select></div><div class="form-group  col-md-6 ">  <label class="control-label" for="name">Qty</label><input type="text" class="form-control" name="Machines_Large_price" placeholder="Machines Large Price" value=""></div> ');
  });
    </script>
@stop
