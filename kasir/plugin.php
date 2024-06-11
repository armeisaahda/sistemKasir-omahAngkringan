<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Logout?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Setelah <b>Logout</b>, untuk masuk ke sistem ini anda diharuskan <b>Login</b> terlebih.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn bg-black text-yellow" href="../logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>


<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../js/sb-admin-2.min.js"></script>
<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../vendor/chart.js/Chart.min.js"></script>
<script src="../js/demo/chart-area-demo.js"></script>
<script src="../js/demo/chart-pie-demo.js"></script>
<script src="../js/demo/datatables-demo.js"></script>
<script src="../vendor/sweetalert2/dist/sweetalert2.min.js"></script>


<?php
$sql = "SELECT pesanan.id_produk,  SUM(pesanan.jumlah) AS total_jumlah, produk.nama 
FROM pesanan
INNER JOIN produk ON pesanan.id_produk = produk.id GROUP BY pesanan.id_produk";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();
?>
<script>
    window.onload = function() {
        var data = <?php echo json_encode($data); ?>;
        var chartData = data.map(item => ({
            label: item.nama,
            y: parseFloat(item.total_jumlah)
        }));

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {

            },
            data: [{
                type: "column",
                dataPoints: chartData
            }]
        });
        chart.render();
    }
</script>