<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DirectBooking;
use App\Events\NotifyDriverBookingEvent;
use App\AcceptReject;
use DB;
use Auth;


class DirectBookingController extends Controller
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
        //
        DB::beginTransaction();
        try {
            
            $direct_booking = DirectBooking::create($request->all());
            DB::commit();
            $response = [
                'success' => true,
                'message' => 'Booking successfully created!!',
                'data' => $direct_booking,
            ];
            event(new \App\Events\NotifyDriverBookingEvent(auth()->user(), $direct_booking));
            return response()->json($response, 200);
            
        } catch (\Exception $ex) {
            DB::rollback();
            $booking = DirectBooking::find(1);
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
        //
        $direct_booking = DirectBooking::where('id', $id)->first();
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
        $direct_booking = DirectBooking::find($id);
        if($direct_booking) {
        $updatedBooking = $direct_booking->update($request->all());
        $getUpdatedBooking = DirectBooking::find($id);
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
        //
        $direct_booking = DirectBooking::find($id);
        if($direct_booking) {
            $direct_booking->delete();
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

public function acceptBooking(Request $request, $booking_id)
    {
        DB::beginTransaction();
        try {
            $userId = DirectBooking::find($booking_id);
            $accept = new AcceptReject;
            $accept->booking_id = $booking_id;
            $accept->user_id = $userId->user_id;
            $accept->driver_id = $request->driver_id;
            $accept->status = 1;
            $accept->save();
            
            DB::commit();
            $response = [
                'success' => true,
                'message' => 'Booking has an action!!',
                'data' => $accept,
            ];
            // event(new \App\Events\NotifyDriverBookingEvent(auth()->user(), $direct_booking));
            return response()->json($response, 200);
        } catch (\Exception $ex) {
            DB::rollback();
            // $booking = DirectBooking::find(1);
            return response()->json(
                [
                    'success'=> false,
                    'error' => $ex->getMessage(),
                    'message' => 'Booking not created',
                ],
                 500);
            
            
        }  
        
    }
    public function cancelBooking(Request $request, $booking_id)
    {
        DB::beginTransaction();
        try {
            $userId = DirectBooking::find($booking_id);
            $accept = AcceptReject::where('booking_id',$booking_id)->latest()->first();
            // dd($accept);
            $accept->booking_id = $booking_id;
            $accept->user_id = $userId->user_id;
            $accept->driver_id = $request->driver_id;
            $accept->status = 0;
            $accept->update();
            
            DB::commit();
            $response = [
                'success' => true,
                'message' => 'Booking has an updated action!!',
                'data' => $accept,
            ];
            // event(new \App\Events\NotifyDriverBookingEvent(auth()->user(), $direct_booking));
            return response()->json($response, 200);
        } catch (\Exception $ex) {
            DB::rollback();
            // $booking = DirectBooking::find(1);
            return response()->json(
                [
                    'success'=> false,
                    'error' => $ex->getMessage(),
                    'message' => 'Booking not canceled',
                ],
                 500);
            
            
        }  
    }
} 