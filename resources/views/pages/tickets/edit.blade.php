<div class="modal-body">
    <form action="{{ route('tickets.update', $ticket->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="input-block mb-3">
                    <x-form.label>{{ __('Subject') }}</x-form.label>
                    <x-form.input type="text" name="subject" value="{{ $ticket->subject }}" />
                </div>
            </div>
            <div @can('edit-ticket')class="col-md-6"@else class="col-md-12"@endcan>
                <div class="input-block mb-3">
                    <x-form.label>{{ __('Priority') }}</x-form.label>
                    <select name="priority" class="form-control">
                        <option value="">{{ __('Select Priority') }}</option>
                        @foreach (\App\Enums\GeneralPriority::cases() as $item)
                            <option {{ $ticket->priority == $item ? 'selected': '' }} value="{{ $item->value }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @can('edit-ticket')
            <div class="col-md-6">
                <div class="input-block mb-3">
                    <x-form.label>{{ __('Ticket Id') }}</x-form.label>
                    <x-form.input type="text" name="tk_id" value="{{ $ticket->tk_id ?? '#TKT-'.pad_zeros(\App\Models\Ticket::count()+1) }}" />
                </div>
            </div>
           
            <div class="col-md-6">
                <div class="input-block mb-3">
                    <x-form.label>{{ __('User') }}</x-form.label>
                    <select name="user" class="form-control">
                        <option value=""> {{ __('Select User') }} </option>
                        @foreach ($users as $user)
                            <option {{ $ticket->user_id == $user->id ? 'selected': '' }} value="{{ $user->id }}">{{ $user->fullname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-block mb-3">
                    <x-form.label>{{ __('End Date') }} </x-form.label>
                    <div class="cal-icon">
                        <input class="form-control datepicker" type="text" name="endDate" value="{{ $ticket->endDate }}">
                    </div>
                </div>
            </div>
            @endcan
        </div>
        <div class="row">
            <div class="col-12">
                <div class="input-block mb-3">
                    <label class="col-form-label">{{ __('Description') }}</label>
                    <x-form.ckeditor name="description" id="editor">{{ $ticket->description }}</x-form.ckeditor>
                </div>
            </div>
            <div class="input-block mb-3">
                <label class="col-form-label">{{ __('Attachment') }} <small class="text-info">{{ __('You can upload multiple files') }}</small></label>
                <x-form.input type="file" name="ticketFiles" multiple />
            </div>
        </div>
        <div class="submit-section my-3">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Update') }}</x-form.button>
        </div>
    </form>
</div>
