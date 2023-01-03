<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChirpRequest;
use App\Models\Chirp;
use App\Notifications\NewChirp;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Chirps/Index', [
            'chirps' => Chirp::with('user:id,name')->latest()->get(),
        ]);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Inertia\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255'
        ]);

        $request->user()->chirps()->create($validated);

        return redirect(route('chirps.index'));
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Chirp  $chirp
    //  * @return \Inertia\Response
    //  */
    // public function show(Chirp $chirp)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Chirp  $chirp
    //  * @return \Inertia\Response
    //  */
    // public function edit(Chirp $chirp)
    // {
        
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ChirpRequest  $request
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Routing\Redirector
     */
    public function update(ChirpRequest $request, Chirp $chirp)
    {
        $this->authorize('update', $chirp);

        $validated = $request->validated();

        $chirp->update($validated);

        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);

        $chirp->delete();

        return redirect(route('chirps.index'));
    }
}
