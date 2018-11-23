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
            <th class="text-center">اختر</th>
            <th class="text-center">عنوان المتبرع</th>
            <th class="text-center">تليفون المتبرع</th>
            <th class="text-center">اسم المتبرع</th>
            <th class="text-center">اسم المشروع</th>
            <th class="text-center">تاريخ اﻹيصال</th>
            <th class="text-center">النوع</th>
            <th class="text-center">المبلغ</th>
            <th class="text-center">نقاً / شيكات</th>                            
            <th class="text-center">رقم اﻹيصال</th>                            
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>
                &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp <a class="btn btn-danger" href="#" name="clear"><i class="glyphicon glyphicon-edit"></i>@lang('validation.edit')</a>
            </td>
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
            <td>
                <input class="form-control" placeholder="رقم اﻹيصال" type="search" dir="rtl" name="search" id="receipt_id" size="5">
            </td>
        </tr>
    </tbody>
</table>
@endsection