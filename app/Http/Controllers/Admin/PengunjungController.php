<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Visitor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PengunjungController extends Controller
{
    public function index()
    {
        $users = Visitor::all();
//        dd($users);
        return view('admin.pengunjung.index', compact('users'));
    }

    public function create()
    {
        return view('admin.pengunjung.create');
    }

    public function store(Request $request)
    {
        $user = Visitor::create($request->all());
//      dd($user);
        return redirect()->route('admin.pengunjung.index');
    }

    public function edit($id)
    {
      $user = Visitor::findOrFail($id);
      return view('admin.pengunjung.edit', compact(   'user'));
    }

    public function update(Request $request, $id)
    {
        $user = Visitor::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('admin.pengunjung.index');
    }

    public function destroy($id)
    {
        $user = Visitor::findOrFail($id);
        $user->delete();
        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
