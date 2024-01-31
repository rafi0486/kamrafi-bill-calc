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
                <h4 class="modal-title">Add/Edit Work Rate</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" id="formRate" action="<?=base_url("billing/rate_save")?>">

                <div class="modal-body mb-0 pb-0 mt-0 pt-0">

                    <input type="hidden" name="rid" id="rid"  >
                    <div class="form-group form-inline">
                        <label class="col-4">Work Name</label>
                        <input type="text" class="form-control col-8" name="work_name" id="work_name">
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-4">Work Desc.</label>
                        <input type="text" class="form-control col-8" name="work_description" id="work_description">
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-4">Rate Per Hr</label>
                        <input type="number" class="form-control col-8" name="rate_per_hr" step="10" id="rate_per_hr">
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
                    <h6 class="h2 text-white d-inline-block mb-0">Rates</h6>
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
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal1">New Rate</button>


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
                                <th scope="col">Work Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Per Hr Rate</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($tbl as $res){
                                ?>
                                <tr  class="">
                                    <td><?=$res->work_name?></td>
                                    <td><?=$res->work_description?></td>
                                    <td><?=$res->rate_per_hr?></td>
                                    <td>
                                        <?php
                                        switch ($res->status){
                                            case 0:echo "Pending";break;
                                            case 1:echo "Active";break;
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
