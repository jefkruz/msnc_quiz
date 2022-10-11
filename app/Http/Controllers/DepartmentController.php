<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * Class DepartmentController
 * @package App\Http\Controllers
 */
class DepartmentController extends Controller
{

    protected $data;

    public function index()
    {
       $data['departments'] = Department::all();
       $data['page_title'] = 'Departments';

        return view('department.index', $data);
    }

    public function departments_import(Request $request)
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
        $validatedFile = $this->validateDepartment($worksheet);
        if(!$validatedFile){
            return back()->with('error', 'Please use the official template');
        }

        // Get the final row where the admin filled the first timers record
        $highestRow = $worksheet->getHighestRow();

        // Start collecting data from row 2
        // Row 1 is the template heading, don't forget
        for($row = 2; $row <= $highestRow; $row++){

            $application = new Department();
            $application->name = trim($worksheet->getCellByColumnAndRow(1, $row));
            $application->save();

        }

        return back()->with('message','Departments Imported Successfully');

    }

    public function departments_template()
    {
        return response()->download(storage_path('app/public/templates/departments_template.xlsx'), 'Department Template.xlsx');
    }


    private function validateDepartment($worksheet)
    {
        $isValidTemplate = true;
        $row = 1;
        $fields = [
            'NAME'
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

    public function create()
    {
        $data['department'] = new Department();
        $data['page_title'] = 'Departments';
        return view('department.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Department::$rules);

        $department = Department::create($request->all());

        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data['department'] = Department::find($id);
        $data['page_title'] = 'View Departments';
        return view('department.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['department'] = Department::find($id);
        $data['page_title'] = 'Edit Department';

        return view('department.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Department $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {


        $department->update($request->all());

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $department = Department::find($id)->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully');
    }
}
