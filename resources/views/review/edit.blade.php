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
                <h1 class="m-0">Редактировать отзыв</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Редактировать отзыв</li>
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
            <form id="review-update" action="{{ route('admin.review.update', $review->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="author_ru" class="form-label">Автор (РУ)</label>
                    <input type="text" name="author_ru" id="author_ru" class="form-control" value="{{ $review->author_ru }}" placeholder="Автор (РУ)">
                    <div class="error invalid-feedback author_ru"></div>
                </div>
                <div class="form-group">
                    <label for="author_tt" class="form-label">Автор (ТАТ)</label>
                    <input type="text" name="author_tt" id="author_tt" class="form-control" value="{{ $review->author_tt }}" placeholder="Автор (ТАТ)">
                    <div class="error invalid-feedback author_tt"></div>
                </div>

                <div class="form-group">
                    <label for="text_ru" class="form-label">Текст (РУ)</label>
                    <textarea id="text_ru" name="text_ru" class="form-control" placeholder="Текст (РУ)">{{ $review->text_ru }}</textarea>
                    <div class="error invalid-feedback text_ru"></div>
                </div>
                <div class="form-group">
                    <label for="text_tt" class="form-label">Текст (ТАТ)</label>
                    <textarea id="text_tt" name="text_tt" class="form-control" placeholder="Текст (ТАТ)">{{ $review->text_tt }}</textarea>
                    <div class="error invalid-feedback text_tt"></div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </div>
            </form>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@include('includes.admin.crud-modals.crud-modals')  

<div class="modal fade" id="success" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p>Изменения сохранены!</p>
            </div>
            <div class="modal-footer justify-content-between">
                <a href="{{ route('admin.review.index') }}" class="btn btn-default">Выйти</a>
                <a href="{{ route('admin.review.edit', $review->id) }}" class="btn btn-primary">Остаться</a>
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
