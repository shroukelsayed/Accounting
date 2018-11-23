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


<!-- <table class="table table-condensed table-striped">
    <thead>
        <tr>
            <th class="text-center">التاريخ</th>
            <th class="text-center">رقم الدفتر</th>
            <th class="text-center">رقم اذن صرف الخزينه</th>
            <th class="text-center">النوع</th>
            <th class="text-center">لحساب</th>
            <th class="text-center">مبلغ ايصال</th>
            <th class="text-center">امين الخزينه</th>
            <th class="text-center">وذلك لقيمه</th>                            
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>
                <input class="form-control" placeholder="عنوان المتبرع" type="textbox" dir="rtl" name="search" id="donator_address">
            </td>
             <td>
                <input class="form-control" placeholder="تليفون المتبرع" type="textbox" dir="rtl" name="search" id="donator_mobile">
            </td>
            <td>
                <input class="form-control" placeholder="اسم المتبرع" type="textbox" dir="rtl" name="search" id="donator_name">
            </td>
            <td>
                <input class="form-control" placeholder="اسم المشروع" type="textbox" dir="rtl" name="search" id="project_name">
            </td>
            <td>
                <input class="form-control" placeholder="" type="date" name="search" id="receipt_date">
            </td>
            <td>
                <select name="search" id="type" class="form-control">
                    <option value="0"> all</option>
                    <option value="1">مستغل </option>
                    <option value="2">غير مستغل</option>
                    <option value="3">ﻻغى</option>
                    <option value="4">مشطوب</option>
                </select>
            </td>
            <td>
                <input class="form-control" placeholder="المبلغ" type="textbox" dir="rtl" name="search" id="amount" maxlength="10" size="10">
            </td>
            <td>
                <select name="search" id="cash" class="form-control">
                    <option value="2"> all</option>
                    <option value="1">نقاً </option>
                    <option value="0">شيكات</option>
                </select> 
            </td>
        </tr>
    </tbody>
</table> -->

<table class="table table-bordered">
  <thead>
    <tr>    
        <th scope="col" class="text-center">وذلك لقيمه</th>
        <th scope="col" class="text-center">امين الخزينه</th>
        <th scope="col" class="text-center">مبلغ ايصال</th>
        <th scope="col" class="text-center">لحساب</th>
        <th scope="col" class="text-center">النوع</th>
        <th scope="col" class="text-center">رقم اذن صرف الخزينه</th>
        <th scope="col" class="text-center">رقم الدفتر</th>                        
        <th scope="col" class="text-center">التاريخ</th>

    </tr>
  </thead>
  <tbody>
    @foreach($receipts as $receipt)
        <tr>
          <td class="text-center">{{$receipt->notes}}</td>
          <td class="text-center">-----------</td>
          <td class="text-center">{{$receipt->amount}}</td>
          <td class="text-center">{{$receipt->depositor_name}}</td>
          <td class="text-center">------------</td>
          <td class="text-center">{{$receipt->id}}</td>
          <td class="text-center">------------</td>
          <td class="text-center">{{$receipt->receipt_date}}</td>
        </tr>
    @endforeach
  </tbody>
</table>
@endsection