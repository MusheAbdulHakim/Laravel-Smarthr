@extends('pages.settings.index')


@section('page-section')
    <h5 class="text-info text-center">Under Development</h5>
    {{-- <form action="{{ route('settings.mail.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div x-data="{mailer: ''}">
                <div class="col-12">
                    <x-form.input-block>
                        <x-form.label>{{ __('Mailer') }}</x-form.label>
                        <select name="mailer" class="form-control" id="mailer">
                            <option x-model="smtp" {{ $settings->mailer == 'smtp'  ? 'selected': ''}} value="smtp">{{ __('SMTP') }}</option>
                            <option x-model="mailgun" {{ $settings->mailer == 'mailgun'  ? 'selected': ''}} value="mailgun">{{ __('Mailgun') }}</option>
                            <option x-model="postmark" {{ $settings->mailer == 'postmark'  ? 'selected': ''}} value="postmark">{{ __('Postmark') }}</option>
                            <option x-model="Resend" {{ $settings->mailer == 'resend'  ? 'selected': ''}} value="resend">{{ __('Resend') }}</option>
                            <option x-model="amazon ses" {{ $settings->mailer == 'amazon ses'  ? 'selected': ''}} value="amazon ses">{{ __('Amazon SES') }}</option>
                            <option x-model="sendmail" {{ $settings->mailer == 'sendmail'  ? 'selected': ''}} value="sendmail">{{ __('SendMail') }}</option>
                        </select>
                    </x-form.input-block>
                </div>
                <div x-show="mailer === smtp">
                    smtp here
                </div>
                <div x-show="mailer === phpmailer">
                    smtp here
                </div>
            </div>
        </div>
        <div class="submit-section">
            <button class="btn btn-primary submit-btn">{{ __('Save & Update') }}</button>
        </div>
    </form> --}}
@endsection

@push('page-scripts')
@endpush
