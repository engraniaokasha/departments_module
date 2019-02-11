<?php

namespace Modules\Departments\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Departments\Entities\Departments;

use Modules\Departments\Http\Requests\CreateDepartmentsRequest;
use Modules\Departments\Http\Requests\UpdateDepartmentsRequest;
use Modules\Departments\Repositories\DepartmentsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class DepartmentsController extends AdminBaseController
{
    /**
     * @var DepartmentsRepository
     */
    private $departments;

    public function __construct(DepartmentsRepository $departments)
    {
        parent::__construct();

        $this->departments = $departments;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
     // $departments = $this->departments->all();
      $departments= Departments::get()->toTree();
      // $departments=(string)$departments;

        return view('departments::admin.departments.index', compact('departments'));
      
          
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('departments::admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateDepartmentsRequest $request
     * @return Response
     */
    public function store(CreateDepartmentsRequest $request)
    {
        $this->departments->create($request->all());

        return redirect()->route('admin.departments.departments.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('departments::departments.title.departments')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Departments $departments
     * @return Response
     */
    public function edit(Departments $departments)
    {
        return view('departments::admin.departments.edit', compact('departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Departments $departments
     * @param  UpdateDepartmentsRequest $request
     * @return Response
     */
    public function update(Departments $departments, UpdateDepartmentsRequest $request)
    {
        $this->departments->update($departments, $request->all());

        return redirect()->route('admin.departments.departments.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('departments::departments.title.departments')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Departments $departments
     * @return Response
     */
    public function destroy(Departments $departments)
    {
        $this->departments->destroy($departments);

        return redirect()->route('admin.departments.departments.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('departments::departments.title.departments')]));
    }
}
