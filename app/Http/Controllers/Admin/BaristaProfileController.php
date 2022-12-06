<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BaristaService;
use Illuminate\Http\Request;

class BaristaProfileController extends Controller
{   
    public function __construct(protected BaristaService $service)
    {
        
    }

    public function show()
    {
        return view("pages.admin.barista", $this->service->getUsersBarista());        
    }

    public function addUser(Request $request)
    {
        $this->service->createBarista($request);

        return redirect()->route('admin.barista.show');
    }

    public function updateUser(Request $request, $id)
    {
        $this->service->updateBarista($request, $id);

        return redirect()->route('admin.barista.show');
    }

    public function deleteUser($id)
    {
        $this->service->deleteBarista($id);

        return redirect()->route('admin.barista.show');
    }
}
