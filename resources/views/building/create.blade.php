@extends('layouts.admin')

@section('building')
active
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Добавить постройку</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Добавить постройку</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <form id="building-store" action="{{ route('admin.building.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title_ru" class="form-label">Заголовок (РУ)</label>
                    <input type="text" name="title_ru" id="title_ru" class="form-control" placeholder="Заголовок (РУ)">
                    <div class="error invalid-feedback title_ru"></div>
                </div>
                <div class="form-group">
                    <label for="title_tt" class="form-label">Заголовок (ТАТ)</label>
                    <input type="text" name="title_tt" id="title_tt" class="form-control" placeholder="Заголовок (ТАТ)">
                    <div class="error invalid-feedback title_tt"></div>
                </div>

                <div class="form-group">
                    <label for="text_ru" class="form-label">Контент (РУ)</label>
                    <textarea id="text_ru" class="editor"></textarea>
                    <div class="error invalid-feedback text_ru"></div>
                </div>
                <div class="form-group">
                    <label for="text_tt" class="form-label">Контент (ТАТ)</label>
                    <textarea id="text_tt" class="editor"></textarea>
                    <div class="error invalid-feedback text_tt"></div>
                </div>
                <div class="form-group">
                    <label for="compatibility" class="form-label">Вместимость</label>
                    <input type="number" name="compatibility" id="compatibility" class="form-control" placeholder="Вместимость">
                    <div class="error invalid-feedback compatibility"></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Этап разработки</label>
                    <select name="development_id" id="development_id" class="custom-select">
                        @foreach ($developments as $development)
                            <option value="{{ $development->id }}">{{ $development->name_ru }}</option>
                        @endforeach
                    </select>
                    <div class="error invalid-feedback development_id"></div>
                </div>
                @include('includes.admin.building.dropzone-images')
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<div class="modal fade" id="success" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p>Добавление прошло успешно!</p>
            </div>
            <div class="modal-footer justify-content-between">
                <a href="{{ route('admin.building.index') }}" class="btn btn-default">Выйти</a>
                <a href="{{ route('admin.building.create') }}" class="btn btn-primary">Создать новый</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@include('includes.admin.crud-modals.crud-modals')


@endsection

@section('scripts')
<script src="{{ asset('js/building.js') }}"></script>
@endsection
