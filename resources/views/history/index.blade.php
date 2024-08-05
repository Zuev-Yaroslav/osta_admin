@extends('layouts.admin')

@section('history')
active
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Туган як</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Туган як</li>
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
            <form id="history-update" action="{{ route('admin.history.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title_ru" class="form-label">Заголовок (РУ)</label>
                    <input type="text" name="title_ru" id="title_ru" class="form-control" placeholder="Заголовок (РУ)" value="{{ $history->title_ru }}">
                    <div class="error invalid-feedback title_ru"></div>
                </div>
                <div class="form-group">
                    <label for="title_tt" class="form-label">Заголовок (ТАТ)</label>
                    <input type="text" name="title_tt" id="title_tt" class="form-control" placeholder="Заголовок (ТАТ)" value="{{ $history->title_tt }}">
                    <div class="error invalid-feedback title_tt"></div>
                </div>

                <div class="form-group">
                    <label for="text_ru" class="form-label">Контент (РУ)</label>
                    <textarea id="text_ru" class="editor">{{ $history->text_ru }}</textarea>
                    <div class="error invalid-feedback text_ru"></div>
                </div>
                <div class="form-group">
                    <label for="text_tt" class="form-label">Контент (ТАТ)</label>
                    <textarea id="text_tt" class="editor">{{ $history->text_tt }}</textarea>
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
                <a href="{{ route('admin.history.index') }}" class="btn btn-primary">Остаться</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/history.js') }}"></script>
@endsection
