@extends('layouts.app')

@push('page-styles')
    <!-- Page Css -->
    <!-- /Page Css -->
@endpush

@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb>
            <x-slot name="title">{{ __("Employee Profile") }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('Profile') }}
                </li>
            </ul>
        </x-breadcrumb>
        <!-- /Page Header -->
        <div class="card mb-0">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="profile-view">
                  <div class="profile-img-wrap">
                    <div class="profile-img">
                      <a href="#"
                        ><img
                        src="{{ !empty($user->avatar) ? asset('storage/users/' . $user->avatar) : Vite::asset('resources/assets/img/user.jpg') }}"
                        alt="User Image"
                      /></a>
                    </div>
                  </div>
                  <div class="profile-basic">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="profile-info-left">
                          <h3 class="user-name m-t-0 mb-0">{{ $user->fullname }}</h3>
                          @if (!empty($employee->department_id))
                          <h6 class="text-muted">{{ $employee->department->name ?? '' }}</h6>
                          @endif
                          @if (!empty($employee->designation_id))
                          <small class="text-muted">{{ $employee->designation->name ?? '' }}</small>
                          @endif
                          @if (!empty($employee->emp_id))
                          <div class="staff-id">{{ __('Employee ID') }} : {{ $employee->emp_id ?? '' }}</div>
                          @endif
                          @if (!empty($employee->date_joined))
                          <div class="small doj text-muted">
                            {{ __('Date of Join') }} : {{ format_date($employee->date_joined) }}
                          </div>
                          @endif
                          <div class="staff-msg">
                            <a class="btn btn-custom" href="#"
                              >{{ __('Send Message') }}</a
                            >
                          </div>
                          <br>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <ul class="personal-info">
                          @if (!empty($user->phone))
                              <li>
                                  <div class="title">{{ __('Phone') }}:</div>
                                  <div class="text"><a href="#">{{ $user->phoneNumber }}</a></div>
                              </li>
                          @endif
                          @if (!empty($user->email))
                              <li>
                                  <div class="title">{{ __('Email') }}:</div>
                                  <div class="text">{{ $user->email }}</div>
                              </li>
                          @endif

                          @if (!empty($user->address))
                              <li>
                                  <div class="title">{{ __('Address') }}:</div>
                                  <div class="text">{{ $user->address }}</div>
                              </li>
                          @endif
                          @if (!empty($employee->dob))
                              <li>
                                  <div class="title">{{ __('Date Of Birth') }}:</div>
                                  <div class="text">{{ format_date($user->dob) }}</div>
                              </li>
                          @endif

                          @if (!empty($user->gender))
                              <li>
                                  <div class="title">{{ __('Gender') }}:</div>
                                  <div class="text">{{ $user->gender }}</div>
                              </li>
                          @endif
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="pro-edit">
                    <a href="javascript:void(0)" data-url="{{ route('employees.edit', ['employee' => \Crypt::encrypt($user->id)]) }}" data-ajax-modal="true" 
                      data-title="Edit Employee" data-size="lg" data-bs-toggle="tooltip" data-bs-title="{{ __('Edit profile') }}"><i class="fa-solid fa-pencil"></i
                    ></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card tab-box">
          <div class="row user-tabs">
            <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
              <ul class="nav nav-tabs nav-tabs-bottom">
                <li class="nav-item">
                  <a
                    href="#emp_profile"
                    data-bs-toggle="tab"
                    class="nav-link active"
                    >{{ __('Profile') }}</a>
                </li>
                @superadmin
                <li class="nav-item">
                  <a
                    href="#bank_statutory"
                    data-bs-toggle="tab"
                    class="nav-link"
                    >{{ __('Bank & Statutory') }}
                  </a>
                </li>
                @endsuperadmin
                @if (!empty($user->assets) && ($user->assets->count() > 0))
                <li class="nav-item">
                  <a
                    href="#emp_assets"
                    data-bs-toggle="tab"
                    class="nav-link"
                    >{{ __('Assets') }}</a>
                </li>
                @endif
              </ul>
            </div>
          </div>
        </div>

        <div class="tab-content">
          <!-- Profile Info Tab -->
          <div
            id="emp_profile"
            class="pro-overview tab-pane fade show active"
          >
            <div class="row">
              <div class="col-md-6 d-flex">
                <div class="card profile-box flex-fill">
                  <div class="card-body">
                    <h3 class="card-title">
                      {{ __('Personal Informations') }}
                      <a href="javascript:void(0)" data-url="{{ route('employee.personal-info', $employee->id) }}"
                        class="edit-icon" data-title="{{ __('Personal Information') }}"
                        data-ajax-modal="true" data-size="lg"
                        >
                        <i class="fa-solid fa-pencil"></i>
                      </a>
                    </h3>
                    <ul class="personal-info">
                      @if (!empty($employee->passport_no))
                        <li>
                          <div class="title">{{ __('Passport No.') }}</div>
                          <div class="text">{{ $employee->passport_no }}</div>
                        </li>
                      @endif
                      @if (!empty($employee->passport_expiry_date))
                      <li>
                        <div class="title">{{ __('Passport Exp Date.') }}</div>
                        <div class="text">{{ format_date($employee->passport_expiry_date) }}</div>
                      </li>
                      @endif
                      @if (!empty($employee->passport_tel))
                      <li>
                        <div class="title">{{ __('Tel') }}</div>
                        <div class="text">{{ $employee->passport_tel }}</a></div>
                      </li>
                      @endif
                      @if (!empty($employee->nationality))
                      <li>
                        <div class="title">{{ __('Nationality') }}</div>
                        <div class="text">{{ $employee->nationality }}</div>
                      </li>
                      @endif
                      @if (!empty($employee->religion))
                      <li>
                        <div class="title">{{ __('Religion') }}</div>
                        <div class="text">{{ $employee->religion }}</div>
                      </li>
                      @endif
                      @if (!empty($employee->marital_status))
                      <li>
                        <div class="title">{{ __('Marital status') }}</div>
                        <div class="text">{{ $employee->marital_status }}</div>
                      </li>
                      @endif
                      @if (!empty($employee->spouse_occupation))
                      <li>
                        <div class="title">{{ __('Employment of spouse') }}</div>
                        <div class="text">{{ $employee->spouse_occupation }}</div>
                      </li>
                      @endif
                      @if (!empty($employee->no_of_children))
                      <li>
                        <div class="title">{{ __('No. of children') }}</div>
                        <div class="text">{{ $employee->no_of_children }}</div>
                      </li>
                      @endif
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-6 d-flex">
                <div class="card profile-box flex-fill">
                  <div class="card-body">
                    <h3 class="card-title">
                      {{ __('Emergency Contact') }}
                      <a href="javascript:void(0)" data-url="{{ route('employee.emergency-contacts', $employee->id) }}"
                          class="edit-icon" data-title="{{ __('Emergency Contacts') }}"
                          data-ajax-modal="true" data-size="lg"
                          >
                          <i class="fa-solid fa-pencil"></i>
                      </a>
                    </h3>
                    <h5 class="section-title">{{ __('Primary') }}</h5>
                    @php
                        $primary_contact = $employee->emergency_contacts['primary'] ?? null;
                        $secondary_contact = $employee->emergency_contacts['secondary'] ?? null;
                    @endphp
                    @if (!empty($primary_contact))
                    <ul class="personal-info">
                      <li>
                        <div class="title">{{ __('Name') }}</div>
                        <div class="text">{{ $primary_contact['name'] }}</div>
                      </li>
                      <li>
                        <div class="title">{{ __('Relationship') }}</div>
                        <div class="text">{{ $primary_contact['relationship'] }}</div>
                      </li>
                      <li>
                        <div class="title">{{ __('Phone') }}</div>
                        <div class="text">{{ $primary_contact['phone'] }}</div>
                      </li>
                      <li>
                        <div class="title">{{ __('Address') }}</div>
                        <div class="text">{{ $primary_contact['address'] }}</div>
                      </li>
                    </ul>
                    @endif
                    @if (!empty($secondary_contact))
                    <hr />
                    <h5 class="section-title">{{ __('Secondary') }}</h5>
                    <ul class="personal-info">
                      <li>
                        <div class="title">Name</div>
                        <div class="text">{{ $secondary_contact['name']  }}</div>
                      </li>
                      <li>
                        <div class="title">Relationship</div>
                        <div class="text">{{ $secondary_contact['relationship']  }}</div>
                      </li>
                      <li>
                        <div class="title">Phone</div>
                        <div class="text">{{ $secondary_contact['phone'] }}</div>
                      </li>
                    </ul>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 d-flex">
                <div class="card profile-box flex-fill">
                  <div class="card-body">
                    <h3 class="card-title">
                      {{ __('Education Informations') }}
                      <a
                      href="javascript:void(0)" data-url="{{ route('employee.education', $employee->id) }}"
                        class="edit-icon" data-title="{{ __('Education Information') }}"
                        data-ajax-modal="true" data-size="lg"
                        data-bs-toggle="tooltip" data-bs-title="Education"
                        ><i class="fa-solid fa-pencil"></i>
                      </a>
                    </h3>
                    <div class="experience-box">
                      <ul class="experience-list">
                        @if(!empty($employee->education) && $employee->education->count() > 0)
                          @foreach ($employee->education as $education)
                          <li>
                            <div class="experience-user">
                              <div class="before-circle"></div>
                            </div>
                            <div class="experience-content">
                              <div class="timeline-content">
                                <a href="#/" class="name"
                                  >{{$education->institution}}</a
                                >
                                <div>{{ $education->course }}</div>
                                <span class="time">{{ $education->start_date }} - {{ $education->end_date }}</span>
                                @if (!empty($education->file))
                                    <a href="{{ uploadedAsset($education->file,'employees/education') }}" target="_blank" rel="noopener noreferrer">{{ __('View File') }}</a>
                                @endif
                              </div>
                            </div>
                          </li>
                          @endforeach
                        @endif
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 d-flex">
                <div class="card profile-box flex-fill">
                  <div class="card-body">
                    <h3 class="card-title">
                      {{ __('Work Experience') }}
                      <a
                      href="javascript:void(0)" data-url="{{ route('employee.experience', $employee->id) }}"
                          class="edit-icon" data-title="{{ __('Working Experience Information') }}"
                          data-ajax-modal="true" data-size="lg"
                          data-bs-toggle="tooltip" data-bs-title="Working Experience"
                          ><i class="fa-solid fa-pencil"></i>
                      </a>
                    </h3>
                    <div class="experience-box">
                      <ul class="experience-list">
                          @if (!empty($employee->workExperience))
                              @foreach ($employee->workExperience as $experience)
                              <li>
                                <div class="experience-user">
                                  <div class="before-circle"></div>
                                </div>
                                <div class="experience-content">
                                  <div class="timeline-content">
                                    <span class="name">{{ $experience->position .__(" At "). $experience->company}}</span>
                                    <span class="time"
                                      >{{ format_date($experience->start_date) }} - {{ format_date($experience->end_date) }} ({{ $experience->dateDifference }}) </span>
                                      @if (!empty($experience->file))
                                          <a href="{{ uploadedAsset($experience->file,'employees/work-experience') }}" target="_blank" rel="noopener noreferrer">{{ __('View File') }}</a>
                                      @endif
                                  </div>
                                </div>
                              </li>
                              @endforeach
                          @endif
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 d-flex">
                <div class="card profile-box flex-fill">
                  <div class="card-body">
                    <h3 class="card-title">
                      {{ __('Family Informations') }}
                      <a href="javascript:void(0)" data-url="{{ route('family-information.create', ['user' => $user->id]) }}"
                          class="edit-icon" data-title="{{ __('Add Family Information') }}"
                          data-ajax-modal="true" data-size="lg"
                          data-bs-toggle="tooltip" data-bs-title="Add Family Member"
                          >
                          <i class="fa-solid fa-plus"></i>
                      </a>
                    </h3>
                    <div class="table-responsive">
                      <table class="table table-nowrap">
                        <thead>
                          <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Relationship') }}</th>
                            <th>{{ __('Date of Birth') }}</th>
                            <th>{{ __('Phone') }}</th>
                            <th>{{ __('Action') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if ($user->has('family'))
                              @foreach ($user->family as $member)
                              <tr>
                                  @if (!empty($member->picture))
                                  <td>
                                      {!! Spatie\Menu\Laravel\Html::userAvatar($member->name, !empty($member->picture) ? uploadedAsset($member->picture,'family-members'): Vite::asset('resources/assets/img/user.jpg')) !!}
                                  </td>
                                  @else
                                  <td>{{ $member->name }}</td>
                                  @endif
                                  <td>{{ $member->relationship }}</td>
                                  <td>{{ format_date($member->dob) }}</td>
                                  <td>{{ $member->phone }}</td>
                                  <x-table-action>
                                      <a class="dropdown-item" href="javascript:void(0)" data-url="javascript:void(0)" data-url="{{ route('family-information.edit', $member->id) }}" data-ajax-modal="true" 
                                          data-title="{{ __('Edit Family Member') }}" data-size="lg" data-bs-toggle="tooltip" data-bs-title="{{ __("Edit Family Member Information") }}">
                                          <i class="fa-solid fa-pencil m-r-5"></i>
                                          {{ __('Edit') }}
                                      </a>
                                      <a class="dropdown-item deleteBtn" data-route="{{ route('family-information.destroy', $member->id) }}"
                                          data-title="{{ __('Delete User') }}" data-bs-toggle="tooltip" data-bs-title="{{ __('Delete Family Member') }}" data-question="{{ __('Are you sure you want to delete?') }}"
                                          href="javascript:void(0)" data-bs-toggle="tootip" data-bs-title="{{ __('Delete Family Member') }}">
                                          <i class="fa-regular fa-trash-can m-r-5"></i>
                                          {{ __('Delete') }}
                                      </a>
                                  </x-table-action>

                                </tr>
                              @endforeach
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /Profile Info Tab -->

          @superadmin
          <!-- Bank Statutory Tab -->
          <div class="tab-pane fade" id="bank_statutory">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">{{ __('Basic Salary Information') }}</h3>
                <form action="{{ route('employee.salary-setting', $employee->id) }}" method="post">
                  @csrf
                  <div class="row">
                    <input type="hidden" name="salary_detail_id" value="{{ !empty($employee->salaryDetails) ? $employee->salaryDetails->id : '' }}">
                    <div class="col-sm-4">
                      <div class="input-block mb-3">
                        <label class="col-form-label"
                          >{{ __('Salary basis') }}
                          <span class="text-danger">*</span></label
                        >
                        <select class="form-control" name="basis">
                          <option value="">{{ __('Select salary basis type') }}</option>
                          @foreach (\App\Enums\Payroll\SalaryType::cases() as $item)
                              <option {{ (!empty($employee->salaryDetails) && $employee->salaryDetails->basis === $item) ? 'selected': '' }} value="{{ $item->value }}">{{ $item->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-block mb-3">
                        <label class="col-form-label"
                          >{{ __('Salary amount') }}
                        </label>
                        <div class="input-group">
                          <span class="input-group-text">{{ LocaleSettings('currency_symbol') }}</span>
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Type your salary amount"
                            name="base_salary"
                            value="{{ !empty($employee->salaryDetails) ? $employee->salaryDetails->base_salary : 0.00 }}"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-block mb-3">
                        <label class="col-form-label">{{ __('Payment type') }}</label>
                        <select class="form-control" name="payment_method">
                          <option value="">{{ __('Select payment type') }}</option>
                          @foreach (\App\Enums\Payroll\PaymentMethod::cases() as $item)
                            <option {{ !empty($employee->salaryDetails) && $employee->salaryDetails->payment_method === $item ? 'selected': '' }} value="{{ $item->value }}">{{ $item->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  @if (!empty(SalarySettings('enable_esi_fund')))
                  <hr />
                  <h3 class="card-title">{{ __('PF Information') }}</h3>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="input-block mb-3">
                        <label class="col-form-label">{{ __('PF contribution') }}</label>
                        <select class="form-control" name="pf_contribution">
                          <option value="">{{ __('Select To Enable') }}</option>
                          <option {{ (!empty($employee->salaryDetails) && $employee->salaryDetails->pf_contribution == '1') ? 'selected': '' }} value="1">{{ __('Yes') }}</option>
                          <option {{ (!empty($employee->salaryDetails) && $employee->salaryDetails->pf_contribution == '0') ? 'selected': '' }} value="0">{{ __('No') }}</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-block mb-3">
                        <label class="col-form-label">{{ __('PF No.') }}</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="N/A"
                          name="pf_number"
                          value="{{ !empty($employee->salaryDetails) ? $employee->salaryDetails->pf_number: '' }}"
                        />
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-block mb-3">
                        <label class="col-form-label">{{ __('Additional Rate') }}</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="N/A"
                          name="additional_pf_rate"
                          value="{{ !empty($employee->salaryDetails) ? $employee->salaryDetails->additional_pf: '' }}"
                        />
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-block mb-3">
                        <label class="col-form-label">{{ __('Total rate') }}</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="N/A"
                          name="total_pf_rate"
                          value="{{ !empty($employee->salaryDetails) ? $employee->salaryDetails->total_pf : '' }}"
                        />
                      </div>
                    </div>
                  </div>
                  @endif
                  @if (!empty(SalarySettings('enable_esi_fund')))  
                  <hr />
                  <h3 class="card-title">{{ __('ESI Information') }}</h3>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="input-block mb-3">
                        <label class="col-form-label">{{ __('Enable ESI contribution') }}</label>
                        <select class="form-control" name="esi_contribution">
                          <option value="">{{ __('Select To Enable') }}</option>
                          <option {{ !empty($employee->salaryDetails) && $employee->salaryDetails->esi_contribution == '1' ? 'selected': '' }} value="1">{{ __('Yes') }}</option>
                          <option {{ !empty($employee->salaryDetails) && $employee->salaryDetails->esi_contribution == '0' ? 'selected': '' }} value="0">{{ __('No') }}</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-block mb-3">
                        <label class="col-form-label">{{ __('ESI No.') }}</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="N/A"
                          name="esi_number"
                          value="{{ !empty($employee->salaryDetails) ? $employee->salaryDetails->esi_number: '' }}"
                        />
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-block mb-3">
                        <label class="col-form-label">{{ __('Additional Rate') }}</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="N/A"
                          name="additional_esi_rate"
                          value="{{ !empty($employee->salaryDetails) ? $employee->salaryDetails->additional_esi: '' }}"
                        />
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-block mb-3">
                        <label class="col-form-label">{{ __('Total rate') }}</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="N/A"
                          name="total_esi_rate"
                          value="{{ !empty($employee->salaryDetails) ? $employee->salaryDetails->total_additional_esi_rate: '' }}"
                        />
                      </div>
                    </div>
                  </div>
                  @endif

                  <div class="submit-section">
                    <button class="btn btn-primary submit-btn" type="submit">
                      {{ __('Save') }}
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- /Bank Statutory Tab -->
          @endsuperadmin

          <!-- Assets -->
          <div class="tab-pane fade" id="emp_assets">
              <livewire:employee-asset :user="$user"/>
          </div>
          <!-- /Assets -->

        </div>

    </div>


@endsection


