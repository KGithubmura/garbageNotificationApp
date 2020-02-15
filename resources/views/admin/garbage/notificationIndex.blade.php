@extends('layouts.admin')
@section('title','通知一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>通知一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4 my-3">
                <a href="{{ action('Admin\GarbageController@notificationCreate') }}" type="button" class="btn btn-primary">新規通知作成</a>
            </div>
        </div>
        <div class="row">
            <div class="notification_list col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                            <th width="10%">ID</th>
                            <th width="10%">曜日</th>
                            <th width="10%">種類</th>
                            <th width="20%">メモ</th>
                            <th width="10%">操作</th>
                            <th width="10%">メール送信</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($garbageQuery as $garbage)
                                    <tr>
                                        <th>{{ $garbage->id }}</th>
                                        <td>{{ str_limit($garbage->dayOf) }}</td>
                                        <td>{{ str_limit($garbage->garbageType) }}</td>
                                        <td>{{ str_limit($garbage->body) }}</td>
                                        <td>
                                            <div>
                                                <a href="{{ action('Admin\GarbageController@notificationEdit',['id' => $garbage->id]) }}">編集</a>
                                            </div>
                                            <div>
                                                <a href="{{ action('Admin\GarbageController@notificationDelete',['id' => $garbage->id]) }}">削除</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="{{ action('Admin\GarbageController@notificationMail', ['dayOf' => $garbage->dayOf, 'garbageType' => $garbage->garbageType, 'body' => $garbage->body]) }}">送信</a>
                                            </div>
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <h2>{{ $year }}年{{ $currentMonth }}月</h2>
                    </div>
                    <table class="table table-bordered text-muted bg-light">
                      <thead>
                        <tr>
                          @foreach ($week as $dayOfWeek)
                          @if ($dayOfWeek == '日')
                          <th width="10%" class="text-danger">{{ $dayOfWeek }}</th>
                          @elseif($dayOfWeek == '土')
                          <th width="10%" class="text-primary">{{ $dayOfWeek }}</th>
                          @else
                          <th width="10%">{{ $dayOfWeek }}</th>
                          @endif
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($dates as $date)
                        @if ($date->dayOfWeek == 0)
                        <tr>
                        @endif
                          <td>
                            @if ($date->month != $currentMonth)
                            <div class="alert alert-secondary">
                                {{ $date->day }}
                            </div>
                            @else
                            <div class="alert alert-light">
                                {{ $date->day }}
                                @foreach($garbageQuery as $garbage)
                                    @if (strpos($garbage->dayOf, $week[$date->format('w')]) !== false)
                                        {{ str_limit($garbage->garbageType) }}
                                    @endif
                                @endforeach
                            </div>
                            @endif
                          </td>
                        @if ($date->dayOfWeek == 6)
                        </tr>
                        @endif
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection