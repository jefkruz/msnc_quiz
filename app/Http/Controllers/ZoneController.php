<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class ZoneController
 * @package App\Http\Controllers
 */
class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zone::paginate();

        return view('zone.index', compact('zones'))
            ->with('i', (request()->input('page', 1) - 1) * $zones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['zone'] = new Zone();
        $data['regions'] = Region::all();
        $data['page_title'] = 'Zones';
        return view('zone.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Zone::$rules);

        $zone = Zone::create($request->all());

        return redirect()->route('zones.index')
            ->with('success', 'Zone created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $zone = Zone::find($id);

        return view('zone.show', compact('zone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['zone'] = Zone::find($id);
        $data['regions'] = Region::all();
        $data['page_title'] = 'Edit Zone';

        return view('zone.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Zone $zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zone $zone)
    {


        $zone->update($request->all());

        return redirect()->route('zones.index')
            ->with('success', 'Zone updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $zone = Zone::find($id)->delete();

        return redirect()->route('zones.index')
            ->with('success', 'Zone deleted successfully');
    }
}
