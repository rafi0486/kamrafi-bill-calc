<style>
    .act-title{
        cursor: pointer;
    }
</style>
<div id="modal1" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Payment</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="formActivity" method="post" action="<?=base_url("billing/invoice_save/payment")?>">

                <div class="modal-body mb-0 pb-0 mt-0 pt-0">
                    <div class="form-group form-inline">
                        <label  class="col-4">Customer</label>
                        <input type="hidden" name="txid" id="txid"  >

                        <select class="form-control col-8" name="customer"  id="lstCustomer">
                            <?php
                            foreach ($customers as $row){
                                ?>
                                <option value="<?=$row->party_id?>"><?=$row->company?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>


                    <div class="form-group form-inline">
                        <label class="col-4">Sub Total</label>
                        <input type="number" class="form-control col-8" name="sub_total" id="sub_total" readonly step="1" >
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-4">Discount</label>
                        <input type="number" class="form-control col-8" name="discount" id="discount" readonly step="1" >
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-4">Billed Amount</label>
                        <input type="number" class="form-control col-8" name="billed_amount" id="billed_amount" readonly step="1" >
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-4">Received Date</label>
                        <input type="date" class="form-control col-8" name="received_date" id="received_date" >
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-4">Received Amount</label>
                        <input type="number" class="form-control col-8" name="received_amount" id="received_amount" step="1">
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-4">Balance</label>
                        <input type="number" class="form-control col-8" name="balance" id="balance" step="1" >
                    </div>


                    <div class="form-group form-inline">
                        <label class="col-4">Remarks</label>
                        <input class="form-control col-8" name="remarks" id="remarks" >
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btn_delete">Delete</button>
                    <button type="submit" class="btn btn-success" id="btn_add_activity">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Invoices</h6>
                </div>
            </div>
            <!-- Card stats -->
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <button type="button" class="btn btn-primary float-right" onclick="window.location='<?=base_url("billing/clear_invoice")?>'"?>New Invoice</button>
                            <form  method="post" action="<?=base_url("billing/invoice")?>">
                                <div class="form-group form-inline row">

                                    <label class="mx-2">Status</label>
                                    <select class="form-control ml-" name="lstStatus"  id="lstStatusSelect">

                                        <?php
                                        $stauses=$this->config->item('bill_statuses');
                                        foreach ($stauses as  $key=>$value){
                                            ?>
                                            <option  value="<?=$key?>"><?=$value?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <button class="btn btn-primary ml-2" type="submit">View</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                <div class="mb-5 px-5">
                    <!-- Projects table -->
                    <h3><?=$tTitle?></h3>
                    <?php
                    if($msg){
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?=$msg?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="table-responsive">
                    <?php

                    if($tbl){
                        ?>
                        <table id="tbl1" class="table table-bordered align-items-center ">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Actions</th>
                                <th scope="col">Invoice No</th>
                                <th scope="col">Client Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Invoice Date</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Sub Total</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Total</th>
                                <th scope="col">Remarks</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($tbl as $res){
                                ?>
                                <tr  class="">
                                    <td><button class="btn btn-primary btn-sm btn-payment" data-sid="<?=$res->tx_id?>"><i class="ni ni-money-coins"></i></button> </td>
                                    <td><?=$res->tx_id?></td>
                                    <td><a href="<?=base_url("billing/load_invoice_single/".$res->tx_id)?>"> <?=$res->company?></a></td>
                                    <td><?=$res->description?></td>
                                    <td><?=date("d-m-Y", strtotime($res->txn_date))?></td>
                                    <td><?=date("d-m-Y", strtotime($res->due_date))?></td>

                                    <td><?=$res->sub_total?></td>
                                    <td><?=$res->discount?></td>
                                    <td><?=$res->billed_amount?></td>
                                    <td><?=$res->remarks?></td>



                                </tr>
                                <?php
                            }

                            ?>

                            </tbody>
                        </table>

                        <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php $this->load->view('template/jquery_admin')?>
    <script>
         $('#tbl1').DataTable({
            dom: 'Bfrtip',
            "paging":   true,
            buttons: ['copyHtml5','excelHtml5']
        });

         $(document).ready(function(){
             var jq=jQuery.noConflict();
             $("#tbl1").on("click",".btn-payment",function () {
                 var sid=$(this).attr("data-sid");

                 $.ajax({
                     type: "POST",
                     dataType:"json",
                     url: HOST_URL+"/billing/get_invoice_pay_details",
                     data:{"id":sid},
                     success: function(obj) {
                         $("#txid").val(obj.tx_id);
                         $("#lstCustomer").val(obj.credit);
                         $("#sub_total").val(obj.sub_total);
                         $("#discount").val(obj.discount);
                         $("#billed_amount").val(obj.billed_amount);
                         $("#received_amount").val(obj.received_amount);
                         $("#received_date").val(obj.received_date);
                         $("#balance").val(obj.balance);
                         $("#remarks").val(obj.remarks);
                         $("#modal1").modal('show');
                     }
                 });

             });

         });

         $('#received_amount').on('change', function() {
             $("#balance").val($("#billed_amount").val()-$(this).val());
         });











    </script>
