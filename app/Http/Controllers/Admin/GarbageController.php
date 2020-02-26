<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Garbage;
use App\Mail\GarbageMail;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;

class GarbageController extends Controller
{
    public function add()
    {
        $selectWeek = [
            '月曜' => '月曜日',
            '火曜' => '火曜日',
            '水曜' => '水曜日',
            '木曜' => '木曜日',
            '金曜' => '金曜日',
            '土曜' => '土曜日',
            '日曜' => '日曜日',
        ];
        
        $selectType= [
            '可燃' => '可燃',
            '不燃' => '不燃',
            '埋め立て' => '埋め立て',
            '資源' => '資源',
        ];
        return view('admin.garbage.garbagecreate',compact('selectWeek', 'selectType'));
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
        $week = ['日', '月', '火', '水', '木', '金', '土'];
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
    
        return view('admin.garbage.notificationIndex', compact('garbageQuery', 'dates', 'currentMonth', 'year', 'week'));   
    }
    
    
    public function notificationMail(Request $request)
    {
        $contact = $request->all();
       
        //dd($contact["garbageType"]);
        Mail::to("7kamimura74@gmail.com")
                    ->send(new GarbageMail($contact)); // 引数にリクエストデータを渡す
        
        return redirect('admin/garbage/');
                    
    }
    
    public function notificationEdit(Request $request)
    {
        $garbage = Garbage::find($request->id);
        if (empty($garbage)) {
            abort('404');
        }
        $selectWeek = [
            '月曜' => '月曜日',
            '火曜' => '火曜日',
            '水曜' => '水曜日',
            '木曜' => '木曜日',
            '金曜' => '金曜日',
            '土曜' => '土曜日',
            '日曜' => '日曜日',
        ];                                      //viewで書いてもいいが、コントローラーに書いた方が綺麗でわかりやすい
        
        $selectType= [
            '可燃' => '可燃',
            '不燃' => '不燃',
            '埋め立て' => '埋め立て',
            '資源' => '資源',
        ];
        return view('admin.garbage.notificationEdit', compact('garbage', 'selectWeek', 'selectType'));
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
