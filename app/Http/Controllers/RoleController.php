<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    public function roleIndex()
    {
        $roleindex = Role::all();
        return view('auth.masterdata.role.roleindex', compact('roleindex'));
    }

    public function addRole()
    {
        return view('auth.masterdata.role.addrole');
    }

    public function storeNewRole(Request $request)
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

    public function roleEdit($id)
    {
        $roleedit = Role::find($id);

        return view('auth.masterdata.role.roleedit', compact('roleedit'));
    }

    public function storeRoleEdit(Request $request, $id)
    {
        $storeroleedit = Role::find($id);

        $storeroleedit->update($request->all());

        return redirect('/role');
    }
}
