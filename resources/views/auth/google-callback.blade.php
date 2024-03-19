<html>

<head>
    <meta charset="utf-8">
    <title>Callback</title>
    <script>
    let data = {
        type: "success",
        data: {
            token: "{{ $data['token'] }}",
            token_expires_at: "{{ $data['token_expires_at'] }}",
            user: "{{ $data['user'] }}",
            hris_token: "{{ $data['hris_token'] }}",
            google: {
                email: "{{ $data['google']['email'] }}",
                email_verified: "{{ $data['google']['email_verified'] }}",
                profile_picture: "{{ $data['google']['profile_picture'] }}",
            }
        }
    }

    console.log(data);

    window.opener.postMessage(data, "{{ env('TREASURY_FRONTEND') }}");
    window.close();
    </script>
</head>

<body>
</body>

</html>