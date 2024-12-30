<?php
if (empty($title) && empty($page) && empty($pagetitle) && empty($content)) {
    header("Location: ../ ");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/w3.css">
    <script src="./assets/js/employee.js"></script>
    <title><?php echo $title; ?></title>
</head>
<body>
    <div class="w3-padding-large w3-blue w3-card-4">
        <a href="./<?php echo $page;?>.php" style="text-decoration: none;"><h3><?php echo $pagetitle; ?></h3></a>
    </div>
    <div class="w3-container">
        <?php echo $content; ?>
    </div>
    <!--MESSAGE-->
    <?php if(isset($_GET["m"])): ?>
        <?php $m = $_GET["m"]; ?>
        <script>alert("<?php echo $m; ?>");</script>
    <?php endif; ?>
    <!--END OF MESSAGE-->
</body>
</html>