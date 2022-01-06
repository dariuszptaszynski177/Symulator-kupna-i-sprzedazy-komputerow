<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource;
use App\Models\Simulation;
use App\Models\Company;

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
}
