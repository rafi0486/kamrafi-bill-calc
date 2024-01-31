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
                <h4 class="modal-title">Add/Edit Client Rate</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" id="formRate" action="<?=base_url("billing/client_rate_save")?>">

                <div class="modal-body mb-0 pb-0 mt-0 pt-0">

                    <div class="form-group form-inline">
                        <label  class="col-4">Customer</label>
                        <input type="hidden" name="aid" id="aid"  >

                        <select class="form-control col-8" name="customer_id"  id="lstCustomer">
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
                        <label class="col-4">Work Type</label>
                        <select class="form-control col-8" name="work_type_id"  id="lstWorkType">
                            <?php
                            foreach ($work_types as $row){
                                ?>
                                <option value="<?=$row->work_type_id?>"><?=$row->work_name?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-4">Type</label>
                        <select class="form-control col-8" name="recurring_period"  id="lstCycleType">
                          <option value="0">Not Recurring</option>
                          <option value="1">Monthly</option>
                          <option value="2">2 Months</option>
                          <option value="6">6 Months</option>
                          <option value="12">1 Year</option>
                          <option value="24">2 Year</option>
                          <option value="36">3 Year</option>
                        </select>
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-4">Start Date</label>
                        <input type="date" class="form-control col-8" name="start_date" id="start_date" >
                    </div>


                    <div class="form-group form-inline">
                        <label class="col-4">Rate Per Hr</label>
                        <input type="number" class="form-control col-8" name="rate_per_hr" step="1" id="rate_per_hr">
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-4">Rate After Limit</label>
                        <input type="number" class="form-control col-8" name="rate_after_limit" step="10" id="rate_after_limit">
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-4">Min. Hr</label>
                        <input type="number" class="form-control col-8" name="min_hr" step="1" id="min_hr">
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-4">Description</label>
                        <input type="text" class="form-control col-8" name="description" id="description">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btn_delete">Delete</button>
                    <button type="submit" class="btn btn-success" id="btn_add_rate">Save</button>
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
                    <h6 class="h2 text-white d-inline-block mb-0">Client Rates</h6>
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
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal1">New Client Rate</button>


                        </div>
                    </div>
                </div>
                <div class="table-responsive  mb-5">
                    <!-- Projects table -->
                    <?php
                    if($tbl){
                        ?>
                        <table id="tbl1" class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Customer</th>
                                <th scope="col">Work Type</th>
                                <th scope="col">Rate</th>
                                <th scope="col">Rate after Limit</th>
                                <th scope="col">Recurring</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">Min. Hour</th>
                                <th scope="col">Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($tbl as $res){
                                ?>
                                <tr  class="">
                                    <td><?=$res->company?></td>
                                    <td><?=$res->work_name?></td>
                                    <td><?=$res->rate_per_hr?></td>
                                    <td><?=$res->rate_after_limit?></td>
                                    <td><?=$res->recurring_period>0?$res->recurring_period." Months":""?></td>
                                    <td><?=$res->start_date?></td>
                                    <td><?=$res->min_hr?></td>
                                    <td><?=$res->description?></td>



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
    <?php $this->load->view('template/jquery_admin')?>
    <script>


        //			document.title = $("#lstSubject option:selected").text() + " - <?=$this->config->item('app_name')?>";

        $("#btn_delete").hide();


        var tbl = $('#tbl1').DataTable({
            dom: 'Bfrtip',
            "paging":   true,
            buttons: ['copyHtml5','excelHtml5']
        });
        $(document).on('click','#btn_delete', function (event) {
            if (confirm('Do you want to delete?')) {
                var id = $("#rid").val();
                $.ajax({
                    type: 'GET',
                    url: HOST_URL + "billing/delete_single_rate",
                    data: {"id": id},
                    dataType: 'json',
                    success: function (data) {
                        location.reload();
                    }
                });
            }
        });
        $(document).ready(function(){
            var jq=jQuery.noConflict();
            $(document).on('click','.act-title', function (event) {
                var id = $(this).attr("data-rw-id");
                $("#formRate").trigger("reset");
                $.ajax({
                    type: 'GET',
                    url: HOST_URL + "billing/get_single_rate",
                    data: {"id": id},
                    dataType: 'json',
                    success: function (data) {
                        /*$("#rid").val(data.activity_id);
                        $("#lstCustomer").val(data.customer_id);*/
                        $("#btn_add_rate").val("Update");
                        $("#btn_delete").show();
                        $("#modal1").modal('show');

                    }
                });
            });

        });


    </script>
