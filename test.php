<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.2.0/css/uikit.min.css">
    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.2.0/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.2.0/js/uikit-icons.min.js"></script>
    <!-- cropzee.js -->
    <script src="https://cdn.jsdelivr.net/gh/BossBele/cropzee@v2.0/dist/cropzee.js" defer></script>
    <!-- google code-prettify -->
    <script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/google/code-prettify@master/styles/sunburst.css">
    <!-- fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Reenie+Beanie">
    <!-- jQuery throttle-debounce -->
    <script src="https://cdn.jsdelivr.net/gh/cowboy/jquery-throttle-debounce/jquery.ba-throttle-debounce.js" defer></script>
    <!-- sanitize.css -->
    <link href="https://unpkg.com/sanitize.css" rel="stylesheet">
</head>
<script>
    $(document).ready(function() {
        $("#input").cropzee();
    });
</script>

<body>
    <div>
        <label for="input" class="image-previewer" data-cropzee="input"></label>
        <input id="input" type="file" accept="image/*" required>
    </div>
</body>

</html>