@extends("back_end.layout/main")
@section("content")
    @php
        $recordForCategoryEditPage = $pageData["category_data"];
        $listCategoryInSelectOption = $pageData["category_record"];
    @endphp
    <div class="row">
        <div class="col-md-6 col-sm-6"></div>
        <div class="col-md-6 col-sm-6 text-right">
            <div class="btn-group">
                <a href="{{route('category-list')}}">
                    <button id="sample_editable_1_new" class="btn green">
                        Category List
                    </button>
                </a>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <form action="{{route("category-update",["id"=>$recordForCategoryEditPage->id])}}" method="post"
                  class="form-horizontal">
                {{csrf_field()}}
                @if(Session::has('alert-update-category'))
                    {!!Session::get('alert-update-category')!!}
                @endif
                <div class="form-group">
                    <label class="col-md-3 control-label">Title*</label>
                    <div class="col-md-4">
                        <input type="text" name="category_name"
                               value="{{isset($recordForCategoryEditPage->id) && !empty($recordForCategoryEditPage->id )
                           ? $recordForCategoryEditPage->category_name : old("category_name")}}"
                               class="form-control"
                               placeholder="Example: Category name">
                        @if($errors->has("category_name"))
                            <span class="text-danger" role="alert">{{ $errors->first('category_name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Slug*</label>
                    <div class="col-md-4">
                        <input type="text" name="slug"
                               value="{{isset($recordForCategoryEditPage->id) && !empty($recordForCategoryEditPage->id )
                           ? $recordForCategoryEditPage->category_name : old("slug")}}"
                               class="form-control"
                               placeholder="Example: Category-name">
                        @if($errors->has("slug"))
                            <span class="text-danger" role="alert">{{ $errors->first('slug') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Parent Category*</label>
                    <div class="col-md-4">
                        <select name="parent_id" class="form-control">
                            <option value="0"> --Parent--</option>
                            @foreach($listCategoryInSelectOption as $item)
                                <option value="{{$item->id}}" {{( $item->id == $recordForCategoryEditPage->parent_id) ? "selected" : ""}}>{{$item->category_name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has("parent_id"))
                            <span class="text-danger" role="alert">{{ $errors->first('parent_id') }}</span>
                        @endif()
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Status<span class="text-danger">*</span></label>
                    <div class="col-md-4">
                        <select name="status" class="form-control">
                            <option  value="1"> Active </option>
                            <option  value="0"> In Active </option>

                        </select>
                        @if($errors->has("parent_id"))
                            <span class="text-danger" role="alert">{{ $errors->first('parent_id') }}</span>
                        @endif()
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Icon</label>
                    <div class="col-md-4">
                        <input type="text" name="icon"
                               value="{{isset($recordForCategoryEditPage->id)&& !empty($recordForCategoryEditPage->id )
                           ? $recordForCategoryEditPage->icon : old("icon")}}"
                               class="form-control"
                               placeholder="Example: fa fa icon">
                        @if($errors->has("icon"))
                            <span class="text-danger" role="alert">{{ $errors->first('icon') }}</span>
                        @endif()
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Description</label>
                    <div class="col-md-4">
                    <textarea name="description"
                              value=""
                              class="form-control"
                              placeholder="Example: description about Category"
                              style="resize: none ; height: 150px">{{isset($recordForCategoryEditPage->id) && !empty($recordForCategoryEditPage->id)
                              ? $recordForCategoryEditPage->description : old("description")}}</textarea>
                        @if($errors->has("description"))
                            <span class="text-danger" role="alert">{{ $errors->first('description')}}</span>
                        @endif()
                    </div>
                </div>
                <div class="form-actions fluid">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn blue">Save</button>
                        <button type="reset" class="btn default">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

