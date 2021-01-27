<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\Slot;
use App\Models\User;
use App\Http\Requests\SaveSlotTime;

class SlotController extends Controller
{
    public function Store(SaveSlotTime $saveslottime)
    {
        if(Auth::user()->id)
        {
            $user = User::find(Auth::user()->id);
            $user->slot_time = $saveslottime->slot_available;
            $user->save();

            $slot = Slot::where('user_id',Auth::user()->id);

            $slot->delete();

            $array['available_from'] =strtotime( $saveslottime->available_from );
            $array['available_to'] = strtotime ($saveslottime->available_to);
            $array['slot_available'] = $saveslottime->slot_available;
            $i =0;  
            while (($array['available_from']) <= ($array['available_to'])) //Run loop
            {
                $i++;
                $ReturnArray[$i]['user_id'] = Auth::user()->id;
                $ReturnArray[$i]['start_time'] = date ("G:i",( $array['available_from']));

                $array['available_from'] += $array['slot_available'] * 60 * 60; //Endtime check
            }

            // dd($ReturnArray);
            
            Slot::insert($ReturnArray);
        
            return redirect('dashboard')->with(['status' => 'success', 'message' => 'Slot save successfully']);

        }else{
            redirect('logout');
        }
    }

    public function getslot(Request $request)
    {
        if(Auth::user()->id)
        {
            $slot = Slot::where('user_id',$request->doctor_id)->get()->toArray();
            return response()->json($slot);
        }else{
            redirect('logout');
        }

    }

    public function bookslot(Request $request)
    {
        if(Auth::user()->id)
        {
            $slot = Slot::find($request->id);
            $slot->is_available = 0;
            $slot->save();
            return response()->json($slot);
        }else{
            redirect('logout');
        }

    }
}
