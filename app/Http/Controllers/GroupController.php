<?php

namespace App\Http\Controllers;

use App\Exports\GroupExport;
use App\MemberGroup;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = MemberGroup::paginate(30);
        return view('theme.template.group.index', compact('groups'));
    }
    public function export(MemberGroup $memberGroup)
    {
        return Excel::download(new GroupExport($memberGroup->id), $memberGroup->name.'.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'groupname' => 'required'
        ]);
        MemberGroup::create([
            'name' => $request->groupname
        ]);
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MemberGroup  $memberGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(MemberGroup $memberGroup)
    {
        return view('theme.template.group.edit', compact('memberGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MemberGroup  $memberGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MemberGroup $memberGroup)
    {
        
        $memberGroup->name = $request->groupname;
        $memberGroup->save();
     
        return redirect()->route('groups');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MemberGroup  $memberGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(MemberGroup $memberGroup)
    {
        $memberGroup->delete();
        return redirect()->back();
    }
}
