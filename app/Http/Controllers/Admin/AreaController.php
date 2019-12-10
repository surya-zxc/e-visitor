<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDe;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Role;
use App\Area;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AreaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('area_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $areas = Area::orderBy('nama','asc')->get();
        return view('admin.area.index', compact('areas'));
    }

    public function create()
    {
        abort_if(Gate::denies('area_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.area.create');
    }

    public function store(StoreAreaRequest $request)
    {
        $area = Area::create($request->all());
        return redirect()->route('admin.area.index');
    }

    public function edit(Area $area)
    {
        abort_if(Gate::denies('area_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.area.edit', compact( 'area'));
    }

    public function update(UpdateAreaRequest $request, Area $area)
    {
        $area->update($request->all());
        return redirect()->route('admin.area.index');

    }

    public function show(Area $area)
    {
      abort_if(Gate::denies('area_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
      return view('admin.users.show', compact('area'));
    }

    public function destroy(Area $area)
    {
        abort_if(Gate::denies('area_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $area->delete();
        return back()->withSuccess('Berhasil dihapus');

    }

    public function massDestroy(MassDestroyAreaRequest $request)
    {
        Area::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
