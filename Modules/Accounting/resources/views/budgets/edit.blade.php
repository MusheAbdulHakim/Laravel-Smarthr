<div class="modal-body">
    <form action="{{ route('budgets.update', $budget->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="row" x-data="{useCategory: {{ $budget->type == 'project' ? 'false': 'true' }} }">
            <x-form.label required>{{ __('Choose Budget Respect Type') }}</x-form.label>
            <x-form.input-block>
                <div class="form-check form-check-inline">
                    <input class="form-check-input BudgetType" type="radio" :checked="!useCategory" @click="useCategory =! true" name="type" id="project" value="project">
                    <label class="form-check-label" for="project">{{ __('Project') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input BudgetType" type="radio" :checked="useCategory" @click="useCategory =! false" name="type" id="category" value="category">
                    <label class="form-check-label" for="category">{{ __('Category') }}</label>
                </div>
            </x-form.input-block>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label required>{{ __('Title') }}</x-form.label>
                    <x-form.input type="text" name="title" value="{{ $budget->title }}" />
                </x-form.input-block>
            </div>
            <div class="col-md-6" x-show="useCategory == false">
                <x-form.input-block>
                    <x-form.label>{{ __('Projects') }}</x-form.label>
                    <select name="project" class="form-control">
                        <option value="">{{ __('Select project') }}</option>
                        @foreach ($projects as $project)
                            <option {{ $budget->project_id == $project->id ? 'selected': '' }} value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </x-form.input-block>
            </div>
            <div class="col-md-6" x-show="useCategory">
                <x-form.input-block>
                    <x-form.label>{{ __('Category') }}</x-form.label>
                    <select name="category" class="form-control">
                        <option value="">{{ __('Select category') }}</option>
                        @foreach ($categories as $category)
                            <option {{ $budget->budget_category_id == $category->id ? 'selected': '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </x-form.input-block>
            </div>
        </div>
        <div class="row" x-data="{
            totalRevenue: {{ $budget->total_revenue ?? 0.00 }},
            totalExpenses: {{ $budget->total_expense ?? 0.00 }},
            taxPercent: {{ $budget->taxes ?? 0.00 }},
            expectedProfit: {{ $budget->profit ?? 0.00 }},
            expectedExpense: function(amount){
                if(!amount){
                    let total = 0.00;
                    $('.expenseItem').each(function(){
                        const amount = $(this).find('input.itemAmount').val()
                        total += parseFloat(amount) 
                    })
                    this.totalExpenses = parseFloat(total)
                }else
                {
                    this.totalExpenses -= amount
                }
            },
            expectedRevenue: function(amount){
                if(!amount){
                    let total = 0.00;
                    $('.revenueItem').each(function(){
                        const amount = $(this).find('input.itemAmount').val()
                        total += parseFloat(amount) 
                    })
                    this.totalRevenue = parseFloat(total)
                }else
                {
                    this.totalRevenue -= amount
                }
            }
        }">
            <div class="revenueRepeater">
                <div data-repeater-list="revenues">
                    <div class="row">
                        <div class="col-sm-11">
                            <label class="col-form-label">{{ __('Expected Revenues') }}</label>
                        </div>
                        <div class="col-sm-1">
                            <div class="add-more">
                                <a class="add_more_revenue" data-repeater-create data-bs-toggle="tooltip" title="{{ __('Add Revenue') }}"><i class="fa-solid fa-plus-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    @if (!empty($budget->revenue) && $budget->revenue->count() > 0)
                    @foreach ($budget->revenue as $item)
                    <div class="row revenueItem" data-repeater-item x-data="{amount: {{ $item->amount ?? 0.00 }}}" @change="expectedRevenue()">
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">{{ __('Revenue Title') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" placeholder="{{ __('Revenue Title') }}" value="{{ $item->title }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-block mb-3">
                                <label class="col-form-label">{{ __('Revenue Amount') }} <span class="text-danger">*</span></label>
                                <input type="text" name="amount" x-model="amount" placeholder="{{ __('Amount') }}" class="form-control itemAmount" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="input-block mt-5">
                                <button type="button" class="btn btn-sm btn-danger" @click="expectedRevenue(amount)" data-bs-toggle="tooltip" title="{{ __('Delete') }}" data-repeater-delete>
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="row revenueItem" data-repeater-item x-data="{amount: 0.00}" @change="expectedRevenue()">
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">{{ __('Revenue Title') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" placeholder="{{ __('Revenue Title') }}"  autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-block mb-3">
                                <label class="col-form-label">{{ __('Revenue Amount') }} <span class="text-danger">*</span></label>
                                <input type="text" name="amount" x-model="amount" placeholder="{{ __('Amount') }}" class="form-control itemAmount" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="input-block mt-5">
                                <button type="button" class="btn btn-sm btn-danger" @click="expectedRevenue(amount)" data-bs-toggle="tooltip" title="{{ __('Delete') }}" data-repeater-delete>
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="input-block mb-3">
                <label class="col-form-label">{{ __('Overall Revenues') }} <span class="text-danger">({{ __('A') }})</span></label>
                <input class="form-control" type="text" x-model="totalRevenue" name="overall_revenues" placeholder="{{ __('Overall Revenues') }}" readonly>
            </div>
            <div class="expenseRepeater">
                <div data-repeater-list="expenses">
                    <div class="row">
                        <div class="col-sm-11">
                            <label class="col-form-label">{{ __('Expected Expense') }}</label>
                        </div>
                        <div class="col-sm-1">
                            <div class="add-more">
                                <a class="add_more_revenue" data-repeater-create data-bs-toggle="tooltip" title="{{ __('Add Expense') }}"><i class="fa-solid fa-plus-circle"></i></a>
                            </div>
                        </div>
                    </div>
                    @if (!empty($budget->expenses) && $budget->expenses->count() > 0)
                        @foreach ($budget->expenses as $item)
                        <div class="row expenseItem" data-repeater-item x-data="{amount: {{ $item->amount ?? 0.00 }}}" @change="expectedExpense()">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <div class="col-sm-6">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">{{ __('Expense Title') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" placeholder="{{ __('Expense Title') }}" value="{{ $item->title }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">{{ __('Expense Amount') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="amount" x-model="amount" placeholder="{{ __('Amount') }}" class="form-control itemAmount" autocomplete="off" >
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="input-block mt-5">
                                    <button type="button" class="btn btn-sm btn-danger" @click="expectedExpense(amount)" data-bs-toggle="tooltip" title="{{ __('Delete') }}" data-repeater-delete>
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <div class="row expenseItem" data-repeater-item x-data="{amount: 0.00}" @change="expectedExpense()">
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">{{ __('Expense Title') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" placeholder="{{ __('Expense Title') }}"  autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-block mb-3">
                                <label class="col-form-label">{{ __('Expense Amount') }} <span class="text-danger">*</span></label>
                                <input type="text" name="amount" x-model="amount" placeholder="{{ __('Amount') }}" class="form-control itemAmount" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="input-block mt-5">
                                <button type="button" class="btn btn-sm btn-danger" @click="expectedExpense(amount)" data-bs-toggle="tooltip" title="{{ __('Delete') }}" data-repeater-delete>
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="input-block mb-3">
                <label class="col-form-label">{{ __('Overall Expense') }} <span class="text-danger">({{ __('B') }})</span></label>
                <input class="form-control" type="text" x-model="totalExpenses" name="overall_expenses" placeholder="{{ __('Overall Expenses') }}" readonly>
            </div>
            <div class="col-md-6">
                <div class="input-block mb-3">
                    <label class="col-form-label">{{ __('Expected Profit') }} <span class="text-danger">( {{ __('C = A - B') }} )</span> </label>
                    <input class="form-control" type="text" x-model="expectedProfit = parseFloat(totalRevenue - totalExpenses)" name="expected_profit" placeholder="{{ __('Expected Profit') }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label>{{ __('Tax') }} <span class="text-danger">( {{ __('D') }} )</span></x-form.label>
                    <x-form.input type="text" name="tax" placeholder="{{ __('Total Taxes') }}" x-model="taxPercent"/>
                </x-form.input-block>
            </div>
            <div class="col-md-12">
                <x-form.input-block>
                    <x-form.label required>{{ __('Budget Amount') }} <span class="text-danger">( {{ __('E = C - D') }} )</span></x-form.label>
                    <input class="form-control" type="text" name="budget_amount" :value="expectedProfit-taxPercent" readonly>
                </x-form.input-block>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label class="focus-label" required> {{ __('Start Date') }}</x-form.label>
                    <div class="cal-icon">
                        <x-form.input type="text" class="datepicker" name="startDate" value="{{ $budget->startDate }}" />
                    </div>
                </x-form.input-block>
            </div>
            <div class="col-md-6">
                <x-form.input-block>
                    <x-form.label class="focus-label" required> {{ __('End Date') }}</x-form.label>
                    <div class="cal-icon">
                        <x-form.input type="text" class="datepicker" name="endDate" value="{{ $budget->endDate }}" />
                    </div>
                </x-form.input-block>
            </div>
            <div class="col-md-12">
                <x-form.input-block>
                    <x-form.label>{{ __('Attachment') }}</x-form.label>
                    <x-form.input type="file" name="attachment"/>
                </x-form.input-block>
            </div>
            <x-form.input-block>
                <x-form.label>{{ __('Note') }}</x-form.label>
                <x-form.textarea name="note">{{ $budget->note }}</x-form.textarea>
            </x-form.input-block>
        </div>
        <div class="submit-section mb-3">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
<script type="module" defer>
    $(document).ready(function(){
        $('.revenueRepeater').repeater({
            initEmpty: false,
            isFirstItemUndeletable: true,
            show: function () {
                $(this).slideDown();
                $('.datepicker').each(function(){
                    $(this).datetimepicker({
                        format: 'YYYY-MM-DD',
                        icons: {
                            up: "fa fa-angle-up",
                            down: "fa fa-angle-down",
                            next: 'fa fa-angle-right',
                            previous: 'fa fa-angle-left'
                        }
                    });
                })
            },
            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },
        });        
        $('.expenseRepeater').repeater({
            initEmpty: false,
            isFirstItemUndeletable: true,
            show: function () {
                $(this).slideDown();
                $('.datepicker').each(function(){
                    $(this).datetimepicker({
                        format: 'YYYY-MM-DD',
                        icons: {
                            up: "fa fa-angle-up",
                            down: "fa fa-angle-down",
                            next: 'fa fa-angle-right',
                            previous: 'fa fa-angle-left'
                        }
                    });
                })
            },
            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },
        });        
    });
</script>