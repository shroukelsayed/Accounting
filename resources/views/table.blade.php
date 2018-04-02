
<table id="receipts_table" class="table table-hover ">

    @foreach($receipts as $receipt)

        @if($receipt->type ==4 )
            <tr class="bg-danger">
        @elseif($receipt->type ==3)
            <tr class="bg-warning">
        @elseif($receipt->type ==2)
            <tr class="bg-info">
        @else
            <tr class="bg-success">
        @endif
            <td width="200 px;">
                
               &nbsp&nbsp <a class="btn btn-xs btn-warning" href="{{ url('receipts', $receipt->id) }}"><i class="glyphicon glyphicon-edit"></i>@lang('validation.edit')</a>
               &nbsp&nbsp 
               <a class="btn btn-xs btn-warning" href="{{ url('receipts', $receipt->id) }}"><i class="glyphicon glyphicon-edit"></i>@lang('validation.view')</a>
               &nbsp&nbsp
                @if($receipt->type ==1)
                    @if($receipt->receipt_id != 0)
                        <input  type="checkbox" disabled="true" checked="true">
                    @else
                        @if($receipt->cash == '1')
                            <input name="checked[]" class="checked" type="checkbox" data-attr="cash" value="{{$receipt->id}}">
                        @else
                            <input name="checked[]" class="checked" type="checkbox" data-attr="cheque" value="{{$receipt->id}}">
                        @endif
                    @endif
                @endif
            </td>
            <td style="text-align: center;">{{$receipt->donator_address}}</td>
            <td style="text-align: center;">{{$receipt->donator_name}}</td>
            <td width="100 px;" style="text-align: center;">{{ Carbon\Carbon::parse($receipt->receipt_date)->format('d-m-Y')}}</td>
            @if($receipt->type ==4 )
                <td style="text-align: center;">مشطوب</td>
            @elseif($receipt->type ==3)
                <td style="text-align: center;">ﻻغى</td>
            @elseif($receipt->type ==2)
                <td style="text-align: center;">غير مستغل</td>
            @else
                <td style="text-align: center;">مستغل</td>
            @endif
            <td style="text-align: center;">{{number_format($receipt->amount)}}</td>
            @if($receipt->cash == '1')
                <td  style="text-align: center;">نقاً </td>
            @else
                <td style="text-align: center;">شيكات</td>
            @endif
            <td>{{$receipt->id}}</td>
        </tr>
    @endforeach
                   

</table>