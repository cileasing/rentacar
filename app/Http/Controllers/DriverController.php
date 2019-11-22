<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Driver;
use App\Trip;
use App\Vehicle;
use Auth;
class DriverController extends Controller
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
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $userId = auth()->user()->id;
        $driver = Driver::where('user_id', $userId)->first();
        if ($driver != null) {
            $response = [
            'success' => true,
            'message' => 'Driver details successfully found!!',
            'data' => $driver,
        ];
            return response()->json($response, 200);
        } else {
            return response()->json(
                [
                    'success'=> false,
                    'message' => 'Driver not found',
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
    public function ride_history()
    {
        $userId = auth()->user()->id;
        $history = Trip::where('driver_id', $userId)->get();
        if ($history != null) {
            $response = [
            'success' => true,
            'message' => 'Driver ride history successfully found!!',
            'data' => $history,
        ];
            return response()->json($response, 200);
        } else {
            return response()->json(
                [
                    'success'=> false,
                    'message' => 'Driver ride history not found',
                ],
                     500);
            }
    }

    public function myVehicle()
    {
        $driver_id = Auth::user()->id;
        $driver = Driver::find($driver_id);
        // dd($driver);
        $vehicle_details = Vehicle::where('vehicle_number', $driver->assigned_vehicle_no)->latest()->first();
        if ($vehicle_details != null) {
            $response = [
            'success' => true,
            'message' => "Driver's vehicle successfully found!!",
            'data' => $vehicle_details,
        ];
            return response()->json($response, 200);
        } else {
            return response()->json(
                [
                    'success'=> false,
                    'message' => 'Driver"s Vehicle not found',
                ],
                     500);
        }
    }

}