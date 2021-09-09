@extends('layouts.app')
@section('content')

@if (session('flash_message'))
<div class="flash_message bg-success text-center py-3 my-0">
{{ session('flash_message') }}
</div>
@endif

@if (Session::has('message'))
<p><font color='red'>{{ session('message') }}</font></p>
@endif

<h1>住所一覧</h1>
@if ($addresses->isEmpty())
お届け先が登録されていません。
@else
{{ Form::open(['method' => 'post', 'route' => ['address.update_selected_address']]) }} 
<table border="1">
<tr>
<th>お届け先に選択</th>
<th>名前</th>
<th>郵便番号</th>
<th>都道府県</th>
<th>市区町村</th>
<th>番地</th>
<th>電話番号</th>
<th>編集</th>
<th>削除</th>
<tr>
@foreach ($addresses as $address)
<tr>
<td>{{ Form::radio('selected_flg', $address->id, $address->selected_flg) }}</td>
<td>{{ $address->name }}</td>
<td>{{ $address->zip }}</td>
<td>{{ config('common.pref.' . $address->pref) }}</td> 
<td>{{ $address->city }}</td>
<td>{{ $address->detail_address }}</td>
<td>{{ $address->phone_num }}</td>
<td><a href="{{ route('address.edit', ['id' => $address->id]) }}">編集</a></td> 
<td><a href="{{ route('address.delete', ['id' => $address->id]) }}" onclick='return confirm("こちらの住所を削除します");'>削除</a></td>
</tr>
@endforeach
</table>
<br>

<p>{{ Form::submit('お届け先を変更する') }}</p>
{{ Form::close() }}

@endif
 <a href="{{ route('address.add')}}">お届け先を追加する</a>
@endsection
