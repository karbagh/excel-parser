@extends('app')
@section('content')
    <section class="container">
        <div class="row my-3">
            <div class="col-12">
                <div class="card my-3">
                    <div class="card-body bg-light">
                        <form action="{{ route('rows.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="file" name="excel" required
                                   accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            <button class="btn btn-secondary" type="submit">Import</button>
                            <ul class="text-danger errors">
                                @foreach($errors->get('excel') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                </div>
                @each('components.integrations.card', $integrations, 'integration')
            </div>
        </div>
    </section>
@endsection
