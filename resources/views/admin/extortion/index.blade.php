@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Political Extortion Reports</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Extortion Reports</li>
    </ol>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Extortion Reports
        </div>
        <div class="card-body">
            <table id="extortionReportsTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date Reported</th>
                        <th>Political Affiliation</th>
                        <th>Business Name</th>
                        <th>Location</th>
                        <th>Approach Method</th>
                        <th>Status</th>
                        <th>Verified</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($extortionReports as $report)
                        <tr>
                            <td>{{ $report->id }}</td>
                            <td>{{ $report->created_at->format('Y-m-d') }}</td>
                            <td>{{ $report->extortionist->political_affiliation ?? 'Unknown' }}</td>
                            <td>{{ $report->extortionist->business_name ?? 'Unknown' }}</td>
                            <td>
                                {{ $report->extortionist->business_address_district ?? '' }}, 
                                {{ $report->extortionist->business_address_upazila ?? '' }}
                            </td>
                            <td>{{ $report->extortionist->approach_method ?? 'Unknown' }}</td>
                            <td>
                                <span class="badge @if($report->extortionist->status === 'allegedly') bg-warning
                                      @elseif($report->extortionist->status === 'confirmed') bg-danger
                                      @elseif($report->extortionist->status === 'disproven') bg-success
                                      @endif">
                                    {{ ucfirst($report->extortionist->status ?? 'Unknown') }}
                                </span>
                            </td>
                            <td>
                                @if($report->verified)
                                    <span class="badge bg-success">Verified</span>
                                @else
                                    <span class="badge bg-secondary">Unverified</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.extortion.view', $report->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('admin.extortion.edit', $report->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No extortion reports found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#extortionReportsTable').DataTable({
            order: [[1, 'desc']]
        });
    });
</script>
@endsection 