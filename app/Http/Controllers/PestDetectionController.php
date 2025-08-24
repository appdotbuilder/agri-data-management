<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePestDetectionRequest;
use App\Models\District;
use App\Models\Pest;
use App\Models\PestDetection;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PestDetectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detections = PestDetection::with([
            'user',
            'district.regency.province',
            'predictedPest',
            'verifiedPest',
            'verifier'
        ])
            ->latest()
            ->paginate(15);

        return Inertia::render('pest-detections/index', [
            'detections' => $detections
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $districts = District::with('regency.province')
            ->orderBy('name')
            ->get();

        $pests = Pest::orderBy('name')->get();

        return Inertia::render('pest-detections/create', [
            'districts' => $districts,
            'pests' => $pests
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePestDetectionRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('pest-detections', 'public');
            $validated['image_path'] = $path;
        }

        $detection = PestDetection::create($validated);

        return redirect()->route('pest-detections.show', $detection)
            ->with('success', 'Pest detection submitted successfully and is pending verification.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PestDetection $pestDetection)
    {
        $pestDetection->load([
            'user',
            'district.regency.province',
            'predictedPest',
            'verifiedPest',
            'verifier'
        ]);

        return Inertia::render('pest-detections/show', [
            'detection' => $pestDetection
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PestDetection $pestDetection)
    {
        // Only allow experts and admins to verify detections
        if (!auth()->user()->isExpert() && !auth()->user()->isAdmin()) {
            abort(403, 'Only experts can verify pest detections.');
        }

        $pestDetection->load([
            'user',
            'district.regency.province',
            'predictedPest'
        ]);

        $pests = Pest::orderBy('name')->get();

        return Inertia::render('pest-detections/verify', [
            'detection' => $pestDetection,
            'pests' => $pests
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PestDetection $pestDetection)
    {
        // Only allow experts and admins to verify detections
        if (!auth()->user()->isExpert() && !auth()->user()->isAdmin()) {
            abort(403, 'Only experts can verify pest detections.');
        }

        $validated = $request->validate([
            'verified_pest_id' => 'nullable|exists:pests,id',
            'status' => 'required|in:verified,rejected',
            'notes' => 'nullable|string|max:1000',
        ]);

        $validated['verified_by'] = auth()->id();
        $validated['verified_at'] = now();

        $pestDetection->update($validated);

        return redirect()->route('pest-detections.show', $pestDetection)
            ->with('success', 'Pest detection has been verified successfully.');
    }
}