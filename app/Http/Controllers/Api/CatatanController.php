<?php

namespace App\Http\Controllers\Api;

use App\Models\Catatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CatatanController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get data from table posts
        $catatans = Catatan::latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Catatan',
            'data'    => $catatans  
        ], 200);

    }
    
     /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find post by ID
        $catatan = Catatan::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Catatan',
            'data'    => $catatan 
        ], 200);

    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'location' => 'required',
            'bodytemp' => 'required',
            'date'     => 'required',
            'time'     => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $catatan = Catatan::create([
            'location'   => $request->location,
            'bodytemp'   => $request->bodytemp,
            'date'       => $request->date,
            'time'       => $request->time
        ]);

        //success save to database
        if($catatan) {

            return response()->json([
                'success' => true,
                'message' => 'Catatan Created',
                'data'    => $catatan  
            ], 201);

        } 

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Catatan Failed to Save',
        ], 409);

    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $catatan
     * @return void
     */
    public function update(Request $request, Catatan $catatan)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'location'   => 'required',
            'bodytemp' => 'required',
            'date'   => 'required',
            'time' => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find post by ID
        $catatan = Catatan::findOrFail($catatan->id);

        if($catatan) {

            //update catatan
            $catatan->update([
            'location'   => $request->location,
            'bodytemp'   => $request->bodytemp,
            'date'       => $request->date,
            'time'       => $request->time
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Catatan Updated',
                'data'    => $catatan  
            ], 200);

        }

        //data catatan not found
        return response()->json([
            'success' => false,
            'message' => 'Catatan Not Found',
        ], 404);

    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find post by ID
        $catatan = Catatan::findOrfail($id);

        if($catatan) {

            //delete catatan
            $catatan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Catatan Deleted',
            ], 200);

        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'Catatan Not Found',
        ], 404);
    }
}
