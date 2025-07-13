@extends('layouts.admin')

@section('page_content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-900 mb-4">Extortion Report #{{ $report->id }}</h1>
    <nav class="text-sm text-gray-500 mb-4">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">Dashboard</a> /
        <a href="{{ route('admin.extortion') }}" class="text-blue-600 hover:underline">Extortion Reports</a> /
        <span class="text-gray-500">View Report #{{ $report->id }}</span>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <div class="card mb-4">
                <div class="bg-blue-600 text-white px-4 py-2 rounded-t-lg">
                    <i class="fas fa-user-shield me-1"></i>
                    Extortionist Information
                </div>
                <div class="p-4">
                    <table class="w-full text-sm text-gray-700 mb-4">
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <th class="w-1/3 py-2 px-4 font-medium text-gray-900">Name:</th>
                                <td class="py-2 px-4">{{ $report->extortionist->name ?? 'Unknown' }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 font-medium text-gray-900">Political Affiliation:</th>
                                <td class="py-2 px-4">{{ $report->extortionist->political_affiliation }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 font-medium text-gray-900">Position/Role:</th>
                                <td class="py-2 px-4">{{ $report->extortionist->position ?? 'Unknown' }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 font-medium text-gray-900">Status:</th>
                                <td class="py-2 px-4">
                                    <span class="badge @if($report->extortionist->status === 'allegedly') bg-warning
                                        @elseif($report->extortionist->status === 'confirmed') bg-danger
                                        @elseif($report->extortionist->status === 'disproven') bg-success
                                        @endif">
                                        {{ ucfirst($report->extortionist->status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 font-medium text-gray-900">Risk Level:</th>
                                <td class="py-2 px-4">
                                    <span class="badge @if($report->extortionist->risk_level === 'low') bg-success
                                        @elseif($report->extortionist->risk_level === 'medium') bg-warning
                                        @elseif($report->extortionist->risk_level === 'high') bg-danger
                                        @endif">
                                        {{ ucfirst($report->extortionist->risk_level) }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mb-4">
                <div class="bg-teal-600 text-white px-4 py-2 rounded-t-lg">
                    <i class="fas fa-building me-1"></i>
                    Business/Target Information
                </div>
                <div class="p-4">
                    <table class="w-full text-sm text-gray-700 mb-4">
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <th class="w-1/3 py-2 px-4 font-medium text-gray-900">Business Name:</th>
                                <td class="py-2 px-4">{{ $report->extortionist->business_name }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 font-medium text-gray-900">Business Sector:</th>
                                <td class="py-2 px-4">{{ $report->extortionist->business_sector }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 font-medium text-gray-900">Location:</th>
                                <td class="py-2 px-4">
                                    {{ $report->extortionist->business_address_district }},
                                    {{ $report->extortionist->business_address_upazila }}
                                    @if($report->extortionist->business_address_detail)
                                        <br>
                                        <small>{{ $report->extortionist->business_address_detail }}</small>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>
            <div class="bg-white shadow rounded-lg">
                <div class="bg-red-600 text-white px-4 py-2 rounded-t-lg">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Incident Details
                </div>
                <div class="p-4">
                    <table class="w-full text-sm text-gray-700 mb-4">
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <th class="w-1/3 py-2 px-4 font-medium text-gray-900">Date Reported:</th>
                                <td class="py-2 px-4">{{ $report->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                            @if(strpos($report->additional_details, 'Incident Date:') !== false)
                                <tr>
                                    <th class="py-2 px-4 font-medium text-gray-900">Incident Date/Time:</th>
                                    <td class="py-2 px-4">{{ strpos($report->additional_details, 'Incident Date:') !== false ? substr($report->additional_details, strpos($report->additional_details, 'Incident Date:'), 50) : 'Not specified' }}</td>
                                </tr>
                            @endif
                            <tr>
                                <th class="py-2 px-4 font-medium text-gray-900">Demanded Amount:</th>
                                <td class="py-2 px-4">
                                    @if($report->extortionist->demanded_amount)
                                        {{ number_format($report->extortionist->demanded_amount, 2) }} BDT
                                    @else
                                        Not specified
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 font-medium text-gray-900">Approach Method:</th>
                                <td class="py-2 px-4">{{ $report->extortionist->approach_method }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 font-medium text-gray-900">Recurring Demand:</th>
                                <td class="py-2 px-4">{{ $report->extortionist->recurring_demand ? 'Yes' : 'No' }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 font-medium text-gray-900">Threat Description:</th>
                                <td class="py-2 px-4"><div style="max-height: 150px; overflow-y: auto;">{{ $report->extortionist->threat_description }}</div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>
            <div class="bg-white shadow rounded-lg">
                <div class="bg-gray-700 text-white px-4 py-2 rounded-t-lg">
                    <i class="fas fa-gavel me-1"></i>
                    Legal Status
                </div>
                <div class="p-4">
                    <table class="w-full text-sm text-gray-700 mb-4">
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <th class="w-1/3 py-2 px-4 font-medium text-gray-900">Police Status:</th>
                                <td class="py-2 px-4">
                                    <span class="badge @if($report->police_status === 'unreported') bg-secondary
                                        @elseif($report->police_status === 'in-progress') bg-info
                                        @elseif($report->police_status === 'reported') bg-success
                                        @endif">
                                        {{ ucfirst($report->police_status) }}
                                    </span>
                                </td>
                            </tr>
                            @if($report->police_station)
                                <tr>
                                    <th class="py-2 px-4 font-medium text-gray-900">Police Station:</th>
                                    <td class="py-2 px-4">{{ $report->police_station }}</td>
                                </tr>
                            @endif
                            <tr>
                                <th class="py-2 px-4 font-medium text-gray-900">Needs Legal Support:</th>
                                <td class="py-2 px-4">{{ $report->needs_legal_support ? 'Yes' : 'No' }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 font-medium text-gray-900">Needs NGO Support:</th>
                                <td class="py-2 px-4">{{ $report->needs_ngo_support ? 'Yes' : 'No' }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 font-medium text-gray-900">Report Verified:</th>
                                <td class="py-2 px-4">
                                    @if($report->verified)
                                        <span class="badge bg-success">Verified</span>
                                    @else
                                        <span class="badge bg-secondary">Unverified</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <div class="bg-white shadow rounded-lg">
                <div class="bg-gray-800 text-white px-4 py-2 rounded-t-lg">
                    <i class="fas fa-user me-1"></i>
                    Reporter Information
                </div>
                <div class="p-4">
                    <table class="w-full text-sm text-gray-700 mb-4">
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <th class="w-1/3 py-2 px-4 font-medium text-gray-900">Name:</th>
                                <td class="py-2 px-4">{{ $report->user->name }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 font-medium text-gray-900">Email:</th>
                                <td class="py-2 px-4">{{ $report->user->email }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 font-medium text-gray-900">Phone:</th>
                                <td class="py-2 px-4">{{ $report->user->phone ?? 'Not provided' }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 font-medium text-gray-900">Privacy Level:</th>
                                <td class="py-2 px-4">{{ ucfirst($report->privacy_level) }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 font-medium text-gray-900">Contact Permission:</th>
                                <td class="py-2 px-4">{{ $report->contact_permission ? 'Yes' : 'No' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>
            <div class="bg-white shadow rounded-lg">
                <div class="bg-green-600 text-white px-4 py-2 rounded-t-lg">
                    <i class="fas fa-file-alt me-1"></i>
                    Evidence Files
                </div>
                <div class="p-4">
                    @if($report->getMedia('evidence')->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            @foreach($report->getMedia('evidence') as $media)
                                <div class="bg-gray-100 p-4 rounded-lg">
                                    @if(in_array($media->mime_type, ['image/jpeg', 'image/png', 'image/gif', 'image/webp']))
                                        <img src="{{ $media->getUrl() }}" class="w-full h-auto mb-2 rounded" alt="Evidence">
                                    @elseif(in_array($media->mime_type, ['video/mp4', 'video/mov', 'video/avi']))
                                        <div class="text-center">
                                            <i class="fas fa-video fa-3x mb-2"></i>
                                            <p>Video File</p>
                                        </div>
                                    @elseif(in_array($media->mime_type, ['audio/mp3', 'audio/wav']))
                                        <div class="text-center">
                                            <i class="fas fa-headphones fa-3x mb-2"></i>
                                            <p>Audio File</p>
                                        </div>
                                    @else
                                        <div class="text-center text-gray-700 mb-2">
                                            <i class="fas fa-file fa-3x"></i>
                                            <p>Document</p>
                                        </div>
                                    @endif
                                    <a href="{{ $media->getUrl() }}" target="_blank" class="inline-block bg-blue-600 text-white text-center px-3 py-1 rounded hover:bg-blue-700 transition">View</a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-gray-600">No evidence files have been uploaded.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 flex space-x-4">
        <a href="{{ route('admin.extortion.edit', $report->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
            Edit Report
        </a>
        <a href="{{ route('admin.extortion') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
            Back to List
        </a>
    </div>
</div>
@endsection 