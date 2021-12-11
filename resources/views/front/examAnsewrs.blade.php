<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background: #eee
        }

        .wrapper {
            max-width: 600px;
            margin: 20px auto
        }

        .content {
            padding: 20px;
            padding-bottom: 50px
        }

        a:hover {
            text-decoration: none
        }

        a,
        span {
            font-size: 15px;
            font-weight: 600;
            color: rgb(50, 141, 245);
            padding-bottom: 30px
        }

        p.text-muted {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 5px
        }

        b {
            font-size: 15px;
            font-weight: bolder
        }

        .option {
            display: block;
            height: 50px;
            background-color: #f4f4f4;
            position: relative;
            width: 100%
        }

        .option:hover {
            background-color: #e8e8e8;
            cursor: pointer
        }

        .option input {
            position: absolute;
            opacity: 0;
            cursor: pointer
        }

        .checkmark,
        .crossmark {
            position: absolute;
            top: 10px;
            right: 10px;
            height: 22px;
            width: 22px;
            background-color: #f4f4f4;
            border-radius: 2px;
            padding: 0
        }

        .option:hover input ~ .checkmark,
        .option:hover input ~ .crossmark {
            background-color: #e8e8e8
        }

        .option input:checked ~ .checkmark {
            background-color: #79d70f
        }

        .option input:checked ~ .crossmark {
            background-color: #ec3838
        }

        .checkmark:after,
        .crossmark:after {
            content: "\2714";
            position: absolute;
            background-color: #79d70f;
            display: none;
            color: #fff;
            padding-left: 4px;
            width: 22px;
            font-size: 16px
        }

        .crossmark:after {
            content: "\2715";
            background-color: #ec3838
        }

        .option input:checked ~ .checkmark:after,
        .option input:checked ~ .crossmark:after {
            display: block;
            transition: 100ms ease-out 1s
        }

        p.mb-4 {
            border-left: 3px solid green
        }

        p.my-2 {
            border-left: 3px solid red
        }

        input[type="submit"] {
            width: 100%;
            height: 50px;
            background-color: #229aeb;
            border: none;
            outline: none;
            color: #fff;
            font-weight: 600;
            cursor: pointer
        }

        input[type="submit"]:hover:focus {
            border: none;
            outline: none;
            background-color: #229bebad
        }</style>
</head>
<body oncontextmenu='return false' class='snippet-body'>
<div class="wrapper bg-white rounded">
    <div class="content">
        <a onclick="history.back()">
            <span class="fa fa-angle-left pr-2"></span>
            العوده لصفحه نتائج اﻻمتحانات
        </a>
        @foreach($questionsAnsewrs as $questionsAnsewr)
            <p class="text-justify h5 pb-2 font-weight-bold">
                {{$questionsAnsewr['question']['question_text']}}
            </p>
            @if(strlen($questionsAnsewr['question']['question_img']) > 0)
                <img style="width:100px;height:100px;" src="{{$questionsAnsewr['question']['question_img']}}">
            @endif
            <div class="options py-3">
                @php
                    $rightAnsewr = '';
                @endphp
                @foreach($questionsAnsewr['question']['answers'] as $answer)
                    @if(strlen($answer['image_ansewr']) > 0)
                        <div class="rounded p-2 option {{$answer['is_correct']==true?'bg-success':'bg-danger'}}">
                            <img style="width:100px;height:100px;" src="{{$answer['image_ansewr']}}">
                        </div>
                    @else
                        <label class="rounded p-2 option {{$answer['is_correct']==true?'bg-success':'bg-danger'}}">
                            {{$answer['text']}}
                            <span class="crossmark"></span>
                        </label>
                        @if($answer['is_correct']==true)
                            @php
                                $rightAnsewr = '';
                            @endphp
                        @endif
                    @endif
                @endforeach
            </div>
        @endforeach

    </div>
</div>
<script type='text/javascript'
        src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
<script type='text/javascript' src=''></script>
<script type='text/javascript' src=''></script>
<script type='text/Javascript'></script>
</body>
</html>
