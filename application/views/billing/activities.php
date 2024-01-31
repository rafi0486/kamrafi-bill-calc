<style>
    .act-title,.badge{
        cursor: pointer;
    }
</style>
<div id="modal1" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add/Edit Activity</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="formActivity" method="post" action="<?=base_url("billing/activities_save")?>">

                <div class="modal-body mb-0 pb-0 mt-0 pt-0">
                    <div class="form-group form-inline my-1">
                        <label  class="col-4">Customer</label>
                        <input type="hidden" name="act_id" id="act_id"  >

                        <select class="form-control col-8" name="customer"  id="lstCustomer">
                            <option value="" hidden="selected">Select</option>
                            <?php
                            foreach ($customers as $row){
                                ?>
                                <option value="<?=$row->party_id?>"><?=$row->company?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group form-inline my-1">
                        <label class="col-4">Work Type</label>
                        <select class="form-control col-8" name="work_type"  id="lstWorkType">
                            <?php
                            foreach ($work_types as $row){
                                ?>
                                <option value="<?=$row->work_type_id?>"><?=$row->work_name?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group form-inline my-1">
                        <label class="col-4">Date</label>
                        <input type="date" class="form-control col-8" name="activity_date" id="activity_date" >
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-3">Actual Hr</label>
                        <input type="number" class="form-control col-3" name="actual_hr" id="actualHr" step=".25" placeholder="eg: 1.5, 1.25" >
                        <label class="col-3">Billed</label>
                        <input type="number" class="form-control col-3" name="billed_hr" id="billedHr" step=".25" >
                    </div>
                    <div class="form-group form-inline pl-5" >
                        <label id="rate_details"></label>
                    </div>
                    <div class="form-group form-inline my-1">
                        <label class="col-4">Bill Amount</label>
                        <input class="form-control col-8" name="bill_amount" id="billAmount" required>
                    </div>
                    <div class="form-group form-inline my-1">
                        <label class="col-4">Project</label>
                        <input class="form-control col-8" name="project" id="project" required >
                    </div>
                    <div class="form-group form-inline" id="project_badge">

                    </div>
                    <div class="form-group form-inline my-1">
                        <label class="col-4">Activity</label>
                        <input class="form-control col-8" name="activity_name" id="activity_name" required >
                    </div>
                    <div class="form-group form-inline my-1">
                        <label class="col-4">Remarks</label>
                        <input class="form-control col-8" name="activity_remarks" id="activity_remarks" >
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
                    <h6 class="h2 text-white d-inline-block mb-0">Activities</h6>
                </div>
                <!--					<div class="col-lg-6 col-5 text-right">-->
                <!--						<a href="#" class="btn btn-sm btn-neutral">New</a>-->
                <!--						<a href="#" class="btn btn-sm btn-neutral">Filters</a>-->
                <!--					</div>-->
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
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal1">New Activity</button>

                            <form  method="post" action="<?=base_url("billing/activities")?>">
                                <div class="form-group form-inline row">
                                    <label>Client</label>
                                    <select class="form-control ml-2" name="lstCustomer"  id="lstCustomerSelect">
                                        <option value="">ALL</option>
                                        <?php
                                        foreach ($customers as $row){
                                            ?>
                                            <option <?=($row->party_id==$current_id?"selected":"")?> value="<?=$row->party_id?>"><?=$row->company?></option>
                                            <?php
                                        }
                                        ?>


                                    </select>

                                    <label class="mx-2">Status</label>
                                    <select class="form-control ml-" name="lstStatus"  id="lstStatusSelect">
                                        <option value="-999">ALL</option>

                                        <?php
                                        $stauses=$this->config->item('bill_statuses');
                                        foreach ($stauses as  $key=>$value){
                                            ?>
                                            <option  value="<?=$key?>"><?=$value?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <button class="btn btn-primary ml-2" type="submit">Filter</button>
                                </div>

                            </form>
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
                                <th scope="col">Date</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Billed</th>
                                <th scope="col">Project</th>
                                <th scope="col">Work Type</th>
                                <th scope="col">Bill Amount</th>
                                <th scope="col">Activity</th>
                                <th scope="col">Remarks</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($tbl as $res){
                                ?>
                                <tr  class="">
                                    <td><?=$res->activity_date?></td>
                                    <td><?=$res->company?></td>
                                    <td><?=$res->billed_hr_format?></td>
                                    <td><?=$res->project?></td>
                                    <td><?=$res->work_name?></td>
                                    <td><?=$res->bill_amount?></td>
                                    <td class="text-underline text-primary act-title" data-rw-id="<?=$res->activity_id?>"><?=$res->activity_name?></td>
                                    <td><?=$res->activity_remarks?></td>
                                    <td>
                                        <?php
                                        switch ($res->status){
                                            case 0:echo "Not Billed";break;
                                            case 1:echo "Billed";break;
                                            case -1:echo "Cancelled";break;
                                        }
                                        ?>
                                    </td>


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
        $('#actualHr').on('change', function() {
            $("#billedHr").val(this.value);
            getBillAmount();
        });
        $('#billedHr').on('change', function() {
            getBillAmount();
        });
        function getBillAmount(){
            if($("#lstCustomer").val()==''){
                alert("Select Client");
                return;
            }
            var billed=$("#billedHr").val();
            if(billed=="" || billed<0){
                alert("Enter Billed Hr");
                return ;
            }
            $("#rate_details").html("");
            $("#billAmount").val("");
            $.ajax({
                url: HOST_URL+'billing/get_worktype_amount',
                type: 'POST',
                dataType:"json",
                data: jQuery.param({ customer: $("#lstCustomer").val(), worktype : $("#lstWorkType").val()}) ,
                contentType: 'application/x-www-form-urlencoded',
                success: function (response) {
                    if(response.status=="common"){
                        $("#rate_details").html("Rate: <label class='badge badge-danger'>Rs."+response.common+"</label>");
                        $("#billAmount").val(Math.round(billed*response.common));
                    }else if(response.status=="customer") {
                        $("#rate_details").html("Rate: <label class='badge badge-danger ml-2'>Rs."+response.customer+"</label><label class='badge badge-secondary ml-2'>Rs."+response.common+"</label>");
                        $("#billAmount").val(Math.round(billed*response.customer));
                    }else{
                        alert("Error");
                    }

                },
                error: function () {
                    alert("error");
                }
            });
        }
        $('#lstCustomer').on('change', function() {

            $("#project_badge").html('');
            $.ajax({
                url: HOST_URL+'billing/get_client_projects',
                type: 'POST',
                dataType:"json",
                data: jQuery.param({ customer: $("#lstCustomer").val()}) ,
                contentType: 'application/x-www-form-urlencoded',
                success: function (response) {
                        for(i=0;i<response.length;i++){
                            var obj=response[i];
                            var elem="<span class='badge badge-warning badge-project mx-1'>"+obj.project+"</span>";
                            $("#project_badge").append(elem);
                        }

                },
                error: function () {
                    alert("error");
                }
            });

        });

        $(document).on('click','.badge-project', function() {

            $("#project").val($(this).text());
        });

        var tbl = $('#tbl1').DataTable({
            dom: 'Bfrtip',
            "paging":   true,
            buttons: ['copyHtml5','excelHtml5']
        });
        $(document).on('click','#btn_delete', function (event) {
            if (confirm('Do you want to delete?')) {
                var id = $("#act_id").val();
                $.ajax({
                    type: 'GET',
                    url: HOST_URL + "billing/delete_single_activity",
                    data: {"id": id},
                    dataType: 'json',
                    success: function (data) {
                        location.reload();
                    }
                });
            }
        });
        $(document).ready(function(){
            $("#act_id").val("");

            var jq=jQuery.noConflict();
            $(document).on('click','.act-title', function (event) {
                var id = $(this).attr("data-rw-id");
                $("#formActivity").trigger("reset");
                $.ajax({
                    type: 'GET',
                    url: HOST_URL + "billing/get_single_activity",
                    data: {"id": id},
                    dataType: 'json',
                    success: function (data) {
                        $("#act_id").val(data.activity_id);
                        $("#lstCustomer").val(data.customer_id);
                        $("#lstWorkType").val(data.work_type_id);
                        $("#activity_date").val(data.activity_date);
                        $("#project").val(data.project);
                        $("#activity_name").val(data.activity_name);
                        $("#activity_remarks").val(data.activity_remarks);
                        $("#actualHr").val(data.actual_hr);
                        $("#billedHr").val(data.billed_hr);
                        $("#billAmount").val(data.bill_amount);

                        $("#btn_add_activity").val("Update");
                        $("#btn_delete").show();
                        $("#modal1").modal('show');

                    }
                });
            });

        });


    </script>
