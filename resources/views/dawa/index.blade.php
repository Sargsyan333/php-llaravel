<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fetch/2.0.3/fetch.min.js"></script>
    <script src="{{ asset('node_modules/dawa-autocomplete2/dist/js/dawa-autocomplete2.min.js') }}"></script>

</head>
<body>

<div class="container">
    <h1>DAWA Page</h1>

    <div class="form-group">
        <label for="adresse">Autocomplete address:</label>
        <input type="text" class="form-control" id="adresse">
        <p>
            Address: <span class="text-primary" id="valgtadresse" style="font-size: 18px"></span>
        </p>
    </div>

</div>

<script>
    dawaAutocomplete.dawaAutocomplete( document.getElementById("adresse"), {
        select: function(selected) {
            document.getElementById("valgtadresse").innerHTML= selected.tekst;
        }
    });
</script>

</body>
</html>
