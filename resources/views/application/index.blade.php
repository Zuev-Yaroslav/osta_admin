@extends('layouts.admin')
@section('application')
active
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Заявки</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Заявки</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="row">
        <!-- /.col -->
        {{-- <div class="col-md-9"> --}}
        <div class="card card-primary card-outline m-3" style="width: 95%">
            <div class="card-header">
                <h3 class="card-title">Письма</h3>

                {{-- <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Search Mail">
                                <div class="input-group-append">
                                    <div class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                    </button>
                    <div class="btn-group">
                        <form method="post" class="application-delete">
                            @csrf
                            @method('delete')
                            {{-- @isset($_GET['page'])
                                        <input type="hidden" name="page" value="{{ $_GET['page'] }}">
                            @endisset --}}
                            <button type="submit" class="btn btn-default btn-sm">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                    <!-- /.btn-group -->
                    <button type="button" class="btn btn-default btn-sm">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                    {{ $applications->links('vendor.pagination.mailbox') }}
                    <!-- /.float-right -->
                </div>
                <div class="table-responsive mailbox-messages">
                    @include('includes.admin.application.list')
                </div>
                <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
                <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                        <i class="far fa-square"></i>
                    </button>
                    <div class="btn-group">
                        <form class="application-delete" method="post">
                            @csrf
                            @method('delete')
                            {{-- @isset($_GET['page'])
                                        <input type="hidden" name="page" value="{{ $_GET['page'] }}">
                            @endisset --}}
                            <button type="submit" class="btn btn-default btn-sm">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                    <!-- /.btn-group -->
                    <button type="button" class="btn btn-default btn-sm">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                    {{ $applications->links('vendor.pagination.mailbox') }}
                    <!-- /.float-right -->
                </div>
            </div>
        </div>
        <!-- /.card -->
        {{-- </div> --}}
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>


@endsection
@section('scripts')
<script src="{{ asset('js/admin.js') }}"></script>
<script src="{{ asset('js/application.js') }}"></script>
<script>
    // $(document).on('click', '.selected', function() {
    //     if ($(this).prev().prop('checked') == true) {
    //         $(this).parent().next().prop('checked', false)
    //     } else {
    //         $(this).parent().next().prop('checked', true)
    //     }
    // })

</script>
@endsection
