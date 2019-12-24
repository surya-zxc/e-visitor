<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use App\Visitor;
use App\Visitation;
use App\Card;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KunjunganController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $visitations = Visitation::orderBy('updated_at','desc')->with('visitor','card')->get();
        return view('admin.kunjungan.index', compact('visitations'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $visitors = Visitor::select('nama','id','no_identitas','jenis_identitas')->orderBy('no_identitas', 'asc')->get();
        $cards = Card::all();
        return view('admin.kunjungan.create', compact('visitors','cards'));
    }

    public function store(Request $request)
    {
        Visitation::create($request->all());
        return redirect()->route('admin.kunjungan.index');
    }

    public function area($id)
    {
      abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      $roles = Role::all()->pluck('title', 'id');

      return view('admin.kunjungan.area', compact('roles'));
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        $user->load('roles');

        return view('admin.kunjungan.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.kunjungan.index');

    }

    public function editArea($id)
    {
      abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      $roles = Role::all()->pluck('title', 'id');

      return view('admin.kunjungan.editArea', compact('roles'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
