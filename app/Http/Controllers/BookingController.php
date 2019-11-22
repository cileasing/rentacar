<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Booking;
use DB;

class BookingController extends Controller
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
    public function store(Request $request)
    {
        
        DB::beginTransaction();
        try {
            
            $booking = Booking::create($request->all());
            DB::commit();
            $response = [
                'success' => true,
                'message' => 'Booking successfully created!!',
                'data' => $booking,
            ];
            return response()->json($response, 200);
            
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(
                [
                    'success'=> false,
                    'error' => $ex->getMessage(),
                    'message' => 'Booking not created',
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
    
            $booking = Booking::where('id', $id)->first();
            if ($booking !== null) {

            
            $response = [
                'success' => true,
                'message' => 'Booking successfully found!!',
                'data' => $booking,
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
        
            $booking = Booking::find($id);
            if($booking) {
            $updatedBooking = $booking->update($request->all());
            $getUpdatedBooking = Booking::find($id);
            $response = [
                'success' => true,
                'message' => 'Booking successfully updated!!',
                'data' => $getUpdatedBooking,
            ];
            return response()->json($response, 200);
        } else {
            return response()->json(
                [
                    'success'=> false,
                    'message' => 'Booking not updated',
                ],
                 500);
    
    
        
            
            
            
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Booking::find($id);
            if($booking) {
                $booking->delete();
                $response = [
                    'success' => true,
                    'message' => 'Booking successfully deleted!!',
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
}
