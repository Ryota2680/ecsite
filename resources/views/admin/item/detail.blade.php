@extends('layouts.app_admin')
@section('content')

<!DOCTYPE html>
<html lang='ja'>
<head>
<meta charest='utf-8'>
<title>商品詳細</title>
</head>
<body>
<h1>商品詳細</h1>

<h4>画像</h4>
@if ($item->image)
<img src="{{ asset('storage/item_image/' . $item->image) }}"  width="300" height="200">
@else
<h4>画像が登録されていません</h4>
@endif

<table>
<tr>
<th>商品名</th>
<th>商品説明</th>
<th>価格</th>
<th>在庫</th>
</tr>
<tr>
<td>{{$item->name}}</td>
<td>{{$item->description}}</td>
<td>{{$item->price}}</td>
<td>
@if ($item->stock >= 1)
<p>在庫あり<p>
@else
<p>在庫なし<p>
</td>
@endif
</tr>
<td><a href="{{route('admin.item.edit', ['id' => $item->id])}}">商品編集</a></td>
</body>
</html>
@endsection

