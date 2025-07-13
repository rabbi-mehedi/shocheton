@extends('layouts.admin')

@section('page_content')
<div class="container mx-auto px-4 py-6">
    <h1 class="mt-4">Extortion Report #{{ $report->id }}</h1>
    <nav class="text-sm text-gray-500 mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.extortion') }}">Extortion Reports</a></li>
        <li class="breadcrumb-item active">View Report #{{ $report->id }}</li>
    </nav>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <div class="card mb-4">
                <div class="bg-blue-600 text-white px-4 py-2 rounded-t-lg">
                    <i class="fas fa-user-shield me-1"></i>
                    Extortionist Information
                </div>
                <div class="p-4">
                    <table class="table table-striped">
                        <tr>
                            <th style="width: 35%">Name:</th>
                            <td>{{ $report->extortionist->name ?? 'Unknown' }}</td>
                        </tr>
                        <tr>
                            <th>Political Affiliation:</th>
                            <td>{{ $report->extortionist->political_affiliation }}</td>
                        </tr>
                        <tr>
                            <th>Position/Role:</th>
                            <td>{{ $report->extortionist->position ?? 'Unknown' }}</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                <span class="badge @if($report->extortionist->status === 'allegedly') bg-warning
                                    @elseif($report->extortionist->status === 'confirmed') bg-danger
                                    @elseif($report->extortionist->status === 'disproven') bg-success
                                    @endif">
                                    {{ ucfirst($report->extortionist->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Risk Level:</th>
                            <td>
                                <span class="badge @if($report->extortionist->risk_level === 'low') bg-success
                                    @elseif($report->extortionist->risk_level === 'medium') bg-warning
                                    @elseif($report->extortionist->risk_level === 'high') bg-danger
                                    @endif">
                                    {{ ucfirst($report->extortionist->risk_level) }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-building me-1"></i>
                    Business/Target Information
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th style="width: 35%">Business Name:</th>
                            <td>{{ $report->extortionist->business_name }}</td>
                        </tr>
                        <tr>
                            <th>Business Sector:</th>
                            <td>{{ $report->extortionist->business_sector }}</td>
                        </tr>
                        <tr>
                            <th>Location:</th>
                            <td>
                                {{ $report->extortionist->business_address_district }}, 
                                {{ $report->extortionist->business_address_upazila }}
                                @if($report->extortionist->business_address_detail)
                                    <br>
                                    <small>{{ $report->extortionist->business_address_detail }}</small>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Incident Details
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th style="width: 35%">Date Reported:</th>
                            <td>{{ $report->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        @if(strpos($report->additional_details, 'Incident Date:') !== false)
                            <tr>
                                <th>Incident Date/Time:</th>
                                <td>{{ strpos($report->additional_details, 'Incident Date:') !== false ? substr($report->additional_details, strpos($report->additional_details, 'Incident Date:'), 50) : 'Not specified' }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Demanded Amount:</th>
                            <td>
                                @if($report->extortionist->demanded_amount)
                                    {{ number_format($report->extortionist->demanded_amount, 2) }} BDT
                                @else
                                    Not specified
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Approach Method:</th>
                            <td>{{ $report->extortionist->approach_method }}</td>
                        </tr>
                        <tr>
                            <th>Recurring Demand:</th>
                            <td>{{ $report->extortionist->recurring_demand ? 'Yes' : 'No' }}</td>
                        </tr>
                        <tr>
                            <th>Threat Description:</th>
                            <td><div style="max-height: 150px; overflow-y: auto;">{{ $report->extortionist->threat_description }}</div></td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <i class="fas fa-gavel me-1"></i>
                    Legal Status
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th style="width: 35%">Police Status:</th>
                            <td>
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
                                <th>Police Station:</th>
                                <td>{{ $report->police_station }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Needs Legal Support:</th>
                            <td>{{ $report->needs_legal_support ? 'Yes' : 'No' }}</td>
                        </tr>
                        <tr>
                            <th>Needs NGO Support:</th>
                            <td>{{ $report->needs_ngo_support ? 'Yes' : 'No' }}</td>
                        </tr>
                        <tr>
                            <th>Report Verified:</th>
                            <td>
                                @if($report->verified)
                                    <span class="badge bg-success">Verified</span>
                                @else
                                    <span class="badge bg-secondary">Unverified</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Reporter Information and Evidence -->
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <i class="fas fa-user me-1"></i>
                    Reporter Information
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th style="width: 35%">Name:</th>
                            <td>{{ $report->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $report->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td>{{ $report->user->phone ?? 'Not provided' }}</td>
                        </tr>
                        <tr>
                            <th>Privacy Level:</th>
                            <td>{{ ucfirst($report->privacy_level) }}</td>
                        </tr>
                        <tr>
                            <th>Contact Permission:</th>
                            <td>{{ $report->contact_permission ? 'Yes' : 'No' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-file-alt me-1"></i>
                    Evidence Files
                </div>
                <div class="card-body">
                    @if($report->getMedia('evidence')->count() > 0)
                        <div class="row">
                            @foreach($report->getMedia('evidence') as $media)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body p-2">
                                            @if(in_array($media->mime_type, ['image/jpeg', 'image/png', 'image/gif', 'image/webp']))
                                                <img src="{{ $media->getUrl() }}" class="img-fluid mb-2" alt="Evidence">
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
                                                <div class="text-center">
                                                    <i class="fas fa-file fa-3x mb-2"></i>
                                                    <p>Document</p>
                                                </div>
                                            @endif
                                            <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-primary w-100">View</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            No evidence files have been uploaded.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="mb-4">
        <a href="{{ route('admin.extortion.edit', $report->id) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit Report
        </a>
        <a href="{{ route('admin.extortion') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
</div>
@endsection 