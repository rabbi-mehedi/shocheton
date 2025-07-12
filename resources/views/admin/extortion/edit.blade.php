@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Extortion Report #{{ $report->id }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.extortion') }}">Extortion Reports</a></li>
        <li class="breadcrumb-item active">Edit Report #{{ $report->id }}</li>
    </ol>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.extortion.update', $report->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <!-- Extortionist Information Card -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-user-shield me-1"></i>
                        Extortionist Information
                    </div>
                    <div class="card-body">
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $report->extortionist->name) }}">
                        </div>
                        
                        <!-- Political Affiliation -->
                        <div class="mb-3">
                            <label for="political_affiliation" class="form-label">Political Affiliation <span class="text-danger">*</span></label>
                            <select class="form-select" id="political_affiliation" name="political_affiliation" required>
                                <option value="">Select political affiliation</option>
                                <option value="Awami League" {{ $report->extortionist->political_affiliation == 'Awami League' ? 'selected' : '' }}>Awami League</option>
                                <option value="BNP" {{ $report->extortionist->political_affiliation == 'BNP' ? 'selected' : '' }}>BNP</option>
                                <option value="Chhatra League" {{ $report->extortionist->political_affiliation == 'Chhatra League' ? 'selected' : '' }}>Chhatra League</option>
                                <option value="Jubo League" {{ $report->extortionist->political_affiliation == 'Jubo League' ? 'selected' : '' }}>Jubo League</option>
                                <option value="Chhatra Shibir" {{ $report->extortionist->political_affiliation == 'Chhatra Shibir' ? 'selected' : '' }}>Chhatra Shibir</option>
                                <option value="Jatiyotabadi Chhatra Dal" {{ $report->extortionist->political_affiliation == 'Jatiyotabadi Chhatra Dal' ? 'selected' : '' }}>Jatiyotabadi Chhatra Dal</option>
                                <option value="Local Political Group" {{ $report->extortionist->political_affiliation == 'Local Political Group' ? 'selected' : '' }}>Local Political Group</option>
                                <option value="Other" {{ $report->extortionist->political_affiliation == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        
                        <!-- Position -->
                        <div class="mb-3">
                            <label for="position" class="form-label">Position/Role</label>
                            <input type="text" class="form-control" id="position" name="position" value="{{ old('position', $report->extortionist->position) }}">
                        </div>
                        
                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="allegedly" {{ $report->extortionist->status == 'allegedly' ? 'selected' : '' }}>Allegedly</option>
                                <option value="confirmed" {{ $report->extortionist->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="disproven" {{ $report->extortionist->status == 'disproven' ? 'selected' : '' }}>Disproven</option>
                            </select>
                        </div>
                        
                        <!-- Risk Level -->
                        <div class="mb-3">
                            <label for="risk_level" class="form-label">Risk Level <span class="text-danger">*</span></label>
                            <select class="form-select" id="risk_level" name="risk_level" required>
                                <option value="low" {{ $report->extortionist->risk_level == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ $report->extortionist->risk_level == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ $report->extortionist->risk_level == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Business Information Card (Read Only) -->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <i class="fas fa-building me-1"></i>
                        Business Information (Read Only)
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Business Name</label>
                            <input type="text" class="form-control" value="{{ $report->extortionist->business_name }}" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Business Sector</label>
                            <input type="text" class="form-control" value="{{ $report->extortionist->business_sector }}" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" value="{{ $report->extortionist->business_address_district }}, {{ $report->extortionist->business_address_upazila }}" readonly>
                            @if($report->extortionist->business_address_detail)
                                <textarea class="form-control mt-2" rows="2" readonly>{{ $report->extortionist->business_address_detail }}</textarea>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column -->
            <div class="col-md-6">
                <!-- Report Information Card -->
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <i class="fas fa-file-alt me-1"></i>
                        Report Information
                    </div>
                    <div class="card-body">
                        <!-- Police Status -->
                        <div class="mb-3">
                            <label for="police_status" class="form-label">Police Status</label>
                            <select class="form-select" id="police_status" name="police_status">
                                <option value="unreported" {{ $report->police_status == 'unreported' ? 'selected' : '' }}>Unreported</option>
                                <option value="in-progress" {{ $report->police_status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="reported" {{ $report->police_status == 'reported' ? 'selected' : '' }}>Reported</option>
                            </select>
                        </div>
                        
                        <!-- Police Station -->
                        <div class="mb-3">
                            <label for="police_station" class="form-label">Police Station</label>
                            <input type="text" class="form-control" id="police_station" name="police_station" value="{{ old('police_station', $report->police_station) }}">
                        </div>
                        
                        <!-- Privacy Level -->
                        <div class="mb-3">
                            <label for="privacy_level" class="form-label">Privacy Level <span class="text-danger">*</span></label>
                            <select class="form-select" id="privacy_level" name="privacy_level" required>
                                <option value="public" {{ $report->privacy_level == 'public' ? 'selected' : '' }}>Public</option>
                                <option value="private" {{ $report->privacy_level == 'private' ? 'selected' : '' }}>Private</option>
                            </select>
                        </div>
                        
                        <!-- Support Needs -->
                        <div class="mb-3">
                            <label class="form-label">Support Needs</label>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="needs_legal_support" name="needs_legal_support" {{ $report->needs_legal_support ? 'checked' : '' }}>
                                <label class="form-check-label" for="needs_legal_support">Needs Legal Support</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="needs_ngo_support" name="needs_ngo_support" {{ $report->needs_ngo_support ? 'checked' : '' }}>
                                <label class="form-check-label" for="needs_ngo_support">Needs NGO Support</label>
                            </div>
                        </div>
                        
                        <!-- Contact Permission -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="contact_permission" name="contact_permission" {{ $report->contact_permission ? 'checked' : '' }}>
                                <label class="form-check-label" for="contact_permission">Contact Permission</label>
                            </div>
                        </div>
                        
                        <!-- Report Verification -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="verified" name="verified" {{ $report->verified ? 'checked' : '' }}>
                                <label class="form-check-label" for="verified">Mark Report as Verified</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Incident Details Card (Partly Editable) -->
                <div class="card mb-4">
                    <div class="card-header bg-danger text-white">
                        <i class="fas fa-exclamation-triangle me-1"></i>
                        Incident Details (Read Only)
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Approach Method</label>
                            <input type="text" class="form-control" value="{{ $report->extortionist->approach_method }}" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Demanded Amount</label>
                            <input type="text" class="form-control" value="{{ $report->extortionist->demanded_amount ? number_format($report->extortionist->demanded_amount, 2) . ' BDT' : 'Not specified' }}" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Recurring Demand</label>
                            <input type="text" class="form-control" value="{{ $report->extortionist->recurring_demand ? 'Yes' : 'No' }}" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Threat Description</label>
                            <textarea class="form-control" rows="4" readonly>{{ $report->extortionist->threat_description }}</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="additional_details" class="form-label">Additional Details</label>
                            <textarea class="form-control" id="additional_details" name="additional_details" rows="3">{{ old('additional_details', $report->additional_details) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Evidence Files Section -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <i class="fas fa-file-alt me-1"></i>
                Evidence Files
            </div>
            <div class="card-body">
                @if($report->getMedia('evidence')->count() > 0)
                    <div class="row">
                        @foreach($report->getMedia('evidence') as $media)
                            <div class="col-md-2 mb-3">
                                <div class="card">
                                    <div class="card-body p-2 text-center">
                                        @if(in_array($media->mime_type, ['image/jpeg', 'image/png', 'image/gif', 'image/webp']))
                                            <img src="{{ $media->getUrl() }}" class="img-fluid mb-2" alt="Evidence" style="max-height: 100px;">
                                        @elseif(in_array($media->mime_type, ['video/mp4', 'video/mov', 'video/avi']))
                                            <i class="fas fa-video fa-3x mb-2"></i>
                                        @elseif(in_array($media->mime_type, ['audio/mp3', 'audio/wav']))
                                            <i class="fas fa-headphones fa-3x mb-2"></i>
                                        @else
                                            <i class="fas fa-file fa-3x mb-2"></i>
                                        @endif
                                        <div>
                                            <a href="{{ $media->getUrl() }}" target="_blank" class="btn btn-sm btn-primary">View</a>
                                        </div>
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
        
        <!-- Submission Buttons -->
        <div class="mb-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Changes
            </button>
            <a href="{{ route('admin.extortion.view', $report->id) }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection 