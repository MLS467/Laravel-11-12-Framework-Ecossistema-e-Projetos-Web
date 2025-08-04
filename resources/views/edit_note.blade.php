@extends("layouts.main")

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col">

            @include('top_bar')

            <!-- label and cancel -->
            <div class="row">
                <div class="col">
                    <p class="display-6 mb-0">EDIT NOTE</p>
                </div>
                <div class="col text-end">
                    <a href="{{ route('home') }}" class="btn btn-outline-danger">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </div>
            </div>

            <!-- form -->
            <form action="{{ route('editNoteSubmit') }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="note_id" value="{{ Crypt::encrypt($nota->id) }}">
                <div class="row mt-3">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Note Title</label>
                            <input type="text" class="form-control bg-primary text-white"
                                value="{{ old('text_title', $nota->title) }}" name="text_title">

                            @error('text_title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Note Text</label>
                            <textarea class="form-control bg-primary text-white" name="text_note" rows="5">
                            {{ old('text_note', $nota->text) }}
                            </textarea>
                            @error('text_note')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col text-end">
                        <a href="{{ route('home') }}" class="btn btn-primary px-5"><i
                                class="fa-solid fa-ban me-2"></i>Cancel</a>
                        <button type="submit" class="btn btn-secondary px-5"><i
                                class="fa-regular fa-circle-check me-2"></i>Update</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection