<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create CV</title>
    <link rel="stylesheet" href="styles/pdf.css">
</head>
<header>
    <div class="title-center">
        <h2>CV</h2>
    </div>
    @if (isset($inputs[0]['name']) or isset($inputs[0]['phone']) or isset($inputs[0]['email']) or isset($inputs[0]['living_place']))
        @foreach ($inputs as $key => $input)
        <div class="ptn">
            <h2 class="text-white">{{ $input['name'] }}</h2>
        </div>
        <div class="personal-data">
            <div class="font-bold">
               <span id="phone" class="font-slim"><span class="text-dark">{{ $input['phone'] }}</span></span>
            </div>
            <div class="font-bold">E-mail: <span class="font-slim text-dark">{{ $input['email'] }}</span></div>
            <div class="font-bold">Living Place: <span class="font-slim text-dark">{{ $input['living_place'] }}</span></div>
            <span class="picture">
               <img src="{{ public_path('pictures/cv/' . $input['file'][$key]) }}" width="75" height="97" alt="">
            </span>
        </div>
       @endforeach
    @endif
</header>
<body>
<div class="content">
    <div class="professional-experience">
        <div class="list-symbol list-none">
            <h3>Experience:</h3>
            @foreach ($inputs as $input)
                @if (isset($input['from']) or isset($input['to']) or isset($input['position']))
                    <span class="span-header">
                        <p>
                           {{ date_format(date_create($input['from']), "F Y") }}
                           {{ ' - ' }}
                           {{ date_format(date_create($input['to']), "F Y") }}
                           {{ ' | ' }} {{ $input['position'] }}
                        </p>
                        @if (isset($input['company']))
                            <span class="text-orange">
                                @if ($input['company'] && $input['company'] !== null)
                                   <span> //* {{ $input['company'] }} *// </span>
                                @endif
                            </span>
                        @endif
                    </span>
                    @if (isset($input['experience']))
                        <ul>
                            @if ($input['experience'] && $input['experience'] !== null)
                                @foreach ($input['experience'] as $experience)
                                   <li>{{ htmlspecialchars($experience) }}</li>
                                @endforeach
                            @endif
                        </ul>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
    <div class="skills">
        <div class="list-symbol list-none">
            @if (isset($inputs[0]['skill']) and $inputs[0]['skill'] !== null)
            <h3>Skills:</h3>
                <ul>
                    @foreach ($inputs as $input)
                        <li>{{ htmlspecialchars($input['skill']) }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="education">
        <div class="list-symbol list-none">
            @if (isset($inputs[0]['education']) and $inputs[0]['education'] !== null)
                <h3>Education:</h3>
                <ul>
                    @foreach ($inputs as $input)
                        <li>{{ htmlspecialchars($input['education']) }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="interests">
        <div class="list-symbol list-none">
            @if (isset($inputs[0]['interest']) and $inputs[0]['interest'] !== null)
                <h3>Interest:</h3>
                <ul>
                    @foreach ($inputs as $input)
                        <li>{{ htmlspecialchars($input['interest']) }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
</body>
<footer>
    <div class="footer-container">
        <p class="footer">
            @if (isset($inputs[0]['agreement']) and $inputs[0]['agreement'] !== null)
                @foreach ($inputs as $input)
                   {{ htmlspecialchars($input['agreement']) }}
                @endforeach
            @endif
        </p>
    </div>
</footer>
</html>

