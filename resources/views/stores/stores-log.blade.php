
@extends('layouts.app')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">  
@endsection

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Stores Log
            <!-- <a class="btn btn-success pull-right" href="{{ route('projects.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a> -->
        </h1>

    </div>
@endsection

@section('content')
 <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.pack.min.js"></script>
<script type="text/javascript">
   
    $(function($){
            
        $(":input[name='search']").blur( function () {
            $.ajax({
                url: '/receipts/search',
                type: "POST",
                data: {'receipt_id': $(":input[id='receipt_id']").val(),
                        'donator_address': $(":input[id='donator_address']").val(),
                        'donator_mobile': $(":input[id='donator_mobile']").val(),
                        'donator_name': $(":input[id='donator_name']").val(),
                        'project_name': $(":input[id='project_name']").val(),
                        'receipt_date': $(":input[id='receipt_date']").val(),
                        'amount': $(":input[id='amount']").val(),
                        'type': $(":input[id='type']").val(),
                        'cash': $(":input[id='cash']").val(), '_token': $('input[name=_token]').val()},

                success:function(html) {                 
                    $("#receipts_table").html(html).show('slow');
                }
            });
        });
       $('.checked').change(function(){
            var cheque = $('.checked');
            if($(this).is(':checked')) {
                if($(this).attr('data-attr') == 'cheque'){
                    $.each(cheque,function () {
                        if($(this).attr('data-attr') == 'cash')
                            $(this).attr('disabled',true)
                    });
                }else{
                     $.each(cheque,function () {
                        if($(this).attr('data-attr') == 'cheque')
                            $(this).attr('disabled',true)
                    });
                }
            }else{
                if($('.checked:checked').length == 0){
                    $(".checked").attr('disabled',false);
                }
            }
        });


    });
</script>

<br><br><br><br><br><br><br>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            @if($stores_logs->count())
                <table id="receipts_table" class="table table-hover ">
                    <tr class="bg-danger">
                        <td style="text-align: center;">اﻻجمالى</td>
                        <td style="text-align: center;">سعر الوحدة</td>
                        <td style="text-align: center;">عدد الوحدات</td>
                        <td style="text-align: center;">رقم محضر الفحص والاستلام</td>
                        <td style="text-align: center;">رقم امر التوريد</td>
                        <td style="text-align: center;">رقم فاتورة المورد</td>
                        <td style="text-align: center;">عنوان المورد</td>
                        <td style="text-align: center;">اسم المورد</td>
                        <td style="text-align: center;">اسم المخزن</td>
                        <td style="text-align: center;">اسم الصنف</td>
                        <td></td>
                    </tr>
                    @foreach($stores_logs as $storeLog)
                       <!--  <?php 
                            var_dump($storeLog->storeItem->title);
                            var_dump($storeLog->store);
                        ?> -->
                        <tr class="bg-success">

                            <td style="text-align: center;">{{$storeLog->total_units_price}}</td>
                            <td style="text-align: center;">{{$storeLog->unit_price}}</td>
                            <td style="text-align: center;">{{$storeLog->units_number}}</td>
                            <td style="text-align: center;">{{$storeLog->receipt_record_number}}</td>
                            <td style="text-align: center;">{{$storeLog->supply_order_number}}</td>
                            <td style="text-align: center;">{{$storeLog->supplier_bill_number}}</td>
                            <td style="text-align: center;">{{$storeLog->supplier_address}}</td>
                            <td style="text-align: center;">{{$storeLog->supplier_name}}</td>
                            <td style="text-align: center;">{{$storeLog->store->title}}</td>
                            <td style="text-align: center;">{{$storeLog->storeItem->title}}</td>
                            <td>{{$storeLog->id}}</td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
        <div class="col-md-1"></div>

    </div>

@endsection