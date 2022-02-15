<?php

namespace App\Http\Controllers;

use App\Models\Link as Link;
use App\Models\Access as Access;
use App\Http\Resources\LinkResource as LinkResource;
use App\Http\Requests\LinkRequest as LinkRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    /**
     * Display a listing of the links with pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::paginate(100);
        return LinkResource::collection($links);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\LinkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkRequest $request)
    {

        $validated = $request->validated(); 

        $link = new Link;
        $link->url = $validated["url"];
        $link->slug = $validated["slug"] ?? $validated["slug"] ?? null;

        if (is_null($link->slug) || empty($link->slug)) {

            $link->slug = Str::random(mt_rand(6,8));

        }

        if($link->save()){
            return new LinkResource($link);
        }

        abort(500);
    }

    /**
     * Display the specified link.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $link = Link::GetBySlug($slug);
        return new LinkResource($link);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\LinkRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LinkRequest $request, $id)
    {
        $link = Link::findOrFail($id);

        $validated = $request->validated();

        $link->url = $validated["url"];

        if (!is_null($validated["slug"]) && !empty($validated["slug"])) {

            $link->slug = $validated["slug"];

        }

        if($link->save()){
            return new LinkResource($link);
        }

        abort(500);
    }

    /**
     * Remove the specified link from DB.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = Link::findOrFail($id);
        if(!$link->delete()){
            abort(500);
        }
    }
}
