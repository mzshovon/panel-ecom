<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Admin\RoleServiceInterface;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    const INDEX_PAGE = "Roles";
    const CREATE_PAGE = "Create Roles";
    const UPDATE_PAGE = "Update Roles";

    public function __construct(
        private RoleServiceInterface $repo
    )
    {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = [];
            $data['page'] = self::INDEX_PAGE;
            $data['roles'] = customPaginate($this->repo->getRoles(), 10);
            return view('admin.role.view', $data);
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $store = $this->repo->createRole($request->all());
            return redirect()->back()->with("success", "role {$request['name']} has been created successfully!");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try {
            $update = $this->repo->updateRole($id, $request->all());
            if($update) {
                return redirect()->back()->with("success", "Role named {$request['name']} info is updated successfully!");
            } else {
                return redirect()->back()->with("error", "Something went wrong while updating {$request['name']} info!");
            }
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
