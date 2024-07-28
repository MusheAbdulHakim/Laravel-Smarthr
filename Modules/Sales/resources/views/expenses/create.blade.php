<div class="modal-body">
    <form action="{{ route('expenses.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label required>{{ __('Item Name') }}</x-form.label>
                    <x-form.input type="text" name="item_name" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
            <x-form.input-block>
                <x-form.label required>{{ __('Purchased From') }}</x-form.label>
                <x-form.input type="text" name="purchase_from" />
            </x-form.input-block>
            </div>
            <div class="col-md-6">
            <x-form.input-block>
                <x-form.label>{{ __('Purchased Date') }}</x-form.label>
                <div class="cal-icon">
                    <x-form.input type="text" class="datepicker" name="purchase_date" />
                </div>
            </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label required>{{ __('Amount') }}</x-form.label>
                    <x-form.input type="text" name="amount" placeholder="100" />
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                <x-form.label required>{{ __('Paid By') }}</x-form.label>
                <select name="paid_by" class="form-control">
                        <option value="1">{{ __('Cash') }}</option>
                        <option value="2">{{ __('Cheque') }}</option>
                        <option value="3">{{ __('Card') }}</option>
                </select>
                </x-form.input-block>
            </div>
           <div class="col-md-6">
            <x-form.input-block>
                <x-form.label required>{{ __('Status') }}</x-form.label>
               <select name="status" class="form-control">
                    <option value="0">{{ __('Pending') }}</option>
                    <option value="1">{{ __('Approved') }}</option>
               </select>
            </x-form.input-block>
           </div>
        </div>
        <div class="submit-section mb-3">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
