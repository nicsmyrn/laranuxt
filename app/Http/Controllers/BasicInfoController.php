<?php

namespace App\Http\Controllers;

use App\Http\Requests\InfoRequest;
use App\Models\BasicInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class BasicInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInfo(): Response|JsonResponse
    {
        $user = Auth::user();

        $user->load('basic_info');

        return $this->render($user);
    }

    public function update(InfoRequest $request) : Response|JsonResponse
    {        
        $info = BasicInfo::where('user_id', Auth::id())->first();

        $info->update($request->all());

        return $this->render($info);
    }

    public function store(InfoRequest $request) : Response|JsonResponse
    {
        $user = Auth::user();

        $newInfo = new BasicInfo($request->all());

        $user->basic_info()->save($newInfo);

        return $this->render($request->all());
        
    }

}
