<?php

namespace App\Http\Controllers\Api;

use App\Exports\RandomizerExport;
use App\Models\Post;
use Illuminate\Http\Request;
use App\traits\RandomizerTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\NamePickerRequest;
use App\Http\Requests\SaveRandomizerRequest;

class RandomizerController extends Controller
{
    use RandomizerTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(SaveRandomizerRequest $request)
    {
        $validatedData = $request->validated();
        $user_id = auth('api')->user()->id;
        $validatedData['user_id'] = $user_id;

        Post::create($validatedData);
        return response()->json(["message" => "Save successfully"]);
    }

    public function handleRandom(NamePickerRequest $request)
    {
        $validated = $request->validated();
        $result = $this->getRandomizer($validated);
        return response()->json(['result' => $result]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = auth('api')->user()->id;

        $posts = Post::where('user_id', $user)->orderBy('id')->get();
        return response()->json($posts);
    }

    public function delete(Request $request)
    {

        $post = Post::find($request['id']);

        if (empty($post)) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Post not found.'
            ]);
        }

        $post->delete();

        return response()->json([
            'status' => 'OK',
            'message' => 'Post deleted.'
        ]);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        $user_id = auth('api')->user()->id;
        return (new RandomizerExport($user_id,))->download('ramdomizer.xlsx');
    }
}
