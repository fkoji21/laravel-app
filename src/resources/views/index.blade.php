@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="attendance__alert">
   {{ session('message') }}
</div>

<div class="attendance__content">
  <div class="attendance__panel">
    <form class="attendance__button" action="{{ route('attendance.start') }}" method="POST">
      @csrf
      <button class="attendance__button-submit" type="submit">勤務開始</button>
    </form>
    <form class="attendance__button" action="{{ route('attendance.end') }}" method="POST">
      @csrf
      <button class="attendance__button-submit" type="submit">勤務終了</button>
    </form>
  </div>
  <div class="attendance-table">
    <table class="attendance-table__inner">
      <tr class="attendance-table__row">
        <th class="attendance-table__header">名前</th>
        <th class="attendance-table__header">開始時間</th>
        <th class="attendance-table__header">終了時間</th>
      </tr>
      @foreach (Auth::user()->attendances as $attendance)
      <tr class="attendance-table__row">
        <td class="attendance-table__item">{{ Auth::user()->name }}</td>
        <td class="attendance-table__item">{{ $attendance->start_time }}</td>
        <td class="attendance-table__item">{{ $attendance->end_time }}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
