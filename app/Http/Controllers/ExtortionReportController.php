<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Report;
use App\Models\Extortionist;
use App\Models\ExtorterIndividual;
use Carbon\Carbon;
use Exception;

class ExtortionReportController extends Controller
{
    public function showForm()
    {
        return view('extortion.form');
    }

    public function submitForm(Request $request)
    {
        try {
            // Log the beginning of form submission
            Log::info('Starting extortion report submission');
            
            // 1. Validate the incoming data
            $validated = $request->validate([
                // User (Reporter) info
                'user_name' => 'required|string|max:255',
                'user_phone' => 'required|string|max:20',
                'user_email' => 'required|email|max:255',
                'contact_permission' => 'nullable',
                'is_anonymous' => 'nullable',
                
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
                'recurring_demand' => 'nullable',
                
                // Individual extorters
                'extorter_names.*' => 'nullable|string|max:255',
                'extorter_nicknames.*' => 'nullable|string|max:255',
                'extorter_positions.*' => 'nullable|string|max:255',
                'extorter_phones.*' => 'nullable|string|max:20',
                'extorter_descriptions.*' => 'nullable|string',
                'extorter_photos.*' => 'nullable|array',
                'extorter_photos.*.*' => 'nullable|file|mimes:jpg,png,jpeg,gif,bmp,webp|max:10240',
                
                // Narrative & evidence
                'threat_description' => 'required|string',
                'evidence.*' => 'nullable|file|mimes:jpg,png,jpeg,gif,bmp,webp,mp4,mov,avi,mp3,wav,pdf,doc,docx,txt|max:10240',
                
                // Police report status
                'police_status' => 'nullable|in:unreported,in-progress,reported',
                'police_station' => 'nullable|string|max:255',
                
                // Support needs
                'needs_legal_support' => 'nullable',
                'needs_ngo_support' => 'nullable',
                
                // Additional fields
                'additional_details' => 'nullable|string',
                
                // reCAPTCHA v2 response
                'g-recaptcha-response' => 'required',
            ]);

            Log::info('Form validation passed');

            // 2. Verify reCAPTCHA
            $captchaResponse = $request->input('g-recaptcha-response');
            $secretKey = env('RECAPTCHA_KEY', '6LftofgqAAAAAGRy8zFG3z0Mo4eG5wcuTT_Wye4w');
            $verifyURL = 'https://www.google.com/recaptcha/api/siteverify';

            $response = file_get_contents($verifyURL . '?secret=' . $secretKey . '&response=' . $captchaResponse);
            $responseKeys = json_decode($response, true);

            if (!$responseKeys['success']) {
                Log::warning('reCAPTCHA validation failed');
                return back()
                    ->withErrors(['captcha' => 'ReCAPTCHA validation failed. Please try again.'])
                    ->withInput();
            }

            Log::info('reCAPTCHA validation passed');

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

            Log::info('User created/found', ['user_id' => $user->id]);

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
                'needs_legal_support' => $request->has('needs_legal_support'),
                'needs_ngo_support' => $request->has('needs_ngo_support'),
                'privacy_level' => $request->has('is_anonymous') ? 'private' : 'public',
                'contact_permission' => $request->has('contact_permission'),
                'additional_details' => $combinedDetails ?: null,
            ];

            $report = Report::create($reportData);
            Log::info('Report created', ['report_id' => $report->id]);

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
                'recurring_demand' => $request->has('recurring_demand'),
                'threat_description' => $validated['threat_description'],
                'status' => 'allegedly', // default
                'risk_level' => 'medium', // default
            ];

            $extortionist = Extortionist::create($extortionistData);
            Log::info('Extortionist record created', ['extortionist_id' => $extortionist->id]);
            
            // Update the report with the extortionist ID
            $report->extortionist_id = $extortionist->id;
            $report->save();
            Log::info('Report updated with extortionist ID');

            // 7. Process individual extorters if provided
            if ($request->has('extorter_names')) {
                foreach ($request->extorter_names as $key => $name) {
                    // Skip empty entries
                    if (empty($name) && empty($request->extorter_nicknames[$key]) && 
                        empty($request->extorter_positions[$key]) && empty($request->extorter_descriptions[$key])) {
                        continue;
                    }
                    
                    // Create individual extorter record
                    $individual = ExtorterIndividual::create([
                        'extortionist_id' => $extortionist->id,
                        'name' => $name,
                        'nickname' => $request->extorter_nicknames[$key] ?? null,
                        'position' => $request->extorter_positions[$key] ?? null,
                        'phone' => $request->extorter_phones[$key] ?? null,
                        'description' => $request->extorter_descriptions[$key] ?? null,
                    ]);
                    
                    // Process photos for this individual if any
                    if ($request->hasFile("extorter_photos.$key")) {
                        foreach ($request->file("extorter_photos.$key") as $photo) {
                            $individual->addMedia($photo)->toMediaCollection('photos');
                        }
                    }
                    
                    Log::info('Individual extorter added', ['id' => $individual->id]);
                }
            }

            // 8. Handle evidence files for the main report
            if ($report && $request->hasFile('evidence')) {
                $fileCount = 0;
                foreach ($request->file('evidence') as $file) {
                    $report->addMedia($file)->toMediaCollection('evidence');
                    $fileCount++;
                }
                Log::info('Evidence files uploaded', ['count' => $fileCount]);
            }

            // 9. Return or redirect
            Log::info('Form submission successful, redirecting to thank you page');
            return redirect()->route('home')->with([
                'type' => 'extortion',
                'success' => 'Your report has been submitted successfully.',
                'report_id' => $report->id
            ]); 
            
        } catch (Exception $e) {
            Log::error('Error submitting extortion report', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()
                ->withErrors(['error' => 'An error occurred while submitting your report. Please try again or contact support.'])
                ->withInput();
        }
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
            'needs_legal_support' => 'nullable',
            'needs_ngo_support' => 'nullable',
            'privacy_level' => 'required|in:public,private',
            'contact_permission' => 'nullable',
            'additional_details' => 'nullable|string',
            'verified' => 'nullable',
            
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
