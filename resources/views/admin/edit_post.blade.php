@include('admin.header')
<link href="{{ url('summernote/summernote-lite.min.css') }}" rel="stylesheet" />

@include("admin.sidebar")

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $page_title }}</h2>
            </div>
            <div>
                <form class="container-fluid col-lg-12" method="post" enctype="multipart/form-data">
                    @if ($errors->all())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <span style="color:red">
                                    {{ $error }}<br />
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Post Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Title" name="title" autofocus
                                value="{{ $row->title }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="file" class="col-sm-2 col-form-label">Featured Image</label>
                        <div class="col-sm-10">
                            <input type="file" id="file" class="form-control" name="file">
                            <img src="{{ url('uploads/' . $row->image) }}" alt="" width="150" height="150">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category_id" class="col-sm-2 col-form-label">Post Category</label>
                        <div class="col-sm-10">
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="{{ $row->category_id }}">{{ $category->category }}</option>
                            </select>
                        </div>
                    </div>

                    @csrf
                    <h4>Post Content</h4>
                    <textarea id="summernote" name="content">{{ $row->content }}</textarea>
                    <a href="{{ url('admin/posts') }}">
                        <input type="button" name="" id="" class="btn btn-secondary" value="Back">
                    </a>
                    <input type="submit" name="" id="" class="btn btn-success" value="Save">
                </form>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />

        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>

@include('admin.footer')
<script src="{{ url('summernote/summernote-lite.min.js') }}"></script>

<script>
    $(function() {
        $('#summernote').summernote({
            height: 400
        });
    })
</script>
