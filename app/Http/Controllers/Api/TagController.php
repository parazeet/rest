<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use function PHPUnit\Framework\isEmpty;

class TagController extends Controller
{
    public function index($id)
    {
        $tag = Tag::where('id', $id)->with('tasks')->get();
        if ($tag->isEmpty()) return response()->error('data not found', 404);

        return response()->success(TagResource::collection($tag));
    }
}
