
<table id="receipts_table" class="table table-condensed table-striped">

    @foreach($receipts as $receipt)
        <tr>
            <td width="200 px;">
                
               &nbsp&nbsp <a class="btn btn-xs btn-warning" href="{{ url('receipts', $receipt->id) }}"><i class="glyphicon glyphicon-edit"></i>@lang('validation.edit')</a>
               &nbsp&nbsp 
               <a class="btn btn-xs btn-warning" href="{{ url('receipts', $receipt->id) }}"><i class="glyphicon glyphicon-edit"></i>@lang('validation.view')</a>
               &nbsp&nbsp
                @if($receipt->cash == '1')
                    <input name="checked[]" class="checked" type="checkbox" data-attr="cash" value="{{$receipt->id}}">
                @else
                    <input name="checked[]" class="checked" type="checkbox" data-attr="cheque" value="{{$receipt->id}}">
                @endif
            </td>
            <td style="text-align: center;">{{$receipt->donator_address}}</td>
            <td style="text-align: center;">{{$receipt->donator_name}}</td>
            <td width="100 px;">{{ Carbon\Carbon::parse($receipt->receipt_date)->format('d-m-Y')}}</td>
            @if($receipt->type ==4 )
                <td style="text-align: center;">مشطوب</td>
            @elseif($receipt->type ==3)
                <td style="text-align: center;">ﻻغى</td>
            @elseif($receipt->type ==2)
                <td style="text-align: center;">غير مستغل</td>
            @else
                <td style="text-align: center;">مستغل</td>
            @endif
            <td>{{$receipt->amount}}</td>
            @if($receipt->cash == '1')
                <td>نقاً </td>
            @else
                <td>شيكات</td>
            @endif
            <td>{{$receipt->id}}</td>
        </tr>
    @endforeach
                   

</table>