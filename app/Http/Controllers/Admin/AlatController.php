<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Area;
use App\Device;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AlatController extends Controller
{
    public function index()
    {
        $users = Device::with('area')->get();
        return view('admin.alat.index', compact('users'));
    }

    public function create()
    {
        $areas = Area::select('id','nama')->orderBy('nama')->get();
        return view('admin.alat.create',compact('areas'));
    }

    public function store(Request $request)
    {
        $user = Device::create($request->all());
        return redirect()->route('admin.alat.index');
    }

    public function edit($id)
    {
        $user = Device::findOrFail($id);
        $areas = Area::select('id','nama')->orderBy('nama')->get();
        return view('admin.alat.edit', compact('areas', 'user'));
    }

    public function update(Request $request, $id)
    {
        $user = Device::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('admin.alat.index');
    }

    public function destroy($id)
    {
        $user = Device::findOrFail($id);
        $user->delete();
        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
