<!DOCTYPE html>
<html>
<body>
    <h2>Promissory Note Recorded</h2>
    <p>Hello {{ $note->user->fullname }},</p>
    <p>Good day! This is from St. Peters College.</p>
    <p>
      Your payment of <strong>₱{{ number_format($set1Table5Balance, 2) }}</strong> for Promissory Note #{{ $note->pn_id }} has been recorded.
    </p>
    <p>Thank you!</p>
</body>
</html>
