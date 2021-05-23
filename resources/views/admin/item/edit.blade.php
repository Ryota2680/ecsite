@extends('layouts.app_admin')
@section('content')

<!DOCTYPE html>
<html lang='ja'>
<head>
<meta charest='utf-8'>
<title>商品編集</title>
</head>
<body>
<h1>商品編集</h1>
<form action='{{ route('admin.item.edit', ['id' => $item->id]) }}' method='post' enctype="multipart/form-data">
{{ csrf_field() }}
<label>商品名</label><br>
<input type='text' name='name' value="{{ $item->name }}"><br>
<label>商品説明</label><br>
<input type='text' name='description' value="{{ $item->description }}"><br>
<label>在庫数</label><br>
<input type='text' name='stock' value="{{ $item->stock }}"><br>
<label>商品画像</label><br>
<input type="file" name="image">
<input type='submit' value='編集'>
</form>
</body>
</html>

@endsection

