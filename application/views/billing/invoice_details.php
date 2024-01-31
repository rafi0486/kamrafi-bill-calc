<style>
    .act-title{
        cursor: pointer;
    }
    .form-inline label{
        justify-content: left;
    }
    .table tfoot th{text-align: right;}
</style>
<?php
define("TAB_SPACE", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
?>
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Invoice Details</h6>
                </div>
            </div>
            <!-- Card stats -->
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6" >
    <div class="row" id="printable">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-md-6">

                            <h2><?= $this->config->item('company_name') ?></h2>
                            <h4><?php
                                if ($data["status"] == 0) {
                                    echo "Invoice No: #";
                                }if ($data["status"] == 1) {
                                    echo "Invoice No: #";
                                }echo $data["tx_id"];
                                ?></h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <h4><?php
                                if ($data["status"] == 0) {
                                    echo "<button class='btn btn-lg btn-outline-danger px-5 no-print'>Not Paid</button>";
                                }if ($data["status"] == 1) {
                                    echo "<button class='btn btn-lg btn-outline-success px-5  no-print'>Paid</button>";
                                };
                                ?></h4>
                        </div>
                        <hr/>
                        <div class="col-md-6"><h4>Invoice To</h4><?= $data["credit_details"] ?></div>
                        <div class="col-md-6 text-right"><h4>Pay To</h4><?= $data["debit_details"] ?></div>
                        <hr/>
                        <div class="col-md-6"><h4>Invoice Date: <?= $data["txn_date"] ?></h4></div>
                        <div class="col-md-6"></div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header border-1">
                                    <h3>Invoice Items</h3>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th class="text-right">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $prevProject = "";
                                            $total_amount = 0;
                                            if ($data["invType"] == "D") {


                                                for ($i = 0; $i < count($data['activity_details']); $i++) {
                                                    $sAct = $data['activity_details'][$i];
                                                    $total_amount+=$sAct->bill_amount;
                                                    if ($i == 0 || $prevProject != $sAct->project) {

                                                        $prevProject = $sAct->project;
                                                        ?>
                                                        <tr>
                                                            <td><h3><?= $sAct->project ?></h3></td><td></td>
                                                        </tr>
                                                        <tr>
                                                            <td> <?= TAB_SPACE . $sAct->activity_name ?></td>
                                                            <td class="text-right"><?= sprintf('%0.2f', $sAct->bill_amount) ?></td>
                                                        </tr>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td><?= TAB_SPACE . $sAct->activity_name ?></td>
                                                            <td class="text-right"><?= sprintf('%0.2f', $sAct->bill_amount) ?></td>
                                                        </tr>

                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                }
                                            }if ($data["invType"] == "S") {

                                                for ($i = 0; $i < count($data['activity_details']); $i++) {
                                                    $sAct = $data['activity_details'][$i];
                                                    $total_amount+=$sAct->bill_amount;
                                                   ?>
                                                        <tr>
                                                            <td><h3><?= $sAct->project ?></h3></td><td></td>
                                                        </tr>
                                                        <tr>
                                                            <td contenteditable="true"> <?= TAB_SPACE . $sAct->project ?></td>
                                                            <td class="text-right"><?= sprintf('%0.2f', $sAct->bill_amount) ?></td>
                                                        </tr>
                                                        <?php
                                                    ?>
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Sub Total</th>
                                                <th><?= sprintf('%0.2f', $total_amount) ?></th>
                                            </tr>
                                            <tr>
                                                <th>Discount</th>
                                                <th><?= sprintf('%0.2f', $data["discount"]) ?></th>
                                            </tr>
                                            <tr>
                                                <th>Advance</th>
                                                <th><?= sprintf('%0.2f', $data["advance"]) ?></th>
                                            </tr>
                                            <tr>
                                                <th><b>Total</b></th>
                                                <th><b><?= sprintf('%0.2f', $data["billed_amount"]) ?></b></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 no-print">
                            <?php
                            if ($data["status"] == 0) {
                                ?>
                                <form method="post" action="<?= base_url("billing/invoice_save/amount") ?>">
                                    <div class="form-inline row mt-1">
                                        <label class="col-3">Sub Total</label>
                                        <input type="number" class="form-control col-5" name="sub_total"  id="sub_total" step="1" value="<?= $total_amount ?>">
                                    </div>
                                    <div class="form-inline row mt-1">
                                        <label class="col-3">Discount</label>
                                        <input type="number" class="form-control col-5" name="discount_amount"  id="discount_amount" step="1" value="<?= $data["discount"] ?>">
                                    </div>
                                    <div class="form-inline row mt-1">
                                        <label class="col-3">Advance</label>
                                        <input type="number" class="form-control col-5" name="advance"  id="advance" step="1" value="<?= $data["advance"] ?>">
                                    </div>
                                    <div class="form-inline row mt-1">
                                        <label class="col-3">Total</label>
                                        <input type="number" class="form-control col-5" name="total_amount"  id="total_amount" step="1" value="<?= $data["billed_amount"] ?>">
                                    </div>
                                    <input type="submit" value="Save" class="btn btn-success no-print"/>
                                </form>
                                <?php
                            }
                            ?>

                        </div>
                        <div class="row" contenteditable="true">
                            <div class="col-md-8">
                                <h2>Bank Details</h2>
                                <?= $data["bank_details"] ?>
                            </div>
                            <div class="col-md-4">
                                <img style="height:200px;float:right" src="<?= base_url("assets/admin/img/QRCode.png") ?>"/>
                            </div>
                        </div>

                    </div>
                    <?php
                    // var_dump($data);
                    ?>

                </div>
            </div>
        </div>

    </div>
    <?php $this->load->view('template/jquery_admin') ?>

    <script>
        $('#discount_amount').on('change', function () {
            $("#total_amount").val(<?= $total_amount ?> -<?= $data["advance"] ?> - this.value);
        });


    </script>
