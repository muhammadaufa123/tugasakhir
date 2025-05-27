<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ get_phrase('Email Notification') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #ffffff;
            color: #000;
            text-align: center;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .email-body {
            padding: 20px;
            color: #333333;
            font-size: 16px;
            line-height: 1.6;
        }

        .email-body p {
            margin: 0 0 10px;
        }

        .email-body .button-container {
            text-align: center;
            margin: 20px 0;
        }

        .email-body a.button {
            display: inline-block;
            background-color: #2f57ef;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
        }

        .email-footer {
            background-color: #f0f3ff;
            color: #2f57ef;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            border-top: 1px solid #dddddd;
        }
    </style>
</head>

<body>
    @php
        $current_route = Route::currentRouteName();
    @endphp
    <div class="email-container">
        <div class="email-header">
            @php 
            $condition = ($current_route == 'register' || $current_route == 'verification.send' || $current_route == 'admin.admins.store' || $current_route == 'admin.instructor.store' || $current_route == 'admin.student.store' || isset($_GET['type']) && $_GET['type'] == 'registration');
            @endphp
            @if ($condition)
                {{ get_phrase('Email Verification Required') }}
            @elseif($current_route == 'password.email')
                {{ get_phrase('Password Reset Required') }}
            @endif
        </div>
        <div class="email-body">
            <p style="text-align: center;">
                @if ($condition)
                    {{ get_phrase('Please click the button below to verify your email address.') }}
                @elseif($current_route == 'password.email')
                    {{ get_phrase('Please click the button below to reset your password.') }}
                @endif
            </p>
            <div class="button-container">
                <a href="{{ $actionUrl }}" class="button">
                    @if ($condition)
                        {{ get_phrase('Verify Email') }}
                    @elseif($current_route == 'password.email')
                        {{ get_phrase('Reset Password') }}
                    @endif
                </a>
            </div>
            @if (!empty($extraMessage))
                <p>{{ $extraMessage }}</p>
            @endif
            <p style="text-align: center;">{{ get_phrase('If you did not request this, you can ignore this email.') }}</p>
            <p style="text-align: center;">{{ get_phrase('Thank you!') }}</p>
        </div>
        <div class="email-footer">
            <p style="text-align: center;">{{ config('app.name') }}</p>
        </div>
    </div>
</body>

</html>