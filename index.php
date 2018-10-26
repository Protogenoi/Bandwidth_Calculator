<?php

require 'bootstrap.php';


$numberOfAdmin = isset($_POST['numberOfAdmin']) ? $_POST['numberOfAdmin']
    : null;
$numberOfCloser = isset($_POST['numberOfCloser']) ? $_POST['numberOfCloser']
    : null;
$numberOfAgent = isset($_POST['numberOfAgent']) ? $_POST['numberOfAgent']
    : null;

$downloadUsageAdmin = isset($_POST['downloadUsageAdmin'])
    ? $_POST['downloadUsageAdmin'] : null;
$downloadUsageCloser = isset($_POST['downloadUsageCloser'])
    ? $_POST['downloadUsageCloser'] : null;
$downloadUsageAgent = isset($_POST['downloadUsageAgent'])
    ? $_POST['downloadUsageAgent'] : null;

$uploadUsageAdmin = isset($_POST['uploadUsageAdmin'])
    ? $_POST['uploadUsageAdmin'] : null;
$uploadUsageCloser = isset($_POST['uploadUsageCloser'])
    ? $_POST['uploadUsageCloser'] : null;
$uploadUsageAgent = isset($_POST['uploadUsageAgent'])
    ? $_POST['uploadUsageAgent'] : null;

$admin = new \Service\Calculator();
$admin->setEmployeeRole('Admin');
$admin->setNumberOfEmployees($numberOfAdmin);
$admin->setDownloadUsage($downloadUsageAdmin);
$admin->setUploadUsage($uploadUsageAdmin);

$closer = new \Service\Calculator();
$closer->setEmployeeRole('Closer');
$closer->setNumberOfEmployees($numberOfCloser);
$closer->setDownloadUsage($downloadUsageCloser);
$closer->setUploadUsage($uploadUsageCloser);

$agent = new \Service\Calculator();
$agent->setEmployeeRole('Agent');
$agent->setNumberOfEmployees($numberOfAgent);
$agent->setDownloadUsage($downloadUsageAgent);
$agent->setUploadUsage($uploadUsageAgent);


/*$admin = new \Service\Calculator();
$admin->setEmployeeRole('Admin');
$admin->setNumberOfEmployees($numberOfAdmin);
$admin->setDownloadUsage(200);
$admin->setUploadUsage(250);

$closer = new \Service\Calculator();
$closer->setEmployeeRole('Closer');
$closer->setNumberOfEmployees($numberOfCloser);
$closer->setDownloadUsage(153);
$closer->setUploadUsage(226);

$agent = new \Service\Calculator();
$agent->setEmployeeRole('Agent');
$agent->setNumberOfEmployees($uploadUsageAdmin);
$agent->setDownloadUsage(110);
$agent->setUploadUsage(105);*/

?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bandwidth Calculator</title>
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>

</head>
<body>

<div class="container">

    <table class="table">
        <caption>Bandwidth calculator</caption>
        <thead>
        <tr>
            <th>Employee</th>
            <th>Employed Count</th>
            <th>Avg Download Usage</th>
            <th>Avg Upload Usage</th>
            <th>Download Req (Mb)</th>
            <th>Uploaded Req (Mb)</th>
        </tr>
        </thead>

        <form method="POST">
            <tbody>
            <tr>
                <td>Closer</td>
                <td><input type="text" name="numberOfCloser"
                           value="<?php echo $closer->getNumberOfEmployees(); ?>"
                           placeholder="Number of closers"></td>
                <td><input type="text" name="downloadUsageCloser"
                           value="<?php echo $closer->getDownloadUsage(); ?>"
                           placeholder="Avg download kbps"></td>
                <td><input type="text" name="uploadUsageCloser"
                           value="<?php echo $closer->getUploadUsage(); ?>"
                           placeholder="Avg upload kbps"></td>
                <td><?php echo $closer->calculateDownloadBw(); ?></td>
                <td><?php echo $closer->calculateUploadBw(); ?></td>

            </tr>
            <tr>
                <td>Agent</td>
                <td><input type="text" name="numberOfAgent"
                           value="<?php echo $agent->getNumberOfEmployees(); ?>"
                           placeholder="Number of agents"></td>
                <td><input type="text" name="downloadUsageAgent"
                           value="<?php echo $agent->getDownloadUsage(); ?>"
                           placeholder="Avg download kbps"></td>
                <td><input type="text" name="uploadUsageAgent"
                           value="<?php echo $agent->getUploadUsage(); ?>"
                           placeholder="Avg upload kbps"></td>
                <td><?php echo $agent->calculateDownloadBw(); ?></td>
                <td><?php echo $agent->calculateUploadBw(); ?></td>

            </tr>
            <tr>
                <td>Admin</td>
                <td><input type="text" name="numberOfAdmin"
                           value="<?php echo $admin->getNumberOfEmployees(); ?>"
                           placeholder="Number of admins"></td>
                <td><input type="text" name="downloadUsageAdmin"
                           value="<?php echo $admin->getDownloadUsage(); ?>"
                           placeholder="Avg download kbps"></td>
                <td><input type="text" name="uploadUsageAdmin"
                           value="<?php echo $admin->getUploadUsage(); ?>"
                           placeholder="Avg upload kbps"></td>
                <td><?php echo $admin->calculateDownloadBw(); ?></td>
                <td><?php echo $admin->calculateUploadBw(); ?></td>

            </tr>
            </tbody>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </table>


    <div class="col-md"> Download:
        <?php echo $closer->totalBw($closer->calculateDownloadBw(),
            $agent->calculateDownloadBw(), $closer->calculateDownloadBw()) ?>
    </div>

    <div class="col-md"> Upload:
        <?php echo $closer->totalBw($closer->calculateUploadBw(),
            $agent->calculateUploadBw(), $closer->calculateUploadBw()) ?>
    </div>

</div>
</body>
</html>
