@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Promissory Note PDF</title>
    <link rel="stylesheet" href="{{ public_path('pdf-tailwind.css') }}">
    <style>
        body { background: #f3f4f6; font-family: DejaVu Sans, Arial, Helvetica, sans-serif; }
        @page { margin: 20px; }
        .section { border: 1px solid #e5e7eb; border-radius: 12px; background: #fff; margin-bottom: 20px; padding: 16px; }
        .label { font-weight: bold; color: #374151; }
        .value { color: #111827; }
        .title { font-size: 2rem; color: #660809; font-family: 'Times New Roman', Times, serif; font-weight: bold; }
        .subtitle { font-size: 1.2rem; font-weight: bold; margin-top: 10px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        .table td, .table th { border: 1px solid #e5e7eb; padding: 8px; font-family: DejaVu Sans, Arial, Helvetica, sans-serif; }
        .rounded { border-radius: 8px; }
        .center { text-align: center; }
        .mb-2 { margin-bottom: 8px; }
        .mb-4 { margin-bottom: 16px; }
        .mb-8 { margin-bottom: 32px; }
        .mt-2 { margin-top: 8px; }
        .mt-4 { margin-top: 16px; }
        .text-red { color: #b91c1c; }
        .text-blue { color: #2563eb; }
        .img-thumb { border: 1px solid #d1d5db; border-radius: 8px; background: #f3f4f6; padding: 4px; }
    </style>
</head>
<body>
    <div class="section center mb-4">
        <img src="{{ public_path('img/logo.jpg') }}" alt="School Logo" width="80" height="80" style="border-radius: 50%; border: 1px solid #e5e7eb;">
        <div>
            <div class="title mb-2">St. Peter's College</div>
            <div style="font-family: 'Times New Roman', Times, serif; font-size: 1rem;">
                042 Sabayle St, Iligan City, 9200 Philippines<br>
                Contact No.: (063)221-6246 or 222-0460<br>
                Email Address: <span class="text-blue">OPsecretary@spc.edu.ph</span>
            </div>
        </div>
        <div class="subtitle mt-4">PROMISSORY FORM<br><span style="font-size: 1.1rem;">DETAILS</span></div>
    </div>

    <div class="section mb-4">
        <table class="table">
            <tr>
                <td class="label">Date of Application:</td>
                <td class="value">{{ Carbon::parse($note->created_at)->format('F d, Y') }}</td>
                <td class="label">School ID No.:</td>
                <td class="value">{{ $note->user->student_id ?? $note->student_id ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Name of Student:</td>
                <td class="value">{{ $note->user->fullname ?? $note->fullname ?? 'N/A' }}</td>
                <td class="label">Program & Year:</td>
                <td class="value">{{ $note->course ?? '-' }}{{ $note->year_level ? ' - ' . $note->year_level : '' }}</td>
            </tr>
            <tr>
                <td class="label">Contact No.:</td>
                <td class="value">{{ $note->phone ?? '-' }}</td>
                <td class="label">Gender:</td>
                <td class="value">{{ $note->gender ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div class="section mb-4">
        <div class="subtitle center mb-2">Tuition Fee Status</div>
        <table class="table">
            <tr>
                <td class="label">Balance (Assessment):</td>
                <td class="value text-red">&#8369;{{ number_format($assessmentBalance ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td class="label">Partial Payment:</td>
                <td class="value">&#8369;{{ number_format($partialPayment ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td class="label">Downpayment:</td>
                <td class="value">&#8369;{{ number_format($note->downpayment ?? $note->down_payment ?? $note->down_payment_amount ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td class="label">Remaining Balance:</td>
                <td class="value text-red">&#8369;{{ number_format($remainingBalance ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td class="label">Due Date:</td>
                <td class="value">{{ $note->due_date ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Reason:</td>
                <td class="value">{{ $note->reason }}@if(strtolower($note->reason ?? '') === 'other' && !empty($note->other_reason)) - {{ $note->other_reason }}@endif</td>
            </tr>
        </table>
    </div>

    <div class="section mb-4">
        <div class="subtitle mb-2">Attachments:</div>
        @if(isset($images) && count($images) > 0)
            <table class="table">
                <tr>
                    @foreach($images as $imgBase64)
                        <td class="center">
                            <img src="{{ $imgBase64 }}" alt="Attachment" width="120" class="img-thumb mb-2" />
                        </td>
                    @endforeach
                </tr>
            </table>
        @else
            <div class="mt-2" style="color: #6b7280;">No attachments</div>
        @endif
    </div>

    @if(!empty($signatureBase64))
    <div class="section mb-4">
        <div class="subtitle mb-2">Signature:</div>
        <div class="center">
            <img
                src="{{ $signatureBase64 }}"
                alt="Signature"
                width="180"
                class="img-thumb"
                style="background: #fff;"
            />
        </div>
    </div>
    @endif

</body>
</html>
