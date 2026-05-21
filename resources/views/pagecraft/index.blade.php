@extends('layouts.pagecraft')

@section('title', 'PageCraft - Upload JSON')

@section('content')
<div style="background:white;padding:40px;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,0.1);text-align:center;">
    <h1 style="color:#1a1d2e;font-size:32px;font-weight:800;margin-bottom:8px;">
        <i class="fa fa-wand-magic-sparkles" style="color:#5b52f0;"></i>
        PageCraft Live Preview
    </h1>
    <p style="color:#4a5270;font-size:16px;margin-bottom:32px;">Upload your PageCraft JSON to see it live</p>
    
    <form method="POST" action="{{ route('pagecraft.upload') }}" enctype="multipart/form-data" style="max-width:500px;margin:0 auto;">
        @csrf
        <div style="margin-bottom:24px;">
            <label style="display:block;margin-bottom:8px;font-weight:600;color:#1a1d2e;">Choose JSON File</label>
            <input type="file" name="json_file" accept=".json" required 
                   style="width:100%;padding:12px;border:2px dashed #d6dae4;border-radius:8px;font-size:14px;">
        </div>
        <button type="submit" style="width:100%;padding:14px 24px;background:#5b52f0;color:white;border:none;border-radius:8px;font-size:16px;font-weight:600;cursor:pointer;transition:all 0.2s;">
            <i class="fa fa-eye"></i> Preview Live
        </button>
    </form>
    
    <div style="margin-top:32px;padding-top:24px;border-top:1px solid #edf0f4;">
        <p style="color:#8a90a8;font-size:14px;">
            Or <a href="{{ route('pagecraft.preview') }}" style="color:#5b52f0;font-weight:600;">try demo</a>
        </p>
    </div>
</div>
@endsection