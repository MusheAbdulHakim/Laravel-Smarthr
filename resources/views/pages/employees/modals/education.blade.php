<div class="modal-body">
  <form action="{{ route('employee.education', $employeeDetail->id) }}" method="post" enctype="multipart/form-data" class="repeater">
      @csrf
      <div class="form-scroll">
          <div data-repeater-list="education">
              @if (!empty($educations) && ($educations->count() > 0))
                  @foreach ($educations as $i => $education)
                  <div data-repeater-item class="card">
                    <input type="hidden" name="id" value="{{ $education->id }}">
                    <div class="card-body">
                        <h3 class="card-title">
                            {{ __('Education Information') }}
                            <a class="delete-icon deleteBtn" data-route="{{ route('employee.education.delete',['education' => $education->id])  }}" 
                                data-title="Delete Education"
                                data-question="Are you sure you want to delete?" data-repeater-delete type="button" href="javascript:void(0)">
                                <i class="fa-regular fa-trash-can"></i>
                            </a>
                           
                        </h3>
                        <div class="row">
                            <div class="col-md-6">
                                <x-form.input-block>
                                    <x-form.label> {{ __('Institution') }}</x-form.label>
                                    <x-form.input type="text" name="institution" value="{{ $education->institution ?? old('institution') }}" />
                                </x-form.input-block>
                            </div>
                            <div class="col-md-6">
                                <x-form.input-block>
                                    <x-form.label> {{ __('Subject') }}</x-form.label>
                                    <x-form.input type="text" name="subject" value="{{ $education->subject ?? old('subject') }}" />
                                </x-form.input-block>
                            </div>
  
                            <div class="col-md-6">
                                <x-form.input-block>
                                    <x-form.label> {{ __('Course') }}</x-form.label>
                                    <x-form.input type="text" name="course" value="{{ $education->course ?? old('course') }}" />
                                </x-form.input-block>
                            </div>
                            <div class="col-md-6">
                                <x-form.input-block>
                                    <x-form.label> {{ __('Grade') }}</x-form.label>
                                    <x-form.input type="text" name="grade" value="{{ $education->grade ?? old('grade') }}" />
                                </x-form.input-block>
                            </div>
  
                            <div class="col-md-6">
                                <x-form.input-block>
                                    <x-form.label calss="focus-label"> {{ __('Starting Date') }}</x-form.label>
                                    <div class="cal-icon">
                                        <x-form.input type="text" class="datepicker" name="start_date" value="{{ $education->start_date ?? old('start_date') }}" />
                                    </div>
                                </x-form.input-block>
                            </div>
                            <div class="col-md-6">
                                <x-form.input-block>
                                    <x-form.label calss="focus-label"> {{ __('Date Completed') }}</x-form.label>
                                    <div class="cal-icon">
                                        <x-form.input type="text" class="datepicker" name="end_date" value="{{ $education->end_date ?? old('end_date') }}" />
                                    </div>
                                </x-form.input-block>
                            </div>
                            <div class="col-md-6">
                                <x-form.input-block>
                                    <x-form.label calss="focus-label"> {{ __('File') }}</x-form.label>
                                    <x-form.input type="file" name="file" />
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
                          {{ __('Education Information') }}
                          <a href="javascript:void(0);" data-repeater-delete type="button" class="delete-icon"
                          ><i class="fa-regular fa-trash-can"></i></a>
                      </h3>
                      <div class="row">
                          <div class="col-md-6">
                              <x-form.input-block>
                                  <x-form.label> {{ __('Institution') }}</x-form.label>
                                  <x-form.input type="text" name="institution" value="{{ old('institution') }}" />
                              </x-form.input-block>
                          </div>
                          <div class="col-md-6">
                              <x-form.input-block>
                                  <x-form.label> {{ __('Subject') }}</x-form.label>
                                  <x-form.input type="text" name="subject" value="{{ old('subject') }}" />
                              </x-form.input-block>
                          </div>

                          <div class="col-md-6">
                              <x-form.input-block>
                                  <x-form.label> {{ __('Course') }}</x-form.label>
                                  <x-form.input type="text" name="course" value="{{ old('course') }}" />
                              </x-form.input-block>
                          </div>
                          <div class="col-md-6">
                              <x-form.input-block>
                                  <x-form.label> {{ __('Grade') }}</x-form.label>
                                  <x-form.input type="text" name="grade" value="{{ old('grade') }}" />
                              </x-form.input-block>
                          </div>

                          <div class="col-md-6">
                              <x-form.input-block>
                                  <x-form.label calss="focus-label"> {{ __('Starting Date') }}</x-form.label>
                                  <div class="cal-icon">
                                      <x-form.input type="text" class="datepicker" name="start_date" value="{{ old('start_date') }}" />
                                  </div>
                              </x-form.input-block>
                          </div>
                          <div class="col-md-6">
                              <x-form.input-block>
                                  <x-form.label calss="focus-label"> {{ __('Date Completed') }}</x-form.label>
                                  <div class="cal-icon">
                                      <x-form.input type="text" class="datepicker" name="end_date" value="{{ old('end_date') }}" />
                                  </div>
                              </x-form.input-block>
                          </div>
                          <div class="col-md-6">
                              <x-form.input-block>
                                  <x-form.label calss="focus-label"> {{ __('File') }}</x-form.label>
                                  <x-form.input type="file" name="file" />
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

