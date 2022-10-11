<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

/**
 * Class RegionController
 * @package App\Http\Controllers
 */
class RegionController extends Controller
{

    public function index()
    {
        $data['regions']= Region::all();
       $data['page_title'] = 'Regions';

        return view('region.index', $data);
    }


    public function create()
    {
        $region = new Region();
        return view('region.create', compact('region'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Region::$rules);

        $region = Region::create($request->all());

        return redirect()->route('regions.index')
            ->with('success', 'Region created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $region = Region::find($id);

        return view('region.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region = Region::find($id);

        return view('region.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Region $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {


        $region->update($request->all());

        return redirect()->route('regions.index')
            ->with('success', 'Region updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $region = Region::find($id)->delete();

        return redirect()->route('regions.index')
            ->with('success', 'Region deleted successfully');
    }
}
