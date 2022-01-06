<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource;
use App\Models\Simulation;
use App\Models\Company;
use App\Models\Computer;

class SimulationController extends Controller
{
    public function resorces()
    {
        $resources = Resource::where('user_id', '=', auth()->user()->id)->get();
        $cash = Company::where('user_id', '=', auth()->user()->id)->first()->cash;

        return view('user.resources', ['resources'=>$resources])->with('cash', $cash);
    }

    public function simulations()
    {
        $simulations = Simulation::where('user_id', '=', auth()->user()->id)->get();

        return view('user.simulations', ['simulations'=>$simulations]);
    }

    public function computers()
    {
        $computers = Computer::get();
        $cash = Company::where('user_id', '=', auth()->user()->id)->first()->cash;

        return view('user.computers', ['computers'=>$computers])->with('cash', $cash);;
    }

    public function computers_buy(Request $request)
    {
        $computers = $request->computer;
        $arr_length = count($computers);
        $price = [];
        $sum=0;

        

       
            for($i=0;$i<$arr_length;$i++)
            {
                $price_temp = Computer::where('id', '=', $i+1)->first()->price;
                array_push($price, $price_temp);
            }

            for($i=0;$i<$arr_length;$i++)
            {
                for($j=0;$j<$arr_length;$j++)
                {
                    if($i==$j)
                    {
                        $temp=$computers[$i]*$price[$j];
                        $sum+=$temp;
                    }
                }
            }

            $cash = Company::where('user_id', '=', auth()->user()->id)->first()->cash;
            $cash_temp = $cash-$sum;

            $update_cash = Company::where('user_id', '=', auth()->user()->id)->update(['cash'=>$cash_temp]);

            for($i=0;$i<$arr_length;$i++)
            {
                $check = Resource::where([['user_id', '=', auth()->user()->id], ['computer_id', '=', $i+1]])->get();
                $count_row = count($check);

                if($count_row==0)
                {
                $simulation = new Resource;
                $simulation->user_id = auth()->user()->id;
                $simulation->computer_id = $i+1;
                $simulation->quantity = $computers[$i];

                $simulation->save();
                }
                else
                {   $quantity = Resource::where([['user_id', '=', auth()->user()->id], ['computer_id', '=', $i+1]])->first()->quantity;
                    $quantity_update = $quantity+$computers[$i];
                    $update = Resource::where([['user_id', '=', auth()->user()->id], ['computer_id', '=', $i+1]])->update(['quantity'=>$quantity_update]);
                }
            }

            return redirect()->route('user-resources');
        
    }

    public function create_offer_simulation(Request $request)
    {
        $price = $request->price;
        $quantity = $request->quantity;
        $count = count($price);

        for($i=0;$i<$count;$i++)
        {
        $simulation = new Simulation;
        $simulation->user_id = auth()->user()->id;
        $simulation->computer_id = $i+1;
        $simulation->quantity = $quantity[$i];
        $simulation->price = $price[$i];
        $simulation->done = 0;

        $simulation->save();

        $quantity_user = Resource::where([['user_id', '=', auth()->user()->id], ['computer_id', '=', $i+1]])->first()->quantity;
        
        $temp_quantity=$quantity_user - $quantity[$i];
        $update_quantity = Resource::where([['user_id', '=', auth()->user()->id], ['computer_id', '=', $i+1]])->update(['quantity'=>$temp_quantity]);

        }

        return redirect()->route('user-simulations');

    }
}
