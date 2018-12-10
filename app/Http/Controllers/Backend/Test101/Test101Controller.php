<?php

namespace App\Http\Controllers\Backend\Test101;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Backend\Test101\CreateTest101;
use App\Http\Requests\Backend\Test101\UpdateTest101;
use App\Repositories\Backend\Test101Repository;
use App\Events\Backend\Test101\Test101Created;
use App\Events\Backend\Test101\Test101Updated;
use App\Events\Backend\Test101\Test101Deleted;
use Prettus\Repository\Criteria\RequestCriteria;
//use XLabTechs\AdminListing\Facades\AdminListing;
use App\Models\Test101;

class Test101Controller extends Controller
{
    /** @var test101Repository */
    private $test101Repository;

    public function __construct(Test101Repository $test101Repo)
    {
        $this->test101Repository = $test101Repo;
    }

    /**
     * Display a listing of the Test101.
     *
     * @param  Request $request
     * @return Response | \Illuminate\View\View|Response
     */

    public function index(Request $request)
    {
        $this->test101Repository->pushCriteria(new RequestCriteria($request));
        $data = $this->test101Repository->paginate(25);

        return view('backend.test101s.index')->with('test101s', $data);
    }

    /**
     * Show the form for creating a new Test101.
     *
     * @return Response | \Illuminate\View\View|Response
     */
    public function create()
    {
        return view('backend.test101s.create');
    }

    /**
     * Store a newly created Test101 in storage.
     *
     * @param CreateTest101Request $request
     *
     * @return Response | \Illuminate\View\View|Response
     */
    public function store(CreateTest101 $request)
    {
        $obj = $this->test101Repository->create(
            $request->only(["name", "status"])
        );

        event(new Test101Created($obj));
        return redirect()
            ->route('admin.test101.index')
            ->withFlashSuccess(__('alerts.frontend.test101.saved'));
    }

    /**
     * Display the specified Test101.
     *
     * @param Test101 $test101
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     *
     */
    public function show(Test101 $test101)
    {
        return view('backend.test101s.show')->with('test101', $test101);
    }

    /**
     * Show the form for editing the specified Test101.
     *
     * @param Test101 $test101
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     *
     */
    public function edit(Test101 $test101)
    {
        return view('backend.test101s.edit')->with('test101', $test101);
    }

    /**
     * Update the specified Test101 in storage.
     *
     * @param UpdateTest101Request $request
     *
     * @param Test101 $test101
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     */
    public function update(UpdateTest101 $request, Test101 $test101)
    {
        $obj = $this->test101Repository->update($test101, $request->all());

        event(new Test101Updated($obj));
        return redirect()
            ->route('admin.test101.index')
            ->withFlashSuccess(__('alerts.frontend.test101.updated'));
    }

    /**
     * Remove the specified Test101 from storage.
     *
     * @param Test101 $test101
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     *
     */
    public function destroy(Test101 $test101)
    {
        $obj = $this->test101Repository->delete($test101);
        event(new Test101Deleted($obj));
        return redirect()
            ->back()
            ->withFlashSuccess(__('alerts.frontend.test101.deleted'));
    }
}
