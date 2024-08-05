@extends('layouts.admin')

@section('event')
active
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Добавить событие</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Добавить событие</li>
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
            <form id="event-store" action="{{ route('admin.event.store') }}" method="post" enctype="multipart/form-data">
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
                    <label for="image" class="form-label">Загрузите картинку</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input class="custom-file-input image-input" accept="image/*" type="file" name="image" id="image">
                            <label class="custom-file-label" for="image">Выберите картинку</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Загрузите</span>
                        </div>
                    </div>
                    <div class="error invalid-feedback image"></div>
                </div>
                <div class="form-group">
                    <img width="auto" height="300px" id="image-preview" class="rounded mb-3 d-none" alt="image">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@include('includes.admin.crud-modals.crud-modals')

<div class="modal fade" id="success" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p>Добавление прошло успешно!</p>
            </div>
            <div class="modal-footer justify-content-between">
                <a href="{{ route('admin.event.index') }}" class="btn btn-default">Выйти</a>
                <a href="{{ route('admin.event.create') }}" class="btn btn-primary">Создать новый</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/event.js') }}"></script>
@endsection
