<html >
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            body {
                font-family: DejaVu Sans, sans-serif;
                text-align:right;
            }
            table, th, td {
                border: 1px solid black;
            }
            th, td {
                padding: 15px;
            }
        </style>
    </head>
    <body dir="rtl">

            <table style="width:100%">
                <thead>
                <tr>
                    <td>اسم الدرس</td>
                    <td>الكود</td>
                    <td>QR</td>
                </tr>
                </thead>
                <tbody>
                    @foreach($qrArray as $qr)
                        <tr>
                            <td><center>{{$qr['lessonTitle']}}</center></td>
                            <td><center>{{$qr['text']}}</center></td>
                            <td padding="10px"><center> <img class="" src="{{$qr['img']}}"></center></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

    </body>
</html>
