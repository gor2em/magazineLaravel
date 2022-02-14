@include('admin.header')

@include("admin.sidebar")

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $page_title }}</h2>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Featured Image</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($rows)
                        @foreach ($rows as $row)
                            <tr>
                                <td>{{ $row->title }}</td>
                                <td>{{ $row->content }}</td>
                                <td><img src="{{ url('uploads/'.$row->image) }}" alt="" style="width:150px;height:150px"></td>
                                <td>{{ $row->created_at }}</td>
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
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
