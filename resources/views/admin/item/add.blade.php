@extends('layouts.app_admin')
@section('content')

<!DOCTYPE html>
<html lang='ja'>
<head>
<meta charest='utf-8'>
<title>商品追加</title>
</head>
<body>
<h1>商品追加</h1>
<form action='{{ route('admin.item.add') }}' method='post' enctype="multipart/form-data">
{{ csrf_field() }}
<label>商品名</label><br>
<input type='text' name='name'><br>
<label>商品説明</label><br>
<input type='text' name='description'><br>
<label>値段</label><br>
<input type='text' name='price'><br>
<label>在庫数</label><br>
<input type='text' name='stock'><br>
<label>商品画像</label><br>
<input type="file" name="image">
<input type='submit' value='追加'>
</form>
</body>
</html>

@endsection

