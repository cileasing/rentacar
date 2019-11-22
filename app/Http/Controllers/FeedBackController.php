<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeedBack;
use DB;
use Auth;

class FeedBackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $driver_id)
    {
        //
        DB::beginTransaction();
        try {
            
            $user_id = Auth::user()->id;
            // dd($user_id);
            
            $feedback = new Feedback;

                $feedback->review = $request->review;
                $feedback->user_id = $user_id;
                $feedback->driver_id = $driver_id;

                $feedback->save();
            
            DB::commit();
            $response = [
                'success' => true,
                'message' => 'Review successfully created!!',
                'data' => $feedback,
            ];
            return response()->json($response, 200);
            
        } catch (\Exception $ex) {
            DB::rollback();
            $feedback = FeedBack::find(1);
            return response()->json(
                [
                    'success'=> false,
                    'error' => $ex->getMessage(),
                    'message' => 'Feedback not created',
                ],
                 500);
            
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $feedback= DirectBooking::where('id', $id)->first();
        if ($direct_booking !== null) {
        
        $response = [
            'success' => true,
            'message' => 'Booking successfully found!!',
            'data' => $direct_booking,
        ];
        return response()->json($response, 200);
    } else {
        return response()->json(
            [
                'success'=> false,
                'message' => 'Booking not found',
            ],
                 500);
        }
        
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
