<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoryRequest;
use App\Models\WorkHistory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Boolean;

class WorkHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response|JsonResponse
    {
        $user = Auth::user();

        $works = $user->works;

        return $this->render($works);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HistoryRequest $request): Response|JsonResponse
    {
        $newWork = new WorkHistory($request->all());

        $user = Auth::user();

        return $this->render($user->works()->save($newWork));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(WorkHistory $work): Response|JsonResponse
    {
        return $this->render($work);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkHistory $work): Response|JsonResponse
    {
        return $this->render($work);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HistoryRequest $request, WorkHistory $work): Response|JsonResponse
    {
        $work->update($request->all());

        return $this->render($work);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkHistory $work): Response|JsonResponse
    {
        $id = $work->id;

        $work->delete();

        return $this->render($id);
    }

    protected function belongsToUser($id) : Boolean
    {
        $user = Auth::user();

        $work = $user->works->firstWhere('id', $id);

        return $work->isNotEmpty();
    }
}
