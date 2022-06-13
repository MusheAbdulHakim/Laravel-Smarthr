@props(['route'=>$route,'title'=>$title])
<!-- Delete Modal -->
<div class="modal custom-modal fade" id="delete_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete {{ucfirst($title)}}</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <form action="{{route($route)}}" method="post">
                    @method("DELETE")
                    @csrf
                    <input type="hidden" id="delete_id" name="id">
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary continue-btn btn-block" type="submit">Delete</button>
                            </div>
                            <div class="col-6">
                                <button data-dismiss="modal" class="btn btn-primary cancel-btn btn-block">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Delete  Modal -->