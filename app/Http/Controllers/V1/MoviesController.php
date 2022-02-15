<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Service\V1\Movies\MoviesRegistration;
use App\Service\V1\Movies\MoviesShow;
use App\Service\V1\Movies\MoviesUpdate;
use App\Filters\V1\Movies\MoviesFilters;
use App\Service\V1\Movies\MoviesDelete;
use App\Http\Controllers\Controller;




class MoviesController extends Controller
{
    protected $movieRegistration;
    protected $movieShow;
    protected $movieFilters;
    protected $movieUpdate;
    protected $movieDelete;

    public function __construct(

        MoviesRegistration $movieRegistration,
        MoviesShow $movieShow,
        MoviesFilters $movieFilters,
        MoviesUpdate $movieUpdate,
        MoviesDelete $movieDelete

    ) {
        $this->movieRegistration = $movieRegistration;
        $this->movieShow = $movieShow;
        $this->movieFilters = $movieFilters;
        $this->movieUpdate = $movieUpdate;
        $this->movieDelete = $movieDelete;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $movieFilters = $this->movieFilters->apply($request->all());
        return response()->json(['data' => $movieFilters]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movieRegistration = $this->movieRegistration->store($request);

        return response()->json(['data' => $movieRegistration]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movieShow = $this->movieShow->show($id);

        return response()->json(['data' => $movieShow]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        $movieUpdate = $this->movieUpdate->update($id, $request);
        return response()->json(['data' => $movieUpdate]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movieDelete = $this->movieDelete->delete($id);
        return response()->json(['data' => $movieDelete]);
    }

}
