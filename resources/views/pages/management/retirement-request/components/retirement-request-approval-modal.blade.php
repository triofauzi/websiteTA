
<div class="modal fade" id="retirementApprovalModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <lord-icon
                    src="https://cdn.lordicon.com/tdrtiskw.json"
                    trigger="loop"
                    colors="primary:#f7b84b,secondary:#405189"
                    style="width:130px;height:130px">
                </lord-icon>

                <div class="mt-4">
                    <h4 class="mb-3">Employee Retirement Approval Confirmation!</h4>
                    <p class="text-muted mb-4">This action cannot be undone. You will accept the employee retirement request and the system will generate retirement letter </p>
                    <div class="hstack gap-2 justify-content-center">
                        <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                        <form action="{{ route('retirement-request.approve', $retirementRequest) }}" method="post">
                            @csrf
                            @method('patch')
                            <button type="submit" class="btn btn-danger">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>