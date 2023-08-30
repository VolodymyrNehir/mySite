
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <h3 class="noFindError errorForm"></h3>
                <form id="addEditForm">
                    <input type="hidden" id="inputHiddenEdit" name="id">
                    <div class="form-group">
                        <label for="firstName" class="col-form-label">First name</label><span class="firstNameError"></span>
                        <input type="text" class="form-control" id="firstName" name="firstName" required >
                    </div>

                    <div class="form-group">
                        <label for="lastName" class="col-form-label">Last name</label><span class="lastNameError"></span>
                        <input type="text" class="form-control" id="lastName" name="lastName" required >
                    </div>

                    <div class="switchStatus">
                        <span>Status</span>
                        <div class="form-check form-switch ">
                            <label class="form-check-label" for="switchStatus"></label>
                            <input class="form-check-input" type="checkbox" id="switchStatus" name="status">
                        </div>
                    </div>

                    <label>Role</label><span class="roleError"></span>
                    <select class="custom-select  my-1 form-select" id="roleAdd" required>
                        <option value="">-Please Select-</option>
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary buttonAdd">Add</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



