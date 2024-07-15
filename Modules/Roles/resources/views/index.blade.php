@extends('layouts.app')


@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb>
            <x-slot name="title">{{ __('Roles') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="#">{{ __('Roles') }}</a>
                </li>
            </ul>
        </x-breadcrumb>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-3">
                <a href="javascript:void(0)" data-url="{{ route('roles.create') }}" data-title="{{ __('Add Role') }}" data-ajax-modal="true" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> {{ __('Add Roles') }}</a>
                <div class="roles-menu">
                    <ul>
                        @foreach ($roles as $role)
                        <li class="{{!empty($selected_role) && ($role->id == $selected_role->id) ? 'active': ''}}">
                            <a href="javascript:void(0)">
                                <span onclick="window.location.href=`{{ route('roles.index', ['id' => \Crypt::encrypt($role->id)]) }}`">
                                    {{$role->name}}
                                </span>
                                <span class="role-action">
                                    <span class="action-circle large" data-bs-toggle="tooltip" title="{{ __("Assign Permissions") }}"
                                        onclick="window.location.href=`{{ route('roles.index', ['id' => \Crypt::encrypt($role->id)]) }}`">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>
                                    <span class="action-circle large" data-bs-toggle="tooltip" title="{{ __("Edit Role") }}"
                                        data-url="{{ route('roles.edit', $role->id) }}" data-title="{{ __('Edit Role') }}" data-ajax-modal="true"
                                    >
                                        <i class="material-icons">edit</i>
                                    </span>
                                    <span class="action-circle large delete-btn deleteBtn" data-bs-toggle="tooltip" title="{{ __('Delete Role') }}"
                                        data-route="{{ route('roles.destroy', $role->id) }}" data-title="{{ __('Delete Role') }}"
                                        data-question="{{ __('Are you sure you want to delete role?') }}">
                                        <i class="material-icons">delete</i>
                                    </span>
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-9">
                <div class="table-responsive">
                    <form @if (!empty($selected_role)) action="{{ route('permissions.update', $selected_role->id)}}" @endif method="post">
                        @csrf
                        <table class="table table-striped custom-table">
                            <thead>
                                <tr>
                                    <th>{{ __('Module Permission') }}</th>
                                    <th class="text-center">{{ __('Create') }}</th>
                                    <th class="text-center">{{ __('Read') }}</th>
                                    <th class="text-center">{{ __('Edit') }}</th>
                                    <th class="text-center">{{ __('Delete') }}</th>
                                    <th class="text-center">{{ __('Import') }}</th>
									<th class="text-center">{{ __('Export') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $module => $permission)
                                <tr>
                                    <td>{{ucwords($module)}}</td>
                                    <td class="text-center">
                                    @foreach ($permission as $key => $item)
                                        @if (!empty(str_starts_with($item, "create-")))
                                        <label class="custom_check">
                                            <input type="checkbox" name="permissions[]" value="{{$item}}"
                                            @if(!empty($selected_role) && ($selected_role->permissions->count() > 0))
                                                {{$selected_role->hasPermissionTo($item) ? 'checked': ''}}
                                            @endif>
                                            <span class="checkmark"></span>
                                        </label>
                                        @endif
                                    @endforeach
                                    </td>
                                    <td class="text-center">
                                        @foreach ($permission as $key => $item)
                                            @if (!empty(str_starts_with($item, "view-")))
                                            <label class="custom_check">
                                                <input type="checkbox" name="permissions[]" value="{{$item}}"
                                                @if(!empty($selected_role) && ($selected_role->permissions->count() > 0))
                                                    {{$selected_role->hasPermissionTo($item) ? 'checked': ''}}
                                                @endif>
                                                <span class="checkmark"></span>
                                            </label>	
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                    @foreach ($permission as $key => $item)
                                        @if (!empty(str_starts_with($item, "edit-")))
                                        <label class="custom_check">
                                            <input type="checkbox" name="permissions[]" value="{{$item}}"
                                            @if(!empty($selected_role) && ($selected_role->permissions->count() > 0))
                                                {{$selected_role->hasPermissionTo($item) ? 'checked': ''}}
                                            @endif>
                                            <span class="checkmark"></span>
                                        </label>	
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @foreach ($permission as $key => $item)
                                        @if (!empty(str_starts_with($item, "delete-")))
                                        <label class="custom_check">
                                            <input type="checkbox" name="permissions[]" value="{{$item}}"
                                            @if(!empty($selected_role) && ($selected_role->permissions->count() > 0))
                                                {{$selected_role->hasPermissionTo($item) ? 'checked': ''}}
                                            @endif>
                                            <span class="checkmark"></span>
                                        </label>   	
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @foreach ($permission as $key => $item)
                                        @if (!empty(str_starts_with($item, "import-")))
                                        <label class="custom_check">
                                            <input type="checkbox" name="permissions[]" value="{{$item}}"
                                            @if(!empty($selected_role) && ($selected_role->permissions->count() > 0))
                                                {{$selected_role->hasPermissionTo($item) ? 'checked': ''}}
                                            @endif>
                                            <span class="checkmark"></span>
                                        </label>	      
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                    @foreach ($permission as $key => $item)
                                        @if (!empty(str_starts_with($item, "export-")))
                                        <label class="custom_check">
                                            <input type="checkbox" name="permissions[]" value="{{$item}}"
                                            @if(!empty($selected_role) && ($selected_role->permissions->count() > 0))
                                                {{$selected_role->hasPermissionTo($item) ? 'checked': ''}}
                                            @endif>
                                            <span class="checkmark"></span>
                                        </label>	  
                                        @endif
                                        @endforeach
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (!empty($selected_role))
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit">{{ __('Update') }}</button>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

