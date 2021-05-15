@extends('layouts.app')
@section('content')
<!--完了・エラーメッセージ-->
@if (session()->has('error'))
	<div class="alert alert-info mb-3">
	{{ session('error') }}
	</div>
@endif
@if (session()->has('success'))
	<div class="alert alert-info mb-3">
	{{ session('success') }}
	</div>
@endif
<!DOCTYPE html>
<html lang='ja'>
<head>
<meta charest='utf-8'>
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
<td><a href="{{ route('item.detail', ['id' => $item->id]) }}">{{ $item->name }}</a></td>
<td>{{ $item->price }}</td>
<td>
@if ($item->stock >= 1)
<p>在庫あり<p>
@else
<p>在庫なし<p>
</td>
@endif
</tr>
@endforeach
</body>
</html>
@endsection




