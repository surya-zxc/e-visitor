<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Visitation_log;

class HomeController
{
    public function index()
    {
        $tahun=date('Y');
        $januari=DB::table('visitations')->whereYear('tanggal', $tahun)->whereMonth('tanggal',01)->count();
        $februari=DB::table('visitations')->whereYear('tanggal', $tahun)->whereMonth('tanggal',02)->count();
        $maret=DB::table('visitations')->whereYear('tanggal', $tahun)->whereMonth('tanggal',03)->count();
        $april=DB::table('visitations')->whereYear('tanggal', $tahun)->whereMonth('tanggal',04)->count();
        $mei=DB::table('visitations')->whereYear('tanggal', $tahun)->whereMonth('tanggal',05)->count();
        $juni=DB::table('visitations')->whereYear('tanggal', $tahun)->whereMonth('tanggal',06)->count();
        $juli=DB::table('visitations')->whereYear('tanggal', $tahun)->whereMonth('tanggal',07)->count();
        $agustus=DB::table('visitations')->whereYear('tanggal', $tahun)->whereMonth('tanggal',8)->count();
        $september=DB::table('visitations')->whereYear('tanggal', $tahun)->whereMonth('tanggal',9)->count();
        $oktober=DB::table('visitations')->whereYear('tanggal', $tahun)->whereMonth('tanggal',10)->count();
        $november=DB::table('visitations')->whereYear('tanggal', $tahun)->whereMonth('tanggal',11)->count();
        $desember=DB::table('visitations')->whereYear('tanggal', $tahun)->whereMonth('tanggal',12)->count();
        // $todayVisitorLastPosition = Visitation_log::select('visitation_id',DB::raw('area_id WHERE timestamp = max(timestamp)'), DB::raw('max(timestamp) as stampTerakhir'))->whereDate('timestamp', date("Y-m-d"))->orderBy('timestamp','desc')->groupBy('visitation_id')->get();
        
        return view('home', compact('januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'));
    }

    public function tableTrack()
    {
        $data = DB::table('visitation_activity_logs')->groupBy('visitation_id')->get();
        $i=0;
        foreach($data as $usr){
            $users[$i]=DB::table('visitation_activity_logs')
            ->select('visitors.nama','areas.nama as nama_area','visitation_activity_logs.timestamp as timestamp')
            ->leftJoin('visitations','visitation_activity_logs.visitation_id','=','visitations.id')
            ->leftJoin('visitors','visitations.visitor_id','=','visitors.id')
            ->leftJoin('areas','visitation_activity_logs.area_id','=','areas.id')
            ->where('visitation_id',$usr->visitation_id)->orderBy('timestamp','desc')->get()->first();
            $i++;
        }
        return view('tabelTrack', compact('users'));
    }
}
