{{-- Add this to the top of any view file (like create/edit/index) --}}

{{-- Flash Messages --}}
@if (session('success'))
  <div class="govuk-notification-banner govuk-notification-banner--success">
    <div class="govuk-notification-banner__content">
      <h2 class="govuk-notification-banner__heading">
        ✅ {{ session('success') }}
      </h2>
    </div>
  </div>
@endif

@if (session('deleted'))
  <div class="govuk-notification-banner govuk-notification-banner--error">
    <div class="govuk-notification-banner__content">
      <h2 class="govuk-notification-banner__heading">
        🗑️ {{ session('deleted') }}
      </h2>
    </div>
  </div>
@endif

{{-- Validation Errors --}}
@if ($errors->any())
  <div class="govuk-error-summary" aria-labelledby="error-summary-title" role="alert" tabindex="-1">
    <h2 class="govuk-error-summary__title" id="error-summary-title">
      There is a problem
    </h2>
    <div class="govuk-error-summary__body">
      <ul class="govuk-list govuk-error-summary__list">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  </div>
@endif
