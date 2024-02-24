<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Notification</title>

</head>
<body>

    <div class="email-template-wrapper">

    <table>
        @foreach($data as $key => $value)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $value }}</td>
            </tr>
        @endforeach
    </table>

</div>

</body>
</html>


