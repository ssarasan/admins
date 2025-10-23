<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View File</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        iframe, embed {
            width: 100%;
            height: 100vh;
            border: none;
        }
    </style>
</head>
<body oncontextmenu="return false;">
<?php
$filename = $_REQUEST['filename'];
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' 
    || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$url = $protocol . $host . '/msa-intranet/administrator/uploads/' . $filename;

$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
?>

<?php if ($ext === 'pdf'): ?>
    <!-- For PDF files -->
    <embed 
        src="<?php echo $url; ?>#toolbar=0&scrollbar=0"
        type="application/pdf">
<?php elseif (in_array($ext, ['xls', 'xlsx'])): ?>
    <!-- For Excel files (Office Viewer) -->
    <iframe 
        src="https://view.officeapps.live.com/op/embed.aspx?src=<?php echo urlencode($url); ?>"
        allowfullscreen="true">
    </iframe>
<?php else: ?>
    <p style="text-align:center; margin-top:20px;">Unsupported file format.</p>
<?php endif; ?>

<script>
  // Disable right-click everywhere
  document.addEventListener("contextmenu", e => e.preventDefault());

  // Disable common inspect/save shortcuts
  document.addEventListener("keydown", e => {
    const key = e.key.toLowerCase();
    if (
      (e.ctrlKey && ["s","u","c","p"].includes(key)) ||
      e.key === "F12"
    ) {
      e.preventDefault();
      alert("This action is disabled!");
    }
  });
</script>
</body>
</html>
