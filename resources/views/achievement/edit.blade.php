@extends('layouts.admin')

@section('achievement')
active
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Редактировать достижение</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Редактировать достижение</li>
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
            <form id="achievement-update" action="{{ route('admin.achievement.update', $achievement->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="text_ru" class="form-label">Текст (РУ)</label>
                    <textarea id="text_ru" name="text_ru" class="form-control" placeholder="Текст (РУ)">{{ $achievement->text_ru }}</textarea>
                    <div class="error invalid-feedback text_ru"></div>
                </div>
                <div class="form-group">
                    <label for="text_tt" class="form-label">Текст (ТАТ)</label>
                    <textarea id="text_tt" name="text_tt" class="form-control" placeholder="Текст (ТАТ)">{{ $achievement->text_tt }}</textarea>
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
                </div>
                <div class="error invalid-feedback image"></div>
                <div class="form-group">
                    <img width="auto" height="300px" id="image-preview" src="{{ $achievement->getImageUrl() }}" class="rounded mb-3" alt="image">
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
                <a href="{{ route('admin.achievement.index') }}" class="btn btn-default">Выйти</a>
                <a href="{{ route('admin.achievement.edit', $achievement->id) }}" class="btn btn-primary">Остаться</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/achievement.js') }}"></script>
@endsection
