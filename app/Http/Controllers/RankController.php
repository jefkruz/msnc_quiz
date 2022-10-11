<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class RankController
 * @package App\Http\Controllers
 */
class RankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['ranks'] = Rank::all();
        $data['page_title'] = 'Ranks';

        return view('rank.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['rank'] = new Rank();
        $data['page_title'] = 'Add Rank';

        return view('rank.create', $data);
    }


    public function store(Request $request)
    {
        request()->validate(Rank::$rules);

        $rank = Rank::create($request->all());

        return redirect()->route('ranks.index')
            ->with('success', 'Rank created successfully.');
    }


    public function show($id)
    {
        $data['rank'] = Rank::find($id);
        $data['page_title'] = 'View Rank';


        return view('rank.show', $data);
    }


    public function edit($id)
    {
        $data['rank'] = Rank::find($id);
        $data['page_title'] = 'View Rank';


        return view('rank.edit', $data);
    }


    public function update(Request $request, Rank $rank)
    {


        $rank->update($request->all());

        return redirect()->route('ranks.index')
            ->with('success', 'Rank updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rank = Rank::find($id)->delete();

        return redirect()->route('ranks.index')
            ->with('success', 'Rank deleted successfully');
    }
}
