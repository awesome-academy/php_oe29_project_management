@extends('users.admin.index')

@section('breadcrumb')
    <li class="breadcrumb-item text-capitalize" aria-current="page">
       <a href="{{ route('courses.index') }}">{{ trans('course.title_list') }}</a>
    </li>
    <li class="breadcrumb-item active text-capitalize" aria-current="page">
        {{ trans('course.edit') . '-' . $course->name }}
    </li>
@endsection

@section('active-user', 'text-dark')
@section('active-role', 'text-dark')
@section('active-course', 'text-primary')

@section('admin')
    <label class="h3 text-uppercase">
        {{ trans('course.edit_title') }}
    </label>
    <form action="{{ route('courses.update', $course->id) }}" method="POST" role="form">
        @csrf
        @method('patch')
        <div class="form-group">
            <label for="name_class">{{ trans('general.name') }}</label>
            @error('name_class')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="text"
                class="form-control"
                name="name_class" id="name_class"
                placeholder="{{ trans('course.type_name') }}"
                value="{{ old('name_class', $course->name) }}">
        </div>
        <div class="form-group">
            <label for="id_lecturer" class="text-capitalize">{{ trans('course.lecturer_id') }}</label>
            @error('lecturer_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <input class="form-control" id="search_lecturer" type="text" placeholder="{{ trans('course.type_lecturer') }}">
            <ul class="list-group h-50 overflow-auto" id="listLecturer">
                @forelse ($lectures as $lecture)
                    <li class="list-group-item">
                        <input type="radio"
                            value="{{ $lecture->id }}"
                            name="lecturer_id"
                            id="{{ $lecture->id }}"
                            {{ old('lecturer_id', $course->user_id) == $lecture->id ? 'checked' : ''}}>
                        <label for="{{ $lecture->id }}" class="ml-2">{{ $lecture->email }}</label>
                    </li>
                @empty
                    <p>{{ trans('general.empty', ['attribute' => trans('user.user')]) }}</p>
                @endforelse
             </ul>
        </div>

        <button type="submit" class="btn btn-primary">{{ trans('general.save') }}</button>
    </form>
@endsection
