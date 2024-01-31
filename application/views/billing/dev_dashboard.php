
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
                </div>

            </div>
            <!-- Card stats -->
            <div class="row">

                <?php
                function calculateSeconds($time) {
                    $timeParts = explode(':', $time);
                    return (int)$timeParts[0] * 3600 + (int)$timeParts[1] * 60;
                }
                function timeDiff($firstTime, $lastTime) {
                    return calculateSeconds($lastTime) - calculateSeconds($firstTime);
                }

                $prev=$summary["prev"];
                $current=$summary["current"];
                function getIncreasePerForTime($prev1,$current1){
                    $increase= timeDiff($prev1,$current1);
                  
                if($prev1!=0){
                    $seconds1=calculateSeconds($prev1);
                    if($seconds1){
                        $increasePer=($increase/$seconds1)*100;
                    }else{
                        $increasePer=0;
                    }
                    $rounded=sprintf('%0.2f', $increasePer);
                    if($rounded>=0){
                        return '<span class="text-success mr-2"><i class="fa fa-arrow-up"></i> '.$rounded.'%</span>';
                    }else{
                        return '<span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> '.$rounded.'%</span>';
                    }
                }

                }
                function getIncreasePerForNumber($prev1,$current1){
                    $increase= $current1-$prev1;
                    if($prev1!=0){
                        $increasePer=($increase/$prev1)*100;
                        $rounded=sprintf('%0.2f', $increasePer);
                        if($rounded>=0){
                            return '<span class="text-success mr-2"><i class="fa fa-arrow-up"></i> '.$rounded.'%</span>';
                        }else{
                            return '<span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> '.$rounded.'%</span>';
                        }
                    }

                }

//echo sprintf('%02d:%02d:%02d', ($diff/ 3600),($diff/ 60 % 60), $diff% 60);
                $ret=array();
               if($current){
                array_push($ret,array("title"=>"Total Hours","data"=>$current->TotalHr,"change"=>getIncreasePerForTime($prev->TotalHr,$current->TotalHr)));
                array_push($ret,array("title"=>"Total Activities","data"=>$current->TotalActivities,"change"=>getIncreasePerForNumber($prev->TotalActivities,$current->TotalActivities)));
                array_push($ret,array("title"=>"Paid Hours","data"=>$current->PaidHr,"change"=>getIncreasePerForTime($prev->PaidHr,$current->PaidHr)));
                array_push($ret,array("title"=>"Paid Activities","data"=>$current->PaidActivities,"change"=>getIncreasePerForNumber($prev->PaidActivities,$current->PaidActivities)));
               }
                foreach ($ret as $single){
                    ?>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0"><?=$single["title"]?></h5>
                                        <span class="h2 font-weight-bold mb-0"><?=$single["data"]?></span>
                                    </div>
                                    <div class="col-auto d-none">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="ni ni-money-coins"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    <?=$single["change"]?>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>

            </div>
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
                            <h3 class="mb-0">Activity Summary</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive  mb-5">
                    <!-- Projects table -->
                    <?php
                    if($activity_tbl){
                        ?>
                        <table id="tbl1" class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Month</th>
                                <th scope="col">Total Activities</th>
                                <th scope="col">Total Hours</th>
                                <th scope="col">Paid Hours</th>
                                <th scope="col">Paid Activities</th>
                                <th scope="col">Pending Hours</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($activity_tbl as $res){
                                ?>
                                <tr  class="">
                                    <td><?=$res->Year."-".$res->Month?></td>
                                    <td><?=$res->TotalActivities?></td>
                                    <td><?=$res->TotalHr?></td>
                                    <td><?=$res->PaidHr?></td>
                                    <td><?=$res->PaidActivities?></td>
                                    <td><?=$res->PendingHr?></td>



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
