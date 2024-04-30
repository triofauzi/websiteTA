<div class="modal fade" id="confirmationModal{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop"
                    colors="primary:#f7b84b,secondary:#405189" style="width:130px;height:130px">
                </lord-icon>

                <div class="mt-4">
                    <h4 class="mb-3">Promote Employee!</h4>
                    <p class="text-muted mb-4"> This action cannot be undone</p>
                    <form action="{{ route('job-position.promote', $user) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="letter_number" class="form-label">Letter Number <span class="text-danger">*</span></label>
                                <input type="text" id="letter_number" name="letter_number" class="form-control" placeholder="Letter Number" required>
                            </div>
                            <div class="form-group col-12 mt-3">
                                <label for="new_salary" class="form-label">New Salary <span class="text-muted">(optional)</span></label>
                                <input type="text" id="new_salary" name="new_salary" class="form-control" placeholder="New Salary">
                            </div>
                        </div>
                        <div class="hstack gap-2 justify-content-center mt-3">
                            <a href="javascript:void(0);" class="btn btn-link link-success fw-medium"
                                data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                            <button type="submit" class="btn btn-success">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
