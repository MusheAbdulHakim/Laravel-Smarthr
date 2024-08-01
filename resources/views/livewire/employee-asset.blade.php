<div>
    @if (!$showAsset)
    <div class="table-responsive table-newdatatable">
        <table class="table table-new custom-table mb-0 datatable">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ __('Name') }}</th>
              <th>{{ __('Asset ID') }}</th>
              <th>{{ __('Assigned Date') }}</th>
              <th>{{ __('Assignee') }}</th>
              <th>{{ __('Action') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($user->assets as $key => $asset)
            <tr>
              <td>{{ ++$key }}</td>
              <td>
                <a href="assets-details.html" class="table-imgname">
                  <span>{{ $asset->name }}</span>
                </a>
              </td>
              <td>{{ $asset->ast_id }}</td>
              <td>{{ format_date($asset->created_at) }}</td>
              <td class="table-namesplit">
                <a href="javascript:void(0);" class="table-name">
                  <span>{{ $asset->createdBy->fullname ?? '' }}</span>
                  <p>{{ $asset->createdBy->email ?? '' }}</p>
                </a>
              </td>
              <td>
                <div class="table-actions d-flex" wire:click="viewAsset({{ $asset->id }})">
                  <a
                    class="delete-table me-2"
                    href="javascript:void(0)"
                  >
                  <img
                      src="{{ asset('images/icons/eye.svg') }}"
                      alt="Eye Icon"
                    />
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
    @else
    <div class="assign-head">
        <div class="assign-content">
            <h6>{{ $asset->name }}</h6>
        </div>
        <div class="assign-content" x-data>
            @php
                $profileUrl = route('employees.show', 
            ['employee' => Crypt::encrypt($asset->user->id)]);
            @endphp
            <button type="button" class="btn btn-assign me-2" @click="window.location.href='{{ $profileUrl }}'">{{ __('Assets') }}</button>
            <a href="#" class="btn btn-assign" data-bs-toggle="modal" data-bs-target="#raise-issue"><i class="fas fa-hand-paper"></i> Raise Issue  </a>
        </div>
    </div>
    <div class="card asset-box">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-7">
                    <h5>{{ __('Asset Info') }}</h5>
                    <div class="asset-info">
                        <div class="asset-info-det">
                            <h6>{{ $asset->name }}</h6>
                            <p>{{ $asset->model }}</p>
                            <ul>
                                <li>Type <span>Keybaord</span></li>
                                <li>{{ __('Serial Number') }} <span>{{ $asset->serial_no }}</span></li>
                                <li>{{ __('Brand') }} <span>{{ $asset->brand }}</span></li>
                            </ul>
                        </div>
                    </div>
                    @if (!empty($asset->files))    
                    <div class="assets-image">
                        <h5>{{ __('Asset Files') }}</h5>
                        <ul>
                            @foreach ($asset->files as $file)
                            @if (is_string($file))
                            <li>
                                <img src="{{ uploadedAsset($file,'assets') }}" width="100px" height="100px" alt="Keyboard Image">
                            </li>
                            @endif
                            @endforeach 
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="col-lg-5">
                    <div class="asset-history">
                        <h5>{{ __('Asset Info') }}</h5>
                        <ul>
                            <li>
                                <div class="aset-img">
                                    <img src="{{ asset('images/icons/icon-01.svg') }}" alt="Asset Image">
                                </div>
                                <div class="asset-inf">
                                    <h6>{{ __('Supplier') }}</h6>
                                    <p>{{ $asset->supplier }}</p>
                                </div>
                            </li>
                            <li>
                                <div class="aset-img">
                                    <img src="{{ asset('images/icons/icon-04.svg') }}" alt="Asset Image">
                                </div>
                                <div class="asset-inf">
                                    <h6>{{ __('Cost') }}</h6>
                                    <p>{{ LocaleSettings('currency_symbol').$asset->cost }}</p>
                                </div>
                            </li>
                            <li>
                                <div class="aset-img">
                                    <img src="{{ asset('images/icons/icon-05.svg') }}" alt="Asset Image">
                                </div>
                                <div class="asset-inf">
                                    <h6>{{ ('Manufacturer') }}</h6>
                                    <p>{{ $asset->manufacturer }}</p>
                                </div>
                            </li>
                            <li>
                                <div class="aset-img">
                                    <img src="{{ asset('images/icons/icon-02.svg') }}" alt="Asset Image">
                                </div>
                                <div class="asset-inf">
                                    <h6>{{ __('Warranty') }}</h6>
                                    <p><span>{{ __('Months: ') }}</span>{{ $asset->warranty }}</p>
                                    <p><span>{{ __('Ends On: ') }}</span>{{ format_date($asset->warranty_end) }}</p>
                                </div>
                            </li>									
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="raise-issue" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Raise Issue') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="raiseIssue({{ $asset->id }})" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-block mb-3">
                                    <label class="col-form-label">{{ __('Description') }}</label>
                                    <textarea rows="4" class="form-control" wire:model="description" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section mt-0">
                            <button class="btn btn-primary submit-btn w-100" type="submit">{{ ('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @script
    <script defer type="module">
        Livewire.on('IssueRaiseSuccess', (param) => {
            modalEl = document.getElementById('raise-issue')
            bootstrap.Modal.getOrCreateInstance(modalEl).hide()
            console.log(param)
            Toastify({
                text: param,
                className: "success",
            }).showToast()
        })
    </script>
    @endscript
</div>
