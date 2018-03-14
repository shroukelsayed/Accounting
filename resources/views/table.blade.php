
<table id="receipts_table" class="table table-condensed table-striped">

    @foreach($receipts as $receipt)
        <tr>
             <td class="text-right">
                
               &nbsp&nbsp <a class="btn btn-xs btn-warning" href="{{ url('receipts', $receipt->id) }}"><i class="glyphicon glyphicon-edit"></i>@lang('validation.edit')</a>
               &nbsp&nbsp<input name="checked[]" type="checkbox" value="{{$receipt->id}}">
            </td>
            <td>{{$receipt->donator_address}}</td>
            <td>{{$receipt->donator_name}}</td>
            <td>{{ Carbon\Carbon::parse($receipt->receipt_date)->format('d-m-Y')}}</td>
            @if($receipt->type ==4 )
                <td>مشطوب</td>
            @elseif($receipt->type ==3)
                <td>ﻻغى</td>
            @elseif($receipt->type ==2)
                <td>غير مستغل</td>
            @else
                <td>مستغل</td>
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