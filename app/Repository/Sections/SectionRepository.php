<?php

namespace App\Repository\Sections;

use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Models\Doctor;
use App\Models\Section;

class SectionRepository implements SectionRepositoryInterface
{
    public function index()
    {
        $sections = Section::all();
        $doctors = Doctor::all();
        return view('Dashboard.Sections.index', compact('sections', "doctors"));
    }
    public function store($request)
    {
        try {
            Section::create([
                'name' => $request->input('name'),
                'head_of_department' => $request->input('head_of_department'),
                'contact_number' => $request->input('contact_number'),
                'location' => $request->input('location'),
                'description' => $request->input('description'),
            ]);
            session()->flash('add');
            return redirect()->route('Sections.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update($request)
    {
        $section = Section::findOrFail($request->id);
        $section->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'head_of_department' => $request->input('head_of_department'),
            'contact_number' => $request->input('contact_number'),
            'location' => $request->input('location'),
        ]);
        session()->flash('edit');
        return redirect()->route('Sections.index');
    }
    public function destroy($request)
    {
        Section::findOrFail($request->id)->delete();
        session()->flash('delete');
        return redirect()->route('Sections.index');
    }
    public function show($id)
    {
        // $doctors = Doctor::where('section_id', $id)->get();
        $doctors = section::findOrFail($id)->doctors;
        $section = section::findOrFail($id);
        return view('Dashboard.Sections.show_doctors', compact('section', 'doctors'));
    }
}
