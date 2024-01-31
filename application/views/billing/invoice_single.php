<style>
    .act-title{
        cursor: pointer;
    }
    .form-inline label{
        justify-content: left;
}
</style>

<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Invoice</h6>
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

                        </div>
                    </div>
                </div>

                <form method="post" id="formRate" action="<?=base_url("billing/invoice_save/master")?>">

                    <div class="mb-0 pb-0 mt-0 pt-0">

                        <div class="form-group form-inline">
                            <label  class="col-3">Customer</label>
                            <input type="hidden" name="txid" id="txid" value="<?=$this->session->userdata('inv_id')?>"  >

                            <select class="form-control col-9" name="customer_id"  id="lstCustomer">
                                <option value="">Select</option>
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
                            <label class="col-3">Invoice Date</label>
                            <input type="date" class="form-control col-9" name="txn_date" id="txn_date" value="<?=isset($iDetails)?$iDetails["txn_date"]:""?>" >
                        </div>
                        <div class="form-group form-inline">
                            <label class="col-3">Repeat After</label>
                            <select class="form-control col-9" name="recurring_period"  id="recurring_period">
                                <option value="0">Not Recurring</option>
                                <option value="1">1 Month</option>
                                <option value="2">2 Month</option>
                                <option value="6">6 Month</option>
                                <option value="12">1 Year</option>
                                <option value="24">2 Year</option>
                                <option value="36">3 Year</option>
                            </select>
                        </div>



                        <div class="form-group form-inline">
                            <label class="col-3">Ref. No</label>
                            <input type="text" class="form-control col-9" name="ref_no"  id="ref_no"  value="<?=isset($iDetails)?$iDetails["ref_no"]:""?>">
                        </div>

                        <div class="form-group form-inline">
                            <label class="col-3">Description</label>
                            <input type="text" class="form-control col-9" name="description" id="description"  value="<?=isset($iDetails)?$iDetails["description"]:""?>">
                        </div>

                        <div class="form-group form-inline">
                            <label class="col-3">Bill Type</label>
                            <select class="form-control col-9" name="invType"  id="invType">
                                <option value="S">Summary</option>
                                <option value="D">Detailed</option>
                                <option value="P">Product</option>
                                <option value="M">Miscellaneous</option>
                            </select>

                        </div>

                        <div >
                                <table class="table align-items-center table-flush">
                                    <thead>
                                    <tr>
                                        <td>Select</td>
                                        <td>Project</td>
                                        <td>Activity</td>
                                        <td>Billed Hr</td>
                                        <td>Amount</td>
                                    </tr>
                                    </thead>
                                    <tbody id="client_activities">

                                    </tbody>
                                </table>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="window.location='<?=base_url("billing/clear_invoice")?>'">Clear</button>
                        <button type="submit" class="btn btn-success" id="btn_proceed">Proceed</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <?php $this->load->view('template/jquery_admin')?>
    <script>
        var selectedActs=[];
        <?php
        if(isset($iDetails)){
            echo "$('#recurring_period').val(".$iDetails["recurring_period"].");";
            echo "$('#invType').val('".$iDetails["invType"]."');";
            echo "$('#lstCustomer').val(".$iDetails["credit"].");";
            echo "loadActivities();";
            echo "selectedActs='".$iDetails["billed_activities"]."'.split(',');";
        }
        ?>
        $("#client_activities").html("");
        $('#lstCustomer').on('change', function() {
            loadActivities();
        });
        console.log(selectedActs);
        function loadActivities(){
            $.ajax({
                url: HOST_URL+'billing/get_client_pending_activities',
                type: 'POST',
                dataType:"json",
                data: jQuery.param({ cid: $("#lstCustomer").val(), status : 0}) ,
                contentType: 'application/x-www-form-urlencoded',
                success: function (response) {
                    for(i=0;i<response.length;i++){
                        var obj=response[i];
                        var select="<input name='act[]' type='checkbox' value='"+obj.activity_id+"' />";

                        if(selectedActs.includes(obj.activity_id)){
                            select="<input name='act[]' type='checkbox' checked value='"+obj.activity_id+"' />";
                        }
                        $("#client_activities").append("<tr><td>"+select+"</td><td>"+obj.project+"</td><td>"+obj.activity_name+"</td><td>"+obj.billed_hr+"</td><td>"+obj.bill_amount+"</td></tr>");

                    }

                },
                error: function () {
                    alert("error");
                }
            });
        }



    </script>
