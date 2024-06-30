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
                          src="{{ !empty($user->avatar) ? asset('storage/users/' . $user->avatar) : asset('assets/img/user.jpg') }}"
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
                            @if (!empty($employee->emp_id))
                            <div class="small doj text-muted">
                              {{ __('Date of Join') }} : {{ format_date($employee->date_joined) }}
                            </div>
                            @endif
                            <div class="staff-msg">
                              <a class="btn btn-custom" href="{{ route('app.chat', $user->id) }}"
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
                                    <div class="text"><a href="#">{{ $user->phoneNumber }}</a>
                                    </div>
                                </li>
                            @endif
                            @if (!empty($user->email))
                                <li>
                                    <div class="title">{{ __('Email') }}:</div>
                                    <div class="text"><a href="">{{ $user->email }}</a></div>
                                </li>
                            @endif

                            @if (!empty($user->address))
                                <li>
                                    <div class="title">{{ __('Address') }}:</div>
                                    <div class="text"><a href="">{{ $user->address }}</a></div>
                                </li>
                            @endif
                            @if (!empty($employee->dob))
                                <li>
                                    <div class="title">{{ __('Date Of Birth') }}:</div>
                                    <div class="text"><a href="">{{ $user->dob }}</a></div>
                                </li>
                            @endif

                            @if (!empty($user->gender))
                                <li>
                                    <div class="title">{{ __('Gender') }}:</div>
                                    <div class="text"><a href="">{{ $user->gender }}</a></div>
                                </li>
                            @endif
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="pro-edit">
                      <a data-bs-target="#profile_info" href="#"
                        ><i class="fa-solid fa-pencil"></i
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
                      >{{ __('Profile') }}</a
                    >
                  </li>
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
                        <a href="{{ route('employee.personal-info', $employee->id) }}"
                          class="edit-icon" data-title="{{ __('Personal Information') }}"
                          data-ajax-modal="true" data-size="lg"
                          data-remote="true">
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
                          <div class="text"><a href="">{{ $employee->passport_tel }}</a></div>
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
                        <a href="{{ route('employee.emergency-contacts', $employee->id) }}"
                            class="edit-icon" data-title="{{ __('Emergency Contacts') }}"
                            data-ajax-modal="true" data-size="lg"
                            data-remote="true">
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
                      <h3 class="card-title">Bank information</h3>
                      <ul class="personal-info">
                        <li>
                          <div class="title">Bank name</div>
                          <div class="text">ICICI Bank</div>
                        </li>
                        <li>
                          <div class="title">Bank account No.</div>
                          <div class="text">159843014641</div>
                        </li>
                        <li>
                          <div class="title">IFSC Code</div>
                          <div class="text">ICI24504</div>
                        </li>
                        <li>
                          <div class="title">PAN No</div>
                          <div class="text">TC000Y56</div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 d-flex">
                  <div class="card profile-box flex-fill">
                    <div class="card-body">
                      <h3 class="card-title">
                        {{ __('Family Informations') }}
                        <a href="{{ route('family-information.create', ['user' => $user->id]) }}"
                            class="edit-icon" data-title="{{ __('Add Family Information') }}"
                            data-ajax-modal="true" data-size="lg"
                            data-bs-toggle="tooltip" data-bs-title="Add Family Member"
                            data-remote="true">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                      </h3>
                      <div class="table-responsive">
                        <table class="table table-nowrap">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Relationship</th>
                              <th>Date of Birth</th>
                              <th>Phone</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if ($user->has('family'))
                                @foreach ($user->family as $member)
                                <tr>
                                    @if (!empty($member->picture))
                                    <td>
                                        {!! Spatie\Menu\Laravel\Html::userAvatar($member->name, !empty($member->picture) ? uploadedAsset($member->picture,'family-members'): asset('assets/img/user.jpg')) !!}
                                    </td>
                                    @else
                                    <td>{{ $member->name }}</td>
                                    @endif
                                    <td>{{ $member->relationship }}</td>
                                    <td>{{ format_date($member->dob) }}</td>
                                    <td>{{ $member->phone }}</td>
                                    <x-table-action>
                                        <a class="dropdown-item" href="{{ route('family-information.edit', $member->id) }}" data-ajax-modal="true" data-remote="true"
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
              <div class="row">
                <div class="col-md-6 d-flex">
                  <div class="card profile-box flex-fill">
                    <div class="card-body">
                      <h3 class="card-title">
                        Education Informations
                        <a
                          href="#"
                          class="edit-icon"
                          data-bs-toggle="modal"
                          data-bs-target="#education_info"
                          ><i class="fa-solid fa-pencil"></i
                        ></a>
                      </h3>
                      <div class="experience-box">
                        <ul class="experience-list">
                          <li>
                            <div class="experience-user">
                              <div class="before-circle"></div>
                            </div>
                            <div class="experience-content">
                              <div class="timeline-content">
                                <a href="#/" class="name"
                                  >International College of Arts and Science
                                  (UG)</a
                                >
                                <div>Bsc Computer Science</div>
                                <span class="time">2000 - 2003</span>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="experience-user">
                              <div class="before-circle"></div>
                            </div>
                            <div class="experience-content">
                              <div class="timeline-content">
                                <a href="#/" class="name"
                                  >International College of Arts and Science
                                  (PG)</a
                                >
                                <div>Msc Computer Science</div>
                                <span class="time">2000 - 2003</span>
                              </div>
                            </div>
                          </li>
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
                            href="{{ route('employee.experience', $employee->id) }}"
                            class="edit-icon" data-title="{{ __('Working Experience Information') }}"
                            data-ajax-modal="true" data-size="lg"
                            data-bs-toggle="tooltip" data-bs-title="Working Experience"
                            data-remote="true"><i class="fa-solid fa-pencil"></i>
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
            </div>
            <!-- /Profile Info Tab -->


            <!-- /Assets -->
          </div>

    </div>
        <!-- Profile Modal -->
        <div id="profile_info" class="modal custom-modal fade" role="dialog">
            <div
            class="modal-dialog modal-dialog-centered modal-lg"
            role="document"
            >
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Profile Information</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form>
                    <div class="row">
                    <div class="col-md-12">
                        <div class="profile-img-wrap edit-img">
                        <img
                            class="inline-block"
                            src="assets/img/profiles/avatar-02.jpg"
                            alt="User Image"
                        />
                        <div class="fileupload btn">
                            <span class="btn-text">edit</span>
                            <input class="upload" type="file" />
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="input-block mb-3">
                            <label class="col-form-label">First Name</label>
                            <input
                                type="text"
                                class="form-control"
                                value="John"
                            />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-block mb-3">
                            <label class="col-form-label">Last Name</label>
                            <input
                                type="text"
                                class="form-control"
                                value="Doe"
                            />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-block mb-3">
                            <label class="col-form-label">Birth Date</label>
                            <div class="cal-icon">
                                <input
                                class="form-control datetimepicker"
                                type="text"
                                value="05/06/1985"
                                />
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-block mb-3">
                            <label class="col-form-label">Gender</label>
                            <select class="select form-control">
                                <option value="male selected">Male</option>
                                <option value="female">Female</option>
                            </select>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                        <div class="input-block mb-3">
                        <label class="col-form-label">Address</label>
                        <input
                            type="text"
                            class="form-control"
                            value="4487 Snowbird Lane"
                        />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                        <label class="col-form-label">State</label>
                        <input
                            type="text"
                            class="form-control"
                            value="New York"
                        />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                        <label class="col-form-label">Country</label>
                        <input
                            type="text"
                            class="form-control"
                            value="United States"
                        />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                        <label class="col-form-label">Pin Code</label>
                        <input type="text" class="form-control" value="10523" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                        <label class="col-form-label">Phone Number</label>
                        <input
                            type="text"
                            class="form-control"
                            value="631-889-3206"
                        />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                        <label class="col-form-label"
                            >Department <span class="text-danger">*</span></label
                        >
                        <select class="select">
                            <option>Select Department</option>
                            <option>Web Development</option>
                            <option>IT Management</option>
                            <option>Marketing</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                        <label class="col-form-label"
                            >Designation <span class="text-danger">*</span></label
                        >
                        <select class="select">
                            <option>Select Designation</option>
                            <option>Web Designer</option>
                            <option>Web Developer</option>
                            <option>Android Developer</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                        <label class="col-form-label"
                            >Reports To <span class="text-danger">*</span></label
                        >
                        <select class="select">
                            <option>-</option>
                            <option>Wilmer Deluna</option>
                            <option>Lesley Grauer</option>
                            <option>Jeffery Lalor</option>
                        </select>
                        </div>
                    </div>
                    </div>
                    <div class="submit-section">
                    <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
      <!-- /Profile Modal -->


@endsection


@push('page-scripts')
    <!-- Page Js -->
    <script src="{{ asset('assets/plugins/jquery-repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <!-- /Page Js -->
@endpush
