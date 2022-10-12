<?php

namespace App\Http\Controllers;

use App\Essay;
use Illuminate\Http\Request;

/**
 * Class EssayController
 * @package App\Http\Controllers
 */
class EssayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $essays = Essay::paginate();

        return view('essay.index', compact('essays'))
            ->with('i', (request()->input('page', 1) - 1) * $essays->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $essay = new Essay();
        return view('essay.create', compact('essay'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Essay::$rules);

        $essay = Essay::create($request->all());

        return redirect()->route('essays.index')
            ->with('success', 'Essay created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $essay = Essay::find($id);

        return view('essay.show', compact('essay'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $essay = Essay::find($id);

        return view('essay.edit', compact('essay'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Essay $essay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Essay $essay)
    {
        request()->validate(Essay::$rules);

        $essay->update($request->all());

        return redirect()->route('essays.index')
            ->with('success', 'Essay updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $essay = Essay::find($id)->delete();

        return redirect()->route('essays.index')
            ->with('success', 'Essay deleted successfully');
    }
}
