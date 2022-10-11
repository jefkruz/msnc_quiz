<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use App\Models\Rank;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * Class QuestionController
 * @package App\Http\Controllers
 */
class QuestionController extends Controller
{

    protected $data;
    public function __construct()
    {
        $this->data['roles'] = Role::all();
        $this->data['ranks'] = Rank::all();
        $this->data['categories'] = Category::all();

        $this->middleware('role:admin');
    }
    public function index()
    {
        $data = $this->data;
        $data['page_title'] = 'Questions';
        $data['questions'] = Question::all();
        return view('question.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->data;
        $data['page_title'] = 'Questions';
        $data['question'] =  new Question();

        return view('question.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Question::$rules);

        $question = Question::create($request->all());

        return redirect()->route('questions.index')
            ->with('success', 'Question created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->data;
        $data['question'] = Question::find($id);
        $data['page_title'] = 'View Question';

        return view('question.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->data;
        $data['question'] = Question::find($id);
        $data['page_title'] = 'Edit Question';


        return view('question.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {


        $question->update($request->all());

        return redirect()->route('questions.index')
            ->with('success', 'Question updated successfully');
    }

    public function questions_template()
    {

        return response()->download(storage_path('app/public/templates/questions_template.xlsx'), 'Question Template.xlsx');
    }

    public function questions_import(Request $request)
    {
        $request->validate([
            'file' => 'file|required'
        ]);

        // Check if file uploaded was a spreadsheet
        $allowedExtensions = ['xls', 'xlsx'];
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();

        if(!in_array($ext, $allowedExtensions)){
            return back()->with('error', 'Incorrect file type');
        }


        $object = IOFactory::load($file->path());
        $worksheet = $object->getSheet(0);

        // Check if the spreadsheet is our template
        $validatedFile = $this->validateQuestion($worksheet);
        if(!$validatedFile){
            return back()->with('error', 'Please use the official template');
        }

        // Get the final row where the admin filled the first timers record
        $highestRow = $worksheet->getHighestRow();

        // Start collecting data from row 2
        // Row 1 is the template heading, don't forget
        for($row = 2; $row <= $highestRow; $row++){

            //VALIDATE CATEGORY
            $cat = trim($worksheet->getCellByColumnAndRow(1, $row));
            $category = Category::where('id',$cat)->firstOrFail();


            //VALIDATE RANK
            $ran = trim($worksheet->getCellByColumnAndRow(1, $row));
            $rank = Rank::where('id',$ran)->firstOrFail();

            $question = new Question();
            $question->category_id = $category->id;
            $question->rank_id = $rank->id;
            $question->question = trim($worksheet->getCellByColumnAndRow(3, $row));
            $question->optiona = trim($worksheet->getCellByColumnAndRow(4, $row));
            $question->optionb = trim($worksheet->getCellByColumnAndRow(5, $row));
            $question->optionc = trim($worksheet->getCellByColumnAndRow(6, $row));
            $question->optiond = trim($worksheet->getCellByColumnAndRow(7, $row));
            $question->answer = trim($worksheet->getCellByColumnAndRow(8, $row));
            $question->note = trim($worksheet->getCellByColumnAndRow(9, $row));
            $question->save();

            return $question;

        }

        return back()->with('success','Questions Imported Successfully');

    }


    private function validateQuestion($worksheet)
    {
        $isValidTemplate = true;
        $row = 1;
        $fields = [
            'CATEGORY_ID','RANK_ID','QUESTION','OPTION A','OPTION B', 'OPTION C', 'OPTION D', 'ANSWER', 'NOTE'
        ];

        foreach($fields as $i => $field){
            $x = trim($worksheet->getCellByColumnAndRow($i + 1, $row));
            if($field != $x){
                $isValidTemplate = false;
                break;
            }
        }

        return $isValidTemplate;

    }

    public function destroy($id)
    {
        $question = Question::find($id)->delete();

        return redirect()->route('questions.index')
            ->with('success', 'Question deleted successfully');
    }
}
