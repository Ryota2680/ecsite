@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang='ja'>
<head>
<meta charest='utf-8'>
<title>商品詳細</title>
</head>
<body>
<h1>商品詳細</h1>
@if (session('flash_message'))
<div class="flash_message bg-success text-center py-3 my-0">
{{ session('flash_message') }}
</div>
@endif
<h4>画像</h4>
@if ($item->image)
<img src="{{ asset('storage/item_image/' . $item->image) }}"  width="300" height="200">
@else
<h4>画像が登録されていません</h4>
@endif
<table border='1'>
<tr>
<th>商品名</th>
<th>商品説明</th>
<th>価格</th>
<th>在庫</th>
<th>カート追加</th>
</tr>
<tr>
<td>{{ $item->name }}</td>
<td>{{ $item->description }}</td>
<td>{{ $item->price }}</td>
<td>
@if ($item->stock >= 1)
<p>在庫あり<p>
@else
<p>在庫なし<p>
@endif
</td>
<td>
@guest
<a href="{{ route('login') }}" class="btn btn-success">ログインしてください</a>
@else
@if ($item->stock >= 1)
<form action="{{ route('cart.add', ['id' => $item->id]) }}" method="post">
{{ csrf_field() }}
<input type="number" min=1 name="quantity">
<button type="submit" class="btn btn-primary">カートに入れる</button>
</form>
@else
{{'在庫なし'}}
@endif
</td>
</tr>
</table>
<a href="{{ route('index') }}">戻る</a>
</body>
</html>
@endguest
@endsection

