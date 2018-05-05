<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
</head>
<body>
<table id="example" class="display">
    <thead>
    <tr>
        <th>Column 1</th>
        <th>Column 2</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Row 1 Data 1</td>
        <td>Row 1 Data 2</td>
    </tr>
    <tr>
        <td>Row 2 Data 1</td>
        <td>Row 2 Data 2</td>
    </tr>
    </tbody>
</table>

<script>
    $(document).ready( function () {
        $('#example').DataTable({
            'responsive' : true,
        });
    } );
</script>
</body>
</html>