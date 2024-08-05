<div class="row" id="previews-containment">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-body" >
                <div class="row">
                    {{-- <div class="col-lg-6"> --}}
                        <div class="btn-group w-100" id="actions">
                            <span class="btn btn-success col fileinput-button">
                                <i class="fas fa-plus"></i>
                                <span>Add files</span>
                            </span>
                            <button type="reset" class="btn btn-warning col cancel">
                                <i class="fas fa-times-circle"></i>
                                <span>Cancel upload</span>
                            </button>
                        </div>
                    {{-- </div> --}}
                </div>
                <div class="table table-striped files" id="previews">
                    <div id="template" class="row mt-2">
                        <div class="col-auto">
                            <span class="grab preview" style="cursor: grab"><img src="data:," alt="" data-dz-thumbnail /></span>
                        </div>
                        <div class="col d-flex align-items-center">
                            <p class="mb-0">
                                <span class="lead" data-dz-name></span>
                                (<span data-dz-size></span>)
                            </p>
                            <strong class="error text-danger" data-dz-errormessage></strong>
                        </div>
                        <div class="col-auto d-flex align-items-center">
                            <div class="mr-3">
                                <input type="text" name="alt_ru" class="form-control" title="alt заголовок (РУ)" placeholder="alt заголовок (РУ)">
                                <div class="error invalid-feedback new_images_i_alt_ru"></div>
                            </div>
                            <div>
                                <input type="text" name="alt_tt" class="form-control" title="alt заголовок (ТАТ)" placeholder="alt заголовок (ТАТ)">
                                <div class="error invalid-feedback new_images_i_alt_tt"></div>
                            </div>
                            
                        </div>
                        <div class="col-auto d-flex align-items-center">
                            <div class="btn-group">
                                <button data-dz-remove class="btn btn-warning cancel">
                                    <i class="fas fa-times-circle"></i>
                                    <span>Cancel</span>
                                </button>
                                <button data-dz-remove class="btn btn-danger delete">
                                    <i class="fas fa-trash"></i>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>