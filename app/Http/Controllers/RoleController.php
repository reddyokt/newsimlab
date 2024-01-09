<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    public function roleindex()
    {
        $roleindex = Role::all();
        return view('auth.masterdata.role.roleindex', compact('roleindex'));
    }

    public function addrole()
    {
        return view('auth.masterdata.role.addrole');
    }

    public function storenewrole(Request $request)
    {
        // dd ($request);
        $storenewrole = $request->validate([
            'role_name' => 'required',
            'code' => 'required',
            'description' => 'required',
        ]);

        $storenewrole['role_name'] = $request->role_name;
        $storenewrole['CODE'] = $request->code;
        $storenewrole['description'] = $request->description;
        $storenewrole['created_by'] = $request->id;

        Role::create($storenewrole);
        return redirect('/role');
    }

    public function roleedit($id)
    {
        $roleedit = Role::find($id);

        return view('auth.masterdata.role.roleedit', compact('roleedit'));
    }

    public function storeroleedit(Request $request, $id)
    {
        $storeroleedit = Role::find($id);

        $storeroleedit->update($request->all());

        return redirect('/role');
    }
}
