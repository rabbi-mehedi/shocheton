<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Offender;
use App\Models\Report;
use App\Models\Witness;

class PrimaryController extends Controller
{
    public function __invoke()
    {
        // Fetch offenders from the database.
        $offenders = Offender::with('report')->latest()->get();
        // dd(auth()->user()->reports);

        return view('welcome',compact('offenders'));
    }

    public function showForm()
    {
        return view('form');
    }

    public function submitForm(Request $request)
    {
        // 1. Validate the incoming data (including multiple evidence files)
        $validated = $request->validate([
            // User (Reporter) info
            'user_name'      => 'required|string|max:255',
            'user_phone'     => 'required|string|max:20',
            'user_email'     => 'required|email|max:255',
            'gender'         => 'nullable|in:male,female,other',
            'contact_permission' => 'nullable|boolean',

            // Offender fields
            'offender_name'  => 'nullable|string|max:255',
            'offender_age'   => 'nullable|integer',
            'offender_gender'=> 'nullable|in:male,female,other',
            'incident_type'  => 'nullable|in:Rape,Attempted Rape,Child Sexual Abuse,Molestation,Sexual Harassment,Cyber Harassment,Blackmail,Stalking,Other',
            'location'       => 'nullable|string|max:255',
            'description'    => 'nullable|string',

            // Offender photo (single file)
            'offender_photo' => 'nullable|file|mimes:jpg,png,jpeg,gif,bmp,webp,mp4,mov,avi,pdf|max:5120',

            // Evidence (multiple files)
            'evidence.*'     => 'nullable|file|mimes:jpg,png,jpeg,gif,bmp,webp,mp4,mov,avi,pdf|max:5120',

            // Additional form fields
            'report_type'    => 'nullable|string|max:255',
            'incident_date'  => 'nullable|date',
            'incident_time'  => 'nullable|string',
            'police_case_number' => 'nullable|string|max:255',
            'police_status'  => 'nullable|in:unreported,in-progress,reported',
            'police_station' => 'nullable|string|max:255',
            'needs_legal_support'=> 'nullable',
            'needs_ngo_support'  => 'nullable',
            'privacy_level'  => 'nullable|in:public,private,anonymous',
            'additional_notes'=> 'nullable|string',
            'offender_relation' => 'nullable|in:Stranger,Family Member,Teacher,Colleague,Neighbor,Police,Partner,Religious Leader,Other',

            // Witness fields
            'witness_name'   => 'nullable|string|max:255',
            'witness_phone'  => 'nullable|string|max:50',
            'witness_email'  => 'nullable|email|max:255',
            'witness_statement' => 'nullable|string',

            // Victim photo (single file)
            'victim_photo'   => 'nullable|file|mimes:jpg,png,jpeg,gif,bmp,webp,mp4,mov,avi,pdf|max:5120',

            // OTP field (if verifying server-side)
            'otp'            => 'nullable|string',
        ]);

        // 2. (Optional) Verify OTP if needed
        // if ($validated['otp'] !== session('otp')) {
        //     return back()->withErrors(['otp' => 'Invalid OTP']);
        // }

        // 3. Create/find the user (reporter)
        $password = 'test1234'; // or generate a random password
        $user = User::firstOrCreate(
            ['phone' => $validated['user_phone']],
            [
                'name'     => $validated['user_name'],
                'email'    => $validated['user_email'],
                'role'     => 'user',
                'phone'    => $validated['user_phone'],
                'password' => Hash::make($password),
                'gender'   => $validated['gender'] ?? 'other',
            ]
        );

        // 4. Prepare Offender data (if any)
        $offenderData = [];
        if (!empty($validated['offender_name']) || !empty($validated['incident_type'])) {
            $offenderData = [
                'name'             => $validated['offender_name'] ?? 'Unknown',
                'age'              => $validated['offender_age'] ?? null,
                'gender'           => $validated['offender_gender'] ?? 'other',
                'crime_description'=> $validated['description'] ?? 'N/A',
                'offense_type'     => $validated['incident_type'] ?? 'Other',
                'location'         => $validated['location'] ?? null,
                'status'           => 'allegedly', // default
                'risk_level'       => 'medium',    // default
            ];
        }

        // 4a. Create the Offender record if we have relevant data
        $offender = null;
        if (!empty($offenderData)) {
            $offender = Offender::create($offenderData);

            // If the offender was created successfully, attach the offender_photo via Spatie
            if ($offender && $request->hasFile('offender_photo')) {
                $offender->addMedia($request->file('offender_photo'))
                        ->toMediaCollection('offender_photo');
            }
        }

        // 5. Build additional details for leftover info
        $additionalDetails = [];
        if (!empty($validated['report_type'])) {
            $additionalDetails[] = "Report Type: ".$validated['report_type'];
        }
        if (!empty($validated['incident_date'])) {
            $additionalDetails[] = "Incident Date: ".$validated['incident_date'];
        }
        if (!empty($validated['incident_time'])) {
            $additionalDetails[] = "Incident Time: ".$validated['incident_time'];
        }
        if (!empty($validated['police_case_number'])) {
            $additionalDetails[] = "Police Case #: ".$validated['police_case_number'];
        }
        if (!empty($validated['additional_notes'])) {
            $additionalDetails[] = "Notes: ".$validated['additional_notes'];
        }
        $combinedDetails = implode(" | ", $additionalDetails);

        // 6. Create the Report record
        //    - e.g., user_id, offender_id, offender_relation_to_victim, police_status, police_station,
        //      needs_legal_support, needs_ngo_support, privacy_level, contact_permission, victim_photo, etc.
        $reportData = [
            'user_id'                    => $user->id,
            'offender_id'                => $offender ? $offender->id : null,
            'offender_relation_to_victim'=> $validated['offender_relation'] ?? null,
            'police_status'              => $validated['police_status'] ?? 'unreported',
            'police_station'             => $validated['police_station'] ?? null,
            'needs_legal_support'        => !empty($validated['needs_legal_support']),
            'needs_ngo_support'          => !empty($validated['needs_ngo_support']),
            'privacy_level'              => $validated['privacy_level'] ?? 'public',
            'contact_permission'         => $validated['contact_permission'] ?? false,
            'additional_details'         => $combinedDetails ?: null,
        ];

        $report = Report::create($reportData);

        // 6a. Victim Photo (if uploaded) => attach via Spatie
        if ($report && $request->hasFile('victim_photo')) {
            $report->addMedia($request->file('victim_photo'))
                ->toMediaCollection('victim_photo');
        }

        // 6b. Evidence (multiple files)
        if ($report && $request->hasFile('evidence')) {
            foreach ($request->file('evidence') as $file) {
                $report->addMedia($file)->toMediaCollection('evidence');
            }
        }

        // 7. Create Witness record if data is provided
        if (!empty($validated['witness_name']) || !empty($validated['witness_phone']) || !empty($validated['witness_email'])) {
            // Combine phone + email into `contact`
            $contactStr = '';
            if (!empty($validated['witness_phone'])) {
                $contactStr .= "Phone: ".$validated['witness_phone'];
            }
            if (!empty($validated['witness_email'])) {
                if ($contactStr) $contactStr .= " | ";
                $contactStr .= "Email: ".$validated['witness_email'];
            }
            $statementStr = $validated['witness_statement'] ?? 'No statement provided';

            // Example: store witness in a separate `witnesses` table
            Witness::create([
                'report_id' => $report->id,
                'name'      => $validated['witness_name'] ?? 'Anonymous Witness',
                'contact'   => $contactStr,
                'statement' => $statementStr,
            ]);
        }

        // 8. Return or redirect
        // Keep the same final redirect you had
        return view('thankyou');  // or redirect()->route('thank.you.page');
    }

    public function explain()
    {
        return view('explain');
    }

}
