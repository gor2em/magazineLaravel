@include('admin.header')

@include("admin.sidebar")

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $page_title }}</h2>
            </div>
            <div>

                <?php if($row): ?>
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
                        <label for="title" class="col-sm-2 col-form-label">Category Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Title" name="category" autofocus
                                value="{{ $row->category }}">
                        </div>
                    </div>

                    @csrf
                    <a href="{{ url('admin/categories') }}">
                        <input type="button" name="" id="" class="btn btn-secondary" value="Back">
                    </a>
                    <input type="submit" name="" id="" class="btn btn-success" value="Update">
                </form>
                <?php else: ?>
                <div class="alert alert-warning">Sorry, we could not find that Category</div>
                <?php endif; ?>
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

