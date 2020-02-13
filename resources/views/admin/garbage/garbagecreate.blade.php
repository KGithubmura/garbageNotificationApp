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
                            <option value="月曜">月曜日</option>
                            <option value="火曜">火曜日</option>
                            <option value="水曜">水曜日</option>
                            <option value="木曜">木曜日</option>
                            <option value="金曜">金曜日</option>
                            <option value="土曜">土曜日</option>
                            <option value="日曜">日曜日</option>
                        </select>
                    </div>
                    <div class="form-group row"> 
                        <label class="col-md-2">ゴミの種類</label>
                        <select class="garbageType" name="garbageType">
                            <option value="可燃">可燃</option>
                            <option value="不燃">不燃</option>
                            <option value="資源">資源</option>
                            <option value="埋め立て">埋め立て</option>
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