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

<h1>住所を登録する</h1>
{{ Form::open(['method' => 'post', 'url' => route('address.add')]) }}
氏名
<p>{{ Form::text('name', old('name'), ['placeholder' => 'プロサー太郎', 'rows' => 1]) }}</p>
郵便番号
<p>{{ Form::text('zip', old('zip'), ['placeholder' => '98601234', 'rows' => 1]) }}</p>

都道府県
<p>{{Form::select('pref', $prefs)}}</p>

市区町村
<p>{{ Form::text('city', old('city'), ['placeholder' => '〇〇市〇〇区', 'rows' => 1]) }}</p>

番地
<p>{{ Form::text('detail_address', old('detail_address'), ['placeholder' => '〇丁目〇-〇〇', 'rows' => 1]) }}</p>

電話番号
<p>{{ Form::text('phone_num', old('phone_num'), ['placeholder' => '09023311291', 'rows' => 1]) }}</p>

お届け先に設定する
<p>{{ Form::checkbox('selected_flg', config('common.flg.true'), true) }}</p>

<p>{{ Form::submit('追加する') }}</p>
{{ Form::close() }}
 <a href="{{ route('address.index') }}" class="btn btn-default">住所一覧に戻る</a>
@endsection
