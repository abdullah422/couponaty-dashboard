@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('coupons.coupons')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.coupons.index') }}">@lang('coupons.coupons')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">
                <form method="post" action="{{ route('admin.coupons.update', $coupon->id)}}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('admin.partials._errors')
                    <div class="row">
                        <div class="col-md-6">
                            {{--category--}}
                            <div class="form-group">
                                <label>@lang('coupons.category')<span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control">
                                    <option value="{{$coupon->category->id}}">{{$coupon->category->name}}</option>--}}
                                    @foreach($categories as $category)
                                        @if($coupon->category->id==$category->id)
                                        @else
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            {{--brand--}}
                            <div class="form-group">
                                <label>@lang('coupons.brand')<span class="text-danger">*</span></label>
                                <select name="brand_id" class="form-control">
                                    <option value="{{$coupon->brand->id}}">{{$coupon->brand->name}}</option>--}}
                                    @foreach($brands as $brand)
                                        @if($coupon->brand->id==$brand->id)
                                        @else
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            {{--title--}}
                            <div class="form-group">
                                <label>@lang('coupons.title')<span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $coupon->title) }}" required autofocus>
                            </div>
                            {{--des--}}
                            <div class="form-group">
                                <label>@lang('coupons.des')<span class="text-danger">*</span></label>
                                <input type="text" name="des" class="form-control" value="{{ old('title', $coupon->des) }}" required autofocus>
                            </div>

                        </div><!-- end of column -->

                        <div class="col-md-6">
                            {{--code--}}
                            <div class="form-group">
                                <label>@lang('coupons.code')  <span class="text-danger">*</span></label>
                                <input type="text" name="code" class="form-control"  maxlength="10" value="{{old('code',$coupon->code)}}"  >
                            </div>
                            {{--url--}}
                            <div class="form-group">
                                <label>@lang('coupons.url')  <span class="text-danger">*</span></label>
                                <textarea  type="text" name="url" class="form-control" aria-label="With textarea" > {{old('url',$coupon->url)}}</textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.update')</button>
                            </div>
                        </div><!-- end of column -->

                    </div><!-- end of row -->

                </form
                ><!-- end of form -->
            </div><!-- end of tile -->

        </div><!-- end of col -->


    </div><!-- end of row -->

@endsection

