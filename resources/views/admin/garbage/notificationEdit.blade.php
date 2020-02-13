@extends('layouts.admin')

@section('title','通知編集')
@section('content')
    <div class="container">
        <div class="row">
            <h2>通知編集</h2>
            <div class="col-md-8 mx-auto">
                <form action="{{ action('Admin\GarbageController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif 
                    <div class="form-group row">
                        <label class="col-md-2">回収曜日</label>
                        <select class="dayOf" name="dayOf" value="{{ $garbage->dayOf }}">
                            @foreach ($selectWeek as $key => $val)
                                @if ($garbage->dayOf == $key)
                                    <option value="{{ $key }}" selected >{{ $val }}</option>
                                @else 
                                    <option value="{{ $key }}">{{ $val }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">種類</label>
                        <select class="garbageType" name="garbageType">
                            @foreach ($selectType as $key => $val)
                                @if ($garbage->garbageType == $key)
                                    <option value="{{ $key }}" selected >{{ $val }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $val }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">メモ</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="10">{{ $garbage->body }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $garbage->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection