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
                      >Profile</a
                    >
                  </li>
                  <li class="nav-item">
                    <a
                      href="#emp_projects"
                      data-bs-toggle="tab"
                      class="nav-link"
                      >Projects</a
                    >
                  </li>
                  <li class="nav-item">
                    <a
                      href="#bank_statutory"
                      data-bs-toggle="tab"
                      class="nav-link"
                      >Bank & Statutory
                      <small class="text-danger">(Admin Only)</small></a
                    >
                  </li>
                  <li class="nav-item">
                    <a href="#emp_assets" data-bs-toggle="tab" class="nav-link"
                      >Assets</a
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
                        Personal Informations
                        <a
                          href="#"
                          class="edit-icon"
                          data-bs-toggle="modal"
                          data-bs-target="#personal_info_modal"
                          ><i class="fa-solid fa-pencil"></i
                        ></a>
                      </h3>
                      <ul class="personal-info">
                        <li>
                          <div class="title">Passport No.</div>
                          <div class="text">9876543210</div>
                        </li>
                        <li>
                          <div class="title">Passport Exp Date.</div>
                          <div class="text">9876543210</div>
                        </li>
                        <li>
                          <div class="title">Tel</div>
                          <div class="text"><a href="">9876543210</a></div>
                        </li>
                        <li>
                          <div class="title">Nationality</div>
                          <div class="text">Indian</div>
                        </li>
                        <li>
                          <div class="title">Religion</div>
                          <div class="text">Christian</div>
                        </li>
                        <li>
                          <div class="title">Marital status</div>
                          <div class="text">Married</div>
                        </li>
                        <li>
                          <div class="title">Employment of spouse</div>
                          <div class="text">No</div>
                        </li>
                        <li>
                          <div class="title">No. of children</div>
                          <div class="text">2</div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 d-flex">
                  <div class="card profile-box flex-fill">
                    <div class="card-body">
                      <h3 class="card-title">
                        Emergency Contact
                        <a
                          href="#"
                          class="edit-icon"
                          data-bs-toggle="modal"
                          data-bs-target="#emergency_contact_modal"
                          ><i class="fa-solid fa-pencil"></i
                        ></a>
                      </h3>
                      <h5 class="section-title">Primary</h5>
                      <ul class="personal-info">
                        <li>
                          <div class="title">Name</div>
                          <div class="text">John Doe</div>
                        </li>
                        <li>
                          <div class="title">Relationship</div>
                          <div class="text">Father</div>
                        </li>
                        <li>
                          <div class="title">Phone</div>
                          <div class="text">9876543210, 9876543210</div>
                        </li>
                      </ul>
                      <hr />
                      <h5 class="section-title">Secondary</h5>
                      <ul class="personal-info">
                        <li>
                          <div class="title">Name</div>
                          <div class="text">Karen Wills</div>
                        </li>
                        <li>
                          <div class="title">Relationship</div>
                          <div class="text">Brother</div>
                        </li>
                        <li>
                          <div class="title">Phone</div>
                          <div class="text">9876543210, 9876543210</div>
                        </li>
                      </ul>
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
                        Family Informations
                        <a
                          href="#"
                          class="edit-icon"
                          data-bs-toggle="modal"
                          data-bs-target="#family_info_modal"
                          ><i class="fa-solid fa-pencil"></i
                        ></a>
                      </h3>
                      <div class="table-responsive">
                        <table class="table table-nowrap">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Relationship</th>
                              <th>Date of Birth</th>
                              <th>Phone</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Leo</td>
                              <td>Brother</td>
                              <td>Feb 16th, 2019</td>
                              <td>9876543210</td>
                              <td class="text-end">
                                <div class="dropdown dropdown-action">
                                  <a
                                    aria-expanded="false"
                                    data-bs-toggle="dropdown"
                                    class="action-icon dropdown-toggle"
                                    href="#"
                                    ><i class="material-icons">more_vert</i></a
                                  >
                                  <div
                                    class="dropdown-menu dropdown-menu-right"
                                  >
                                    <a href="#" class="dropdown-item"
                                      ><i class="fa-solid fa-pencil m-r-5"></i>
                                      Edit</a
                                    >
                                    <a href="#" class="dropdown-item"
                                      ><i
                                        class="fa-regular fa-trash-can m-r-5"
                                      ></i>
                                      Delete</a
                                    >
                                  </div>
                                </div>
                              </td>
                            </tr>
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
                        Experience
                        <a
                          href="#"
                          class="edit-icon"
                          data-bs-toggle="modal"
                          data-bs-target="#experience_info"
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
                                  >Web Designer at Zen Corporation</a
                                >
                                <span class="time"
                                  >Jan 2013 - Present (5 years 2 months)</span
                                >
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
                                  >Web Designer at Ron-tech</a
                                >
                                <span class="time"
                                  >Jan 2013 - Present (5 years 2 months)</span
                                >
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
                                  >Web Designer at Dalt Technology</a
                                >
                                <span class="time"
                                  >Jan 2013 - Present (5 years 2 months)</span
                                >
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /Profile Info Tab -->

            <!-- Projects Tab -->
            <div class="tab-pane fade" id="emp_projects">
              <div class="row">
                <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="dropdown profile-action">
                        <a
                          aria-expanded="false"
                          data-bs-toggle="dropdown"
                          class="action-icon dropdown-toggle"
                          href="#"
                          ><i class="material-icons">more_vert</i></a
                        >
                        <div class="dropdown-menu dropdown-menu-right">
                          <a
                            data-bs-target="#edit_project"
                            data-bs-toggle="modal"
                            href="#"
                            class="dropdown-item"
                            ><i class="fa-solid fa-pencil m-r-5"></i> Edit</a
                          >
                          <a
                            data-bs-target="#delete_project"
                            data-bs-toggle="modal"
                            href="#"
                            class="dropdown-item"
                            ><i class="fa-regular fa-trash-can m-r-5"></i>
                            Delete</a
                          >
                        </div>
                      </div>
                      <h4 class="project-title">
                        <a href="project-view.html">Office Management</a>
                      </h4>
                      <small class="block text-ellipsis m-b-15">
                        <span class="text-xs">1</span>
                        <span class="text-muted">open tasks, </span>
                        <span class="text-xs">9</span>
                        <span class="text-muted">tasks completed</span>
                      </small>
                      <p class="text-muted">
                        Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. When an unknown printer took a
                        galley of type and scrambled it...
                      </p>
                      <div class="pro-deadline m-b-15">
                        <div class="sub-title">Deadline:</div>
                        <div class="text-muted">17 Apr 2019</div>
                      </div>
                      <div class="project-members m-b-15">
                        <div>Project Leader :</div>
                        <ul class="team-members">
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="Jeffery Lalor"
                              ><img
                                src="assets/img/profiles/avatar-16.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                        </ul>
                      </div>
                      <div class="project-members m-b-15">
                        <div>Team :</div>
                        <ul class="team-members">
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="John Doe"
                              ><img
                                src="assets/img/profiles/avatar-02.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="Richard Miles"
                              ><img
                                src="assets/img/profiles/avatar-09.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="John Smith"
                              ><img
                                src="assets/img/profiles/avatar-10.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="Mike Litorus"
                              ><img
                                src="assets/img/profiles/avatar-05.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                          <li>
                            <a href="#" class="all-users">+15</a>
                          </li>
                        </ul>
                      </div>
                      <p class="m-b-5">
                        Progress <span class="text-success float-end">40%</span>
                      </p>
                      <div class="progress progress-xs mb-0">
                        <div
                          class="w-40"
                          title=""
                          data-bs-toggle="tooltip"
                          role="progressbar"
                          class="progress-bar bg-success"
                          data-original-title="40%"
                        ></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="dropdown profile-action">
                        <a
                          aria-expanded="false"
                          data-bs-toggle="dropdown"
                          class="action-icon dropdown-toggle"
                          href="#"
                          ><i class="material-icons">more_vert</i></a
                        >
                        <div class="dropdown-menu dropdown-menu-right">
                          <a
                            data-bs-target="#edit_project"
                            data-bs-toggle="modal"
                            href="#"
                            class="dropdown-item"
                            ><i class="fa-solid fa-pencil m-r-5"></i> Edit</a
                          >
                          <a
                            data-bs-target="#delete_project"
                            data-bs-toggle="modal"
                            href="#"
                            class="dropdown-item"
                            ><i class="fa-regular fa-trash-can m-r-5"></i>
                            Delete</a
                          >
                        </div>
                      </div>
                      <h4 class="project-title">
                        <a href="project-view.html">Project Management</a>
                      </h4>
                      <small class="block text-ellipsis m-b-15">
                        <span class="text-xs">2</span>
                        <span class="text-muted">open tasks, </span>
                        <span class="text-xs">5</span>
                        <span class="text-muted">tasks completed</span>
                      </small>
                      <p class="text-muted">
                        Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. When an unknown printer took a
                        galley of type and scrambled it...
                      </p>
                      <div class="pro-deadline m-b-15">
                        <div class="sub-title">Deadline:</div>
                        <div class="text-muted">17 Apr 2019</div>
                      </div>
                      <div class="project-members m-b-15">
                        <div>Project Leader :</div>
                        <ul class="team-members">
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="Jeffery Lalor"
                              ><img
                                src="assets/img/profiles/avatar-16.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                        </ul>
                      </div>
                      <div class="project-members m-b-15">
                        <div>Team :</div>
                        <ul class="team-members">
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="John Doe"
                              ><img
                                src="assets/img/profiles/avatar-02.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="Richard Miles"
                              ><img
                                src="assets/img/profiles/avatar-09.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="John Smith"
                              ><img
                                src="assets/img/profiles/avatar-10.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="Mike Litorus"
                              ><img
                                src="assets/img/profiles/avatar-05.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                          <li>
                            <a href="#" class="all-users">+15</a>
                          </li>
                        </ul>
                      </div>
                      <p class="m-b-5">
                        Progress <span class="text-success float-end">40%</span>
                      </p>
                      <div class="progress progress-xs mb-0">
                        <div
                          class="w-40"
                          title=""
                          data-bs-toggle="tooltip"
                          role="progressbar"
                          class="progress-bar bg-success"
                          data-original-title="40%"
                        ></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="dropdown profile-action">
                        <a
                          aria-expanded="false"
                          data-bs-toggle="dropdown"
                          class="action-icon dropdown-toggle"
                          href="#"
                          ><i class="material-icons">more_vert</i></a
                        >
                        <div class="dropdown-menu dropdown-menu-right">
                          <a
                            data-bs-target="#edit_project"
                            data-bs-toggle="modal"
                            href="#"
                            class="dropdown-item"
                            ><i class="fa-solid fa-pencil m-r-5"></i> Edit</a
                          >
                          <a
                            data-bs-target="#delete_project"
                            data-bs-toggle="modal"
                            href="#"
                            class="dropdown-item"
                            ><i class="fa-regular fa-trash-can m-r-5"></i>
                            Delete</a
                          >
                        </div>
                      </div>
                      <h4 class="project-title">
                        <a href="project-view.html">Video Calling App</a>
                      </h4>
                      <small class="block text-ellipsis m-b-15">
                        <span class="text-xs">3</span>
                        <span class="text-muted">open tasks, </span>
                        <span class="text-xs">3</span>
                        <span class="text-muted">tasks completed</span>
                      </small>
                      <p class="text-muted">
                        Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. When an unknown printer took a
                        galley of type and scrambled it...
                      </p>
                      <div class="pro-deadline m-b-15">
                        <div class="sub-title">Deadline:</div>
                        <div class="text-muted">17 Apr 2019</div>
                      </div>
                      <div class="project-members m-b-15">
                        <div>Project Leader :</div>
                        <ul class="team-members">
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="Jeffery Lalor"
                              ><img
                                src="assets/img/profiles/avatar-16.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                        </ul>
                      </div>
                      <div class="project-members m-b-15">
                        <div>Team :</div>
                        <ul class="team-members">
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="John Doe"
                              ><img
                                src="assets/img/profiles/avatar-02.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="Richard Miles"
                              ><img
                                src="assets/img/profiles/avatar-09.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="John Smith"
                              ><img
                                src="assets/img/profiles/avatar-10.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="Mike Litorus"
                              ><img
                                src="assets/img/profiles/avatar-05.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                          <li>
                            <a href="#" class="all-users">+15</a>
                          </li>
                        </ul>
                      </div>
                      <p class="m-b-5">
                        Progress <span class="text-success float-end">40%</span>
                      </p>
                      <div class="progress progress-xs mb-0">
                        <div
                          class="w-40"
                          title=""
                          data-bs-toggle="tooltip"
                          role="progressbar"
                          class="progress-bar bg-success"
                          data-original-title="40%"
                        ></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="dropdown profile-action">
                        <a
                          aria-expanded="false"
                          data-bs-toggle="dropdown"
                          class="action-icon dropdown-toggle"
                          href="#"
                          ><i class="material-icons">more_vert</i></a
                        >
                        <div class="dropdown-menu dropdown-menu-right">
                          <a
                            data-bs-target="#edit_project"
                            data-bs-toggle="modal"
                            href="#"
                            class="dropdown-item"
                            ><i class="fa-solid fa-pencil m-r-5"></i> Edit</a
                          >
                          <a
                            data-bs-target="#delete_project"
                            data-bs-toggle="modal"
                            href="#"
                            class="dropdown-item"
                            ><i class="fa-regular fa-trash-can m-r-5"></i>
                            Delete</a
                          >
                        </div>
                      </div>
                      <h4 class="project-title">
                        <a href="project-view.html">Hospital Administration</a>
                      </h4>
                      <small class="block text-ellipsis m-b-15">
                        <span class="text-xs">12</span>
                        <span class="text-muted">open tasks, </span>
                        <span class="text-xs">4</span>
                        <span class="text-muted">tasks completed</span>
                      </small>
                      <p class="text-muted">
                        Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. When an unknown printer took a
                        galley of type and scrambled it...
                      </p>
                      <div class="pro-deadline m-b-15">
                        <div class="sub-title">Deadline:</div>
                        <div class="text-muted">17 Apr 2019</div>
                      </div>
                      <div class="project-members m-b-15">
                        <div>Project Leader :</div>
                        <ul class="team-members">
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="Jeffery Lalor"
                              ><img
                                src="assets/img/profiles/avatar-16.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                        </ul>
                      </div>
                      <div class="project-members m-b-15">
                        <div>Team :</div>
                        <ul class="team-members">
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="John Doe"
                              ><img
                                src="assets/img/profiles/avatar-02.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="Richard Miles"
                              ><img
                                src="assets/img/profiles/avatar-09.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="John Smith"
                              ><img
                                src="assets/img/profiles/avatar-10.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                          <li>
                            <a
                              href="#"
                              data-bs-toggle="tooltip"
                              title="Mike Litorus"
                              ><img
                                src="assets/img/profiles/avatar-05.jpg"
                                alt="User Image"
                            /></a>
                          </li>
                          <li>
                            <a href="#" class="all-users">+15</a>
                          </li>
                        </ul>
                      </div>
                      <p class="m-b-5">
                        Progress <span class="text-success float-end">40%</span>
                      </p>
                      <div class="progress progress-xs mb-0">
                        <div
                          class="w-40"
                          title=""
                          data-bs-toggle="tooltip"
                          role="progressbar"
                          class="progress-bar bg-success"
                          data-original-title="40%"
                        ></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /Projects Tab -->

            <!-- Bank Statutory Tab -->
            <div class="tab-pane fade" id="bank_statutory">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Basic Salary Information</h3>
                  <form>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="input-block mb-3">
                          <label class="col-form-label"
                            >Salary basis
                            <span class="text-danger">*</span></label
                          >
                          <select class="select">
                            <option>Select salary basis type</option>
                            <option>Hourly</option>
                            <option>Daily</option>
                            <option>Weekly</option>
                            <option>Monthly</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="input-block mb-3">
                          <label class="col-form-label"
                            >Salary amount
                            <small class="text-muted">per month</small></label
                          >
                          <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Type your salary amount"
                              value="0.00"
                            />
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="input-block mb-3">
                          <label class="col-form-label">Payment type</label>
                          <select class="select">
                            <option>Select payment type</option>
                            <option>Bank transfer</option>
                            <option>Check</option>
                            <option>Cash</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <hr />
                    <h3 class="card-title">PF Information</h3>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="input-block mb-3">
                          <label class="col-form-label">PF contribution</label>
                          <select class="select">
                            <option>Select PF contribution</option>
                            <option>Yes</option>
                            <option>No</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="input-block mb-3">
                          <label class="col-form-label"
                            >PF No. <span class="text-danger">*</span></label
                          >
                          <select class="select">
                            <option>Select PF contribution</option>
                            <option>Yes</option>
                            <option>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="input-block mb-3">
                          <label class="col-form-label">Employee PF rate</label>
                          <select class="select">
                            <option>Select PF contribution</option>
                            <option>Yes</option>
                            <option>No</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="input-block mb-3">
                          <label class="col-form-label"
                            >Additional rate
                            <span class="text-danger">*</span></label
                          >
                          <select class="select">
                            <option>Select additional rate</option>
                            <option>0%</option>
                            <option>1%</option>
                            <option>2%</option>
                            <option>3%</option>
                            <option>4%</option>
                            <option>5%</option>
                            <option>6%</option>
                            <option>7%</option>
                            <option>8%</option>
                            <option>9%</option>
                            <option>10%</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="input-block mb-3">
                          <label class="col-form-label">Total rate</label>
                          <input
                            type="text"
                            class="form-control"
                            placeholder="N/A"
                            value="11%"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="input-block mb-3">
                          <label class="col-form-label">Employee PF rate</label>
                          <select class="select">
                            <option>Select PF contribution</option>
                            <option>Yes</option>
                            <option>No</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="input-block mb-3">
                          <label class="col-form-label"
                            >Additional rate
                            <span class="text-danger">*</span></label
                          >
                          <select class="select">
                            <option>Select additional rate</option>
                            <option>0%</option>
                            <option>1%</option>
                            <option>2%</option>
                            <option>3%</option>
                            <option>4%</option>
                            <option>5%</option>
                            <option>6%</option>
                            <option>7%</option>
                            <option>8%</option>
                            <option>9%</option>
                            <option>10%</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="input-block mb-3">
                          <label class="col-form-label">Total rate</label>
                          <input
                            type="text"
                            class="form-control"
                            placeholder="N/A"
                            value="11%"
                          />
                        </div>
                      </div>
                    </div>

                    <hr />
                    <h3 class="card-title">ESI Information</h3>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="input-block mb-3">
                          <label class="col-form-label">ESI contribution</label>
                          <select class="select">
                            <option>Select ESI contribution</option>
                            <option>Yes</option>
                            <option>No</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="input-block mb-3">
                          <label class="col-form-label"
                            >ESI No. <span class="text-danger">*</span></label
                          >
                          <select class="select">
                            <option>Select ESI contribution</option>
                            <option>Yes</option>
                            <option>No</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="input-block mb-3">
                          <label class="col-form-label"
                            >Employee ESI rate</label
                          >
                          <select class="select">
                            <option>Select ESI contribution</option>
                            <option>Yes</option>
                            <option>No</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="input-block mb-3">
                          <label class="col-form-label"
                            >Additional rate
                            <span class="text-danger">*</span></label
                          >
                          <select class="select">
                            <option>Select additional rate</option>
                            <option>0%</option>
                            <option>1%</option>
                            <option>2%</option>
                            <option>3%</option>
                            <option>4%</option>
                            <option>5%</option>
                            <option>6%</option>
                            <option>7%</option>
                            <option>8%</option>
                            <option>9%</option>
                            <option>10%</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="input-block mb-3">
                          <label class="col-form-label">Total rate</label>
                          <input
                            type="text"
                            class="form-control"
                            placeholder="N/A"
                            value="11%"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="submit-section">
                      <button class="btn btn-primary submit-btn" type="submit">
                        Save
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- /Bank Statutory Tab -->

            <!-- Assets -->
            <div class="tab-pane fade" id="emp_assets">
              <div class="table-responsive table-newdatatable">
                <table class="table table-new custom-table mb-0 datatable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Asset ID</th>
                      <th>Assigned Date</th>
                      <th>Assignee</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>
                        <a href="assets-details.html" class="table-imgname">
                          <img
                            src="assets/img/laptop.png"
                            class="me-2"
                            alt="Laptop Image"
                          />
                          <span>Laptop</span>
                        </a>
                      </td>
                      <td>AST - 001</td>
                      <td>22 Nov, 2022 10:32AM</td>
                      <td class="table-namesplit">
                        <a
                          href="javascript:void(0);"
                          class="table-profileimage"
                        >
                          <img
                            src="assets/img/profiles/avatar-02.jpg"
                            class="me-2"
                            alt="User Image"
                          />
                        </a>
                        <a href="javascript:void(0);" class="table-name">
                          <span>John Paul Raj</span>
                          <p>john@dreamguystech.com</p>
                        </a>
                      </td>
                      <td>
                        <div class="table-actions d-flex">
                          <a
                            class="delete-table me-2"
                            href="user-asset-details.html"
                          >
                            <img
                              src="assets/img/icons/eye.svg"
                              alt="Eye Icon"
                            />
                          </a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>
                        <a href="assets-details.html" class="table-imgname">
                          <img
                            src="assets/img/laptop.png"
                            class="me-2"
                            alt="Laptop Image"
                          />
                          <span>Laptop</span>
                        </a>
                      </td>
                      <td>AST - 002</td>
                      <td>22 Nov, 2022 10:32AM</td>
                      <td class="table-namesplit">
                        <a
                          href="javascript:void(0);"
                          class="table-profileimage"
                          data-bs-toggle="modal"
                          data-bs-target="#edit-asset"
                        >
                          <img
                            src="assets/img/profiles/avatar-05.jpg"
                            class="me-2"
                            alt="User Image"
                          />
                        </a>
                        <a href="javascript:void(0);" class="table-name">
                          <span>Vinod Selvaraj</span>
                          <p>vinod.s@dreamguystech.com</p>
                        </a>
                      </td>
                      <td>
                        <div class="table-actions d-flex">
                          <a
                            class="delete-table me-2"
                            href="user-asset-details.html"
                          >
                            <img
                              src="assets/img/icons/eye.svg"
                              alt="Eye Icon"
                            />
                          </a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>
                        <a href="assets-details.html" class="table-imgname">
                          <img
                            src="assets/img/keyboard.png"
                            class="me-2"
                            alt="Keyboard Image"
                          />
                          <span>Dell Keyboard</span>
                        </a>
                      </td>
                      <td>AST - 003</td>
                      <td>22 Nov, 2022 10:32AM</td>
                      <td class="table-namesplit">
                        <a
                          href="javascript:void(0);"
                          class="table-profileimage"
                          data-bs-toggle="modal"
                          data-bs-target="#edit-asset"
                        >
                          <img
                            src="assets/img/profiles/avatar-03.jpg"
                            class="me-2"
                            alt="User Image"
                          />
                        </a>
                        <a href="javascript:void(0);" class="table-name">
                          <span>Harika </span>
                          <p>harika.v@dreamguystech.com</p>
                        </a>
                      </td>
                      <td>
                        <div class="table-actions d-flex">
                          <a
                            class="delete-table me-2"
                            href="user-asset-details.html"
                          >
                            <img
                              src="assets/img/icons/eye.svg"
                              alt="Eye Icon"
                            />
                          </a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>
                        <a href="#" class="table-imgname">
                          <img
                            src="assets/img/mouse.png"
                            class="me-2"
                            alt="Mouse Image"
                          />
                          <span>Logitech Mouse</span>
                        </a>
                      </td>
                      <td>AST - 0024</td>
                      <td>22 Nov, 2022 10:32AM</td>
                      <td class="table-namesplit">
                        <a
                          href="assets-details.html"
                          class="table-profileimage"
                        >
                          <img
                            src="assets/img/profiles/avatar-02.jpg"
                            class="me-2"
                            alt="User Image"
                          />
                        </a>
                        <a href="assets-details.html" class="table-name">
                          <span>Mythili</span>
                          <p>mythili@dreamguystech.com</p>
                        </a>
                      </td>
                      <td>
                        <div class="table-actions d-flex">
                          <a
                            class="delete-table me-2"
                            href="user-asset-details.html"
                          >
                            <img
                              src="assets/img/icons/eye.svg"
                              alt="Eye Icon"
                            />
                          </a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>
                        <a href="#" class="table-imgname">
                          <img
                            src="assets/img/laptop.png"
                            class="me-2"
                            alt="Laptop Image"
                          />
                          <span>Laptop</span>
                        </a>
                      </td>
                      <td>AST - 005</td>
                      <td>22 Nov, 2022 10:32AM</td>
                      <td class="table-namesplit">
                        <a
                          href="assets-details.html"
                          class="table-profileimage"
                        >
                          <img
                            src="assets/img/profiles/avatar-02.jpg"
                            class="me-2"
                            alt="User Image"
                          />
                        </a>
                        <a href="assets-details.html" class="table-name">
                          <span>John Paul Raj</span>
                          <p>john@dreamguystech.com</p>
                        </a>
                      </td>
                      <td>
                        <div class="table-actions d-flex">
                          <a
                            class="delete-table me-2"
                            href="user-asset-details.html"
                          >
                            <img
                              src="assets/img/icons/eye.svg"
                              alt="Eye Icon"
                            />
                          </a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>6</td>
                      <td>
                        <a href="#" class="table-imgname">
                          <img
                            src="assets/img/laptop.png"
                            class="me-2"
                            alt="Laptop Image"
                          />
                          <span>Laptop</span>
                        </a>
                      </td>
                      <td>AST - 006</td>
                      <td>22 Nov, 2022 10:32AM</td>
                      <td class="table-namesplit">
                        <a
                          href="javascript:void(0);"
                          class="table-profileimage"
                        >
                          <img
                            src="assets/img/profiles/avatar-05.jpg"
                            class="me-2"
                            alt="User Image"
                          />
                        </a>
                        <a href="javascript:void(0);" class="table-name">
                          <span>Vinod Selvaraj</span>
                          <p>vinod.s@dreamguystech.com</p>
                        </a>
                      </td>
                      <td>
                        <div class="table-actions d-flex">
                          <a
                            class="delete-table me-2"
                            href="user-asset-details.html"
                          >
                            <img
                              src="assets/img/icons/eye.svg"
                              alt="Eye Icon"
                            />
                          </a>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
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

      <!-- Personal Info Modal -->
      <div
        id="personal_info_modal"
        class="modal custom-modal fade"
        role="dialog"
      >
        <div
          class="modal-dialog modal-dialog-centered modal-lg"
          role="document"
        >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Personal Information</h5>
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
                  <div class="col-md-6">
                    <div class="input-block mb-3">
                      <label class="col-form-label">Passport No</label>
                      <input type="text" class="form-control" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-block mb-3">
                      <label class="col-form-label"
                        >Passport Expiry Date</label
                      >
                      <div class="cal-icon">
                        <input
                          class="form-control datetimepicker"
                          type="text"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-block mb-3">
                      <label class="col-form-label">Tel</label>
                      <input class="form-control" type="text" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-block mb-3">
                      <label class="col-form-label"
                        >Nationality <span class="text-danger">*</span></label
                      >
                      <input class="form-control" type="text" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-block mb-3">
                      <label class="col-form-label">Religion</label>
                      <div class="cal-icon">
                        <input class="form-control" type="text" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-block mb-3">
                      <label class="col-form-label"
                        >Marital status
                        <span class="text-danger">*</span></label
                      >
                      <select class="select form-control">
                        <option>-</option>
                        <option>Single</option>
                        <option>Married</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-block mb-3">
                      <label class="col-form-label"
                        >Employment of spouse</label
                      >
                      <input class="form-control" type="text" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-block mb-3">
                      <label class="col-form-label">No. of children </label>
                      <input class="form-control" type="text" />
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
      <!-- /Personal Info Modal -->

      <!-- Family Info Modal -->
      <div
        id="family_info_modal"
        class="modal custom-modal fade"
        role="dialog"
      >
        <div
          class="modal-dialog modal-dialog-centered modal-lg"
          role="document"
        >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Family Informations</h5>
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
                <div class="form-scroll">
                  <div class="card">
                    <div class="card-body">
                      <h3 class="card-title">
                        Family Member
                        <a href="javascript:void(0);" class="delete-icon"
                          ><i class="fa-regular fa-trash-can"></i
                        ></a>
                      </h3>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="input-block mb-3">
                            <label class="col-form-label"
                              >Name <span class="text-danger">*</span></label
                            >
                            <input class="form-control" type="text" />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3">
                            <label class="col-form-label"
                              >Relationship
                              <span class="text-danger">*</span></label
                            >
                            <input class="form-control" type="text" />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3">
                            <label class="col-form-label"
                              >Date of birth
                              <span class="text-danger">*</span></label
                            >
                            <input class="form-control" type="text" />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3">
                            <label class="col-form-label"
                              >Phone <span class="text-danger">*</span></label
                            >
                            <input class="form-control" type="text" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-body">
                      <h3 class="card-title">
                        Education Informations
                        <a href="javascript:void(0);" class="delete-icon"
                          ><i class="fa-regular fa-trash-can"></i
                        ></a>
                      </h3>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="input-block mb-3">
                            <label class="col-form-label"
                              >Name <span class="text-danger">*</span></label
                            >
                            <input class="form-control" type="text" />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3">
                            <label class="col-form-label"
                              >Relationship
                              <span class="text-danger">*</span></label
                            >
                            <input class="form-control" type="text" />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3">
                            <label class="col-form-label"
                              >Date of birth
                              <span class="text-danger">*</span></label
                            >
                            <input class="form-control" type="text" />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3">
                            <label class="col-form-label"
                              >Phone <span class="text-danger">*</span></label
                            >
                            <input class="form-control" type="text" />
                          </div>
                        </div>
                      </div>
                      <div class="add-more">
                        <a href="javascript:void(0);"
                          ><i class="fa-solid fa-plus-circle"></i> Add More</a
                        >
                      </div>
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
      <!-- /Family Info Modal -->

      <!-- Emergency Contact Modal -->
      <div
        id="emergency_contact_modal"
        class="modal custom-modal fade"
        role="dialog"
      >
        <div
          class="modal-dialog modal-dialog-centered modal-lg"
          role="document"
        >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Personal Information</h5>
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
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Primary Contact</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="input-block mb-3">
                          <label class="col-form-label"
                            >Name <span class="text-danger">*</span></label
                          >
                          <input type="text" class="form-control" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="input-block mb-3">
                          <label class="col-form-label"
                            >Relationship
                            <span class="text-danger">*</span></label
                          >
                          <input class="form-control" type="text" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="input-block mb-3">
                          <label class="col-form-label"
                            >Phone <span class="text-danger">*</span></label
                          >
                          <input class="form-control" type="text" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="input-block mb-3">
                          <label class="col-form-label">Phone 2</label>
                          <input class="form-control" type="text" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Primary Contact</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="input-block mb-3">
                          <label class="col-form-label"
                            >Name <span class="text-danger">*</span></label
                          >
                          <input type="text" class="form-control" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="input-block mb-3">
                          <label class="col-form-label"
                            >Relationship
                            <span class="text-danger">*</span></label
                          >
                          <input class="form-control" type="text" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="input-block mb-3">
                          <label class="col-form-label"
                            >Phone <span class="text-danger">*</span></label
                          >
                          <input class="form-control" type="text" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="input-block mb-3">
                          <label class="col-form-label">Phone 2</label>
                          <input class="form-control" type="text" />
                        </div>
                      </div>
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
      <!-- /Emergency Contact Modal -->

      <!-- Education Modal -->
      <div id="education_info" class="modal custom-modal fade" role="dialog">
        <div
          class="modal-dialog modal-dialog-centered modal-lg"
          role="document"
        >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Education Informations</h5>
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
                <div class="form-scroll">
                  <div class="card">
                    <div class="card-body">
                      <h3 class="card-title">
                        Education Informations
                        <a href="javascript:void(0);" class="delete-icon"
                          ><i class="fa-regular fa-trash-can"></i
                        ></a>
                      </h3>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus focused">
                            <input
                              type="text"
                              value="Oxford University"
                              class="form-control floating"
                            />
                            <label class="focus-label">Institution</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus focused">
                            <input
                              type="text"
                              value="Computer Science"
                              class="form-control floating"
                            />
                            <label class="focus-label">Subject</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus focused">
                            <div class="cal-icon">
                              <input
                                type="text"
                                value="01/06/2002"
                                class="form-control floating datetimepicker"
                              />
                            </div>
                            <label class="focus-label">Starting Date</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus focused">
                            <div class="cal-icon">
                              <input
                                type="text"
                                value="31/05/2006"
                                class="form-control floating datetimepicker"
                              />
                            </div>
                            <label class="focus-label">Complete Date</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus focused">
                            <input
                              type="text"
                              value="BE Computer Science"
                              class="form-control floating"
                            />
                            <label class="focus-label">Degree</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus focused">
                            <input
                              type="text"
                              value="Grade A"
                              class="form-control floating"
                            />
                            <label class="focus-label">Grade</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-body">
                      <h3 class="card-title">
                        Education Informations
                        <a href="javascript:void(0);" class="delete-icon"
                          ><i class="fa-regular fa-trash-can"></i
                        ></a>
                      </h3>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus focused">
                            <input
                              type="text"
                              value="Oxford University"
                              class="form-control floating"
                            />
                            <label class="focus-label">Institution</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus focused">
                            <input
                              type="text"
                              value="Computer Science"
                              class="form-control floating"
                            />
                            <label class="focus-label">Subject</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus focused">
                            <div class="cal-icon">
                              <input
                                type="text"
                                value="01/06/2002"
                                class="form-control floating datetimepicker"
                              />
                            </div>
                            <label class="focus-label">Starting Date</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus focused">
                            <div class="cal-icon">
                              <input
                                type="text"
                                value="31/05/2006"
                                class="form-control floating datetimepicker"
                              />
                            </div>
                            <label class="focus-label">Complete Date</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus focused">
                            <input
                              type="text"
                              value="BE Computer Science"
                              class="form-control floating"
                            />
                            <label class="focus-label">Degree</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus focused">
                            <input
                              type="text"
                              value="Grade A"
                              class="form-control floating"
                            />
                            <label class="focus-label">Grade</label>
                          </div>
                        </div>
                      </div>
                      <div class="add-more">
                        <a href="javascript:void(0);"
                          ><i class="fa-solid fa-plus-circle"></i> Add More</a
                        >
                      </div>
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
      <!-- /Education Modal -->

      <!-- Experience Modal -->
      <div id="experience_info" class="modal custom-modal fade" role="dialog">
        <div
          class="modal-dialog modal-dialog-centered modal-lg"
          role="document"
        >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Experience Informations</h5>
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
                <div class="form-scroll">
                  <div class="card">
                    <div class="card-body">
                      <h3 class="card-title">
                        Experience Informations
                        <a href="javascript:void(0);" class="delete-icon"
                          ><i class="fa-regular fa-trash-can"></i
                        ></a>
                      </h3>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus">
                            <input
                              type="text"
                              class="form-control floating"
                              value="Digital Devlopment Inc"
                            />
                            <label class="focus-label">Company Name</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus">
                            <input
                              type="text"
                              class="form-control floating"
                              value="United States"
                            />
                            <label class="focus-label">Location</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus">
                            <input
                              type="text"
                              class="form-control floating"
                              value="Web Developer"
                            />
                            <label class="focus-label">Job Position</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus">
                            <div class="cal-icon">
                              <input
                                type="text"
                                class="form-control floating datetimepicker"
                                value="01/07/2007"
                              />
                            </div>
                            <label class="focus-label">Period From</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus">
                            <div class="cal-icon">
                              <input
                                type="text"
                                class="form-control floating datetimepicker"
                                value="08/06/2018"
                              />
                            </div>
                            <label class="focus-label">Period To</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-body">
                      <h3 class="card-title">
                        Experience Informations
                        <a href="javascript:void(0);" class="delete-icon"
                          ><i class="fa-regular fa-trash-can"></i
                        ></a>
                      </h3>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus">
                            <input
                              type="text"
                              class="form-control floating"
                              value="Digital Devlopment Inc"
                            />
                            <label class="focus-label">Company Name</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus">
                            <input
                              type="text"
                              class="form-control floating"
                              value="United States"
                            />
                            <label class="focus-label">Location</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus">
                            <input
                              type="text"
                              class="form-control floating"
                              value="Web Developer"
                            />
                            <label class="focus-label">Job Position</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus">
                            <div class="cal-icon">
                              <input
                                type="text"
                                class="form-control floating datetimepicker"
                                value="01/07/2007"
                              />
                            </div>
                            <label class="focus-label">Period From</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-block mb-3 form-focus">
                            <div class="cal-icon">
                              <input
                                type="text"
                                class="form-control floating datetimepicker"
                                value="08/06/2018"
                              />
                            </div>
                            <label class="focus-label">Period To</label>
                          </div>
                        </div>
                      </div>
                      <div class="add-more">
                        <a href="javascript:void(0);"
                          ><i class="fa-solid fa-plus-circle"></i> Add More</a
                        >
                      </div>
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
      <!-- /Experience Modal -->
@endsection


@push('page-scripts')
    <!-- Page Js -->
    <!-- /Page Js -->
@endpush
