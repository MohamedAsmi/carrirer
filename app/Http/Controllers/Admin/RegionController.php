<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Helper\Service\RegionService;
use App\Http\Requests\Admin\Region\CreateRegionRequest;
use App\Http\Requests\Admin\Region\UpdateRegionRequest;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends BaseController
{
    protected $regionService;

    public function __construct(RegionService $regionService)
    {
        $this->regionService = $regionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.region.index');
    }

    /**
     * Get data to show
     *
     * @return \Illuminate\Http\Response
     */

    public function list()
    {
        $RegionListDatatable = $this->regionService->RegionListDatatable();
        return $RegionListDatatable;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.region.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRegionRequest $request)
    {
        $validatedData = $request->validated();
        Region::create($validatedData);
        return self::response('success', 'Successfully Region Created!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Region $region)
    {
        return view('admin.region.edit', compact('region'));
    }

    public function update(UpdateRegionRequest $request, $id)
    {
        $validatedData = $request->validated();
        $region = Region::findOrFail($id);
        $region->update($validatedData);
        return self::response('success', 'Successfully User Updated!');
    }

    public function destroy(Region $region)
    {
        try {
            $region->delete();
            return $this->_response('success', 'Region deleted successfully', [], 200);
        } catch (\Exception $e) {
            return $this->_response('error', $e->getMessage(), [], 422);
        }
    }
}
