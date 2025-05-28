@extends('layouts.app')

@section('content')
<div class="govuk-width-container">
  <main class="govuk-main-wrapper" id="main-content" role="main">
    <div class="govuk-grid-row">
      <div class="govuk-grid-column-two-thirds">

       <h1 class="govuk-heading-l">Case Worker Task Manager</h1>
        <a href="{{ route('tasks.create') }}" class="govuk-button govuk-button--primary govuk-!-margin-bottom-4">
        Add New Task
      </a>

        <p class="govuk-body-l">Browse the tasks below.</p>

     
      <h2>Tasks</h2>
@foreach($tasks as $index => $task)
  <details class="govuk-details govuk-!-margin-bottom-4" data-module="govuk-details" {{ $index === 0 ? 'open' : '' }}>
    <summary class="govuk-details__summary">
      <span class="govuk-details__summary-text">
        {{ $task->title }}
      </span>
    </summary>
    <div class="govuk-details__text">
      <p><strong>Due:</strong> {{ \Carbon\Carbon::parse($task->due_date)->format('d F Y, g:i A') }}</p>
     <p><span class="govuk-tag govuk-tag--{{ $task->status === 'completed' ? 'green' : ($task->status === 'in_progress' ? 'blue' : 'grey') }}">
                {{ ucfirst($task->status) }}
              </span><br></p>
      <p><strong>Assigned to:</strong> {{ $task->assigned_to ?? 'Unassigned' }}</p>
      <p><a href="{{ route('tasks.show', $task->id) }}" class="govuk-link">View / Update</a></p>
    </div>
  </details>
@endforeach

      

        {{-- GOV.UK-style Pagination --}}
        <nav class="govuk-pagination" role="navigation" aria-label="Pagination">
          @if ($tasks->onFirstPage())
            <div class="govuk-pagination__prev govuk-pagination__prev--disabled">
              <span class="govuk-pagination__link">Previous</span>
            </div>
          @else
            <div class="govuk-pagination__prev">
              <a class="govuk-pagination__link" href="{{ $tasks->previousPageUrl() }}">Previous</a>
            </div>
          @endif

          @if ($tasks->hasMorePages())
            <div class="govuk-pagination__next">
              <a class="govuk-pagination__link" href="{{ $tasks->nextPageUrl() }}">Next</a>
            </div>
          @else
            <div class="govuk-pagination__next govuk-pagination__next--disabled">
              <span class="govuk-pagination__link">Next</span>
            </div>
          @endif
        </nav>

      </div>
    </div>
  </main>
</div>
@endsection