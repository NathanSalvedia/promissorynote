<!DOCTYPE html>
<html>
<body>
    @if($isAdmin)
        <p>Hello {{ $adminName }},</p>
        <p>Promissory note PN-{{ $note->pn_id }} for {{ $note->user->name }} is due tomorrow ({{ $note->due_date }}).</p>
    @else
        <p>Hello {{ $note->user->name }},</p>
        <p>Good day! This is from St. Peters College.</p>
        <p>This is a reminder that your promissory note is due tomorrow ({{ $note->due_date }}).</p>
    @endif
</body>
</html>
