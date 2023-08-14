<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <h3 class="errorWindow"></h3>
                <form id="addEditForm">
                    <input type="hidden" id="inputHiddenEdit" name="id">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">First name:</label>
                        <input type="text" class="form-control" id="firstName" name="firstName">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Last name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName">
                    </div>
                    <div class="flexSwitchCheckChecked">
                        <span>Status</span>
                        <div class="form-check form-switch ">
                            <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="status">
                        </div>
                    </div>
                    <label>Role</label>
                    <select class="custom-select  my-1 form-select" id="roleAdd">
                        <option value="">-Please Select-</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
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


<!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">-->
<!--    Launch demo modal-->
<!--</button>-->



