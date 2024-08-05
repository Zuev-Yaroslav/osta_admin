@extends('layouts.admin')

@section('mosque-history')
active
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Добавить историю мечети</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Добавить историю мечети</li>
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
            <form id="mosque-history-store" action="{{ route('admin.mosque-history.store') }}" method="post" enctype="multipart/form-data">
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
                    <label for="text_ru" class="form-label">Текст (РУ)</label>
                    <textarea id="text_ru" name="text_ru" class="form-control"></textarea>
                    <div class="error invalid-feedback text_ru"></div>
                </div>
                <div class="form-group">
                    <label for="text_tt" class="form-label">Текст (ТАТ)</label>
                    <textarea id="text_tt" name="text_tt" class="form-control"></textarea>
                    <div class="error invalid-feedback text_tt"></div>
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
                <a href="{{ route('admin.mosque-history.index') }}" class="btn btn-default">Выйти</a>
                <a href="{{ route('admin.mosque-history.create') }}" class="btn btn-primary">Создать новый</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@include('includes.admin.crud-modals.crud-modals')


@endsection

@section('scripts')
<script src="{{ asset('js/mosque-history.js') }}"></script>
@endsection
