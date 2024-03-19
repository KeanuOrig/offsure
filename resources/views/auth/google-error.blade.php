<html>
<head>
  <meta charset="utf-8">
  <title>Error</title>
  <script>
    let data = {
      type: "error",
      message: "{{ $message }}",
    }

    window.opener.postMessage(data, "{{ env('TREASURY_FRONTEND') }}");

    console.log(data);
    window.close();
  </script>
</head>
<body>
</body>
</html>
