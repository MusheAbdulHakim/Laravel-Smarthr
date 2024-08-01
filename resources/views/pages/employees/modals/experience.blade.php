<div class="modal-body">
    <form action="{{ route('employee.experience', $employeeDetail->id) }}" method="post" enctype="multipart/form-data" class="repeater">
        @csrf
        <div class="form-scroll">
            <div data-repeater-list="experience">
                @if (!empty($experiences) && ($experiences->count() > 0))
                    @foreach ($experiences as $i => $experience)
                    <div data-repeater-item class="card">
                        <input type="hidden" name="id" value="{{ $experience->id }}">
                        <div class="card-body">
                            <h3 class="card-title">
                                {{ __('Experience') }}
                                <a class="delete-icon deleteBtn" data-route="{{ route('employee.experience.delete', $experience->id)  }}" 
                                    data-title="Delete Work Experience"
                                    data-question="Are you sure you want to delete?" data-repeater-delete type="button" href="javascript:void(0)">
                                    <i class="fa-regular fa-trash-can"></i>
                                </a>
                            </h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <x-form.input-block>
                                        <x-form.label> {{ __('Job Position') }}</x-form.label>
                                        <x-form.input class="floating" type="text" name="position" value="{{ old('position', $experience->position) }}" />
                                    </x-form.input-block>
                                </div>
                                <div class="col-md-6">
                                    <x-form.input-block>
                                        <x-form.label> {{ __('Company Name') }}</x-form.label>
                                        <x-form.input class="floating" type="text" name="company" value="{{ old('company', $experience->company) }}" />
                                    </x-form.input-block>
                                </div>

                                <div class="col-md-6">
                                    <x-form.input-block>
                                        <x-form.label> {{ __('Location') }}</x-form.label>
                                        <x-form.input class="floating" type="text" name="location" value="{{ old('location', $experience->location) }}" />
                                    </x-form.input-block>
                                </div>

                                <div class="col-md-6">
                                    <x-form.input-block>
                                        <x-form.label calss="focus-label"> {{ __('From') }}</x-form.label>
                                        <div class="cal-icon">
                                            <x-form.input type="text" class="datepicker floating" name="start_date" value="{{ old('start_date', $experience->start_date) }}" />
                                        </div>
                                    </x-form.input-block>
                                </div>
                                <div class="col-md-6">
                                    <x-form.input-block>
                                        <x-form.label calss="focus-label"> {{ __('To') }}</x-form.label>
                                        <div class="cal-icon">
                                            <x-form.input type="text" class="datepicker floating" name="end_date" value="{{ old('end_date', $experience->end_date) }}" />
                                        </div>
                                    </x-form.input-block>
                                </div>
                                <div class="col-md-6">
                                    <x-form.input-block>
                                        <x-form.label calss="focus-label"> {{ __('File') }}</x-form.label>
                                        <x-form.input type="file" class="floating" name="file" />
                                    </x-form.input-block>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                <div data-repeater-item class="card">
                    <div class="card-body">
                        <h3 class="card-title">
                            {{ __('Experience') }}
                            <a href="javascript:void(0);" data-repeater-delete type="button" class="delete-icon"
                            ><i class="fa-regular fa-trash-can"></i></a>
                        </h3>
                        <div class="row">
                            <div class="col-md-6">
                                <x-form.input-block>
                                    <x-form.label> {{ __('Job Position') }}</x-form.label>
                                    <x-form.input class="floating" type="text" name="position" value="{{ old('position') }}" />
                                </x-form.input-block>
                            </div>
                            <div class="col-md-6">
                                <x-form.input-block>
                                    <x-form.label> {{ __('Company Name') }}</x-form.label>
                                    <x-form.input class="floating" type="text" name="company" value="{{ old('company') }}" />
                                </x-form.input-block>
                            </div>

                            <div class="col-md-6">
                                <x-form.input-block>
                                    <x-form.label> {{ __('Location') }}</x-form.label>
                                    <x-form.input class="floating" type="text" name="location" value="{{ old('location') }}" />
                                </x-form.input-block>
                            </div>


                            <div class="col-md-6">
                                <x-form.input-block>
                                    <x-form.label calss="focus-label"> {{ __('From') }}</x-form.label>
                                    <div class="cal-icon">
                                        <x-form.input type="text" class="datepicker floating" name="start_date" value="{{ old('start_date') }}" />
                                    </div>
                                </x-form.input-block>
                            </div>
                            <div class="col-md-6">
                                <x-form.input-block>
                                    <x-form.label calss="focus-label"> {{ __('To') }}</x-form.label>
                                    <div class="cal-icon">
                                        <x-form.input type="text" class="datepicker floating" name="end_date" value="{{ old('end_date') }}" />
                                    </div>
                                </x-form.input-block>
                            </div>
                            <div class="col-md-6">
                                <x-form.input-block>
                                    <x-form.label calss="focus-label"> {{ __('File') }}</x-form.label>
                                    <x-form.input type="file" class="floating" name="file" />
                                </x-form.input-block>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="add-more">
            <a href="javascript:void(0);" data-repeater-create type="button"><i class="fa fa-plus-circle"></i> {{ __('Add More') }}</a>
        </div>
        <div class="submit-section my-3">
            <button class="btn btn-primary submit-btn">{{ __('Submit') }}</button>
        </div>
    </form>
</div>

<script type="module" defer>
    $(document).ready(function(){
        $('.repeater').repeater({
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
        })
    })
</script>

