<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Garbage;

use Carbon\Carbon;

class GarbageController extends Controller
{
    public function add()
    {
        return view('admin.garbage.garbagecreate');
    }
    
    public function notificationCreate(Request $request)
    {
        //$user = Auth::user();
        $this->validate($request, Garbage::$rules);
        $garbage = new Garbage;
        $form = $request->all();
        
        unset($form['_token']);
        
        $garbage->fill($form)->save();
        
        return redirect ('admin/garbage/notificationCreate');
    }
    
    public function notificationIndex(Request $request)
    {
        $garbageQuery = Garbage::all();
        //dd($garbageQuery);
        
        $year = date('Y');
        $month = date('m');
        $currentMonth = date('m');
        //dd($year);
        $dateStr = sprintf('%04d-%02d-01', $year, $month);
        $date = new Carbon($dateStr);
        // カレンダーを四角形にするため、前月となる左上の隙間用のデータを入れるためずらす
        $date->subDay($date->dayOfWeek);
        // 同上。右下の隙間のための計算。
        $count = 31 + $date->dayOfWeek;
        $count = ceil($count / 7) * 7;
        $dates = [];

        for ($i = 0; $i < $count; $i++, $date->addDay()) {
            // copyしないと全部同じオブジェクトを入れてしまうことになる
            $dates[] = $date->copy();
        }
    
        return view('admin.garbage.notificationIndex',['garbageQuery' => $garbageQuery, 'dates' => $dates, 'currentMonth' => $currentMonth, 'year' => $year]);   
    }
    
    public function notificationEdit(Request $request)
    {
        $garbage = Garbage::find($request->id);
        if (empty($garbage)) {
            abort('404');
        }
        
        return view('admin.garbage.notificationEdit',['garbage_form' => $garbage]);
    }
    
    public function notificationDelete(Request $request)
    {
        $garbage = Garbage::find($request->id);
        $garbage->delete();
        return redirect('admin/garbage/');
    }
    
    public function update(Request $request)
    {
        $this->validate($request,Garbage::$rules);
        $garbage = Garbage::find($request->id);
        $garbage_form = $request->all();
        
        unset($garbage_form['_token']);
        
        $garbage->fill($garbage_form)->save();
        
        return redirect('admin/garbage');
    }
}
