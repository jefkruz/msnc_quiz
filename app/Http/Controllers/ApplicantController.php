<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;

/**
 * Class ApplicantController
 * @package App\Http\Controllers
 */
class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applicants = Applicant::paginate();

        return view('applicant.index', compact('applicants'))
            ->with('i', (request()->input('page', 1) - 1) * $applicants->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $applicant = new Applicant();
        return view('applicant.create', compact('applicant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Applicant::$rules);

        $applicant = Applicant::create($request->all());

        return redirect()->route('applicants.index')
            ->with('success', 'Applicant created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $applicant = Applicant::find($id);

        return view('applicant.show', compact('applicant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $applicant = Applicant::find($id);

        return view('applicant.edit', compact('applicant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Applicant $applicant)
    {
        request()->validate(Applicant::$rules);

        $applicant->update($request->all());

        return redirect()->route('applicants.index')
            ->with('success', 'Applicant updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $applicant = Applicant::find($id)->delete();

        return redirect()->route('applicants.index')
            ->with('success', 'Applicant deleted successfully');
    }
}
