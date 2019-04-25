<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Equipment;

class EquipmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $equipments = Equipment::where('key', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orderBy('id')->paginate($perPage);
        } else {
            $equipments = Equipment::orderBy('id')->paginate($perPage);
        }

        return view('admin.equipments.index', compact('equipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.equipments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|string|unique:equipments',
                'oem' => 'required'
            ]
        );

        $requestData = $request->all();

        $requestData['created_at'] = $requestData['updated_at'] = date('Y-m-d H:i:s');
        Equipment::create($requestData);

        return redirect('admin/equipments')->with('flash_message', 'Equipment added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $equipment = Equipment::findOrFail($id);

        return view('admin.equipments.show', compact('equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $equipment = Equipment::findOrFail($id);

        return view('admin.equipments.edit', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|string|unique:equipments,name,' . $id,
                'oem' => 'required'
            ]
        );
        $requestData = $request->all();

        $equipment = Equipment::findOrFail($id);
        $equipment->update($requestData);

        return redirect('admin/equipments')->with('flash_message', 'Equipment updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Equipment::destroy($id);

        return redirect('admin/equipments')->with('flash_message', 'Equipment deleted!');
    }
}
