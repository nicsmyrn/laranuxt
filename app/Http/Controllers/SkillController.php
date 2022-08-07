<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillsRequest;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Boolean;

class SkillController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response|JsonResponse
    {
        $user = Auth::user();

        $skills = $user->skills;

        return $this->render($skills); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkillsRequest $request): Response|JsonResponse
    {
        $newSkill = new Skill($request->all());

        $user = Auth::user();

        return $this->render($user->skills()->save($newSkill));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill): Response|JsonResponse
    {
        return $this->render($skill);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill): Response|JsonResponse
    {
        return $this->render($skill);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skill $skill): Response|JsonResponse
    {
        // TODO security Hole belongsToUser function

        $skill->update($request->all());

        return $this->render($skill);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill): Response|JsonResponse
    {
        $id = $skill->id;

        $skill->delete();

        return $this->render($id);
    }

    protected function belongsToUser($id) : Boolean
    {
        $user = Auth::user();

        $skill = $user->skills->firstWhere('id', $id);

        return $skill->isNotEmpty();
    }
}
