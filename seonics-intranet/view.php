<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View PDF</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        /* Disable text selection globally */
        body {
            -webkit-user-select: none; /* Safari */
            -moz-user-select: none;    /* Firefox */
            -ms-user-select: none;     /* IE10+/Edge */
            user-select: none;         /* Standard */
        }
    </style>
</head>

<body>

    <?php
    $filename = $_REQUEST['filename'];
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' 
        || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $url = $protocol . $host . '/seonics-intranet/administrator/uploads/';
    ?>

    <embed 
        id="popp" 
        src="<?php echo $url . $filename; ?>#toolbar=0&scrollbar=0" 
        width="100%" 
        height="8100px"
        style="pointer-events:none;">
    </embed>

    <script>
// Disable right click
document.addEventListener("contextmenu", function (e) {
  e.preventDefault();
  console.log("Right click is disabled!");
}, false);

// Disable certain key shortcuts (like Ctrl+S, Ctrl+U, F12)
document.addEventListener("keydown", function (e) {
  if (
    e.ctrlKey && 
    (e.key === "u" || e.key === "s" || e.key === "c" || e.key === "Shift") || 
    e.key === "F12"
  ) {
    e.preventDefault();
    alert("This action is disabled!");
  }
});
</script>

</body>
</html>
