
@extends('layouts.app')

@section('content')
    

    <br><br><br><br><br><br><br>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            @if($custodySheets->count())
                <table id="receipts_table" class="table table-hover ">
                    <tr class="bg-danger">
                        <td style="text-align: center;">ملاحظات</td>
                        <td style="text-align: center;">البيان</td>
                        <td style="text-align: center;">المبلغ</td>
                        <td style="text-align: center;">تاريخ سحب العهدة</td>
                        <td style="text-align: center;">الاسم</td>

                        <td style="text-align: center;">النوع</td>
                        <td></td>
                    </tr>
                    @foreach($custodySheets as $custodySheet)
                        <tr class="bg-success">
                            <td style="text-align: center;">{{$custodySheet->notes}}</td>
                            <td style="text-align: center;">{{$custodySheet->report}}</td>
                            <td style="text-align: center;">{{$custodySheet->amount}}</td>
                            <td style="text-align: center;">{{$custodySheet->custody_date}}</td>
                            <td style="text-align: center;">{{$custodySheet->worker->title}}</td>
                            <td style="text-align: center;">{{$custodySheet->type}}</td>
                            <td>{{$custodySheet->id}}</td>
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
