@extends('layouts.admin')

@section('review')
active
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Добавить отзыв</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Добавить отзыв</li>
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
            <form id="review-store" action="{{ route('admin.review.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="author_ru" class="form-label">Автор (РУ)</label>
                    <input type="text" name="author_ru" id="author_ru" class="form-control" placeholder="Автор (РУ)">
                    <div class="error invalid-feedback author_ru"></div>
                </div>
                <div class="form-group">
                    <label for="author_tt" class="form-label">Автор (ТАТ)</label>
                    <input type="text" name="author_tt" id="author_tt" class="form-control" placeholder="Автор (ТАТ)">
                    <div class="error invalid-feedback author_tt"></div>
                </div>

                <div class="form-group">
                    <label for="text_ru" class="form-label">Текст (РУ)</label>
                    <textarea id="text_ru" name="text_ru" class="form-control" placeholder="Текст (РУ)"></textarea>
                    <div class="error invalid-feedback text_ru"></div>
                </div>
                <div class="form-group">
                    <label for="text_tt" class="form-label">Текст (ТАТ)</label>
                    <textarea id="text_tt" name="text_tt" class="form-control" placeholder="Текст (ТАТ)"></textarea>
                    <div class="error invalid-feedback text_tt"></div>
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
                <a href="{{ route('admin.review.index') }}" class="btn btn-default">Выйти</a>
                <a href="{{ route('admin.review.create') }}" class="btn btn-primary">Создать новый</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/review.js') }}"></script>
@endsection
