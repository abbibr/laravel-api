<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Resources\AuthorsResource;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AuthorsResource::collection(Author::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAuthorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create([
            'name' => $request->name
        ]);

        return new AuthorsResource($author);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        # Eloquent
        $data = Author::findOrFail($id);
        /* return response()->json([
            'data' => [
                'id' => (string)$data->id,
                'type' => 'Authors',
                'attributes' => [
                    'name' => $data->name,
                    'created_at' => $data->created_at,
                    'updated_at' => $data->updated_at,
                ],
            ]
        ]); */

        return new AuthorsResource($data);

        # Model Binding
        // return $author;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAuthorRequest  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuthorRequest $request, $id)
    {
        $data = Author::findOrFail($id);

        $data->update([
            'name' => $request->name
        ]);

        return new AuthorsResource($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Author::findOrFail($id);
        $data->delete();

        return response(null, 204);
    }
}
