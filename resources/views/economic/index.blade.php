<!DOCTYPE html>
<html lang="en">
<head>
    <title>Economic</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Account Get All Result</h2>
    <p></p>
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>Number</th>
        </tr>
        </thead>
        <tbody>
            @foreach($result->Account_GetAllResult->AccountHandle as $r)
                <tr>
                    <td>{{ $r->Number }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>


