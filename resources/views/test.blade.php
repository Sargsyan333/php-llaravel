<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>
<body>


<script>

    $(document).ready(function () {
        var headers = {
            'X-AppSecretToken': "BHTEqCFYsEqJhaYmgMEqi3uBsq3W8MA11z82RUEhYtA1",
            'X-AgreementGrantToken': "38guGima7DtfTWX8jkLpdpQ61H9pSHJLkogBbYEpws81",
            'Content-Type': "application/json"
        };

        var invoice = {
            "date": "2019-07-29",
            "currency": "DKK",
            "paymentTerms": {
                "paymentTermsNumber": 4,
                "daysOfCredit": 14,
                "name": "Netto 14 dage",
                "paymentTermsType": "net",
                "self": "https://restapi.e-conomic.com/payment-terms/4"
            },
            "customer": {
                "customerNumber": 1
            },
            "recipient": {
                "name": "Toj & Co Grossisten",
                "address": "Vejlevej 21",
                "zip": "7000",
                "city": "Fredericia",
                "vatZone": {
                    "name": "Domestic",
                    "vatZoneNumber": 1,
                    "enabledForCustomer": true,
                    "enabledForSupplier": true
                }
            },

            "layout": {
                "layoutNumber": 19
            },
            "lines": [
                {
                    "lineNumber": 1,
                    "sortKey": 1,
                    "unit": {
                        "unitNumber": 1,
                        "name": "Stk."
                    },
                    "product": {
                        "productNumber": "150150"
                    },
                    "quantity": 1.00,
                    "unitNetPrice": 200.00,
                    "discountPercentage": 0.00,
                    "totalNetAmount": 200.00
                }
            ]
        };

        var product = {
            "productNumber": "7A4s5e11e2d",
                "name": "My test product",
                // 'costPrice': 50,
                // 'salesPrice': 100,
                "productGroup": {
                "productGroupNumber": 1,
                    "self": "https://restapi.e-conomic.com/product-groups/1"
            }
        };

        $(document).ready(function () {
            $('#input').text(JSON.stringify(invoice, null, 4));
            $.ajax({
                url: "https://restapi.e-conomic.com/invoices/drafts",
                dataType: "json",
                headers: headers,
                data: JSON.stringify(invoice),
                contentType: 'application/json; charset=UTF-8',
                type: "POST"
            }).always(function (data) {
                $('#output').text(JSON.stringify(data, null, 4));
            });

            /**
             * Get Products
             */
            // $.ajax({
                //     url: "https://restapi.e-conomic.com/products",
                //     dataType: "json",
                //     headers: headers,
                //     contentType: 'application/json; charset=UTF-8',
                //     type: "POST",
                //     success: function (data) {
                //         console.log("***");
                //         console.log(data);
                //     }
                // });

                //
                // $.ajax({
                //     url: "https://restapi.e-conomic.com/products",
                //     dataType: "json",
                //     headers: headers,
                //     contentType: 'application/json; charset=UTF-8',
                //     type: "POST",
                //     data: JSON.stringify(product),
                //     success: function (data) {
                //         console.log("***");
                //         console.log(data);
                //     }
                // });


            // const settings = {
            //     "crossDomain": true,
            //     "url": "https://restapi.e-conomic.com/products",
            //     "method": "POST",
            //         "headers": {
            //             "x-appsecrettoken": "BHTEqCFYsEqJhaYmgMEqi3uBsq3W8MA11z82RUEhYtA1",
            //             "x-agreementgranttoken": "38guGima7DtfTWX8jkLpdpQ61H9pSHJLkogBbYEpws81",
            //             "content-type": "application/json",
            //         },
            //     "data": {
            //
            //             "productNumber": "7A4s5e11e2d",
            //             "name": "My test product",
            //             // 'costPrice': 50,
            //             // 'salesPrice': 100,
            //             "productGroup": {
            //                 "productGroupNumber": 1,
            //                 "self": "https://restapi.e-conomic.com/product-groups/1"
            //             }
            //
            //     }
            // };
            //
            // $.ajax(settings).done(function (response) {
            //     console.log(response);
            // });




        });
    })

</script>


</body>
</html>