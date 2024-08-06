</section>
<section class="page-section">
    <div class="container">
    <div class="w-100 justify-content-between d-flex">
        
        <a href="./?page=edit_account" class="btn btn btn-primary btn-flat"><div class="fa fa-user-cog"></div> Manage Account</a>
    </div>
        
        <hr class="border-warning">
        <table class="table table-stripped text-dark">
        <h4><b>Booked Packages</b></h4>
            <colgroup>
                <col width="5%">
                <col width="10">
                <col width="25">
                <col width="25">
                <col width="15">
                <col width="10">
            </colgroup>
            <thead>
                <tr>
                    <th>#</th>
                    <th>DateTime</th>
                    <th>Packages</th>
                    <th>Schedule</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
               
               
            </thead>
            
            
            <tbody>
                <?php 
                $i=1;
                $has_pending = false; // Flag to check pending status
                $qry = $conn->query("SELECT b.*,p.title FROM book_list b inner join `packages` p on p.id = b.package_id where b.user_id ='".$_settings->userdata('id')."' order by date(b.date_created) desc ");
                while($row= $qry->fetch_assoc()):
                    $review = $conn->query("SELECT * FROM `rate_review` where package_id='{$row['id']}' and user_id = ".$_settings->userdata('id'))->num_rows;
                    if ($row['status'] == 0) {
                        $has_pending = true; // Set flag if there's a pending status
                    }
                ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo date("Y-m-d",strtotime($row['schedule'])) ?></td>
                        <td class="text-center">
                            <?php if($row['status'] == 0): ?>
                                <span class="badge badge-warning">Pending</span>
                            <?php elseif($row['status'] == 1): ?>
                                <span class="badge badge-primary">Confirmed</span>
                            <?php elseif($row['status'] == 2): ?>
                                <span class="badge badge-danger">Cancelled</span>
                            <?php elseif($row['status'] == 3): ?>
                                <span class="badge badge-success">Done</span>
                            <?php endif; ?>
                        </td>
                        <td align="center">
                            <button type="button" class="btn btn-flat btn-default border btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                Action
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Edit</a>
                                <?php if($row['status'] == 3 && $review <= 0): ?>
                                    <a class="dropdown-item submit_review" href="javascript:void(0)" data-id="<?php echo $row['package_id'] ?>">Submit Review</a>
                                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item cancel_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Cancel</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <br>
        <hr>
        <br>
        <table class ="table table-stripped text-dark">
        <h4><b>Booked hotel</b></h4>
        <colgroup>
                <col width="5%">
                <col width="10">
                <col width="25">
                <col width="25">
                <col width="15">
                <col width="10">
            </colgroup>
            <thead>
                <tr>
                    <th>#</th>
                    <th>DateTime</th>
                    <th>Hotels</th>
                    <th>Schedule</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
               
               
            </thead>
            
            
            <tbody>
                <?php 
                $i=1;
                $has_pending = false; // Flag to check pending status
                $qry = $conn->query("SELECT b.*,p.title FROM book_list b inner join `hotel` p on p.id = b.hotel_id where b.user_id ='".$_settings->userdata('id')."' order by date(b.date_created) desc ");
                while($row= $qry->fetch_assoc()):
                    $review = $conn->query("SELECT * FROM `rate_review` where hotel_id='{$row['id']}' and user_id = ".$_settings->userdata('id'))->num_rows;
                    if ($row['status'] == 0) {
                        $has_pending = true; // Set flag if there's a pending status
                    }
                ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo date("Y-m-d",strtotime($row['schedule'])) ?></td>
                        <td class="text-center">
                            <?php if($row['status'] == 0): ?>
                                <span class="badge badge-warning">Pending</span>
                            <?php elseif($row['status'] == 1): ?>
                                <span class="badge badge-primary">Confirmed</span>
                            <?php elseif($row['status'] == 2): ?>
                                <span class="badge badge-danger">Cancelled</span>
                            <?php elseif($row['status'] == 3): ?>
                                <span class="badge badge-success">Done</span>
                            <?php endif; ?>
                        </td>
                        <td align="center">
                            <button type="button" class="btn btn-flat btn-default border btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                Action
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Edit</a>
                                <?php if($row['status'] == 3 && $review <= 0): ?>
                                    <a class="dropdown-item submit_review" href="javascript:void(0)" data-id="<?php echo $row['hotel_id'] ?>">Submit Review</a>
                                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item cancel_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Cancel</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        
        </table>
        
    </div>
</section>

<!-- Modal for Pending Payment -->
<div class="modal fade" id="pendingPaymentModal" tabindex="-1" role="dialog" aria-labelledby="pendingPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pendingPaymentModalLabel">Pending Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
    <p>Please pay for your pending bookings to proceed with your order. Follow the instructions below:</p>
    <ol>
        <li>
            <strong>Payment Instructions:</strong>
            <ul>
                <li>Pay the amount via your Internet Banking App and Direct Deposit to Bank to the following account details:</li>
                <ul>
                    <li><strong>Account No.:</strong> 12345677899</li>
                    <li><strong>Bank Name:</strong> ABC Bank</li>
                    <li><strong>Account Title:</strong> Isle Travels and Tours Pvt. Ltd.</li>
                </ul>
            </ul>
        </li>
        <li>
            <strong>Share Payment Proof:</strong>
            <ul>
                <li>After making the payment, share a screenshot or scan of the payment receipt through our official channels:</li>
                <ul>
                    <li><strong>WhatsApp:</strong> +92 111 123334</li>
                    <li><strong>Email:</strong> booking@isletravels.com</li>
                </ul>
            </ul>
        </li>
        <li>
            <strong>Confirmation:</strong>
            <ul>
                <li>After confirmation, our representative will contact you shortly.</li>
            </ul>
        </li>
    </ol>
    <p>Thank you for choosing Isle Travels!</p>
</div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script>
    function cancel_book($id){
        start_loader()
        $.ajax({
            url:_base_url_+"classes/Master.php?f=update_book_status",
            method:"POST",
            data:{id:$id,status:2},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("An error occurred",'error')
                end_loader()
            },
            success:function(resp){
                if(typeof resp == 'object' && resp.status == 'success'){
                    alert_toast("Book cancelled successfully",'success')
                    setTimeout(function(){
                        location.reload()
                    },2000)
                }else{
                    console.log(resp)
                    alert_toast("An error occurred",'error')
                }
                end_loader()
            }
        })
    }

    function checkPendingPayment() {
        var hasPending = <?php echo $has_pending ? 'true' : 'false'; ?>;
        if(hasPending) {
            $('#pendingPaymentModal').modal('show');
        }
    }

    $(function(){
        $('.cancel_data').click(function(){
            _conf("Are you sure to cancel this booking?","cancel_book",[$(this).data('id')])
        })
        $('.submit_review').click(function(){
            uni_modal("Rate & Feedback","./rate_review.php?id="+$(this).data('id'),'mid-large')
        })
        $('table').dataTable();
        checkPendingPayment(); // Check for pending payment on page load
    })
</script>






