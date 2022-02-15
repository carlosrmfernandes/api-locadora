<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Service\V1\MovieTag\MovieTagRegistration;
use App\Service\V1\MovieTag\MovieTagShow;
use App\Service\V1\MovieTag\MovieTagUpdate;
use App\Filters\V1\MovieTag\MovieTagFilters;
use App\Http\Controllers\Controller;




class MovieTagController extends Controller
{
    protected $tagRegistration;
    protected $tagShow;
    protected $tagFilters;
    protected $tagUpdate;

    public function __construct(

        MovieTagRegistration $movieTagRegistration,
        MovieTagShow $movieTagShow,
        MovieTagFilters $movieTagFilters,
        MovieTagUpdate $movieTagUpdate

    ) {
        $this->movieTagRegistration = $movieTagRegistration;
        $this->movieTagShow = $movieTagShow;
        $this->movieTagFilters = $movieTagFilters;
        $this->movieTagUpdate = $movieTagUpdate;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $movieTagFilters = $this->movieTagFilters->apply($request->all());
        return response()->json(['data' => $movieTagFilters]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movieTagRegistration = $this->movieTagRegistration->store($request);

        return response()->json(['data' => $movieTagRegistration]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movieTagShow = $this->movieTagShow->show($id);

        return response()->json(['data' => $movieTagShow]);
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
        $movieTagUpdate = $this->movieTagUpdate->update($id, $request);
        return response()->json(['data' => $movieTagUpdate]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

}
