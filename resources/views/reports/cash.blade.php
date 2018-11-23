@extends('layouts.app')
@section('header')
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

@endsection
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection

@section('content')

<table class="table table-condensed table-striped">
    <thead>
        <tr>
            <th class="text-center">التاريخ الى  </th>
            <th class="text-center">التاريخ من </th>
            <th class="text-center">رقم الايصال</th>
            <th class="text-center">رقم الدفتر</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>
                <input class="form-control" placeholder="" type="date" name="search" id="receipt_date">
            </td>

            <td>
                <input class="form-control" placeholder="" type="date" name="search" id="receipt_date">
            </td>
            <td>
                <input class="form-control" placeholder="رقم الايصال" type="textbox" dir="rtl" name="search" id="donator_address">
            </td>
             <td>
                <input class="form-control" placeholder="رقم الدفتر" type="textbox" dir="rtl" name="search" id="donator_mobile">
            </td>
        </tr>
    </tbody>
</table>


<table class="table table-bordered">
  <thead>
    <tr>    
        <th scope="col" class="text-center">وذلك لقيمه</th>
        <th scope="col" class="text-center">امين الخزينه</th>
        <th scope="col" class="text-center">مبلغ ايصال</th>
        <th scope="col" class="text-center">استلمنا من السادة </th>
        <th scope="col" class="text-center">النوع</th>
        <th scope="col" class="text-center">رقم   ايصال استلام الخزينة</th>
        <th scope="col" class="text-center">رقم الدفتر</th>                        
        <th scope="col" class="text-center">كود الدفتر</th>                        
        <th scope="col" class="text-center">التاريخ</th>

    </tr>
  </thead>
  <tbody>
    @foreach($receipts as $receipt)
        <tr>
          <td class="text-center">{{$receipt->notes}}</td>
          <td class="text-center">-----------</td>
          <td class="text-center">{{$receipt->amount}}</td>
          <td class="text-center">{{$receipt->delivered_by}}</td>
          <td class="text-center">------------</td>
          <td class="text-center">{{$receipt->id}}</td>
          <td class="text-center">------------</td>
          <td class="text-center">------------</td>
          <td class="text-center">{{$receipt->receipt_date}}</td>
        </tr>
    @endforeach
  </tbody>
</table>
@endsection