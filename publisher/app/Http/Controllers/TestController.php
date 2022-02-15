<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Http\Requests\StoreTestRequest;
use App\Http\Resources\TestResource;
use App\Jobs\TestStore;
use App\Jobs\TestUpdate;

class TestController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return TestResource::collection(Test::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestRequest $request) {
        TestStore::dispatch($request->validated())->onQueue('default');
        return response()->json([
                    'status' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test) {
        return new TestResource($test);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTestRequest $request, Test $test) {
        TestUpdate::dispatch($request->validated(), $test)->onQueue('default');
        return response()->json([
                    'status' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test) {
        return response()->json([
                    'status' => $test->delete(),
        ]);
    }

}
