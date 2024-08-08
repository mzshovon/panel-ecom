<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Admin\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUser;
use App\Http\Requests\UserStoreRequest;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    const INDEX_PAGE = "Users";
    const CREATE_PAGE = "Create Users";
    const UPDATE_PAGE = "Update Users";

    public function __construct(
        private UserServiceInterface $repo
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
            $data['users'] = customPaginate($this->repo->getUsers(), 10);
            return view('admin.user.view', $data);
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $data = [];
            $data['page'] = self::CREATE_PAGE;
            return view('admin.user.create', $data);
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        try {
            $store = $this->repo->createUser($request->all());
            return redirect()->back()->with("success", "User {$request['name']} has been created successfully!");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $data = [];
            $data['page'] = self::UPDATE_PAGE;
            return view('admin.user.create', $data);
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        try {
            $data = [];
            $data['page'] = self::UPDATE_PAGE;
            $data['user'] = $this->repo->getUserById($id);
            return view('admin.user.edit', $data);
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUser $request, int $id)
    {
        try {
            $update = $this->repo->updateUser($id, $request->all());
            if($update) {
                return redirect()->back()->with("success", "User named {$request['name']} info is updated successfully!");
            } else {
                return redirect()->back()->with("error", "Something went wrong while updating {$request['name']} info!");
            }
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Update the status specified resource in storage.
     */
    public function statusChange(Request $request, int $id)
    {
        try {
            $update = $this->repo->updateUser($id, $request->all());
            if($update) {
                return response()->json([($update ? 'success' : 'error') =>
                    ($update ? 'User status changed successfully.' : 'something went wrong with chage the status')]);
            }
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Update the status specified resource in storage.
     */
    public function assignRole(Request $request)
    {
        try {
            $id = $request->user_id ?? null;
            $update = $this->repo->updateUser($id, $request->all());
            if($update) {
                return redirect()->back()->with("success", "Role assigned successfully!");
            } else {
                return redirect()->back()->with("error", "Something went wrong while assigning role to id #{$id}!");
            }
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $delete = $this->repo->deleteUser($id);
            return response()->json([($delete ? 'success' : 'error') =>
                    ($delete ? 'User deleted successfully.' : 'something went wrong with delete')]);
        } catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }
}
