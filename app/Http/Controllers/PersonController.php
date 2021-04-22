<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = Person::query()->get()->sortByDesc('created_at');

        $data = [
            'people' => $people,
        ];
        return response()->view('dash.person-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('dash.person-add');
    }

    public function store(Request $request)
    {
        $validator = Validator::validate($request->all(), [
            'rfid' => 'required',
            'name' => 'required',
        ], ['required' => 'Data diperlukan']);

        Person::create([
            'rfid' => Str::upper($validator['rfid']),
            'name' => Str::upper($validator['name']),
        ]);

        return back()->with(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = Person::find($id);

        return view('dash.person-edit', ['person' => $person]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::validate($request->all(), [
            'rfid' => 'required',
            'name' => 'required',
        ], ['required' => 'Data diperlukan']);

        $person = Person::find($id);

        if ($person) {
            $person->rfid = Str::upper($validator['rfid']);
            $person->name = Str::upper($validator['name']);
            $person->save();
        }

        return response()->redirectToRoute('person.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Person::destroy($id);
        return back()->with(['success' => true]);
    }
}
