<div class="modal flip" id="employeePayrollModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalFullscreenLabel">Payment Process Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('payroll-period.payment-process') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="period" class="form-label">Period</label>
                                <select name="period" id="period" data-choices class="form-select">
                                    
                                </select>
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
