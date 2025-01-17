<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function start()
    {
        $user = Auth::user();

        // 勤務開始を登録
        Attendance::create([
            'user_id' => $user->id,
            'start_time' => now(),
        ]);

        return redirect()->back()->with('message', '勤務開始を登録しました。');
    }

    public function end()
    {
        $user = Auth::user();

        // 最新の勤怠データを取得して終了時間を登録
        $attendance = $user->attendances()->latest()->first();
        if ($attendance && !$attendance->end_time) {
            $attendance->update([
                'end_time' => now(),
            ]);

            return redirect()->back()->with('message', '勤務終了を登録しました。');
        }

        return redirect()->back()->with('error', '勤務開始が未登録です。');
    }

}
