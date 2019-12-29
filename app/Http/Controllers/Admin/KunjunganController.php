<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Area;
use App\Role;
use App\User;
use App\Visitor;
use App\Visitation;
use App\Visitation_area;
use App\Card;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KunjunganController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $visitations = Visitation::orderBy('updated_at','desc')->orderBy('status','asc')->with('visitor','card')->get();
        return view('admin.kunjungan.index', compact('visitations'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $visitors = Visitor::select('nama','id','no_identitas','jenis_identitas')->orderBy('no_identitas', 'asc')->get();
        $cards = Card::whereDoesntHave('kunjungan', function($q){
          $q->whereDate('tanggal', date('Y-m-d'))->where('status', 'aktif');
        })->get();
        return view('admin.kunjungan.create', compact('visitors','cards'));
    }

    public function store(Request $request)
    {
        $visitation = Visitation::create($request->all());
        return redirect()->route('admin.kunjungan.area',$visitation->id);
    }

    public function area($id)
    {
      abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
      $areas = Area::orderBy('nama','asc')->get();
      $selected_areas = Visitation_area::where('visitation_id', $id)->pluck('area_id');
      return view('admin.kunjungan.area', compact('id','areas','selected_areas'));
    }

    public function storeArea($id, Request $request){
      $selected_areas = Visitation_area::where('visitation_id', $id)->pluck('area_id')->toArray();
      $posted_areas = $request->area;
//      dd($posted_areas);
      $toBeDeleted = $toBeInserted = array();
      foreach($posted_areas as $posted_area){
        if(!in_array($posted_area, $selected_areas)){
          array_push($toBeInserted, $posted_area);
        }
      }
      foreach($selected_areas as $selected_area){
        if(!in_array($selected_area, $posted_areas)){
          array_push($toBeDeleted, $selected_area);
        }
      }
//      dd($toBeInserted);
      foreach($toBeInserted as $insert){
        $data = array(
          'visitation_id' => $id,
          'area_id' => $insert,
        );
//        dd($data);
        Visitation_area::create($data);
      }
      foreach($toBeDeleted as $delete){
        $data = Visitation_area::where('visitation_id', $id)->where('area_id', $delete)->first();
        $data->delete();
      }
      return redirect()->route('admin.kunjungan.area',$id);
    }

    public function edit($id)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $visitation = Visitation::findOrFail($id);
        $visitors = Visitor::select('nama','id','no_identitas','jenis_identitas')->orderBy('no_identitas', 'asc')->get();
//        dd($visitation->tanggal->toDateString());
        $cards = Card::whereDoesntHave('kunjungan', function($q) use ($id){
          $q->whereDate('tanggal', date('Y-m-d'))->where('status', 'aktif')->where('id', '!=',$id);
        })->get();
      return view('admin.kunjungan.edit', compact('visitation','visitors','cards'));
    }

    public function update(Request $request, $id)
    {
        $visitation = Visitation::findOrFail($id);
        $visitation->update($request->all());
        return redirect()->route('admin.kunjungan.edit', $id);
    }

    public function editArea($id)
    {
      abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
      $roles = Role::all()->pluck('title', 'id');
      return view('admin.kunjungan.editArea', compact('roles'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $visitation = Visitation::findOrFail($id);
        $visitation->delete();
        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
