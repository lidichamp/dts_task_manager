@extends('layouts.app')

@section('title', 'View Task')

@section('content')
  <h1 class="govuk-heading-l">📄 Task Details</h1>

  <div class="govuk-summary-list">
    <div class="govuk-summary-list__row">
      <dt class="govuk-summary-list__key">Title</dt>
      <dd class="govuk-summary-list__value">{{ $task->title }}</dd>
    </div>
    <div class="govuk-summary-list__row">
      <dt class="govuk-summary-list__key">Assigned To</dt>
      <dd class="govuk-summary-list__value">{{ $task->assigned_to }}</dd>
    </div>
    <div class="govuk-summary-list__row">
      <dt class="govuk-summary-list__key">Description</dt>
      <dd class="govuk-summary-list__value">{{ $task->description }}</dd>
    </div>
    <div class="govuk-summary-list__row">
      <dt class="govuk-summary-list__key">Status</dt>
      <dd class="govuk-summary-list__value">{{ ucfirst($task->status) }}</dd>
    </div>
    <div class="govuk-summary-list__row">
      <dt class="govuk-summary-list__key">Due Date</dt>
      <dd class="govuk-summary-list__value">{{ \Carbon\Carbon::parse($task->due_date)->format('j M Y, g:i A') }}</dd>
    </div>
  </div>

  <a href="{{ route('tasks.edit', $task->id) }}" class="govuk-button">✏️ Edit Task</a>

  <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="govuk-button govuk-button--warning">❌ Delete Task</button>
  </form>
@endsection
