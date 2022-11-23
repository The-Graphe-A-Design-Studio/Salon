<?php
    error_reporting (E_ALL ^ E_NOTICE);

    include('session.php');
    include('layout.php');

    $download = $_GET['download'] ? : 'no';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Export Customers | diva lounge spa</title>
    <link rel="icon" href="assets/img/diva-logo-sm.png" type="image/gif" sizes="32x32">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" 
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <style>
        .table{
            font-size: 0.8rem;
        }
        .table th{
            vertical-align: middle;
        }
    </style>
</head>
<body class="p-3">
    <div class="d-flex justify-content-end align-items-center w-100">
        <input type="text" id="downloadFlag" value="<?php echo $download; ?>" hidden>
        <button class="btn btn-primary" id="btnExport" onclick="ExportToExcel('xlsx')">Export</button>
    </div>
    <div class="table-responsive text-nowrap mt-3">
        <table id="tbl_exporttable_to_xls" class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th colspan="17">Diva Lounge Spa : All Customers</th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Whatsapp</th>
                    <th>Email</th>
                    <th>Birthday</th>
                    <th>Anniversary</th>
                    <th>Work Phone</th>
                    <th>Qatar ID</th>
                    <th>Category</th>
                    <th>Address</th>
                    <th>Skin Allergy</th>
                    <th>Back Problem</th>
                    <th>Blood Pressure</th>
                    <th>Hear about us</th>
                    <th>Others</th>
                    <th>Registered</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $connect = new PDO("mysql:host=$hostName; dbname=$dbName", $userName, $password);
                    $query = "select * from cust_name_phone where reg = 1";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();

                    foreach($result as $row)
                    {
                ?>
                <tr>
                    <td><?php echo $row['cust_id']; ?></td>
                    <td><?php echo $row['cust_name'].' '.$row['last_name']; ?></td>
                    <td><?php echo $row['con_cust_phone'].' '.$row['cust_phone']; ?></td>
                    <td><?php echo $row['con_whatsapp_num'].' '.$row['whatsapp_num']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['birthday']; ?></td>
                    <td><?php echo $row['anniversary']; ?></td>
                    <td><?php echo $row['con_work_phone'].' '.$row['work_phone']; ?></td>
                    <td><?php echo $row['qatar_id']; ?></td>
                    <td><?php echo $row['cust_category']; ?></td>
                    <td>
                        <span class="text-break">
                            <?php echo $row['address_1'].', '.$row['address_2'].', '.$row['address_3'].', '.$row['city'].
                                    '- '.$row['zip'].', '.$row['state'].', '.$row['country']; ?>
                        </span>
                    </td>
                    <td><?php echo $row['skin_allergy']; ?></td>
                    <td><?php echo $row['back_problem']; ?></td>
                    <td><?php echo $row['blood_pressure']; ?></td>
                    <td><?php echo $row['hear_ab_us']; ?></td>
                    <td><?php echo $row['others']; ?></td>
                    <td><?php echo date_format(date_create($row['joined_on']), 'd M, Y'); ?></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

    <script>

        $(document).ready(function() {
            if($('#downloadFlag').val() === 'yes')
            {
                setTimeout(function() {
                    ExportToExcel('xlsx');
                }, 1000);
                setTimeout(function() {
                    close();
                }, 10000);
            }            
        });

        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('tbl_exporttable_to_xls');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                XLSX.writeFile(wb, fn || ('customers.' + (type || 'xlsx')));
        }
    </script>
</body>
</html>