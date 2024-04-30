<div class="modal flip" id="generateLeaveLetterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalFullscreenLabel">Leave Request Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('leave-request.generate', ['user' => Auth::user()]) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12 mt-3">
                                <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" required>
                                <small class="text-muted">ex: Sakit / Urusan Keluarga</small>
                                @error('subject')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-12">
                                <label for="attachment" class="form-label">Other Attachment <span class="text-muted">(optional)</span></label>
                                <input type="text" id="attachment" name="attachment" class="form-control" placeholder="Other Attachment">
                                <small class="text-muted">ex: Surat Dokter</small>
                                @error('attachment')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="leave_date_from" class="form-label">Leave Date From <span class="text-danger">*</span></label>
                                <input type="date" id="leave_date_from" name="leave_date_from" class="form-control">
                                @error('leave_date_from')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="leave_date_to" class="form-label">Leave Date To <span class="text-danger">*</span></label>
                                <input type="date" id="leave_date_to" name="leave_date_to" class="form-control">
                                @error('leave_date_to')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-end">
                                    <a href="javascript:void(0);"
                                        class="btn btn-link shadow-none link-success fw-medium"
                                        data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>
                                        Close</a>
                                    <button type="submit" class="btn btn-primary ">Generate</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
</div>
