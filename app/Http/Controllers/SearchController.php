<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;

class SearchController extends Controller
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function index(Request $request)
    {
        // dd($request->toArray());
        $keyword = $request->input('q');
        $results = $this->searchService->search($keyword);

        return view('pages.search', $results);
    }
}