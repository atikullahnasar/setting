<?php

namespace atikullahnasar\setting\Http\Controllers;

use App\Http\Controllers\Controller;
use atikullahnasar\setting\Http\Requests\CustomPageRequest;
use atikullahnasar\setting\Services\CustomPages\CustomPageServiceInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomPageController extends Controller
{
    public function __construct(
        private readonly CustomPageServiceInterface $customPageService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $customPages = $this->customPageService->getAllWithRelations();
            return DataTables::of($customPages)
                ->addIndexColumn()
                ->addColumn('actions', function ($customPage) {
                    return ''; // Actions will be rendered by DataTables
                })
                ->editColumn('enabled', function ($customPage) {
                    return $customPage->enabled;
                })
                ->make(true);
        }
        return view('setting::system-settings.custom-pages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomPageRequest $request)
    {
        $this->customPageService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Custom Page created successfully!'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customPage = $this->customPageService->findById($id);
        return $customPage;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomPageRequest $request, string $id)
    {
        $this->customPageService->update($id, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Custom Page updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->customPageService->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Custom Page deleted successfully!'
        ]);
    }

    public function toggleStatus($id)
    {
        $this->customPageService->toggleStatus($id);
        return response()->json([
            'success' => true,
            'message' => 'Custom Page status updated successfully!'
        ]);
    }
}
