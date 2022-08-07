<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterestRequest;
use App\Models\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response|JsonResponse
    {
        $user = Auth::user();

        $interests = $user->interests;

        return $this->render($interests);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InterestRequest $request) : Response|JsonResponse
    {
        $tailWindColor = $this->findUniqueTailWindColor();

        $newInterest = new Interest($request->all() + ['color' => $tailWindColor]);

        $user = Auth::user();

        return $this->render($user->interests()->save($newInterest));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interest $interest): Response|JsonResponse
    {
        $id = $interest->id;

        $interest->delete();

        return $this->render($id);
    }

    public function findUniqueTailWindColor() : string
    {
        $color = Arr::random(config('tailwind.colors'));

        $deapth = Arr::random(config('tailwind.deapth'));

        $tailwindColor = "bg-$color-$deapth";

        $exists = Interest::where('color', $tailwindColor)->first();

        if($exists != null)
            return $this->findUniqueTailWindColor();

        return $tailwindColor;
    }
}
