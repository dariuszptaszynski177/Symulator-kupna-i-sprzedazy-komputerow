<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\Computer;
use App\Models\Condition;
use App\Models\SimulationCondition;
use App\Models\Simulation;
use App\Models\Company;
use App\Models\SimulationLog;
use App\Models\Resource;

class AdminPanelController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function users()
    {
        $admin = auth()->user()->id;
        $users = User::where('id', '!=', $admin)->get();
        return view('admin.users', ['users'=>$users]);
        
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $value = $request->value;

        if($value==0)
        {
            $status=1;
        }
        else
        {
            $status=0;
        }

        $update = User::where('id', '=', $id)->update(['active'=>$status]);

        $admin = auth()->user()->id;

        $users = User::where('id', '!=', $admin)->get();
        $content = view('admin.users_list', compact('users'))->render();
        return response()->json(['users'=>$content]);
    }

    public function computers()
    {
        $computers = Computer::get();

        return view('admin.computers.index', ['computers'=>$computers]);
    }

    public function computer_create()
    {
        return view('admin.computers.create');
    }

    public function computer_save(Request $request)
    {
        $name = $request->name;
        $price = $request->price;

        $computer = new Computer;
        $computer->name = $name;
        $computer->price = $price;

        $save = $computer->save();

        if($save)
        {
            return redirect()->route('computers');
        }
    }

    public function computer_edit($id)
    {
        $computer = Computer::where('id', '=', $id)->first();

        return view('admin.computers.edit', ['computer'=>$computer]);
    }

    public function computer_update(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $price = $request->price;

        $update = Computer::where('id', '=', $id)->update(['name'=>$name, 'price'=>$price]);

        if($update)
        {
            return redirect()->route('computers');
        }
    }

    public function conditions()
    {
        $conditions = Condition::get();
        $conditions_simulation = SimulationCondition::first();

        return view('admin.conditions.index', ['conditions'=>$conditions, 'conditions_simulation'=>$conditions_simulation]);
    }

    public function conditions_create()
    {
        return view('admin.conditions.create');
    }

    public function conditions_save(Request $request)
    {
        $inflation = $request->inflation;
        $euro = $request->euro;
        $dolar = $request->dolar;
        $funt = $request->funt;
        $situation = $request->situation;

        $conditions = new Condition;
        $conditions->inflation = $inflation;
        $conditions->euro_currency = $euro;
        $conditions->dolar_currency = $dolar;
        $conditions->funt_british_currency = $funt;
        $conditions->situation = $situation;
        
        $conditions->save();

        return redirect()->route('conditions');
    }

    public function conditions_simulation_edit($id)
    {
        $conditions_simulation = SimulationCondition::find($id);
        return view('admin.conditions.edit_conditions_simulation', ['conditions_simulation'=>$conditions_simulation]);
    }

    public function conditions_simulation_update(Request $request)
    {
        $id = $request->id;
        $inflation = $request->inflation;
        $euro = $request->euro;
        $dolar = $request->dolar;
        $funt = $request->funt;
        $situation = $request->situation; 

        $update = SimulationCondition::where('id', '=', $id)->update(['inflation'=>$inflation, 'euro_currency'=>$euro, 'dolar_currency'=>$dolar, 'funt_british_currency'=>$funt]);

        return redirect()->route('conditions');
    }

    public function simulations()
    {
        $conditions = SimulationCondition::first();
        // dd($conditions);
        if($conditions->inflation<4)
        {
            $cash = 6000;
        }
        elseif($conditions->inflation>5 && $conditions->inflation<7)
        {
            $cash = 5000;
        }
        elseif($conditions->inflation>7)
        {
            $cash = 4000;
        }

        if($conditions->situation=="dobra")
        {
            $quantity = 8;
        }
        elseif($conditions->situation=="umiarkowana")
        {
            $quantity = 6;
        }
        else
        {
            $quantity = 4;
        }

        $offers = Simulation::where([['price', '<', $cash], ['quantity', '<=', $quantity], ['done', '=', 0]])->get();
        $other_offers = Simulation::where([['price', '>', $cash], ['done', '=', 0]])->orWhere([['quantity', '>', $quantity], ['done', '=', 0]])->get();

        return view('admin.simulations.index', ['offers'=>$offers, 'other_offers'=>$other_offers]);
    }

    public function simulation_accept_offer(Request $request)
    {
        $offer_id = $request->offer_id;
        $user_id = $request->user_id;
        $computer_id = $request->computer_id;
        $quantity = $request->quantity;
        $price = $request->price;

        $cash = $quantity*$price;

        $user_cash = Company::where('user_id', '=', $user_id)->first()->cash;
        $temp_cash = $user_cash+$cash;
        $user_cash_update = Company::where('user_id', '=', $user_id)->update(['cash'=>$temp_cash]);

        $situation = Simulation::where('id', '=', $offer_id)->update(['done'=>1]);

        $simulation_log = new SimulationLog;
        $simulation_log->user_id = $user_id;
        $simulation_log->offer_id = $offer_id;
        $simulation_log->status = "kupione";
        $simulation_log->information = "Zapłacono ".$cash." zł";

        $simulation_log->save();


        $conditions = SimulationCondition::first();
        // dd($conditions);
        if($conditions->inflation<4)
        {
            $cash = 6000;
        }
        elseif($conditions->inflation>5 && $conditions->inflation<7)
        {
            $cash = 5000;
        }
        elseif($conditions->inflation>7)
        {
            $cash = 4000;
        }

        if($conditions->situation=="dobra")
        {
            $quantity = 8;
        }
        elseif($conditions->situation=="umiarkowana")
        {
            $quantity = 6;
        }
        else
        {
            $quantity = 4;
        }

        $offers = Simulation::where([['price', '<', $cash], ['quantity', '<=', $quantity], ['done', '=', 0]])->get();
        

        $content = view('admin.simulations.offers_list', compact('offers'))->render();
        return response()->json(['offers'=>$content]);
    }

    public function simulation_decline_offer(Request $request)
    {
        $offer_id = $request->offer_id;
        $user_id = $request->user_id;
        $computer_id = $request->computer_id;
        $quantity = $request->quantity;
        $price = $request->price;

        $user_resources = Resource::where([['user_id', '=', $user_id], ['computer_id', '=', $computer_id]])->first()->quantity;
        $temp_quantity = $user_resources+$quantity;
        $user_resources_update = Resource::where([['user_id', '=', $user_id], ['computer_id', '=', $computer_id]])->update(['quantity'=>$temp_quantity]);
    
        $situation = Simulation::where('id', '=', $offer_id)->update(['done'=>1]);

        $simulation_log = new SimulationLog;
        $simulation_log->user_id = $user_id;
        $simulation_log->offer_id = $offer_id;
        $simulation_log->status = "Odrzucone";
        $simulation_log->information = "Oferta odrzucona";

        $simulation_log->save();


        $conditions = SimulationCondition::first();
        // dd($conditions);
        if($conditions->inflation<4)
        {
            $cash = 6000;
        }
        elseif($conditions->inflation>5 && $conditions->inflation<7)
        {
            $cash = 5000;
        }
        elseif($conditions->inflation>7)
        {
            $cash = 4000;
        }

        if($conditions->situation=="dobra")
        {
            $quantity = 8;
        }
        elseif($conditions->situation=="umiarkowana")
        {
            $quantity = 6;
        }
        else
        {
            $quantity = 4;
        }

        $offers = Simulation::where([['price', '<', $cash], ['quantity', '<=', $quantity], ['done', '=', 0]])->get();

        $user_cash = Company::where('user_id', '=', $user_id)->first()->cash;
        $temp_cash = $user_cash-(500*$quantity);
        $user_cash_update = Company::where('user_id', '=', $user_id)->update(['cash'=>$temp_cash]);
        

        $content = view('admin.simulations.offers_list', compact('offers'))->render();
        return response()->json(['offers'=>$content]);


    }
}
