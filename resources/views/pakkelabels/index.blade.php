<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pakkelabels</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Pakkelabels products</h2>
    <p></p>

    @isset($account_balance)
        <p>Currency code : {{$account_balance['output']['currency_code']}}</p>
    @endisset

    <table class="table table-condensed">
        <thead>
        <tr>
            <th>Id</th>
            <th>Number</th>
            <th>Code</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products['output'] as $r)
            <tr>
                <td>{{ $r['id'] }}</td>
                <td>{{ $r['name'] }}</td>
                <td>{{ $r['code'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>


