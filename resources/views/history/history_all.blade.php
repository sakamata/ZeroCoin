@extends('layouts.app')

@section('content')
<div class="col-12">
    <div id="qr_receve" class="card mx-auto">
        <div class="card p-1 pb-0">
            <div class="mx-auto">{{$items->links()}}</div>
            <h2>全体履歴</h2>
            <div class="mx-auto">
                <table class="table">
                    <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Point</th>
                        <th>DateTime</th>
                    </tr>
                    @foreach ($items as $item)
                    <tr>
                        <td>ID:{{$item->user_id}}<br>{{$item->name}}</td>
                        <td>ID:{{$item->r_user_id}}<br>{{$item->r_name}}</td>
                        <td>{{$item->receve_point}}</td>
                        <td>{{$item->created_at}}</td>
                    </tr>
                    @endforeach
                </table>

            </div>
            <div class="mx-auto">{{$items->links()}}</div>
        </div>
    </div>
</div>
@endsection
