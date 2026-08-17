@extends('adminlte::page')

@section('title', 'Edit Doctor')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3>Edit Doctor</h3>

        <a href="{{ route('doctors.index') }}" class="back-btn btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow border-0">
                <div class="card-header bg-white">
                    <h3 class="card-title font-weight-bold">
                        Update Doctor Information
                    </h3>
                </div>

                <form action="{{ route('doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            @include('backend.doctor_section.partial_layout.edit_page.part_1')
                            <div class="col-md-8">
                                @include('backend.doctor_section.partial_layout.edit_page.part_2')
                                @include('backend.doctor_section.partial_layout.edit_page.part_3')
                                <div class="form-group">
                                    <label>Qualification</label>

                                    <input type="text" name="qualification" value="{{ $doctor->qualification }}"
                                        class="form-control @error('qualification') is-invalid @enderror">
                                    @error('qualification')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Location</label>

                                    <input type="text" name="location" value="{{ $doctor->location }}"
                                        class="form-control @error('location') is-invalid @enderror">
                                    @error('location')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                @include('backend.doctor_section.partial_layout.edit_page.part_4')
                                <div class="form-group">
                                    <label>About Doctor</label>
                                    <textarea name="about" rows="5" class="form-control">{{ $doctor->about }}</textarea>
                                </div>

                                {{-- Doctor Authentication Part --}}

                                @include('backend.doctor_section.partial_layout.edit_page.part_5')
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white text-right">
                        <button type="submit" class="btn btn-warning px-5">
                            <i class="fas fa-save"></i>
                            Update Doctor
                        </button>

                        <a href="{{ route('doctors.index') }}" class="btn btn-secondary px-4">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        bsCustomFileInput.init();
    </script>
@stop
