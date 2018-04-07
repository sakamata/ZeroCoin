@extends('layouts.app')

@section('content')
<div class="col-12">
    <div id="qr_receve" class="card mx-auto">
        <div class="card p-1 pb-0">
            <div class="mx-auto">{{$items->links()}}</div>
            <h2 class="p-3">{{$tagetUser->name}}さんの履歴</h2>
            <div class="mx-auto">
                <table class="table table-striped table-sm">
                    <tr class="text-center">
                        <th>あげた</th>
                        <th>もらった</th>
                        <th>Point</th>
                        <th>日時</th>
                    </tr>
                @foreach ($items as $item)
                    <tr>
                        <td class="align-middle">ID:{{$item->user_id}}<br>{{$item->name}}</td>
                        <td class="align-middle">ID:{{$item->r_user_id}}<br>{{$item->r_name}}</td>

                    @if ($item->id == $tagetUser->id)
                        <td class="text-right align-middle">-{{number_format($item->receve_point)}}</td>
                    @else
                        <td class="text-right align-middle">{{number_format($item->receve_point)}}</td>
                    @endif
                        <td class="text-right align-middle">{{ $item->created_at}}</td>
                    </tr>
                @endforeach
                </table>
            </div>
            <div class="mx-auto">{{$items->links()}}</div>
        </div>
    </div>
</div>
@endsection
