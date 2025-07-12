<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Report;
use App\Models\Extortionist;
use Carbon\Carbon;

class ExtortionReportController extends Controller
{
    public function showForm()
    {
        return view('extortion.form');
    }

    public function submitForm(Request $request)
    {
        // 1. Validate the incoming data
        $validated = $request->validate([
            // User (Reporter) info
            'user_name' => 'required|string|max:255',
            'user_phone' => 'required|string|max:20',
            'user_email' => 'required|email|max:255',
            'contact_permission' => 'nullable|boolean',
            'is_anonymous' => 'nullable|boolean',
            
            // Extortionist details
            'extortionist_name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'political_affiliation' => 'required|string|max:255',
            
            // Business details
            'business_name' => 'required|string|max:255',
            'business_sector' => 'required|string|max:255',
            'business_address_district' => 'required|string|max:255',
            'business_address_upazila' => 'required|string|max:255',
            'business_address_detail' => 'nullable|string',
            
            // Incident metadata
            'incident_date' => 'nullable|date',
            'incident_time' => 'nullable|string',
            'demanded_amount' => 'nullable|numeric',
            'approach_method' => 'required|in:In Person,Phone Call,SMS,Social Media,Through Associates,Other',
            'recurring_demand' => 'nullable|boolean',
            
            // Narrative & evidence
            'threat_description' => 'required|string',
            'evidence.*' => 'nullable|file|mimes:jpg,png,jpeg,gif,bmp,webp,mp4,mov,avi,mp3,wav,pdf,doc,docx,txt|max:10240',
            
            // Police report status
            'police_status' => 'nullable|in:unreported,in-progress,reported',
            'police_station' => 'nullable|string|max:255',
            
            // Support needs
            'needs_legal_support' => 'nullable|boolean',
            'needs_ngo_support' => 'nullable|boolean',
            
            // Additional fields
            'additional_details' => 'nullable|string',
            
            // reCAPTCHA v2 response
            'g-recaptcha-response' => 'required',
        ]);

        // 2. Verify reCAPTCHA
        $captchaResponse = $request->input('g-recaptcha-response');
        $secretKey = env('RECAPTCHA_KEY');
        $verifyURL = 'https://www.google.com/recaptcha/api/siteverify';

        $response = file_get_contents($verifyURL . '?secret=' . $secretKey . '&response=' . $captchaResponse);
        $responseKeys = json_decode($response, true);

        if (!$responseKeys['success']) {
            return back()
                ->withErrors(['captcha' => 'ReCAPTCHA validation failed. Please try again.'])
                ->withInput();
        }

        // 3. Create/find the user (reporter)
        $password = 'test1234'; // or generate a random password
        $user = User::firstOrCreate(
            ['phone' => $validated['user_phone']],
            [
                'name' => $validated['user_name'],
                'email' => $validated['user_email'],
                'role' => 'user',
                'phone' => $validated['user_phone'],
                'password' => Hash::make($password),
            ]
        );

        // 4. Build additional details
        $additionalDetails = [];
        if (!empty($validated['incident_date'])) {
            $additionalDetails[] = "Incident Date: " . $validated['incident_date'];
        }
        if (!empty($validated['incident_time'])) {
            $additionalDetails[] = "Incident Time: " . $validated['incident_time'];
        }
        if (!empty($validated['additional_details'])) {
            $additionalDetails[] = "Notes: " . $validated['additional_details'];
        }
        $combinedDetails = implode(" | ", $additionalDetails);

        // 5. Create the Report record
        $reportData = [
            'user_id' => $user->id,
            'report_type' => 'extortionist',
            'police_status' => $validated['police_status'] ?? 'unreported',
            'police_station' => $validated['police_station'] ?? null,
            'needs_legal_support' => !empty($validated['needs_legal_support']),
            'needs_ngo_support' => !empty($validated['needs_ngo_support']),
            'privacy_level' => !empty($validated['is_anonymous']) ? 'private' : 'public',
            'contact_permission' => $validated['contact_permission'] ?? false,
            'additional_details' => $combinedDetails ?: null,
        ];

        $report = Report::create($reportData);

        // 6. Create the Extortionist record
        $extortionistData = [
            'report_id' => $report->id,
            'name' => $validated['extortionist_name'] ?? 'Unknown',
            'position' => $validated['position'] ?? null,
            'political_affiliation' => $validated['political_affiliation'],
            'business_name' => $validated['business_name'],
            'business_sector' => $validated['business_sector'],
            'business_address_district' => $validated['business_address_district'],
            'business_address_upazila' => $validated['business_address_upazila'],
            'business_address_detail' => $validated['business_address_detail'] ?? null,
            'demanded_amount' => $validated['demanded_amount'] ?? null,
            'approach_method' => $validated['approach_method'],
            'recurring_demand' => $validated['recurring_demand'] ?? false,
            'threat_description' => $validated['threat_description'],
            'status' => 'allegedly', // default
            'risk_level' => 'medium', // default
        ];

        $extortionist = Extortionist::create($extortionistData);
        
        // Update the report with the extortionist ID
        $report->extortionist_id = $extortionist->id;
        $report->save();

        // 7. Handle evidence files
        if ($report && $request->hasFile('evidence')) {
            foreach ($request->file('evidence') as $file) {
                $report->addMedia($file)->toMediaCollection('evidence');
            }
        }

        // 8. Return or redirect
        return view('thankyou', ['type' => 'extortion']); 
    }
    
    public function index()
    {
        // For admin panel - fetch all extortion reports
        $extortionReports = Report::where('report_type', 'extortionist')
            ->with('extortionist')
            ->latest()
            ->get();
            
        return view('admin.extortion.index', compact('extortionReports'));
    }
    
    public function view(Report $report)
    {
        if ($report->report_type !== 'extortionist') {
            abort(404);
        }
        
        return view('admin.extortion.view', compact('report'));
    }
    
    public function edit(Report $report)
    {
        if ($report->report_type !== 'extortionist') {
            abort(404);
        }
        
        return view('admin.extortion.edit', compact('report'));
    }
    
    public function update(Request $request, Report $report)
    {
        if ($report->report_type !== 'extortionist') {
            abort(404);
        }
        
        $validated = $request->validate([
            'police_status' => 'nullable|in:unreported,in-progress,reported',
            'police_station' => 'nullable|string|max:255',
            'needs_legal_support' => 'nullable|boolean',
            'needs_ngo_support' => 'nullable|boolean',
            'privacy_level' => 'required|in:public,private',
            'contact_permission' => 'nullable|boolean',
            'additional_details' => 'nullable|string',
            'verified' => 'nullable|boolean',
            
            'name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'political_affiliation' => 'required|string|max:255',
            'status' => 'required|in:allegedly,confirmed,disproven',
            'risk_level' => 'required|in:low,medium,high',
        ]);
        
        // Update report
        $reportData = [
            'police_status' => $validated['police_status'],
            'police_station' => $validated['police_station'],
            'needs_legal_support' => $request->has('needs_legal_support'),
            'needs_ngo_support' => $request->has('needs_ngo_support'),
            'privacy_level' => $validated['privacy_level'],
            'contact_permission' => $request->has('contact_permission'),
            'additional_details' => $validated['additional_details'],
            'verified' => $request->has('verified'),
        ];
        
        $report->update($reportData);
        
        // Update extortionist
        $extortionistData = [
            'name' => $validated['name'],
            'position' => $validated['position'],
            'political_affiliation' => $validated['political_affiliation'],
            'status' => $validated['status'],
            'risk_level' => $validated['risk_level'],
        ];
        
        $report->extortionist->update($extortionistData);
        
        return redirect()->route('admin.extortion')
            ->with('success', 'Extortion report updated successfully.');
    }
}
