@extends('layouts.admin.app')

@section('title', 'Product Details')

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card card-solid mt-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h3 class="d-inline-block d-sm-none">{{ $product->product_name }}</h3>
                        <div class="col-12">
                            <img src="{{ $product->thumb->image_path }}" class="product-image" alt="Product Image" style="width: 100%; max-height: 40vh">
                        </div>
                        <div class="col-12 product-image-thumbs">
                            @foreach($product->attachments as $attachment)
                            <div class="product-image-thumb {{ $loop->first? 'active': '' }}"><img src="{{ $attachment->image_path }}" alt="Product Image" style="width: 100%; max-height: 5rem"></div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3 text-capitalize">{{ $product->product_name }}</h3>
                        <hr>
                        <h4>Using Language</h4>
                        @if(!empty($product->languages) && count($product->languages) > 0)
                            @foreach($product->languages as $language)
                                <label class="btn btn-default text-center">
                                    {{ $language->lang_name }}
                                </label>
                            @endforeach
                        @else
                            <p class="text-info text-bold">No Language Added</p>
                        @endif

                        <h4 class="mt-3">Product Tags</h4>
                        @if(!empty($product->tags) && count($product->tags) > 0)
                            @foreach($product->tags as $tag)
                                <label class="btn btn-default text-center">
                                    {{ $tag->tag_name }}
                                </label>
                            @endforeach
                        @else
                            <p class="text-info text-bold">No Tag Added</p>
                        @endif

                        <div class="bg-gray py-2 px-3 mt-4">
                            <h2 class="mb-0">
                               TK. {{ $product->product_price }}
                            </h2>
                        </div>
                        <div class="mt-4 product-share">
                            <a href="#" class="text-gray">
                                <i class="fab fa-facebook-square fa-2x"></i>
                            </a>
                            <a href="#" class="text-gray">
                                <i class="fab fa-twitter-square fa-2x"></i>
                            </a>
                            <a href="#" class="text-gray">
                                <i class="fas fa-envelope-square fa-2x"></i>
                            </a>
                            <a href="#" class="text-gray">
                                <i class="fas fa-rss-square fa-2x"></i>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="row mt-4">
                    <nav class="w-100">
                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                            <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                            <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-feature" role="tab" aria-controls="product-feature" aria-selected="false">Features</a>
                            <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-meta" role="tab" aria-controls="product-meta" aria-selected="false">Meta Data</a>
                        </div>
                    </nav>
                    <div class="tab-content p-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                            {!! $product->product_details !!}
                        </div>
                        <div class="tab-pane fade" id="product-feature" role="tabpanel" aria-labelledby="product-feature-tab">
                            {!! $product->product_features !!}
                        </div>
                        <div class="tab-pane fade" id="product-meta" role="tabpanel" aria-labelledby="product-meta-tab">
                            {!! $product->product_meta !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
