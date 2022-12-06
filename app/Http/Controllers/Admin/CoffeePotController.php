<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CoffeePotService;
use Illuminate\Http\Request;

class CoffeePotController extends Controller
{   
    public function __construct(protected CoffeePotService $service)
    {
        
    }

    public function show()
    {   
        return view("pages.admin.coffeePot.show", $this->service->getCoffeePots());
    }

    public function add(Request $request)
    {   
        $this->service->addCoffeePot($request);
        
        return redirect()->route('admin.coffeePot.show');
    }

    public function update(Request $request, $id)
    {   
        $this->service->updateCoffeePot($request, $id);

        return redirect()->route('admin.coffeePot.show');
    }

    public function delete($id)
    {   
        $this->service->deleteCoffeePot($id);

        return redirect()->route('admin.coffeePot.show');
    }
}
