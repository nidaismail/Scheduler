<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resource Requested</title>
</head>
<body>
    <h1>New Resource Request!</h1>
    <p>Hello,</p>
    <p>A new resource has been requested</p>
    
    
    <!-- Additional content here -->
    <table>
        <tr>
            <td><strong>Start Date:</strong></td>
            <td>{{ $requestData['start_date'] }}</td>
        </tr>
        <tr>
            <td><strong>End Date:</strong></td>
            <td>{{ $requestData['end_date'] }}</td>
        </tr>
        <!-- Add more rows for other form fields -->
    </table>

</body>
</html>
