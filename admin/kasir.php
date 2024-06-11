<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "link.php"; ?>
    <style>
        .cart-items {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 10px;
            transition: box-shadow 0.3s ease;
        }

        .cart-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .cart-item img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 15px;
        }

        .cart-item-details p {
            margin: 0;
            padding: 0;
            font-size: 16px;
            color: #333;
        }

        .quantity-controls {
            margin-left: auto;
            display: flex;
            align-items: center;
        }

        .quantity-controls button {
            background: #007BFF;
            color: white;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            font-size: 16px;
        }

        .quantity-controls input {
            width: 50px;
            text-align: center;
            margin: 0 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            height: 32px;
        }

        .remove-from-cart {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            margin-left: 10px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .cart-summary {
            padding: 10px;
            background: #f8f9fa;
            border-top: 1px solid #dee2e6;
            text-align: right;
            margin-top: 10px;
        }

        .checkout-btn {
            background-color: #000000;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">

        <?php include "sidebar.php"; ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include "topbar.php"; ?>

                <div class="container-fluid d-flex">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="row">
                                <?php $produk = mysqli_query($conn, "SELECT * FROM produk"); ?>
                                <?php foreach ($produk as $p) : ?>
                                    <div class="col-6 col-md-4 mb-4">
                                        <div class="card h-100 clickable-card" data-id="<?= $p['id']; ?>">
                                            <img src="../gambar_produk/<?= $p['gambar']; ?>" style="height: 200px;" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title text-sm text-center"><?= $p['nama']; ?></h5>
                                                <b>
                                                    <p class="text-sm text-center">Rp<?= number_format($p['harga'], 0, ',', '.'); ?></p>
                                                </b>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <h2>Keranjang</h2>
                            <div class="cart-items"></div>
                            <div class="cart-summary">
                                <div class="total">
                                    Total: <span class="total-price">0.00</span>
                                </div>
                                <button class="checkout-btn">Checkout</button>
                            </div>
                        </div>
                    </div>



                </div>

            </div>

            <?php include "footer.php"; ?>

        </div>

    </div>
    <div class="modal fade" id="qrisModal" tabindex="-1" role="dialog" aria-labelledby="qrisModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrisModalLabel">Metode Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body column d-flex justify-content-center">
                    <div class="title float-center">
                        Total <span id="totalModalPrice">Rp. 0.00</span>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="box-img">
                            <img src="../img/money.png" alt="Bayar Cash" class="mr-3 payment-option" data-payment="cash">
                        </div>
                        <div class="box-img">
                            <img src="../img/qr.png" alt="QRIS" class="payment-option" data-payment="qris">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Cash Payment -->
    <div class="modal fade" id="cashModal" tabindex="-1" role="dialog" aria-labelledby="cashModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cashModalLabel">Pembayaran Tunai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Anda telah memilih untuk membayar secara tunai.</p>
                    <p>Total yang harus dibayar: <span id="cashTotalPrice">Rp. 0.00</span></p>
                    <div class="form-group">
                        <label for="cashAmount">Jumlah Uang</label>
                        <input type="text" class="form-control" id="cashAmount" placeholder="Masukkan jumlah uang">
                    </div>
                    <p>Kembalian: <span id="cashChange">Rp. 0.00</span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary confirm-payment-btn">Saya sudah membayar</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal for QRIS Payment -->
    <div class="modal fade" id="qrisPaymentModal" tabindex="-1" role="dialog" aria-labelledby="qrisPaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrisPaymentModalLabel">Scan QRIS untuk Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="../img/qr.png" alt="QRIS Code" class="img-fluid">
                    <p class="mt-3">Total yang harus dibayar: <span id="qrisTotalPrice">Rp. 0.00</span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary confirm-payment-btn">Saya sudah membayar</button>
                </div>
            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include "plugin.php"; ?>
    <script>
        $(document).ready(function() {
            updateCartDisplay();

            $('.card').click(function() {
                var idProduk = $(this).data('id');
                $.ajax({
                    url: 'addToCart.php',
                    method: 'POST',
                    data: {
                        id_produk: idProduk,
                        action: 'add_to_cart'
                    },
                    success: function() {
                        updateCartDisplay();
                    }
                });
            });

            function updateCartDisplay() {
                $.ajax({
                    url: 'cartItems.php',
                    method: 'POST',
                    data: {
                        action: 'get_cart_view'
                    },
                    success: function(response) {
                        $('.cart-items').html(response);
                        updateCartTotal();
                    }
                });
            }

            function updateCartTotal() {
                var total = 0;
                $('.cart-item').each(function() {
                    var priceText = $(this).find('.price').text().trim(); // Misal "Rp10.000,00"
                    // Menghapus "Rp" dan semua titik, lalu mengganti koma dengan titik untuk penghitungan
                    var price = parseFloat(priceText.replace('Rp', '').replace(/\./g, '').replace(',', '.'));
                    var quantity = parseInt($(this).find('.quantity').val(), 10);
                    total += price * quantity;
                });
                // Menampilkan total dalam format Rupiah
                $('.total-price').text(new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(total));

                // Update total price in modal
                var formattedTotal = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(total);

                $('#totalModalPrice').text(formattedTotal);
                $('#cashTotalPrice').text(formattedTotal);
                $('#qrisTotalPrice').text(formattedTotal);
            }

            $(document).on('click', '.increase-quantity, .decrease-quantity', function() {
                var itemId = $(this).data('id');
                var action = $(this).hasClass('increase-quantity') ? 'increase' : 'decrease';
                $.ajax({
                    url: 'update_quantity.php',
                    type: 'POST',
                    data: {
                        id_pesanan: itemId,
                        action: action
                    },
                    success: function() {
                        updateCartDisplay();
                    }
                });
            });

            $(document).on('click', '.remove-from-cart', function() {
                var itemId = $(this).data('id');
                $.ajax({
                    url: 'remove_from_cart.php',
                    type: 'POST',
                    data: {
                        id_pesanan: itemId
                    },
                    success: function() {
                        updateCartDisplay();
                    }
                });
            });

            $('.checkout-btn').on('click', function(e) {
                e.preventDefault(); // Mencegah form dari submit biasa
                if ($('.cart-item').length === 0) {
                    alert('Keranjang Anda kosong.');
                    return;
                }

                // Show the QRIS modal
                $('#qrisModal').modal('show');
            });

            $(document).on('click', '.payment-option', function() {
                var paymentMethod = $(this).data('payment');
                $('#qrisModal').modal('hide');

                if (paymentMethod === 'cash') {
                    $('#cashModal').modal('show');
                } else if (paymentMethod === 'qris') {
                    $('#qrisPaymentModal').modal('show');
                }
            });

            $(document).on('input', '#cashAmount', function() {
                var cashAmount = parseFloat($(this).val().replace(/\./g, '').replace(',', '.'));
                var total = parseFloat($('.total-price').text().replace('Rp', '').replace(/\./g, '').replace(',', '.'));

                if (cashAmount && cashAmount >= total) {
                    var change = cashAmount - total;
                    $('#cashChange').text(new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }).format(change));
                } else {
                    $('#cashChange').text('Rp. 0.00');
                }
            });

            $('.confirm-payment-btn').on('click', function() {
                var paymentMethod = $(this).closest('.modal').attr('id');
                var cashAmount = parseFloat($('#cashAmount').val().replace(/\./g, '').replace(',', '.'));
                var total = parseFloat($('.total-price').text().replace('Rp', '').replace(/\./g, '').replace(',', '.'));

                if (paymentMethod === 'cashModal' && (!cashAmount || cashAmount < total)) {
                    alert('Jumlah uang tidak cukup.');
                    return;
                }

                var change = cashAmount - total;

                $.ajax({
                    url: 'checkout.php',
                    method: 'POST',
                    data: {
                        action: 'complete_order'
                    },
                    success: function(response) {
                        var url = 'downloadbill.php?' + $.param({
                            total: total,
                            cashAmount: cashAmount,
                            change: change,
                            paymentMethod: paymentMethod
                        });
                        alert('Pesanan Anda telah berhasil diproses!');
                        var downloadWindow = window.open(url, '_blank');

                        // Menunggu hingga window downloadbill.php ditutup
                        downloadWindow.onbeforeunload = function() {
                            // Alihkan kembali ke kasir.php
                            window.location.href = 'kasir.php';
                        };

                        $('.cart-items').html('');
                        $('.total-price').text('0.00');
                        alert('Pesanan Anda telah berhasil diproses!');
                        window.location.href = 'kasir.php';

                    },
                    error: function() {
                        alert('Terjadi kesalahan saat memproses checkout.');
                    }
                });
            });


            // function printReceipt(total, cashAmount, change, paymentMethod) {
            //     var receiptWindow = window.open('', 'Print Receipt', 'height=600,width=800');
            //     receiptWindow.document.write('<html><head><title>Struk Pembayaran</title>');
            //     receiptWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');
            //     receiptWindow.document.write('</head><body>');
            //     receiptWindow.document.write('<div class="container">');
            //     receiptWindow.document.write('<h1>Struk Pembayaran</h1>');
            //     receiptWindow.document.write('<p>Terima kasih telah berbelanja!</p>');
            //     receiptWindow.document.write('<p>Total yang dibayar: ' + formatCurrency(total) + '</p>');
            //     if (paymentMethod === 'cashModal') {
            //         receiptWindow.document.write('<p>Jumlah uang: ' + formatCurrency(cashAmount) + '</p>');
            //         receiptWindow.document.write('<p>Kembalian: ' + formatCurrency(change) + '</p>');
            //     } else if (paymentMethod === 'qrisPaymentModal') {
            //         receiptWindow.document.write('<p>Metode Pembayaran: QRIS</p>');
            //     }
            //     receiptWindow.document.write('</div>');
            //     receiptWindow.document.write('</body></html>');
            //     receiptWindow.document.close();
            //     receiptWindow.print();
            // }

            // function formatCurrency(amount) {
            //     return new Intl.NumberFormat('id-ID', {
            //         style: 'currency',
            //         currency: 'IDR',
            //         minimumFractionDigits: 2,
            //         maximumFractionDigits: 2
            //     }).format(amount);
            // }
        });
    </script>


</body>

</html>