<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Service\V1\Tag\TagRegistration;
use App\Service\V1\Tag\TagShow;
use App\Service\V1\Tag\TagUpdate;
use App\Service\V1\Tag\TagDelete;
use App\Filters\V1\Tag\TagFilters;
use App\Http\Controllers\Controller;




class TagController extends Controller
{
    protected $tagRegistration;
    protected $tagShow;
    protected $tagFilters;
    protected $tagUpdate;
    protected $tagDelete;

    public function __construct(

        TagRegistration $tagRegistration,
        TagShow $tagShow,
        TagFilters $tagFilters,
        TagUpdate $tagUpdate,
        TagDelete $tagDelete

    ) {
        $this->tagRegistration = $tagRegistration;
        $this->tagShow = $tagShow;
        $this->tagFilters = $tagFilters;
        $this->tagUpdate = $tagUpdate;
        $this->tagDelete = $tagDelete;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tagFilters = $this->tagFilters->apply($request->all());
        return response()->json(['data' => $tagFilters]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tagRegistration = $this->tagRegistration->store($request);

        return response()->json(['data' => $tagRegistration]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tagShow = $this->tagShow->show($id);

        return response()->json(['data' => $tagShow]);
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
        $tagUpdate = $this->tagUpdate->update($id, $request);
        return response()->json(['data' => $tagUpdate]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $tagDelete = $this->tagDelete->delete($id);
        return response()->json(['data' => $tagDelete]);
    }
}
