<?php

namespace App\Http\Controllers;

use App\Models\Link as Link;
use App\Models\Access as Access;
use App\Http\Resources\LinkResource as LinkResource;
use App\Http\Requests\LinkRequest as LinkRequest;
use App\Http\Requests\ImportLinkRequest as ImportLinkRequest;
use Illuminate\Http\Request;
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
     * Export a list of links in CSV format.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportLinks()
    {

        $fileName = "link_list.csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Expires"             => "0"
        ];

        $csv_columns = ['Link', 'Slug', 'Total Access', 'Creation'];

        $csv_output = function() use($csv_columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $csv_columns);

            Link::chunk(100, function($links) use(&$file){
                foreach ($links as $link) {
                    $row = [
                        $link->url,
                        $link->slug,
                        $link->total_access,
                        $link->created_at,
                    ];
    
                    fputcsv($file, $row);
                }
            });

            fclose($file);
        };

        return response()->stream($csv_output, 200, $headers);

    }


    /**
     * Store a newly created link in DB.
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
        $link->total_access = 0;

        if (is_null($link->slug) || empty($link->slug)) {
            $link->slug = Str::random(mt_rand(6, 8));
        }

        $check_slug = Link::GetBySlug($link->slug);

        if ($check_slug->exists()) {
            abort(500);
        }

        if ($link->save()) {
            return new LinkResource($link);
        }

        abort(500);
    }

    /**
     * Import links from a CSv file.
     *
     * @param  \Illuminate\Http\ImportLinkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function importLinks(ImportLinkRequest $request)
    {
        $csv = $request->file('csv');

        $handle = fopen($csv, "r");
        $csv_header = true;

        while ($csv_line = fgetcsv($handle, 1000, ",")) {

            if ($csv_header || empty($csv_line[0])) {
                $csv_header = false;
            } else {

                $link = new Link;
                $link->url = $csv_line[0];
                $link->slug = $csv_line[1] ?? $csv_line[1] ?? null;
                $link->total_access = 0;

                if (is_null($link->slug) || empty($link->slug)) {
                    $link->slug = Str::random(mt_rand(6, 8));
                }

                $check_slug = Link::GetBySlug($link->slug);

                if (!$check_slug->exists()) {
                    $link->save();
                }

            }
        }

        abort(500);
    }

    /**
     * Display the specified link in DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $link = Link::GetBySlug($slug);

        if (!$link->exists()) {
            // validate error
        }

        $link->first();

        $link->increment('total_access');

        $access = new Access;
        $access->link_id = $link["id"];
        $access->ip = $request->ip();
        $access->user_agent = $request->header('User-Agent');
        $access->save();

        return new LinkResource($link);
    }

    /**
     * Update the specified link in DB.
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

        $slug = $validated["slug"] ?? $validated["slug"] ?? null;

        if (!is_null($slug) && !empty($slug)) {
            $link->slug = $slug;
        }

        if ($link->save()) {
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

        if ($link->delete()) {
            return response()->json([
                'success' => true
            ], 200);
        }

        abort(500);
    }
}
