<div class="modal flip" id="createLeaveRequestModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalFullscreenLabel">Leave Request Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('leave-request.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="leave_date_from" class="form-label">Leave Date From</label>
                                <input type="date" id="leave_date_from" name="leave_date_from" class="form-control">
                                @error('leave_date_from')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="leave_date_to" class="form-label">Leave Date To</label>
                                <input type="date" id="leave_date_to" name="leave_date_to" class="form-control">
                                @error('leave_date_to')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-12 mt-3">
                                <label for="reason" class="form-label">Reason</label>
                                <input type="text" id="reason" name="reason" class="form-control" placeholder="Reason">
                                @error('reason')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-12 mt-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control" placeholder="description"></textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-12 mt-3">
                                <label for="attachment" class="form-label">Attachment</label>
                                <input type="file" id="attachment" name="attachment" class="form-control" placeholder="Attachment">
                                @error('attachment')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-end">
                                    <a href="javascript:void(0);"
                                        class="btn btn-link shadow-none link-success fw-medium"
                                        data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>
                                        Close</a>
                                    <button type="submit" class="btn btn-primary ">Process</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
</div>
