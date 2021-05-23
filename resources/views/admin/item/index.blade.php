@extends('layouts.app_admin')
@section('content')

<!DOCTYPE html>
<html lang='ja'>
<head>
<meta charest='utf-8'>
<title>筋トレマニア</title>
</head>
<body>
<h1>商品一覧</h1>
<table>
<tr>
<th>商品名</th>
<th>価格</th>
<th>在庫</th>
</tr>
@foreach ($items as $item)
<tr>
<td><a href="{{route('admin.item.detail', ['id' => $item->id])}}">{{$item->name}}</a></td>
<td>{{$item->price}}</td>
<td>
@if ($item->stock >= 1)
<p>在庫あり<p>
@else
<p>在庫なし<p>
</td>
@endif
</tr>
@endforeach
<td><a href="{{route('admin.item.add')}}">商品追加を追加する</a></td>
</body>
</html>
@endsection
