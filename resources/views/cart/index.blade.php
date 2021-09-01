@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang='ja'>
<head>
<meta charest='utf-8'>
<title>カート一覧</title>
</head>
<body>
<h1>カート一覧</h1>
@if (session('flash_message'))
<div class="flash_message bg-success text-center py-3 my-0">
{{ session('flash_message') }}
</div>
@endif
@if (count($carts) == 0)
<p>カートは空です</p>
@else
<table>
<tr>
<th>商品名</th>
<th>個数</th>
<th>価格</th>
<th>削除</th>
</tr>
@foreach ($carts as $cart)
<tr>
<td>{{$cart->item->name}}</td>
<td>{{$cart->quantity}}</td>
<td>{{$cart->item->price}}</td>
<td><a href="{{ route('cart.delete', ['id' => $cart->id]) }}">削除</a></td>
</tr>
@endforeach
</body>
</table>
<p>{{'合計金額:'}} {{$total}}</p>
@endif
{{-- <a href="{{ route('charge.confirm') }}" class="btn btn-default">レジへ進む</a><br><br> --}}
<a href="{{ route('index') }}" class="btn btn-default">戻る</a>
{{-- <a href="{{ route('address.index') }}" class="btn btn-default">お届け先選択</a> --}}
@endsection
