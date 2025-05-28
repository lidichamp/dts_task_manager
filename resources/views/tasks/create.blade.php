@extends('layouts.app')

@section('title', 'Create Task')

@section('content')
  <h1 class="govuk-heading-l">📝 Create New Task</h1>

  @include('partials.flash_and_validation')

  <form action="{{ route('tasks.store') }}" method="POST">
    @csrf

    <div class="govuk-form-group">
      <label class="govuk-label" for="title">Task Title</label>
      <input class="govuk-input" id="title" name="title" type="text" required>
    </div>

    <div class="govuk-form-group">
      <label class="govuk-label" for="assigned_to">Assigned To</label>
      <input class="govuk-input" id="assigned_to" name="assigned_to" type="text">
    </div>

    <div class="govuk-form-group">
      <label class="govuk-label" for="description">Description</label>
      <textarea class="govuk-textarea" id="description" name="description" rows="5"></textarea>
    </div>

    <div class="govuk-form-group">
      <fieldset class="govuk-fieldset" aria-describedby="status-hint">
        <legend class="govuk-fieldset__legend govuk-fieldset__legend--m">
          <h1 class="govuk-fieldset__heading">Status</h1>
        </legend>
        <div class="govuk-radios" data-module="govuk-radios">
          <div class="govuk-radios__item">
            <input class="govuk-radios__input" id="status-pending" name="status" type="radio" value="pending" checked>
            <label class="govuk-label govuk-radios__label" for="status-pending">Pending</label>
          </div>
          <div class="govuk-radios__item">
            <input class="govuk-radios__input" id="status-in-progress" name="status" type="radio" value="in_progress">
            <label class="govuk-label govuk-radios__label" for="status-in-progress">In Progress</label>
          </div>
          <div class="govuk-radios__item">
            <input class="govuk-radios__input" id="status-completed" name="status" type="radio" value="completed">
            <label class="govuk-label govuk-radios__label" for="status-completed">Completed</label>
          </div>
        </div>
      </fieldset>
    </div>

    <div class="govuk-form-group">
      <label class="govuk-label" for="due_date">Due Date</label>
      <input class="govuk-input" id="due_date" name="due_date" type="datetime-local" required>
    </div>

    @include('partials.form_buttons')
  </form>
@endsection
