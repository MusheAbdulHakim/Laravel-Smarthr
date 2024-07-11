<div>
    <li class="menu-title"><span>Chat Groups</span> 
        <a href="javascript:void(0)"
            @click="$('#add_group').modal('show');$('.modal-backdrop').remove()"><i class="fa-solid fa-plus"></i></a>
    </li>
       
    <div x-data="{ groups: null}"
        x-init="groups = await (await fetch('{{ $groupsEndpoint }}')).json()">
        <template x-for="group in groups.data">
            <li> 
                <a :href="group.id">
                    <span class="chat-avatar-sm user-img">
                        <img class="rounded-circle" :src="group.avatar.sm" alt="Group Image" >
                    </span> 
                    <span class="chat-user" x-text="group.name"></span>
                </a>
            </li>
        </template>
    </div>
    
    <div id="add_group" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create a group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Groups are where your team communicates</p>
                    <form wire:submit="createGroup">
                        <div class="input-block mb-3">
                            <label class="col-form-label">Group Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" wire:model="groupName" placeholder="Enter group name">
                        </div>
                    
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
