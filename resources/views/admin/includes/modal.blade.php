<!-- Modal -->
<div class="modal fade" id="subscriptionsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Subscriptions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Package</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="subscriptionTable">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal -->

{{-- approve subscription modal --}}
<div class="modal fade" id="approve-request-modal" tabindex="-1" role="dialog" aria-labelledby="request-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="request-modal">Subscriptions Cancellation Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="approve-request-form">
                    <input type="hidden" name="user_id" id="user-id">
                    <input type="hidden" name="id" id="subscription-id">
                    <div class="form-group">
                        <label for="approvalStatus">Approval Status:</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="approvedRadio" name="approval_status" value="1">
                            <label class="form-check-label" for="approvedRadio">Approved</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="deniedRadio" name="approval_status" value="0">
                            <label class="form-check-label" for="deniedRadio">Denied</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="approvalDate">End Date:</label>
                        <input type="date" class="form-control" id="approvalDate" name="end_date">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updateRequest()">Save changes</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- end model --}}