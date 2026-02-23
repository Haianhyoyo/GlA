<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::latest()->get();
        return view('admin.consultations.index', compact('consultations'));
    }

    public function show(Consultation $consultation)
    {
        return view('admin.consultations.show', compact('consultation'));
    }

    public function update(Request $request, Consultation $consultation)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,contacted,completed,cancelled',
        ]);

        $consultation->update($validated);
        return redirect()->route('admin.consultations.index')->with('success', 'Cập nhật trạng thái thành công.');
    }

    public function destroy(Consultation $consultation)
    {
        $consultation->delete();
        return redirect()->route('admin.consultations.index')->with('success', 'Xóa yêu cầu thành công.');
    }
}
