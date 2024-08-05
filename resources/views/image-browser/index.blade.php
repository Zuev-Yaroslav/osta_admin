<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Изображения</title>
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
</head>
<body>
    <div class="container">
        <div class="row mb-5">
            <input type="hidden" id="CKEditorFuncNum" value="{{ request()->get('CKEditorFuncNum') }}">
            <form id="text-image-store" action="{{ route('admin.textImage.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group">
                    <label for="alt_ru" class="form-label">Заголовок (РУ)</label>
                    <input type="text" name="alt_ru" id="alt_ru" class="form-control" placeholder="Заголовок (РУ)">
                    <div class="error invalid-feedback alt_ru"></div>
                </div>
                <div class="form-group">
                    <label for="alt_tt" class="form-label">Заголовок (ТАТ)</label>
                    <input type="text" name="alt_tt" id="alt_tt" class="form-control" placeholder="Заголовок (ТАТ)">
                    <div class="error invalid-feedback alt_tt"></div>
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
        <div class="row">
            <button id="SelectPossible" type="button" class="btn btn-outline-primary m-3">Множественный выбор</button>
            <button id="DeleteImage" type="button" class="btn btn-danger m-3 d-none">Удалить навсегда</button>
        </div>
        <div class="row">
            @foreach ($images as $image)
            <div class="m-3">
                <h6>{{ $image->alt_ru }}</h6>
                <div class="mb-2 position-relative img-div">
                    <img width="300" height="auto" src="{{ $image->getImageUrl() }}" alt="{{ $image->alt_ru }}">
                    <div class="position-absolute" style="top: -5%; left:95%">
                        <div class="icheck-primary d-none">
                            <input class="select-img" data-delete-url="{{ route('admin.textImage.delete', $image->id) }}" type="checkbox" id="image-check{{ $image->id }}" value="{{ $image->id }}">
                            <label class="bg-white" for="image-check{{ $image->id }}"></label>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-block choose-image-btn" onclick="selectImage(event, '{{ $image->getImageUrl() }}')">Выбрать</button>
                <button data-toggle="modal" data-target="#image{{ $image->id }}" class="btn btn-primary btn-block edit-image-btn">Изменить</button>
            </div>
            <div class="modal fade" id="image{{ $image->id }}">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Информация о фотографии</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="text-image-update" method="POST" action="{{ route('admin.textImage.update', $image->id) }}">
                            @csrf
                            @method('put')
                            <div class="modal-body p-4">
                                <div class="mb-3">
                                    <img src="{{ $image->getImageUrl() }}" alt="{{ $image->alt_ru }}" class="rounded" width="100%" height="10%">
                                </div>
                                <div class="mb-3">
                                    <label>Alt заголовок</label>
                                    <input type="text" class="form-control" name="alt_ru" value="{{ $image->alt_ru }}">
                                    <div class="invalid-feedback alt_ru error"></div>
                                </div>
                                <div class="mb-3">
                                    <label>Alt заголовок</label>
                                    <input type="text" class="form-control" name="alt_tt" value="{{ $image->alt_tt }}">
                                    <div class="invalid-feedback alt_tat error"></div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-end">
                                <button type="submit" class="btn btn-default">Cохранить</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            @endforeach
        </div>
        {{-- @if(method_exists($images, 'links')) --}}
        {{ $images->withQueryString()->links('vendor.pagination.bootstrap-4') }}
        {{-- @endif --}}
    </div>
    <div class="modal fade" id="loading" data-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="overlay">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <div class="modal-body p-5">
    
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.content -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/text-image.js') }}"></script>
    <script>
        var CKEditorFuncNum = document.getElementById('CKEditorFuncNum').value;

        function selectImage(e, url) {
            e.preventDefault();
            if (CKEditorFuncNum) {
                window.opener.CKEDITOR.tools.callFunction(CKEditorFuncNum, url);
                window.close();
            }
        }

    </script>
</body>
</html>
