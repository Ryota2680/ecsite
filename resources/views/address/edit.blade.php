@extends('layouts.app')
@section('content')

@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<h1>住所を編集する</h1>
{{ Form::open(['method' => 'post', 'route' => ['address.edit', 'id' => $address->id]]) }}
氏名
<p>{{ Form::text('name', $address->name) }}</p>

郵便番号
<p>{{ Form::text('zip', $address->zip) }}</p>

都道府県
<p>{{Form::select('pref', $prefs, $address->pref)}}</p>

市区町村
<p>{{ Form::text('city', $address->city) }}</p>

番地
<p>{{ Form::text('detail_address', $address->detail_address) }}</p>

電話番号
<p>{{ Form::text('phone_num', $address->phone_num) }}</p>
<p>{{ Form::submit('編集する') }}</p>
{{ Form::close() }}
 <a href="{{ route('address.index') }}" class="btn btn-default">住所一覧に戻る</a>
@endsection
