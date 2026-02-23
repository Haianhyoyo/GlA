<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Service;
use App\Models\News;
use App\Models\Testimonial;
use App\Models\Faq;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'services' => Service::count(),
            'news' => News::count(),
            'testimonials' => Testimonial::count(),
            'faqs' => Faq::count(),
            'consultations' => Consultation::count(),
            'pending_consultations' => Consultation::where('status', 'pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
