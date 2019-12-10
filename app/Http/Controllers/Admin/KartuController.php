<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\Card;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KartuController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = Card::all();
        return view('admin.kartu.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.kartu.create');
    }

    public function store(Request $request)
    {
        $data = array('card_uid' => $request->uid);
        Card::create($data);
        return redirect()->route('admin.kartu.index');
    }

    public function edit($user)
    {
        $user = Card::findOrFail((int) $user);
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.kartu.edit', compact('user'));
    }

    public function update(Request $request, $user)
    {
        $user = Card::findOrFail((int) $user);
        $data = array(
          'card_uid' => $request->uid,
        );
        $user->update($data);
        return redirect()->route('admin.kartu.index');
    }

    public function destroy($user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = Card::findOrFail((int) $user);
        $user->delete();
        return back();
    }

    public function massDestroy(MassDestroyCardRequest $request)
    {
        Card::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
