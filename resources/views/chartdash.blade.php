<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chartisan example</title>
</head>
<body>
<!-- Chart's container -->
<div id="chart" style="height: 300px;"></div>

<!-- Your application script -->
<script>
    const chart = new Chartisan({
        el: '#chart',
        url: "@chart('dash_chart')",
    });
</script>
</body>
</html>
