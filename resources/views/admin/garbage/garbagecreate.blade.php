@extends('layouts.admin')

@section('title','収集日通知作成')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>収集日通知作成</h2>
                <form action="{{ action('Admin\GarbageController@notificationCreate') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">回収曜日</label>
                        <select class="dayOf" name="dayOf">
                            @foreach ($selectWeek as $key => $val)
                                <option value="{{ $key }}">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row"> 
                        <label class="col-md-2">ゴミの種類</label>
                        <select class="garbageType" name="garbageType">
                            @foreach ($selectType as $key => $val)
                                <option value="{{ $key }}">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">メモ</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="10">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="作成">
                </form>
            </div>
        </div>
    </div>
@endsection