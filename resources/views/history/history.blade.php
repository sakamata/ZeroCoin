@extends('layouts.app')

@section('content')
<div class="col-12">
    <div id="qr_receve" class="card mx-auto">
        <div class="card p-1 pb-0">
            <div class="mx-auto mt-3">{{$items->links()}}</div>
            <h2 class="p-3">{{$tagetUser->name}}さんの履歴<br>残高: {{number_format($tagetUser->now_point)}}Pt</h2>
            <div class="mx-auto">
                <table class="table table-striped">
                    <tr class="text-center">
                        <th>日時</th>
                        <th>あげた</th>
                        <th>もらった</th>
                        <th>Point</th>
                    </tr>
                    @foreach ($items as $item)
                    <tr>
                        <td class="text-right align-middle">{{ Carbon\Carbon::parse($item->created_at)->format('n/j G:i') }}</td>

                        @if ($item->id == $tagetUser->id)
                        <td class="align-middle break-all"><span>{{$item->r_user_id}}</span><span>{{$item->r_name}}</span></td>
                        @else
                        <td class="align-middle"></td>
                        @endif

                        @if ($item->id == $tagetUser->id)
                        <td class="align-middle"></td>
                        @else
                        <td class="align-middle break-all"><span>{{$item->user_id}}</span><span>{{$item->name}}</span></td>
                        @endif

                        @if ($item->id == $tagetUser->id)
                        <td class="text-right align-middle">-{{number_format($item->receve_point)}}</td>
                        @else
                        <td class="text-right align-middle">{{number_format($item->receve_point)}}</td>
                        @endif
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="mx-auto">{{$items->links()}}</div>
            <div class="d-flex mx-auto pb-3">
                <a role="button" href="/" class="btn btn-lg btn-warning d-block mx-auto">HOME</a>
            </div>
        </div>
    </div>
</div>
@endsection
